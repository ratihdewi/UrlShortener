<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Waktu SLA</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('master.sla.update')}}" method="POST" id="edit-form">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label class="small mb-1">Proses </label>
                            <input name="process" disabled id="modal-input-process" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Waktu </label><label class="small mb-1" style="color:red">*</label>
                            <input name="value_id" id="modal-input-id" type="hidden"/>
                            <input name="time" id="modal-input-time" required="true" value="{{ old('time') }}" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" type="text"/>
                            @if ($errors->has('time'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('time') }}</strong>
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