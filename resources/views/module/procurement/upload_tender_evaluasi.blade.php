<div class="modal fade" id="uploadEvaluasiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah Evaluasi Tender</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('procurement.upload.evaluasitender', [$procurement])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <input name="procurement_id" value="{{$procurement->id}}" type="hidden"/>
                            <label class="small mb-1">Unggah File Evaluasi Tender (.pdf) </label>
                            <input name="file_evaluasi" required="true" value="{{ old('file_evaluasi') }}" class="form-control{{ $errors->has('file_evaluasi') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('file_evaluasi'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('file_evaluasi') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input name="procurement_id" value="{{$procurement->id}}" type="hidden"/>
                            <label class="small mb-1">Unggah Data Evaluasi Tender (.xlxs) </label>
                            <input name="data_evaluasi" required="true" value="{{ old('data_evaluasi') }}" class="form-control{{ $errors->has('data_evaluasi') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('data_evaluasi'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('data_evaluasi') }}</strong>
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