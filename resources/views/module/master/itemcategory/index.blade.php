@extends("master.main")

@section("title","Kategori Barang")

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
            Daftar Kategori Barang
            @if(Auth::user()->role_id==1)
            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="modal" data-target="#addModal"><i class="mr-1" data-feather="plus-square"></i>
                Tambah Kategori Barang
            </button>
            @endif
        </div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Kategori</th>
                            <th>Nama</th>
                            <th>Kode Bidang Usaha</th>
                            @if(Auth::user()->role_id==1)<th class="text-center">Aksi</th>@endif
                        </tr>
                    </thead>
                    <tfoot>
                        
                    </tfoot>
                    <tbody>
                        @forelse($categories as $row)
                            <tr class="data-row">
                                <td>{{$row->id}}</td>
                                <td class="name">{{$row->name}}</td>
                                <td class="code">{{$row->code}}</td>
                                @if(Auth::user()->role_id==1)
                                    <td class="text-center">
                                        <a class="btn btn-hapus btn-sm btn-danger" href="{{route('master.itemcategory.delete', [$row])}}"><small>Hapus</small></a>
                                        <button type="button" class="btn btn-primary btn-sm" id="edit-item" data-item-id="{{$row->id}}"><small>Ubah</small></button>
                                    </td>
                                @endif
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

@include('module.master.itemcategory.create')
@include('module.master.itemcategory.update')
@include('module.master.itemcategory.js')

@endsection