
<form action="{{route('procurement.umk.pj.store', [$procurement])}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Input PJ Umk</h5>
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
                                <input name="no_memo" disabled required="true" value="{{ $procurement->no_memo }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Perihal </label>
                                <input name="perihal" disabled required="true" value="{{ $procurement->name }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">No Memo UMK </label>
                                <input name="no_memo_umk" required="true" value="{{ old('no_memo_umk') }}" class="form-control{{ $errors->has('no_memo_umk') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('no_memo_umk'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('no_memo_umk') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Nama </label>
                                <input name="name" required="true" value="{{ old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('name'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">No Pekerja</label>
                                <input name="no_pekerja" required="true" value="{{ old('no_pekerja') }}" class="form-control{{ $errors->has('no_pekerja') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('no_pekerja'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('no_pekerja') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Jabatan </label>
                                <input name="jabatan" required="true" value="{{ old('jabatan') }}" class="form-control{{ $errors->has('jabatan') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('jabatan'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('jabatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Fungsi </label>
                                <input name="fungsi" required="true" value="{{ old('fungsi') }}" class="form-control{{ $errors->has('fungsi') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('fungsi'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('fungsi') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">GL Account/ Cost Element</label>
                                <input name="gl_account" required="true" value="{{ old('gl_account') }}" class="form-control{{ $errors->has('gl_account') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('gl_account'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('gl_account') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Cost Center </label>
                                <input name="cost_center" required="true" value="{{ old('cost_center') }}" class="form-control{{ $errors->has('cost_center') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('cost_center'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('cost_center') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Jumlah </label>
                                <input name="total" required="true" value="{{ old('total') }}" class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('total'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('total') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Upload Invoice</label>
                                <input name="invoice_file" required="true" value="{{ old('invoice_file') }}" class="form-control{{ $errors->has('invoice_file') ? ' is-invalid' : '' }}" type="file"/>
                                @if ($errors->has('invoice_file'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('invoice_file') }}</strong>
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
    
    
</script>
