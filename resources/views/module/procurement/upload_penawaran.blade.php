<div class="modal fade" id="uploadPenawaranModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Penawaran Harga</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('procurement.upload.penawaran', [$procurement])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <input name="procurement_id" value="{{$procurement->id}}" type="hidden"/>
                            <label class="small mb-1">Unggah File Penawaran Harga (.pdf) </label>
                            <input name="file_penawaran" required="true" value="{{ old('file_penawaran') }}" class="form-control{{ $errors->has('file_penawaran') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('file_penawaran'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('file_penawaran') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input name="procurement_id" value="{{$procurement->id}}" type="hidden"/>
                            <label class="small mb-1">Unggah Data Penawaran Barang (.xlxs) </label>
                            <input name="data_penawaran" required="true" value="{{ old('data_penawaran') }}" class="form-control{{ $errors->has('data_penawaran') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('data_penawaran'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('data_penawaran') }}</strong>
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