
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Cetak BAPP</h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Nomor Surat </label>
                                <input disabled value="{{ $procurement->bapp->no_surat }}" class="form-control"type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Dari </label>
                                <input disabled value="Direktur Pengelolaan Fasilitas Universitas" class="form-control"type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Lampiran </label>
                                <input disabled value="1 Bundel" class="form-control"type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Tanggal </label>
                                <input disabled value="{{$procurement->bapp->location}}, {{ date('d M Y', strtotime($procurement->bapp->date)) }}" class="form-control"type="text"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Dari </label>
                                <input disabled value="{{ $procurement->bapp->userDari->name }} - {{ $procurement->bapp->userDari->jabatan_caption }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Kepada </label>
                                <input disabled value="{{ $procurement->bapp->userKepada->name }} - {{ $procurement->bapp->userKepada->jabatan_caption }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Perihal </label>
                                <input disabled value="{{ $procurement->name }}" class="form-control"type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                        Memo terkait<br>
                        surat Permintaan Penawaran Harga yang dikirimkan kepada {{$vendor_spph}} vendor pada tanggal {{date('d M Y', strtotime($procurement->spph_sending_date))}} sebagai berikut:
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                        <div class="datatable">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Vendor</th>
                                        <th>Nomor SPPH</th>
                                        <th>Nomor Surat Penawaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($procurement->spphs as $row)
                                     @if($row->status === 2 || $row->status === 3)
                                        <tr>
                                            <td>{{$row->vendor->name}}</td>
                                            <td>{{$row->no_spph}}</td>
                                            <td>{{$row->no_surat_penawaran}}</td>
                                        </tr>
                                      @endif
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
                    <div class="row">
                        <div class="col-xl-12">
                        <br>
                        Berdasarkan Surat Permintaan Penawaran Harga yang dikirimkan ke Vendor, terdapat {{$vendor_count}} vendor yang mengirimkan penawaran harga sebagai berikut:
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                        <div class="datatable">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Spesifikasi</th>
                                        <th>Harga Satuan</th>
                                        <th>Kuantitas</th>
                                        <th>Total Harga</th>
                                        <th>Nama Vendor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($procurement->penawarans as $row)
                                        @if(in_array($row->id, $min_price->pluck('penawaran_id')->toArray()))
                                        <tr>
                                            <td style="font-weight:bold">{{$row->item->name}}</td>
                                            <td style="font-weight:bold">{{$row->item->category->name}}</td>
                                            <td style="font-weight:bold">{{$row->item->specs}}</td>
                                            <td style="font-weight:bold">Rp{{number_format($row->harga_satuan,2)}}</td>
                                            <td style="font-weight:bold">{{$row->item->total_unit}}</td>
                                            <td style="font-weight:bold">Rp{{number_format($row->item->total_unit*$row->harga_satuan, 2)}}</td>
                                            <td style="font-weight:bold">{{$row->spph->vendor->name}}</td>
                                        </tr>
                                        @else 
                                        <tr>
                                            <td>{{$row->item->name}}</td>
                                            <td>{{$row->item->category->name}}</td>
                                            <td>{{$row->item->specs}}</td>
                                            <td>Rp{{number_format($row->harga_satuan,2)}}</td>
                                            <td>{{$row->item->total_unit}}</td>
                                            <td>Rp{{number_format($row->item->total_unit*$row->harga_satuan, 2)}}</td>
                                            <td>{{$row->spph->vendor->name}}</td>
                                        </tr>
                                        @endif
                                        
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
    </div> 
</div>
<div class="modal-footer">
    <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
    <a class="btn btn-primary" href="{{route('procurement.bapp.cetak', [$procurement])}}">Cetak</a>
</div>

