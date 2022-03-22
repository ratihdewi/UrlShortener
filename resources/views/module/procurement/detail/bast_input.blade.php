
<form action="{{route('procurement.bast.store', [$spph])}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Input Bast</h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Nama Vendor </label>
                                <input disabled required="true" value="{{ $spph->vendor->name }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Perihal </label>
                                <input disabled required="true" value="{{ $spph->procurement->name }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">No Surat </label>
                                <input name="no_surat" required="true" value="{{ old('no_surat') }}" class="form-control{{ $errors->has('no_surat') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('no_surat'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('no_surat') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Pihak Pertama </label>
                                <select class="form-control select2" name="user_id" style="width:100%">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}} - {{$user->role_caption}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Nomor SPMP </label>
                                <input disabled required="true" value="{{ $spph->po->no_spmp }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Nama Pihak Kedua </label>
                                <input name="nama_pihak_kedua" required="true" value="{{ old('nama_pihak_kedua') }}" class="form-control{{ $errors->has('nama_pihak_kedua') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('nama_pihak_kedua'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('nama_pihak_kedua') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Jabatan Pihak Kedua</label>
                                <input name="jabatan_pihak_kedua" required="true" value="{{ old('jabatan_pihak_kedua') }}" class="form-control{{ $errors->has('jabatan_pihak_kedua') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('jabatan_pihak_kedua'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('jabatan_pihak_kedua') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Upload Dokumen&nbsp;</label>
                                <input name="bast_file" required="true" value="{{ old('bast_file') }}" class="form-control{{ $errors->has('bast_file') ? ' is-invalid' : '' }}" type="file"/>
                                @if ($errors->has('bast_file'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('bast_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div> 
</div>
<div class="modal-footer">
    <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>
</form>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('.select2').select2()
        $(".datepicker").datepicker({
            startDate: new Date(),
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    } );
    
</script>
