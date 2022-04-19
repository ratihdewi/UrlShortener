@extends("master.main")

@section("title", "Detail Deleted")

@section("content")

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        <a href="{{route('vendor.deleted.index')}}"> Daftar Vendor (Terhapus) </a>  &nbsp;> Detail Deleted
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-4" id="contentDelete">
    @include('partial.alert')
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-body">
                    <form>
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-xl-6">
                                <!-- Form Group (username)-->
                                <div class="form-group">
                                    <label class="small mb-1">Nama Vendor </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="name" required="true" value="{{ $vendor->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                                    @if ($errors->has('name'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Alamat Vendor </label><label class="small mb-1" style="color:red">*</label>
                                    <textarea name="address" rows="4" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">{{ $vendor->address }}</textarea>
                                    @if ($errors->has('address'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">No. Telepon </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="no_telp" required="true" value="{{ $vendor->no_telp }}" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" type="number"/>
                                    @if ($errors->has('no_telp'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('no_telp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Alamat Email </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="email" required="true" value="{{ $vendor->email }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"/>
                                    @if ($errors->has('email'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Nama PIC </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="pic_name" required="true" value="{{ $vendor->pic_name }}" class="form-control{{ $errors->has('pic_name') ? ' is-invalid' : '' }}" type="text"/>
                                    @if ($errors->has('pic_name'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('pic_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="small mb-1">Bidang Usaha</label>
                                    <select id="catId" class="form-control select2" name="category_id[]" multiple="" style="width:100%">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if(in_array($category->id, $vendor->categories->pluck('category_id')->toArray())) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Nomor Rekening </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="no_rek" required="true" value="{{ $vendor->no_rek }}" class="form-control{{ $errors->has('no_rek') ? ' is-invalid' : '' }}" type="number"/>
                                    @if ($errors->has('no_rek'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('no_rek') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Nama Bank </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="bank_name" required="true" value="{{ $vendor->bank_name }}" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" type="text"/>
                                    @if ($errors->has('bank_name'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1"> NPWP / TIN (Tax Identification Number) </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="no_tax" required="true" value="{{ $vendor->no_tax }}" class="form-control{{ $errors->has('no_tax') ? ' is-invalid' : '' }}" type="text"/>
                                    @if ($errors->has('no_tax'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('no_tax') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1"> Penilaian </label><br>
                                    <div class="rateit" data-rateit-value="{{$vendor->score}}" style="font-family:fontawesome" data-rateit-resetable="false" data-rateit-readonly="true"></div>
                                    {{$vendor->score}}/5
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Afiliasi </label>
                                    <input name="afiliasi" style="width:20px" @if($vendor->afiliasi==1) checked @endif value="1" class="form-control{{ $errors->has('afiliasi') ? ' is-invalid' : '' }}" type="checkbox"/>
                                </div>
                            </div>
                        </div>
                        <div id="listBtn">
                            <button class="btn btn-primary float-right" type="submit">Simpan</button>
                            <a href="{{ url()->previous() }}" class="btn btn-light float-right" style="margin-right:10px">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Account page navigation-->
    <ul class="nav nav-borders" role="tablist">
        <li class="nav-item">
            <a class="nav-link @if(!session('tabfile')) active @endif" href="#review" role="tab" data-toggle="tab">Review</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(session('tabfile')) active @endif" href="#file" role="tab" data-toggle="tab">File</a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane @if(session('tabfile')) fade show active @endif" id="file">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <button id="unggahFile" class="btn btn-sm btn-success float-right" style="margin-left:10px" data-toggle="modal" data-target="#uploadFileModal">Unggah File</button>
                        </div>
                        <div class="card-body">
                            <div class="datatable">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>File</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vendor->files as $row)
                                            <tr>
                                                <td>{{$row->file}}<a href="{{route('procurement.file.download', [$row->id, 'vendorfile'])}}"><i data-feather="download"></i></a></td>
                                                <td>{{$row->keterangan}}</td>
                                                <td>
                                                    <a class="btn btn-hapus btn-sm btn-danger" href="{{route('vendor.delete.file', [$row])}}"><small>Hapus</small></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3"><center><i>Tidak ada data.</i></center></td>
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
        <div role="tabpanel" class="tab-pane @if(!session('tabfile')) fade show active @endif" id="review">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body">
                            <div class="datatable">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Score</th>
                                            <th>User</th>
                                            <th>Comment</th>
                                            <th>Spph</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vendor->scores as $row)
                                            <tr>
                                                <td>{{date('Y-m-d', strtotime($row->created_at))}}</td>
                                                <td><div class="rateit" data-rateit-value="{{$row->score}}" style="font-family:fontawesome" data-rateit-resetable="false" data-rateit-readonly="true"></div></td>
                                                <td>{{$row->user->name}}</td>
                                                <td>{{$row->comment}}</td>
                                                <td>@if($row->spph_id!=NULL) <a target="_blank" href="{{route('procurement.file.view', [$row->spph->id, 'spph'])}}"> {{$row->spph->no_spph}} </a> @endif</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2"><center><i>Tidak ada data.</i></center></td>
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
    </div>
    <button class="btn btn-danger float-left" id="btn-hapus-vendor">Hapus Vendor</button>
</div>

@include('module.vendor.input_file')
@include('module.vendor.js')

<form id="form-hapus-vendor" method="POST" action="{{route('vendor.delete', [$vendor])}}">
    @csrf
    {{ method_field('DELETE') }}
</form>

<script type="text/javascript">
    $('#btn-hapus-vendor').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi.',
            type: 'warning',
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Ya!',
            showCancelButton: true,
            cancelButtonText: 'Batal!',
            html: false,
            preConfirm: function() {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 50);
                });
            }
        }).then(function(result){
            if (result.value) {
                // form action delete
                document.getElementById('form-hapus-vendor').submit();
                    
            }
        });
    });



        $('input[name=name]').prop('disabled', true);
        $('textarea[name=address]').prop('disabled', true);
        $('input[name=no_telp]').prop('disabled', true);
        $('input[name=email]').prop('disabled', true);
        $('input[name=pic_name]').prop('disabled', true);
        $('select[id=catId]').prop('disabled', true);
        $('input[name=no_rek]').prop('disabled', true);
        $('input[name=bank_name]').prop('disabled', true);
        $('input[name=no_tax]').prop('disabled', true);
        $('input[name=afiliasi]').prop('disabled', true);

        $('#listBtn').hide();
        $('#btn-hapus-vendor').hide();
        $('#unggahFile').hide();



</script>


@endsection