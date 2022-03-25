
<form action="{{route('procurement.banegosiasi.store', [$spph])}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Input Berita Acara Negosiasi dan Klarifikasi</h5>
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
                                <input name="no_spph" disabled required="true" value="{{ $spph->no_spph }}" class="form-control{{ $errors->has('no_spph') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Hari/Tanggal </label>
                                <input name="date" required="true" value="{{ old('date') }}" class="datepicker form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                                @if ($errors->has('date'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Tempat </label>
                                <input name="location" required="true" value="{{ old('location') }}" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('location'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
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
                                <input name="time" required="true" value="{{ old('time') }}" class="timepicker form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" placeholder="hh:mm" type="time"/>
                                @if ($errors->has('time'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Peserta Rapat Vendor/Eksternal</label> <label style="font-size:8pt" class="small mb-1">Pisahkan nama dengan tanda koma ","</label>
                                <input name="peserta_eksternal" required="true" value="{{ old('peserta_eksternal') }}" class="form-control{{ $errors->has('peserta_eksternal') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('peserta_eksternal'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('peserta_eksternal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="small mb-1">Peserta Rapat Internal</label>
                                <select class="form-control select2" name="peserta_id[]" multiple="" style="width:100%">
                                    @foreach($pesertas as $peserta)
                                        <option value="{{$peserta->id}}">{{$peserta->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="datatable">
                                <table class="table table-hover" id="penawaran-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" name="check-all" id="check-all" value=""/></th>
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
                                        <tr @if($penawaran->can_win == 0) style="color:red" @endif>
                                            <td class="text-center">
                                                <input type="checkbox" @if($penawaran->can_win == 0) disabled="true" @endif name="penawaran_id[]" value="{{$penawaran->id}}"/>
                                            </td>
                                            <td>{{$penawaran->item->category->name}}</td>
                                            <td>{{$penawaran->item->name}}</td>
                                            <td>{{$penawaran->item->specs}}</td>
                                            <td>Rp{{number_format($penawaran->harga_satuan, 2)}}</td>
                                            <td>{{$penawaran->item->total_unit}}</td>
                                            <td>Rp{{number_format($penawaran->harga_total,2)}}</td>
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
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="small mb-1">Hasil Rapat </label>
                                <textarea name="meeting_result" rows="4" class="form-control{{ $errors->has('meeting_result') ? ' is-invalid' : '' }}">{{ old('meeting_result') }}</textarea>
                                @if ($errors->has('meeting_result'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('meeting_result') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Upload Dokumentasi Meeting (.jpg | .png) </label>
                                <input name="photo_doc" required="true" value="{{ old('photo_doc') }}" class="form-control{{ $errors->has('photo_doc') ? ' is-invalid' : '' }}" type="file"/>
                                @if ($errors->has('photo_doc'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('photo_doc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Negosiasi </label>
                                (Rp)<input name="negosiasi" required="true" value="{{ old('negosiasi') }}" class="form-control{{ $errors->has('negosiasi') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('negosiasi'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('negosiasi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div> 
</div>
<div class="modal-footer">
    <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>
</form>

<script type="text/javascript">
    $("#check-all").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
    
    $(document).ready(function() {
        $('#penawaran-table').DataTable();
        $('.select2').select2()
        $(".datepicker").datepicker({
            startDate: new Date(),
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    } );
    
</script>
