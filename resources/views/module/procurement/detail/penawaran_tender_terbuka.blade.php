<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Penawaran</h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1">Email Vendor </label>
                                <h3>{{$penawaran->vendor->email}}</h3>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1">Nama Vendor </label>
                                <h3>{{$penawaran->vendor->name}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1">No Surat Penawaran </label>
                                <h3>{{$penawaran->no_penawaran}}</h3>
                            </div>
                        </div>
                        @php $date = \Carbon\Carbon::now()->format('Y-m-d') @endphp
                        @if($penawaran->procurement->tanggal_batas_tender_terbuka < $date)
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Total Penawaran</label>
                                <h3>Rp{{number_format($penawaran->items->sum('harga_total'),2)}}</h3>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
        </div>
    </div>
    @if($penawaran->procurement->tanggal_batas_tender_terbuka < $date)
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
            @forelse($penawaran->items as $row)
                <tr>
                    <td>{{$row->item->category->name}}</td>
                    <td>{{$row->item->name}}</td>
                    <td>{{$row->item->specs}}</td>
                    <td>{{$row->item->satuan}}</td>
                    <td>Rp{{number_format($row->harga_satuan, 2)}}</td>
                    <td>{{$row->item->total_unit}}</td>
                    <td>Rp{{number_format($row->harga_total,2)}}</td>
                    <td>{{$row->keterangan}}</td>
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
    @endif
</div>
<div class="modal-footer">
    <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
    @if($penawaran->procurement->tanggal_batas_tender_terbuka < $date)
    @if($penawaran->status==0)
        <a href="{{route('procurement.tenderterbuka.penawaran.submit', [$penawaran])}}" class="btn btn-primary float-right" style="margin-left:10px">Submit</a>
    @endif
    @endif
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#penawaran-table').DataTable();
    } );
    
</script>
