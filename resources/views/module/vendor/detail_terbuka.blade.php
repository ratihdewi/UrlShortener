@extends("master.main")

@section("title","Detail Vendor")

@section("content")

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        <a href="{{route('vendor.terbuka.index')}}"> Daftar Vendor Tender Terbuka </a>  &nbsp;> Detail
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container mt-4">
    @include('partial.alert')
    <form method="POST" action="" id="formDetail">
    @csrf
    {{ method_field('PUT') }}
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <!-- Form Group (username)-->
                                <div class="form-group">
                                    <label class="small mb-1">Nama Vendor </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="name" required="true" value="{{ $vendor->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/ readonly>
                                    @if ($errors->has('name'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Alamat Vendor </label><label class="small mb-1" style="color:red">*</label>
                                    <textarea name="address" rows="4" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" readonly>{{ $vendor->address }}</textarea>
                                    @if ($errors->has('address'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">No. Telepon </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="no_telp" required="true" value="{{ $vendor->no_telp }}" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" type="number" readonly />
                                    @if ($errors->has('no_telp'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('no_telp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Alamat Email </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="email" required="true" value="{{ $vendor->email }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" readonly />
                                    @if ($errors->has('email'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Nama PIC </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="pic_name" required="true" value="{{ $vendor->pic_name }}" class="form-control{{ $errors->has('pic_name') ? ' is-invalid' : '' }}" type="text" readonly />
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
                                    <select class="form-control select2" disabled multiple="" style="width:100%">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if(in_array($category->id, $vendor->categories->pluck('category_id')->toArray())) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="tersembunyi">
                                    <label class="small mb-1">Bidang Usaha</label>
                                    <select class="form-control select2" name="category_id[]" multiple="" style="width:100%">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if(in_array($category->id, $vendor->categories->pluck('category_id')->toArray())) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Nomor Rekening </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="no_rek" required="true" value="{{ $vendor->no_rek }}" class="form-control{{ $errors->has('no_rek') ? ' is-invalid' : '' }}" type="number" readonly />
                                    @if ($errors->has('no_rek'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('no_rek') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Nama Bank </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="bank_name" required="true" value="{{ $vendor->bank_name }}" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" type="text" readonly />
                                    @if ($errors->has('bank_name'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1"> NPWP / TIN (Tax Identification Number) </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="no_tax" required="true" value="{{ $vendor->no_tax }}" class="form-control{{ $errors->has('no_tax') ? ' is-invalid' : '' }}" type="text" readonly />
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
                                    <input  name="afiliasi" style="width:20px" @if($vendor->afiliasi==1) checked @endif value="1" class="form-control{{ $errors->has('afiliasi') ? ' is-invalid' : '' }}" type="checkbox" disabled/>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('vendor.terbuka.index') }}" class="btn btn-light float-right" style="margin-right:10px">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-danger float-left" id="btn-tolak-vendor"> Rejected </button>
        <button class="btn btn-primary float-right" id="btn-terima-vendor"> Approve </button>
    </form>
</div>

@include('module.vendor.js')

<script type="text/javascript">
    
    $('#tersembunyi').hide();


    $('#btn-terima-vendor').click(function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Apakah Anda yakin ingin disimpan?',
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
                $('#formDetail').attr('action', "{{ route('vendor.terbuka.approve', [$vendor]) }}");
                document.getElementById('formDetail').submit();
            }
        });
    });


    $('#btn-tolak-vendor').click(function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Data yang sudah direject tidak dapat dikembalikan lagi.',
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
                $('#formDetail').attr('action', "{{ route('vendor.terbuka.reject', [$vendor]) }}");
                document.getElementById('formDetail').submit();
                    
            }
        });
        
    });

</script>

@endsection