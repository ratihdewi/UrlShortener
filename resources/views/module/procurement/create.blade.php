@extends("master.main")

@section("title","Tambah Pengadaan")

@section("content")

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        <a href="{{route('procurement.index')}}"> Daftar Pengadaan </a>  &nbsp;> Tambah
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-4">
@include('partial.alert')
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('procurement.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf   
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="small mb-1">No. Memo&nbsp;</label><label class="small mb-1" style="color:red">*</label>
                                    <select class="form-control select2" name="no_memo" id="select_memo">
                                        <option value="0">Pilih Nomor Memo</option>
                                        @foreach($data_memos as $row)
                                            <option value="{{$row['nomor_surat']}}">{{$row['nomor_surat']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input name="status" value="0" type="hidden"/>
                                    <label class="small mb-1">Perihal&nbsp;</label><label class="small mb-1" style="color:red">*</label>
                                    <input name="name" readonly="readonly" required="true" value="{{ old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="perihal"/>
                                    @if ($errors->has('name'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Mekanisme&nbsp;</label><label style="font-size:8pt" class="small mb-1">(optional)</label>
                                    <select class="form-control" name="mechanism_id" id="mechanism_id">
                                        @foreach($mechanisms as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="small mb-1">Kerangka Acuan Kerja (ToR)&nbsp;</label><label class="small mb-1" style="color:red">*</label>
                                    <input name="tor_file" required="true" value="{{ old('tor_file') }}" class="form-control{{ $errors->has('tor_file') ? ' is-invalid' : '' }}" type="file"/>
                                    @if ($errors->has('tor_file'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('tor_file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Barang (import excel file)</label>
                                    <input name="item_file" value="{{ old('items') }}" class="form-control{{ $errors->has('items') ? ' is-invalid' : '' }}" type="file"/>
                                    <a href="{{route('procurement.item.import.example')}}" class="btn btn-primary btn-sm"><small>Download Template Contoh</small></a>
                                    @if ($errors->has('items'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('items') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div id="vendor_penunjukan_langsung">
                                    <div class="form-group">
                                        <label class="small mb-1">Vendor</label><br>
                                        <select class="form-control{{ $errors->has('vendor_id') ? ' is-invalid' : '' }} select2" name="vendor_id" style="width:100%;">
                                            <option value="0">Pilih Vendor</option>
                                            @foreach($vendors as $vendor)
                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1">Atau Masukkan Data Vendor Baru&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <input name="vendor_name" style="width=:50%" placeholder="nama vendor" class="form-control" type="text"/>
                                            </div>
                                            <div class="col-xl-6">
                                                <input name="vendor_email" style="width=:50%" placeholder="email vendor" class="form-control" type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="vendor_afiliasi">
                                    <label class="small mb-1">Vendor Afiliasi</label><br>
                                    <select class="form-control select2" name="vendor_id_afiliasi" style="width:100%;">
                                        <option value="0">Pilih Vendor</option>
                                        @foreach($vendor_afiliasis as $vendor)
                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:20px;margin-bottom:20px;">
                            <div class="col-xl-12">
                                <div class="col-auto mt-4">
                                    <button class="btn btn-outline-primary btn-sm float-right" type="button" data-toggle="modal" data-target="#addItemModal"><i class="mr-1" data-feather="plus-square"></i>
                                        Tambah Barang
                                    </button>
                                </div>
                                <div class="datatable" id="content">
                                </div>
                                <div class="loading"></div>
                            </div>
                        </div>  
                        <button class="btn btn-primary float-right" type="submit">Simpan</button>
                        <a href="{{ route('procurement.index') }}" class="btn btn-light float-right" style="margin-right:10px">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('module.procurement.additemjs')


<script type="text/javascript">
    $(document).ready(function () {
        ajaxFirstLoad('{{route('procurement.item.index')}}');

        var passedMemos = @json($data_memos);
        $("#select_memo").on("change", function () {
            nomor_surat = $(this).val()
            document.getElementById("perihal").value = passedMemos.find(x => x.nomor_surat === nomor_surat).perihal
        });
    });
    

    function ajaxFirstLoad(filename, content) {
        content = typeof content !== 'undefined' ? content : 'content';
        $('.loading').show();
        $("#vendor_penunjukan_langsung").hide();
        $("#vendor_afiliasi").hide();
        $.ajax({
            type: "GET",
            url: filename,
            success: function (data) {
                $("#" + content).html(data);
                $('.loading').hide();
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

    function clearForm(form)
    {
        $(":input", form).each(function(){
            var type = this.type;
            var tag = this.tagName.toLowerCase();
            if (type == 'text' || type=='textarea' || type=='number')
            {
                this.value = "";
            }
        });
    }

    function ajaxItemDelete(filename, content) {
        content = typeof content !== 'undefined' ? content : 'content';
        $('.loading').show();
        $.ajax({
            type: "GET",
            url: filename,
            success: function (data) {
                $("#" + content).html(data);
                $('.loading').hide();
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

    
    $('#mechanism_id').change(function() {
        id = $(this).val()
        if(id==3) {
            $("#vendor_penunjukan_langsung").show();
            $("#vendor_afiliasi").hide();
        } else if(id==4) {
            $("#vendor_penunjukan_langsung").hide();
            $("#vendor_afiliasi").show();
        } else {
            $("#vendor_penunjukan_langsung").hide();
            $("#vendor_afiliasi").hide();
        }
    })
    

    $("#add").click(function() {
    	var lastField = $("#vendor-form div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
        var fieldWrapper = $("<div class=\"row\" style=\"margin-top:5px\" id=\"field" + intId + "\"/>");
        fieldWrapper.data("idx", intId);
        var fName = $("<input style=\"width:40%;margin-left:10px;margin-right:8px;\" placeholder=\"nama vendor\" type=\"text\" name=\"vendor_name[]\" class=\"form-control\" />");
        var fEmail = $("<input style=\"width:40%;margin-right:15px;\" type=\"email\" placeholder=\"email\" name=\"vendor_email[]\" class=\"form-control\" />");
        var removeButton = $("<input type=\"button\" class=\"btn btn-danger btn-sm remove\" value=\"-\" />");
        removeButton.click(function() {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(fEmail);
        fieldWrapper.append(removeButton);
        $("#vendor-form").append(fieldWrapper);
    });

</script>

@endsection