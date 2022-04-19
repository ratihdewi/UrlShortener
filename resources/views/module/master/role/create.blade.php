<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('master.role.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                        <input name="status" value="0" type="hidden"/>
                            <label class="small mb-1">Nama </label><label class="small mb-1" style="color:red">*</label>
                            <input name="name" required="true" value="{{ old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                            @if ($errors->has('name'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Parent </label><label class="small mb-1" style="color:red">*</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">Tidak Ada</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
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