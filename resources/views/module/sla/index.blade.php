@extends("master.main")

@section("title","Daftar Sla")

@section("content")

<header class="page-header page-header-dark pb-10">
    <div class="container"><br>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-n10">
    @include('partial.alert')
    <ul class="nav nav-borders" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#tender" role="tab" data-toggle="tab">Tender</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#umk" role="tab" data-toggle="tab">UMK</a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade show active" id="tender">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <a class="btn btn-sm btn-success float-right" style="margin-left:10px" href="{{route('sla.export', [0])}}">Export</a>
                        </div>
                        <div class="card-body">
                            <div class="datatable">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nomor Memo</th>
                                            <th>Perihal</th>
                                            @foreach($master_sla_tender as $sla)
                                                <th>{{$sla->process}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($procs_tender as $proc)
                                            <tr @if($proc->status_caption=="Selesai") style="color:rgba(52, 152, 219);" @elseif($proc->status_caption=="Dibatalkan") style="color:rgba(192, 57, 43);" @endif>
                                                <td>{{$proc->tanggal_caption}}</td>
                                                <td>{{$proc->no_memo}}</td> 
                                                <td>{{$proc->name}}</td>
                                                @foreach($master_sla_tender as $sla)
                                                    <td>{{$sla->realisasi($proc->id, 0)}}</td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"><center><i>Tidak ada data.</i></center></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="umk">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                        <a class="btn btn-sm btn-success float-right" style="margin-left:10px" href="{{route('sla.export', [1])}}">Export</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nomor Memo</th>
                                        <th>Perihal</th>
                                        @foreach($master_sla_umk as $sla)
                                            <th>{{$sla->process}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($procs_umk as $proc)
                                            <tr @if($proc->status_caption=="Selesai") style="color:rgba(52, 152, 219);" @elseif($proc->status_caption=="Dibatalkan") style="color:rgba(192, 57, 43);" @endif>
                                                <td>{{$proc->tanggal_caption}}</td>
                                                <td>{{$proc->no_memo}}</td>
                                                <td>{{$proc->name}}</td>
                                                @foreach($master_sla_umk as $sla)
                                                    <td>{{$sla->realisasi($proc->id, 1)}}</td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"><center><i>Tidak ada data.</i></center></td>
                                            </tr>
                                        @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#dataTable').DataTable( {
            "ordering": false
        } );
    } );

</script>

@endsection