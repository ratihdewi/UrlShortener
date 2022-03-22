@extends("master.main")

@section("title","Mekanisme Pengadaan")

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
            Daftar Mekanisme
            <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="modal" data-target="#addModal"><i class="mr-1" data-feather="plus-square"></i>
                Tambah Mekanisme
            </button>
        </div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        
                    </tfoot>
                    <tbody>
                        @forelse($mechanisms as $row)
                            <tr class="data-row">
                                <td class="name">{{$row->name}}</td>
                                <td class="text-center">
                                    <a class="btn btn-hapus btn-sm btn-danger" href="{{route('master.mechanism.delete', [$row])}}"><small>Hapus</small></a>
                                    <button type="button" class="btn btn-primary btn-sm" id="edit-item" data-item-id="{{$row->id}}"><small>Ubah</small></button>
                                </td>
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
    </div>
</div>

@include('module.master.mechanism.create')
@include('module.master.mechanism.update')
@include('module.master.mechanism.js')

@endsection