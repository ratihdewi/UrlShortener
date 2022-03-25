<div class="modal fade" id="uploadSp3Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah File SP3</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('procurement.sp3.store', [$procurement])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label class="small mb-1">Keterangan </label>
                            <input name="keterangan" required="true" value="{{ old('keterangan') }}" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" type="text"/>
                            @if ($errors->has('keterangan'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('keterangan') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input name="procurement_id" value="{{$procurement->id}}" type="hidden"/>
                            <label class="small mb-1">Unggah File SP3 (.pdf) </label>
                            <input name="sp3_file" required="true" value="{{ old('sp3_file') }}" class="form-control{{ $errors->has('sp3_file') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('sp3_file'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('sp3_file') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" type="submit">Kirim</button>
            </div>
            </form>
        </div>
    </div>
</div>