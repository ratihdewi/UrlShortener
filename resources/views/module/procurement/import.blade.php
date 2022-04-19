<div class="modal fade" id="importItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Item</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('procurement.item.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label class="small mb-1">Template&nbsp;</label><br>
                            <a href="{{route('procurement.item.import.example')}}" class="btn btn-primary btn-sm"><small>Download Template Contoh</small></a>
                        </div>
                        <div class="form-group">
                            <input name="procurement_id" value="{{$procurement->id}}" type="hidden"/>
                            <label class="small mb-1">File Excel </label>
                            <input name="file_excel" required="true" value="{{ old('file_excel') }}" class="form-control{{ $errors->has('file_excel') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('file_excel'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('file_excel') }}</strong>
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