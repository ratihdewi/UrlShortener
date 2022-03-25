<div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah File Vendor</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('vendor.upload.file', [$vendor])}}" method="POST" enctype="multipart/form-data">
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
                            <label class="small mb-1">Unggah File Vendor (.pdf) </label>
                            <input name="file" required="true" value="{{ old('file') }}" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('file'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>