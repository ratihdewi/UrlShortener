
@if($procurement->status >= 4)
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
                @if($procurement->status == 4 && !$procurement->has_pjumk)
                    <a class="btn btn-sm btn-primary float-right" data-toggle="modal" id="getInputPjUmk" data-target="#inputPjUmkModal" data-url="{{route('procurement.umk.pj.input', [$procurement])}}" href="#."><small>Input PJ  @if($procurement->mechanism_id==7) CC @else UMK @endif</small></a>
                @endif
                @if($procurement->status >= 4 && $procurement->has_pjumk)
                    <a class="btn btn-sm btn-primary float-right" href="{{route('procurement.umk.pj.cetak', [$procurement])}}"><small>Cetak PJ  @if($procurement->mechanism_id==7) CC @else UMK @endif</small></a>
                @endif
            </div>
            <div class="card-body">
                @if(!$procurement->has_pjumk)
                <div class="row">
                    <center><i>Belum ada PJ @if($procurement->mechanism_id==7) CC @else UMK @endif</i></center>
                </div>
                @else
                <div class="row">
                    <div class="col-xl-6">
                        <!-- Form Group (username)-->
                        <div class="form-group">
                            <label class="small mb-1">No Memo @if($procurement->mechanism_id==7) CC @else UMK @endif </label>
                            <h3 style="margin-left:10px;">{{$procurement->pjumk->no_memo_umk}}</h3>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Nama </label>
                            <h3 style="margin-left:10px;">{{$procurement->pjumk->name}}</h3>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">No Pekerja</label>
                            <h3 style="margin-left:10px;">{{$procurement->pjumk->no_pekerja}}</h3>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Jabatan</label>
                            <h3 style="margin-left:10px;">{{$procurement->pjumk->jabatan}}</h3>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Fungsi </label>
                            <h1 style="margin-left:10px;">{{$procurement->pjumk->fungsi}}</h1>
                        </div>
                    </div>
                    <div class="col-xl-6 float-right">
                        <div class="form-group">
                            <label class="small mb-1">GL Account/Cost Element </label>
                            <h1 style="margin-left:10px;">{{$procurement->pjumk->gl_account}}</h1>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Cost Center </label>
                            <h1 style="margin-left:10px;">{{$procurement->pjumk->cost_center}}</h1>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Total </label>
                            <h3 style="margin-left:10px;">Rp{{number_format($procurement->pjumk->total,2)}}</h3>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">invoice </label>
                            <h3 style="margin-left:10px;">{{$procurement->pjumk->invoice_file}}&nbsp;<a href="{{route('procurement.file.download', [$procurement, 'invoice'])}}"><i data-feather="download"></i></a></h3>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-footer">
                @if($procurement->has_pjumk)
                    @if($procurement->status == 4 && $procurement->mechanism_id == 2 || $procurement->status == 4 && $procurement->mechanism_id == 5 || $procurement->status == 4 && $procurement->mechanism_id == 7)
                        <a href="{{route('procurement.umk.pj.done', [$procurement])}}" class="btn btn-primary float-right" style="margin-left:10px">Selesaikan Proses Pengadaan</a>
                    @endif
                @endif
                <a href="{{route('procurement.index')}}" class="btn btn-light float-right" style="margin-left:10px">Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inputPjUmkModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content input-pjumk-modal">
            
        </div>
    </div>
</div>

@endif

<script type="text/javascript">

    $(document).on('click', '#getInputPjUmk', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.input-pjumk-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.input-pjumk-modal').html('');    
            $('.input-pjumk-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

</script>




