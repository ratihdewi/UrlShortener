
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Bast</h5>
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
                                <input disabled required="true" value="{{ $spph->bast->no_surat }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Pihak Pertama </label>
                                <input disabled required="true" value="{{ $spph->bast->user->role_caption }} - {{ $spph->bast->user->name }}" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Nomor SPMP </label>
                                <input disabled required="true" value="{{ $spph->po->no_spmp }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Nama Pihak Kedua </label>
                                <input disabled required="true" value="{{ $spph->bast->nama_pihak_kedua }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Jabatan Pihak Kedua</label>
                                <input disabled required="true" value="{{ $spph->bast->jabatan_pihak_kedua }}" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Dokumen&nbsp;</label><br>
                                <a class="btn btn-sm btn-warning" href="{{route('procurement.file.download', [$spph->id, 'bast'])}}">Download Dokumen</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div> 
</div>
<div class="modal-footer">
    <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
</div>

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
