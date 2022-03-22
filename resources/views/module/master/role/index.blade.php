@extends("master.main")

@section("title","Role")

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
            Daftar Role
            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="modal" data-target="#addModal"><i class="mr-1" data-feather="plus-square"></i>
                Tambah Role
            </button>
        </div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Parent</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        
                    </tfoot>
                    <tbody>
                        @forelse($roles as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>@if($row->parent_id==0) @else {{$row->parent->name}} @endif</td>
                                <td class="text-center">
                                    <a class="btn btn-hapus btn-sm btn-danger" href="{{route('master.role.delete', [$row])}}"><small>Hapus</small></a>
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
    </div>
</div>

@include('module.master.role.create')
@include('module.master.role.js')

@endsection