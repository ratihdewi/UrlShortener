
<form action="{{route('procurement.po.store', [$spph])}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Input PO</h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Nomor Memo </label>
                                <input name="no_memo" disabled required="true" value="{{ $spph->procurement->no_memo }}" class="form-control" type="text"/>
                            </div>
                            <input name="job_terms" value="Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga" type="hidden"/>
                            
                            <div class="form-group">
                                <label class="small mb-1">Perihal </label>
                                <input name="perihal" disabled required="true" value="{{ $spph->procurement->name }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">No SPMP </label>
                                <input name="no_spmp" required="true" value="{{ old('no_spmp') }}" class="form-control{{ $errors->has('no_spmp') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('no_spmp'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('no_spmp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Tanggal </label>
                                <input name="date" required="true" value="{{ old('date') }}" class="datepicker form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                                @if ($errors->has('date'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Disetujui Oleh </label>
                                <select class="form-control select2" name="approved_by" style="width:100%">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}} - {{$user->jabatan_caption}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">PPN </label>
                                <input name="ppn" style="width:20px" checked value="1" class="form-control{{ $errors->has('ppn') ? ' is-invalid' : '' }}" type="checkbox"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="small mb-1">Ketentuan Pekerjaan </label><label class="small mb-1" style="color:red">*</label>
                                <textarea id="editor" name="ketentuan_pekerjaan" rows="4" class="form-control{{ $errors->has('ketentuan_pekerjaan') ? ' is-invalid' : '' }}">{{ $po->ketentuan_pekerjaan }}</textarea>
                                @if ($errors->has('ketentuan_pekerjaan'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('ketentuan_pekerjaan') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Ketentuan Pembayaran </label><label class="small mb-1" style="color:red">*</label>
                                <textarea id="editor2" name="ketentuan_pembayaran" rows="4" class="form-control{{ $errors->has('ketentuan_pembayaran') ? ' is-invalid' : '' }}">{{ $po->ketentuan_pembayaran }}</textarea>
                                @if ($errors->has('ketentuan_pembayaran'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('ketentuan_pembayaran') }}</strong>
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
    
    $(document).ready(function() {
        $('.select2').select2()
        $(".datepicker").datepicker({
            startDate: new Date(),
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    } );

    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
            console.error( error );
        } );
    
</script>
