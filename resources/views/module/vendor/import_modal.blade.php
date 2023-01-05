<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah Data Vendor</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('vendor.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label class="small mb-1">Download Tempalte </label><br>
                            <a href="{{route('vendor.download.import')}}" class="btn btn-primary btn-sm"><small>Download Template Contoh</small></a>

                            <div class="mt-3"> <small> <i> Harap baca petunjuk pengisian vendor melalui excel pada sheet keterangan </i> </small> </div>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Unggah Data Vendor </label>
                            <input name="data_vendor" required="true" value="{{ old('data_vendor') }}" class="form-control{{ $errors->has('data_vendor') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('data_vendor'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('data_vendor') }}</strong>
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