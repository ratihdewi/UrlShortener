<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah Data User</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('master.user.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label class="small mb-1">Download Tempalte </label><br>
                            <a href="{{route('master.user.download.import')}}" class="btn btn-primary btn-sm"><small>Download Template Contoh</small></a>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Unggah Data User </label>
                            <input name="data_user" required="true" value="{{ old('data_user') }}" class="form-control{{ $errors->has('data_user') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('data_user'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('data_user') }}</strong>
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