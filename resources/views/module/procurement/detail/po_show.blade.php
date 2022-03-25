
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail PO</h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">No Memo </label>
                                <input name="no_spph" disabled value="{{ $spph->procurement->no_memo }}" class="form-control{{ $errors->has('no_spph') ? ' is-invalid' : '' }}" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Perihal </label>
                                <input name="no_spph" disabled value="{{ $spph->procurement->name }}" class="form-control{{ $errors->has('no_spph') ? ' is-invalid' : '' }}" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Nama Vendor </label>
                                <input name="nama_vendor" disabled required="true" value="{{ $spph->vendor->name }}" class="form-control{{ $errors->has('nama_vendor') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Alamat Vendor </label>
                                <input name="nama_vendor" disabled required="true" value="{{ $spph->vendor->address }}" class="form-control{{ $errors->has('nama_vendor') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">No. Vendor </label>
                                <input name="nama_vendor" disabled required="true" value="{{ $spph->vendor->no }}" class="form-control{{ $errors->has('nama_vendor') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                            </div>
                            
                        </div>
                        <div class="col-xl-6">
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1">NPWP </label>
                                <input name="nama_vendor" disabled required="true" value="{{ $spph->vendor->no_tax }}" class="form-control{{ $errors->has('nama_vendor') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Nomor SPMP </label>
                                <input name="nama_vendor" disabled required="true" value="{{ $spph->po->no_spmp }}" class="form-control{{ $errors->has('nama_vendor') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Disetujui Oleh </label>
                                <input name="nama_vendor" disabled required="true" value="{{ $spph->po->approvedBy->name }} - {{ $spph->po->approvedBy->jabatan_caption }}" class="form-control{{ $errors->has('nama_vendor') ? ' is-invalid' : '' }}" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Tanggal </label>
                                <input disabled value="{{ date('d M Y', strtotime($spph->po->date)) }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">PPN </label>
                                <input name="ppn" disabled style="width:20px" @if($spph->po->ppn==1) checked @endif value="1" class="form-control{{ $errors->has('ppn') ? ' is-invalid' : '' }}" type="checkbox"/>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="datatable">
                                <table class="table table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="garis">Nama Barang</th>
                                            <th class="garis">Spesifikasi</th>
                                            <th class="garis">Kuantitas</th>
                                            <th class="garis">Harga Satuan</th>
                                            <th class="garis">Harga Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($spph->penawarans as $penawaran)
                                        @if($penawaran->won==1)
                                        <tr>
                                            <td>{{$penawaran->item->name}}</td>
                                            <td>{{$penawaran->item->specs}}</td>
                                            <td>{{$penawaran->item->total_unit}}</td>
                                            <td class="text-right">Rp{{number_format($penawaran->harga_satuan, 2)}}</td>
                                            <td class="text-right">Rp{{number_format($penawaran->harga_total,2)}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    @if($spph->has_negosiasi)
                                    <tr>
                                        <td colspan="4" class="text-right">Negosiasi</td>
                                        <td class="text-right">Rp{{number_format($spph->negosiasi->negosiasi,2)}}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4" class="text-right">Total</td>
                                        @if($spph->has_negosiasi)
                                        <td class="text-right">Rp{{number_format($spph->penawarans->where('won', 1)->sum('harga_total')-$spph->negosiasi->negosiasi,2)}}</td>
                                        @else
                                        <td class="text-right">Rp{{number_format($spph->penawarans->where('won', 1)->sum('harga_total'),2)}}</td>
                                        @endif
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="small mb-1">Ketentuan Pekerjaan </label>
                                <label class="small mb-1" style="margin-left:10px;">{!! $spph->po->ketentuan_pekerjaan !!} </label>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Ketentuan Pembayaran </label>
                                <label class="small mb-1" style="margin-left:10px;">{!! $spph->po->ketentuan_pembayaran !!} </label>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div> 
</div>
<div class="modal-footer">
    <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
    <a class="btn btn-primary" href="{{route('procurement.po.cetak', [$spph])}}">Cetak</a>
</div>
