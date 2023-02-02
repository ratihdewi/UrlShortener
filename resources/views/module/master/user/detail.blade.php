@extends("master.main")

@section("title","Detail User")

@section("content")

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        <a href="{{route('master.user.index')}}"> Daftar User </a>  &nbsp;> Detail
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-4">
    @include('partial.alert')
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1">Nama </label>
                                <h3 style="margin-left:10px;">{{$user->name}}</h3>
                            </div>
                            <div class="form-group mt-4">
                                <label class="small mb-1">Email </label>
                                <h3 style="margin-left:10px;">{{$user->email}}</h3>
                            </div>
                            <div class="form-group mt-4">
                                <label class="small mb-1">Unit Kerja </label>
                                <h3 style="margin-left:10px;">{{$user->unit_kerja}} </h3>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Username </label>
                                <h3 style="margin-left:10px;">{{$user->username}}</h3>
                            </div>
                            <div class="form-group mt-4">
                                <label class="small mb-1">Role</label>
                                <h3 style="margin-left:10px;">{{$user->role_caption}}</h3>
                            </div>
                            <div class="form-group mt-4">
                                <label class="small mb-1">Jabatan</label>
                                <h3 style="margin-left:10px;">{{ ($user->jabatan_caption == "") ? "Tidak Ada" : $user->jabatan_caption }}</h3>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('master.user.edit', [$user])}}" class="btn btn-primary float-right" style="margin-right:10px">Ubah</a>
                    <a href="{{ route('master.user.index') }}" class="btn btn-light float-right" style="margin-right:10px">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-danger float-left" id="btn-hapus-user">Hapus User</button>
</div>

<form id="form-hapus-user" method="POST" action="{{route('master.user.delete', [$user])}}">
    @csrf
    {{ method_field('DELETE') }}
</form>

<script type="text/javascript">
    $('#btn-hapus-user').on('click', function(e){
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
                document.getElementById('form-hapus-user').submit();
                    
            }
        });
    });
</script>

@endsection