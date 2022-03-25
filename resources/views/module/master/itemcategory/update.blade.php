<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Kategori Barang</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('master.itemcategory.update')}}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label class="small mb-1">Nama </label><label class="small mb-1" style="color:red">*</label>
                            <input name="value_id" id="modal-input-id" type="hidden"/>
                            <input name="name" id="modal-input-name" equired="true" value="{{ old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                            @if ($errors->has('name'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Kode Bidang Usaha</label><label class="small mb-1" style="color:red">*</label>
                            <input name="code" id="modal-input-code" equired="true" value="{{ old('code') }}" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" type="text"/>
                            @if ($errors->has('name'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
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