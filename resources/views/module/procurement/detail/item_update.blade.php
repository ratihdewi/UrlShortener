
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Item</h5>
    </div>
    <div class="modal-body">
    <form action="{{route('procurement.item.update', [$item])}}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-xl-12">
            <div class="form-group">
                <input name="procurement_id" value="{{$procurement->id}}" type="hidden"/>
                <label class="small mb-1">Nama </label><label class="small mb-1" style="color:red">*</label>
                <input name="name" required="true" value="{{$item->name}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                @if ($errors->has('name'))
                    <span class="small" style="color:red" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="small mb-1">Harga </label><label class="small mb-1" style="color:red">*</label>
                <input name="price_est" required="true" value="{{$item->price_est}}" class="form-control{{ $errors->has('price_est') ? ' is-invalid' : '' }}" type="number"/>
                @if ($errors->has('price_est'))
                    <span class="small" style="color:red" role="alert">
                        <strong>{{ $errors->first('price_est') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="small mb-1">Total Unit </label><label class="small mb-1" style="color:red">*</label>
                <input name="total_unit" required="true" value="{{$item->total_unit}}" class="form-control{{ $errors->has('total_unit') ? ' is-invalid' : '' }}" type="number"/>
                @if ($errors->has('total_unit'))
                    <span class="small" style="color:red" role="alert">
                        <strong>{{ $errors->first('total_unit') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="small mb-1">Spesifikasi </label><label class="small mb-1" style="color:red">*</label>
                <textarea name="specs" class="form-control{{ $errors->has('specs') ? ' is-invalid' : '' }}">{{ $item->specs }}</textarea>
                @if ($errors->has('specs'))
                    <span class="small" style="color:red" role="alert">
                        <strong>{{ $errors->first('specs') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="small mb-1">Satuan </label><label class="small mb-1" style="color:red">*</label>
                <textarea name="satuan" class="form-control{{ $errors->has('satuan') ? ' is-invalid' : '' }}">{{ $item->satuan }}</textarea>
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
                        <option value="{{$category->id}}" @if($item->category_id==$category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            </div>
        </div>
        <hr>
        <button style="margin-left:10px;" class="btn btn-primary float-right" type="submit">Simpan</button>
        <button class="btn btn-light float-right" type="button" data-dismiss="modal">Tutup</button>
    </form>
    </div>   
        
</div>

<script src="{{asset('js/plugins/rateit/scripts/jquery.rateit.js')}}"></script>