@extends("master.main")

@section("title","Tambah Vendor")

@section("content")

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        <a href="{{route('vendor.index')}}"> Daftar Vendor </a>  &nbsp;> Tambah
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-4">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('vendor.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="small mb-1">Nama Vendor </label> <label class="small mb-1" style="color:red">*</label>
                                    <input name="name" required="true" value="{{ old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                                    @if ($errors->has('name'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Alamat Vendor </label>
                                    <textarea name="address" rows="4" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">{{ old('address') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">No. Telepon </label>
                                    <input name="no_telp" value="{{ old('no_telp') }}" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" type="number"/>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Alamat Email </label>
                                    <input name="email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"/>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Nama PIC </label>
                                    <input name="pic_name" value="{{ old('pic_name') }}" class="form-control{{ $errors->has('pic_name') ? ' is-invalid' : '' }}" type="text"/>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="small mb-1">Bidang Usaha</label>
                                    <select class="form-control select2" name="category_id[]" multiple="" style="width:100%">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Nomor Rekening </label>
                                    <input name="no_rek" value="{{ old('no_rek') }}" class="form-control{{ $errors->has('no_rek') ? ' is-invalid' : '' }}" type="number"/>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Nama Bank </label>
                                    <input name="bank_name" value="{{ old('bank_name') }}" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1"> NPWP / TIN (Tax Identification Number) </label>
                                    <input name="no_tax" value="{{ old('no_tax') }}" class="form-control{{ $errors->has('no_tax') ? ' is-invalid' : '' }}" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Afiliasi Pertamina</label>
                                    <input name="afiliasi" style="width:20px" value="1" class="form-control{{ $errors->has('afiliasi') ? ' is-invalid' : '' }}" type="checkbox"/>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary float-right" type="submit">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-light float-right" style="margin-right:10px">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection