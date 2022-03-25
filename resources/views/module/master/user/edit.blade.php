@extends("master.main")

@section("title","Ubah User")

@section("content")

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        <a href="{{route('master.user.index')}}"> Daftar User </a>  &nbsp;> Ubah
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
                    <form action="{{route('master.user.update', [$user])}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-xl-6">
                                <!-- Form Group (username)-->
                                <div class="form-group">
                                    <label class="small mb-1">Nama </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="name" required="true" value="{{$user->name}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                                    @if ($errors->has('name'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Email </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="email" required="true" value="{{ $user->email }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"/>
                                    @if ($errors->has('email'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Password </label>
                                    <input name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Masukkan password apabila ingin diubah" autofocus/>
                                    @if ($errors->has('password'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="small mb-1">Username </label><label class="small mb-1" style="color:red">*</label>
                                    <input name="username" required="true" value="{{$user->username}}" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" type="text"/>
                                    @if ($errors->has('username'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Role</label>
                                    <select class="form-control" name="role_id">
                                        <option value="1" @if($user->role_id==1) selected @endif>Super Admin</option>
                                        <option value="2" @if($user->role_id==2) selected @endif>Manager Pengadaan</option>
                                        <option value="3" @if($user->role_id==3) selected @endif>Staff Pengadaan</option>
                                        <option value="4" @if($user->role_id==4) selected @endif>User</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Jabatan </label>
                                    <select class="form-control" name="jabatan_id">
                                        <option @if($user->jabatan_id==0) selected @endif value="0">Tidak Ada</option>
                                        @foreach($jabatans as $row)
                                            <option value="{{$row->id}}" @if($user->jabatan_id==$row->id) selected @endif>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="is_pengadaan" id="pdn" value="{{$user->is_pengadaan}}">
                        <button class="btn btn-primary float-right" type="submit">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-light float-right" style="margin-right:10px">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $('select[name=role_id]').on('change', function () {

        if (this.value == 4) {
            $('input[id=pdn]').prop('value', 0);
        }

        else {
            $('input[id=pdn]').prop('value', 1);
        }

    });


</script>

@endsection
