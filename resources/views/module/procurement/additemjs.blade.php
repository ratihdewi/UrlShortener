<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('procurement.item.store', ['0'])}}" method="POST" id="formItem" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-6">
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
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="small mb-1">Category </label> <label class="small mb-1" style="color:red">*</label>
                            <select name="category_id" class="form-control" id="category">
                                <option disabled selected> -- Pilih Opsi --</option> 
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
                        <div class="form-group" id="selectMethodVendor">
                            <label class="small mb-1">Rekomenasi Vendor &nbsp;</label>
                            <select class="form-control" id="methodVendor">
                                <option disabled value="0" selected> -- Pilih Opsi --</option> 
                                <option value="1"> Pilih dari daftar </option>
                                <option value="2"> Masukkan secara manual </option>
                                <option value="3" class="flex-option"> Custom </option>
                            </select>
                        </div>
                        <div class="form-group" id="inputManual">
                            <input type="button" class="btn btn-primary btn-sm add" value="Tambah" id="add"/>
                            <div id="vendor-form" style="margin-top:10px;">
                            </div>
                        </div>
                        <div class="form-group" id="inputList">
                            <label class="small mb-1"> Pilih Vendor </label> <br>
                            <select class="form-control select2" style="width: 100%" name="vendor_select" id="listVendor">
                            </select>
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

    let vendorUrl = window.location.origin + '/procurement/get-vendor/';

    $(document).ready(function() {
        $('#inputManual').hide();
        $('#inputList').hide();
    });

    $('#mechanism_id').on('change', function(){
        if (this.value != 2) {
            $('.flex-option').prop('disabled', false);
        } else {
            $('.flex-option').prop('disabled', true);
        }

        if (this.value == 3 || this.value == 4) {
            $('#selectMethodVendor').hide();
        } else {
            $('#selectMethodVendor').show();
        }
        
    });

    $('#methodVendor').on('change', function(){

        if(this.value == 1){
           
            $('#inputManual').hide();
            $('#inputList').show();
            loadVendorOption();

        } else if (this.value == 2) {
           
            $('#inputManual').show();
            $('#inputList').hide();
            $('#listVendor').html('');
        } 
        else {

            $('#inputManual').show();
            $('#inputList').show();   
            loadVendorOption();         
        }

    });

    $('#category').on('change', function(){
        loadVendorOption();
    });

    function loadVendorOption () {
        $('#listVendor').html('');
        $.ajax({
            type: "GET",
            url: vendorUrl + $('#category').val(),
            success: function (res) {
                $('#listVendor').append('<option disabled selected> -- Pilih Vendor -- </option>');
                $.each(res.vendors, function(k,v){
                    $('#listVendor').append(`<option value="${v.id}"> ${v.name} </option>`);
                });
            }
        });
    }

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

                if (data.message == "Error") {
                    Swal.fire({
                      icon: 'error',
                      title: 'Galat',
                      text: 'Email Vendor Yang Dimasukkan Sudah Terdaftar',
                    });
                } else {
                    $("#" + content).html(data);
                    $('.loading').hide();
                    $('#addItemModal').modal('toggle');
                    clearForm("#formItem");
                }
            },
            error: function (xhr, status, error) {
                let txt = JSON.parse(xhr.responseText).errors;
                console.log(txt);

                Swal.fire({
                  icon: 'error',
                  title: 'Galat',
                  text: 'Data tidak lengkap',
                });
            }
        });
    }

</script>