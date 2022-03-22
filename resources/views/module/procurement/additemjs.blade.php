<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('procurement.item.store', ['0'])}}" method="POST" id="formItem" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <input name="procurement_id" value="0" type="hidden"/>
                            <label class="small mb-1">Nama </label><label class="small mb-1" style="color:red">*</label>
                            <input name="name" required="true" value="{{ old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                            @if ($errors->has('name'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Harga </label><label class="small mb-1" style="color:red">*</label>
                            <input name="price_est" required="true" value="{{ old('price_est') }}" class="form-control{{ $errors->has('price_est') ? ' is-invalid' : '' }}" type="number"/>
                            @if ($errors->has('price_est'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('price_est') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Total Unit </label><label class="small mb-1" style="color:red">*</label>
                            <input name="total_unit" required="true" value="{{ old('total_unit') }}" class="form-control{{ $errors->has('total_unit') ? ' is-invalid' : '' }}" type="number"/>
                            @if ($errors->has('total_unit'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('total_unit') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Spesifikasi </label><label class="small mb-1" style="color:red">*</label>
                            <textarea name="specs" class="form-control{{ $errors->has('specs') ? ' is-invalid' : '' }}">{{ old('specs') }}</textarea>
                            @if ($errors->has('specs'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('specs') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Satuan </label><label class="small mb-1" style="color:red">*</label>
                            <input name="satuan" required="true" value="{{ old('satuan') }}" class="form-control{{ $errors->has('satuan') ? ' is-invalid' : '' }}" type="text"/>
                            @if ($errors->has('satuan'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('satuan') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Category </label>
                            <select name="category_id" class="form-control" id="category">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Brosur&nbsp;</label>
                            <input name="brosur_file" value="{{ old('brosur_file') }}" class="form-control{{ $errors->has('brosur_file') ? ' is-invalid' : '' }}" type="file"/>
                            @if ($errors->has('brosur_file'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('brosur_file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Rekomendasi Vendor </label> 
                            <input type="button" class="btn btn-primary btn-sm add" value="+" id="add"/>
                            <div id="vendor-form" style="margin-top:10px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
                <a href="javascript:ajaxSave('{{route('procurement.item.store', ['0'])}}')" class="btn btn-primary">Simpan</a>
            </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    function ajaxSave(filename, content) {
        content = typeof content !== 'undefined' ? content : 'content';
        $('.loading').show();
        var form = $('#formItem');
        var formData = new FormData($('#formItem')[0]);

        $.ajax({
            type: "POST",
            url: filename,
            enctype: 'multipart/form-data',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#" + content).html(data);
                $('.loading').hide();
                $('#addItemModal').modal('toggle');
                clearForm("#formItem");
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

</script>