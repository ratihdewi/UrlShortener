
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Berita Acara Negosiasi dan Klarifikasi</h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Nomor SPPH </label>
                                <input name="no_spph" disabled value="{{ $spph->no_spph }}" class="form-control{{ $errors->has('no_spph') ? ' is-invalid' : '' }}" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Hari/Tanggal </label>
                                <input disabled value="{{ date('Y/m/d', strtotime($spph->negosiasi->date)) }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Tempat </label>
                                <input disabled value="{{ $spph->negosiasi->location }}" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1">Nama Vendor </label>
                                <input name="nama_vendor" disabled required="true" value="{{ $spph->vendor->name }}" class="form-control{{ $errors->has('nama_vendor') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Waktu </label>
                                <input disabled value="{{ $spph->negosiasi->time }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Peserta Rapat Vendor/Eksternal </label>
                                <input disabled value="{{ $spph->negosiasi->peserta_eksternal }}" class="form-control" type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="small mb-1">Peserta Rapat </label>
                                <select class="form-control select2" disabled multiple="" style="width:100%">
                                    @foreach($pesertas as $peserta)
                                        <option value="{{$peserta->id}}" @if(in_array($peserta->id, $spph->negosiasi->pesertas->pluck('user_id')->toArray())) selected @endif>{{$peserta->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="small mb-1">Melalui berita acara ini, Fungsi Pengadaan Barang dan Jasa dan Fungsi Pengguna (Sekretaris Universitas) melakukan Klarifikasi kepada {{$spph->vendor->name}} untuk pekerjaan Pengadaan {{$spph->procurement->name}}. </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="small mb-1">1. Klarifikasi Kesesuaian Spesifikasi dan Harga Penawaran</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="datatable">
                                <table class="table table-hover" id="penawaran-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kategori</th>
                                            <th>Nama Barang</th>
                                            <th>Spesifikasi</th>
                                            <th>Harga Satuan</th>
                                            <th>Kuantitas</th>
                                            <th>Harga Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($spph->penawarans as $penawaran)
                                        @if($penawaran->negosiasi!=null)
                                        <tr>
                                            <td>{{$penawaran->item->category->name}}</td>
                                            <td>{{$penawaran->item->name}}</td>
                                            <td>{{$penawaran->item->specs}}</td>
                                            <td class="text-right">Rp{{number_format($penawaran->harga_satuan, 2)}}</td>
                                            <td>{{$penawaran->item->total_unit}}</td>
                                            <td class="text-right">Rp{{number_format($penawaran->harga_total,2)}}</td>
                                        </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="7"><center><i>Tidak ada data.</i></center></td>
                                        </tr>
                                    @endforelse
                                        <tr>
                                            <td colspan="5" class="text-right">Harga Awal</td>
                                            <td class="text-right">Rp{{number_format($spph->penawarans->where('negosiasi', '<>', null)->sum('harga_total'),2)}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">Negosiasi</td>
                                            <td class="text-right">Rp{{number_format($spph->negosiasi->negosiasi,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">Total Akhir</td>
                                            <td class="text-right">Rp{{number_format($spph->penawarans->where('negosiasi', '<>', null)->sum('harga_total')-$spph->negosiasi->negosiasi,2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="small mb-1">Hasil Meeting </label><br>
                                <label style="margin-left:10px;">{{ $spph->negosiasi->meeting_result }}</label>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Dokumentasi </label><br>
                                <img style="margin-left:10px;" src="{{asset('negosiasidoc/'.$spph->negosiasi->photo_doc)}}" width="200px" height="200px"><br>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div> 
</div>
<div class="modal-footer">
    <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
    <a class="btn btn-primary" href="{{route('procurement.banegosiasi.cetak', [$spph])}}">Cetak</a>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('.select2').select2()
    } );
    
</script>