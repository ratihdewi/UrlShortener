@extends("master.main")

@section("title","Master Jabatan")

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
            Master Jabatan
        </div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        
                    </tfoot>
                    <tbody>
                        @forelse($jabatans as $row)
                            <tr class="data-row">
                                <td>{{$row->code}}</td>
                                <td class="name">{{$row->name}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" id="edit-item" data-item-id="{{$row->id}}"><small>Ubah</small></button>
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

@include('module.master.jabatan.update')
@include('module.master.jabatan.js')

@endsection