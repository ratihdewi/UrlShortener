<div class="modal fade" id="uploadBastModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah File BAST</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('procurement.umk.bast.store', [$procurement])}}" method="POST" enctype="multipart/form-data">
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
                            <label class="small mb-1">Unggah File BAST (.pdf) </label>
                            <input name="bast_file" required="true" value="{{ old('bast_file') }}" class="form-control{{ $errors->has('bast_file') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('bast_file'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('bast_file') }}</strong>
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