<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Penawaran</h5>
    <a href="{{route('procurement.file.download', [$spph->id, 'penawaran'])}}" class="btn btn-primary btn-sm"> <i data-feather="file-text"></i>Download File</a>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">No. SPPH </label>
                                <h3>{{$spph->no_spph}}</h3>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1">Nama Vendor </label>
                                <h3>{{$spph->vendor->name}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1">No Surat Penawaran </label>
                                <h3>{{$spph->no_surat_penawaran}}</h3>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Total Penawaran</label>
                                <h3>Rp{{number_format($spph->penawarans->sum('harga_total'),2)}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
    
        <div class="card-body">
        <div class="datatable">
        <table class="table table-hover" id="penawaran-table" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Spesifikasi</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Kuantitas</th>
                    <th>Harga Total</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
            @forelse($spph->penawarans as $penawaran)
                <tr>
                    <td>{{$penawaran->item->category->name}}</td>
                    <td>{{$penawaran->item->name}}</td>
                    <td>{{$penawaran->item->specs}}</td>
                    <td>{{$penawaran->item->satuan}}</td>
                    <td>Rp{{number_format($penawaran->harga_satuan, 2)}}</td>
                    <td>{{$penawaran->item->total_unit}}</td>
                    <td>Rp{{number_format($penawaran->harga_total,2)}}</td>
                    <td>{{$penawaran->keterangan}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7"><center><i>Tidak ada data.</i></center></td>
                </tr>
            @endforelse
            </tbody>
        </table>
        </div>
        </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#penawaran-table').DataTable();
    } );
    
</script>
