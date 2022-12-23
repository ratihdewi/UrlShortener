<div class="modal fade" id="edit-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Detail Pengadaan</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('procurement.update', [$procurement->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label class="small mb-1">No. Memo&nbsp;</label><label class="small mb-1" style="color:red">*</label>
                            <br><select class="form-control select2" name="no_memo" id="select_memo" style='width:100%'>
                                @foreach($data_memos as $row)
                                    <option value="{{$row['nomor_surat']}}" @if($row['nomor_surat'] == $procurement->no_memo) selected @endif>{{$row['nomor_surat']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Perihal&nbsp;</label><label class="small mb-1" style="color:red">*</label>
                            <input name="name" readonly="readonly" required="true" value="{{ $procurement->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="perihal"/>
                            @if ($errors->has('name'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Kerangka Acuan Kerja (ToR)&nbsp;</label><label class="small mb-1"><a href="{{route('procurement.file.download', [$procurement->id, 'tor'])}}"> Download file saat ini </a></label>
                            <div class="row" style="margin-left:1px;">
                                <input name="tor_file" class="form-control" style="width:300px" type="file"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Nomor RKA</label>
                            <div class="row" style="margin-left:1px;">
                                <input name="no_rka" class="form-control" value="{{ $procurement->no_rka }}" style="width:350px" type="text"/>
                            </div>
                        </div>

                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <div class="form-group">
                                <label class="small mb-1">Ditugaskan </label><br>
                                <select class="form-control select2" style='width:100%' name="staff_id">
                                    <option value="0">Belum ada staff dipilih</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" @if($user->id==$procurement->staff_id) selected @endif>{{$user->name}}</option>
                                    @endforeach
                                </select>
                                {{--@if($procurement->staff_id!=null) <i style="margin-top:8px;margin-left:10px;"data-feather="check-circle"></i> @endif--}}
                            </div>
                        @endif

                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                            <div class="form-group">
                                <label class="small mb-1">Mekanisme </label><br>
                                <select class="form-control select2" style='width:100%' name="mechanism_id" id="mechanism_type">
                                    @foreach($mechanisms as $mechanism)
                                        <option value="{{$mechanism->id}}" @if($mechanism->id==$procurement->mechanism_id) selected @endif>{{$mechanism->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="changeVendorRec">
                                <div class="form-group">
                                    <label class="small mb-1">Rekomenasi Vendor &nbsp;</label>
                                    <select class="form-control" id="methodVendor" onchange="setShowVendor(this)">
                                        <option value="0"> -- Pilih Opsi --</option> 
                                        <option value="1"> Pilih dari daftar </option>
                                        <option value="2"> Masukkan secara manual </option>
                                        <option value="3" class="flex-option"> Custom </option>
                                    </select>
                                </div>
                                <div class="form-group" id="inputManual" hidden>
                                    <input type="button" class="btn btn-primary btn-sm add" value="Tambah" id="add"/>
                                    <div id="vendor-form" style="margin-top:10px;">
                                    </div>
                                </div>
                                <div class="form-group" id="inputList" hidden>
                                    <label class="small mb-1"> Pilih Vendor </label> <br>
                                    <select class="form-control select2" style="width: 100%" name="vendor_select" id="listVendor">
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div id="penunjukan_langsung">
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
                        <div class="form-group" id="afiliasi">
                            <label class="small mb-1">Vendor Afiliasi</label><br>
                            <select class="form-control select2" name="vendor_id_afiliasi" style="width:100%;">
                                <option value="0">Pilih Vendor</option>
                                @foreach($vendor_afiliasis as $vendor)
                                    <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @if($procurement->mechanism_id==3 || $procurement->mechanism_id==4)
                            <div class="form-group">
                                <label class="small mb-1">Vendors </label><br>
                                <select class="form-control select2" style='width:100%' name="vendor_id" id="select_assign_vendor">
                                    <option value="0">Belum ada vendor dipilih</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}" @if($vendor->id==$procurement->vendor->id) selected @endif>{{$vendor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

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

<script type="text/javascript">

    $(document).ready(function () {

        $("#penunjukan_langsung").hide();
        $("#afiliasi").hide();
        $("#changeVendorRec").hide();

        var passedMemos = @json($data_memos);
        $("#select_memo").on("change", function () {
            nomor_surat = $(this).val()
            document.getElementById("perihal").value = passedMemos.find(x => x.nomor_surat === nomor_surat).perihal
        });

        $('#mechanism_type').change(function() {
            $("#changeVendorRec").show();
            id = $(this).val()
            if(id==3) {
                $("#penunjukan_langsung").show();
                $("#afiliasi").hide();
            } else if(id==4) {
                $("#penunjukan_langsung").hide();
                $("#afiliasi").show();
            } else {
                $("#penunjukan_langsung").hide();
                $("#afiliasi").hide();
            }
        });

    });


    function setShowVendor(sel) {

        console.log(sel.value);
    }
    

</script>