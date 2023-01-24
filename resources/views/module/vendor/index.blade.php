<?php 
    
    $segment = Request::segment(1);
    if ($segment == 'tenderterbuka-bidder') {
        $redirect = 'vendor.terbuka.detail';
    }
    else if ($segment == 'deleted-bidder') {
        $redirect = 'vendor.deleted.detail';
    }
    else {
        $redirect = 'vendor.edit';
    }
    function customOutput ($kalimat, $i) {
        if (strlen($kalimat) <= $i) {
            return $kalimat;
        }
        else {
            $y = substr($kalimat,0,$i) . '...';
            return $y;
        }
    }

    function isComplete ($vendor) {
        
        $res = true;
        foreach ($vendor->getFillable() as $keyword) {
            if (is_null($vendor->$keyword)) {
                $res = false;
                break;
            }
        }

        return $res;
    }
    
?>

@extends("master.main")

@section("title","Daftar Vendor")

@section("content")

<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container"><br>
    </div>
    <style>
    .checked {
        color: orange;
    }
    td span {
        font-size:8px;
    }
        </style>
</header>
<?php use App\Http\Controllers\VendorController; ?>
<!-- Main page content-->
<div class="container mt-n10">
    @include('partial.alert')
    <div class="card mb-4">
        <div class="card-header">
            Total Vendor: {{$vendors->count()}}
            @if ($segment == 'bidder-list')
                <a class="btn btn-sm btn-primary float-right" href="{{route('vendor.create')}}">
                    <i class="mr-1" data-feather="plus-square"></i>
                    Tambah Vendor
                </a>
                <a class="btn btn-sm btn-info float-right" style="margin-right:20px;" data-toggle="modal" data-target="#uploadModal" href="#">Import</a>
                <a class="btn btn-sm btn-secondary float-right"  style="margin-right:5px;"  href="{{route('vendor.export')}}">Export</a>
                <a class="btn btn-sm btn-warning float-right"  style="margin-right:5px;"  href="{{route('vendor.download.unfinished.data')}}"> Update Data </a>
            @endif
        </div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Vendor</th>
                            <th>Nama Vendor</th>
                            <th>Bidang Usaha</th>
                            <th>Nomor Telepon</th>
                            <th>PIC</th>
                            <th>Email</th>
                            <th>Last Update</th>
                            <th>Score</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        
                    </tfoot>
                    <tbody>
                        @forelse($vendors as $vendor) 

                        <?php $score= VendorController::getScore($vendor->id); ?>
                            <tr style="{{ isComplete ($vendor) ? '' : 'background-color: red; opacity: 75%; color: white'}}">   
                                <td>{{$vendor->no}}</td>
                                <td style="width:50px;">{{$vendor->name}}</td>
                                <td>
                                    @foreach($vendor->categories as $row) 
                                        @if($row->category()->exists())
                                        {{$row->category['name']}}{{ $loop->last ? '' : ',' }} 
                                        @endif
                                    @endforeach
                                </td> 
                                <td>{{$vendor->no_telp}}</td>
                                <td>{{$vendor->pic_name}}</td>
                                <td>{{customOutput($vendor->email, 30)}}</td>
                                <td>{{date('Y-m-d', strtotime($vendor->updated_at))}}</td>
                                {{--<td><div class="rateit" data-rateit-value="{{$vendor->score}}" style="font-family:fontawesome" data-rateit-resetable="false" data-rateit-readonly="true"></div></td>--}}
                                <td style="width:100px;">
                                    @for($i=1;$i <= $score ;$i++)
                                    <span class="fa fa-star checked"></span>
                                    @endfor
                                    @for($i=1;$i <= 5-$score ;$i++)
                                    <span class="fa fa-star"></span>
                                    @endfor
                                </td>

                                <td class="text-center">
                                    <div id="btnAction">
                                        <a href="{{route($redirect, [$vendor])}}" class="btn btn-light btn-sm"><small>Detail</small></a>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9"><center><i>Tidak ada data.</i></center></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('module.vendor.import_modal')

@endsection