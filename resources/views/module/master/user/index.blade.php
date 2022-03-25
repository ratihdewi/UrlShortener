@extends("master.main")

@section("title","User")

@section("content")

<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container"><br>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-n10">
    @include('partial.alert')
    <div class="card mb-4">
        <div class="card-header">
            Daftar User
            <a class="btn btn-primary btn-sm float-right" href="{{route('master.user.create')}}">
                <i class="mr-1" data-feather="plus-square"></i>
                Tambah User
            </a>
            <a class="btn btn-sm btn-info float-right" style="margin-right:20px;" data-toggle="modal" data-target="#uploadModal" href="#">Import</a>
        </div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Unit Kerja</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        
                    </tfoot>
                    <tbody>
                        @forelse($users as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->role_caption}}</td>
                                <td>{{$row->unit_kerja}}</td>
                                <td class="text-center"><a href="{{route('master.user.show', [$row])}}" class="btn btn-light btn-sm"><small>Detail</small></a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"><center><i>Tidak ada data.</i></center></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('module.master.user.import_modal')

@endsection