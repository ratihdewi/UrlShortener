@extends("master.main")

@section("title","Tambah User")

@section("content")

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        <a href="{{route('master.user.index')}}"> Daftar User </a>  &nbsp;> Tambah
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
                    <form action="{{route('master.user.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <!-- Form Group (username)-->
                                <div class="form-group">
                                    <label class="small mb-1">Nama </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="name" required="true" value="{{ old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                                    @if ($errors->has('name'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Email </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="email" required="true" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"/>
                                    @if ($errors->has('email'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Password </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="password" required="true" value="{{ old('password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"/>
                                    @if ($errors->has('password'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Unit Kerja </label>
                                    <select class="form-control select2" name="unit_kerja">
                                        <option disabled selected value="-"> -- Pilih Opsi -- </option>
                                        @foreach ($organizations as $organization)
                                            <option value="{{ $organization['org_unit'] }}"> {{ $organization['org_unit'] }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="small mb-1">Username </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="username" required="true" value="{{ old('username') }}" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" type="text"/>
                                    @if ($errors->has('username'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Role</label>
                                    <select class="form-control" name="role_id">
                                        <option value="1">Super Admin</option>
                                        <option value="2">Manager Pengadaan</option>
                                        <option value="3">Staff Pengadaan</option>
                                        <option value="4">User</option>
                                        <option value="5">Pejabat</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Jabatan</label>
                                    <select class="form-control" name="jabatan_id">
                                        <option value="0">Tidak Ada</option>
                                        @foreach($jabatans as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary float-right" type="submit">Simpan</button>
                        <a href="{{ route('master.user.index') }}" class="btn btn-light float-right" style="margin-right:10px">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection