<div class="modal fade" id="procurementDocModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-75" role="document" >
        <div class="modal-content" style="min-height:700px;">
            <div class="modal-header" style="padding-right:30px;">
                <h5 class="modal-title" id="exampleModalLabel">Import Item</h5>
                
            </div>
            <div class="modal-body">
                <div class="row" style="min-height:550px;" >
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label class="small mb-1"><a id="viewTor" data-url="{{route('procurement.file.view', [$procurement, 'tor'])}}" href="#.">ToR</a></label>
                        </div>
                        @if($procurement->mechanism_id != 2)
                        <div class="form-group">
                            <label class="small mb-1">Spph&nbsp;</label>
                            <div class="timeline timeline-sm">
                                <table style="margin-left:10px;font-size:9pt">
                                @foreach($procurement->spphs as $row)
                                    <tr>
                                        <td><a id="viewTor" data-url="{{route('procurement.file.view', [$row->id, 'spph'])}}" href="#."> {{$row->vendor->name}} </a></td>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                        @endif
                        @if($procurement->mechanism_id != 2)
                        <div class="form-group">
                            <label class="small mb-1"><a id="viewSpph" data-url="{{route('procurement.file.view', [$procurement, 'evaluasi'])}}" href="#."> Tender Evaluasi</a></label>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Ba Negosiasi&nbsp;</label>
                            <div class="timeline timeline-sm">
                                <table style="margin-left:10px;font-size:9pt">
                                @foreach($procurement->spphs as $row)
                                    @if($row->has_negosiasi)
                                    <tr>
                                        <td><a id="viewTor" data-url="{{route('procurement.file.view', [$row->id, 'banegosiasi'])}}" href="#."> {{$row->vendor->name}}</i></a></td>
                                    </tr>
                                    @endif
                                @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1"><a id="viewSpph" data-url="{{route('procurement.file.view', [$procurement, 'bapp'])}}" href="#."> Bapp</a></label>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">PO&nbsp;</label>
                            <div class="timeline timeline-sm">
                                <table style="margin-left:10px;font-size:9pt">
                                @foreach($procurement->spphsWon as $row)
                                    @if($row->has_po)
                                    <tr>
                                        <td><a id="viewTor" data-url="{{route('procurement.file.view', [$row->id, 'po'])}}" href="#."> {{$row->vendor->name}}</a></td>
                                    </tr>
                                    @endif
                                @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">BAST&nbsp;</label>
                            <div class="timeline timeline-sm">
                                <table style="margin-left:10px;font-size:9pt">
                                @foreach($procurement->spphsWon as $row)
                                    @if($row->has_bast)
                                    <tr>
                                        <td><a id="viewTor" data-url="{{route('procurement.file.view', [$row->id, 'bast'])}}" href="#."> {{$row->vendor->name}}</a></td>
                                    </tr>
                                    @endif
                                @endforeach
                                </table>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="small mb-1">SP3&nbsp;</label>
                            <div class="timeline timeline-sm">
                                <table style="margin-left:10px;font-size:9pt">
                                @foreach($procurement->sp3s as $row)
                                    <tr>
                                        <td><a id="viewTor" data-url="{{route('procurement.file.view', [$row->id, 'sp3'])}}" href="#."> {{$row->sp3_file}}</a></td>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                        @if($procurement->mechanism_id == 2)
                            <div class="form-group">
                                <label class="small mb-1">BAST&nbsp;</label>
                                <div class="timeline timeline-sm">
                                    <table style="margin-left:10px;font-size:9pt">
                                    @foreach($procurement->bastUmks as $row)
                                        <tr>
                                            <td><a id="viewTor" data-url="{{route('procurement.file.view', [$row->id, 'bast_umk'])}}" href="#."> {{$row->bast_file}}</a></td>
                                        </tr>
                                    @endforeach
                                    </table>
                                </div>
                            </div>
                            @if($procurement->has_pjumk)
                            <div class="form-group">
                                <label class="small mb-1"><a id="viewSpph" data-url="{{route('procurement.file.view', [$procurement, 'invoice'])}}" href="#."> Invoice</a></label>
                            </div>
                            @endif
                        @endif
                    </div>
                    <div class="col-xl-9">
                        <div class="dokumen-detail" style="height:100%;">
                            <embed src="{{asset('tors/').'/'.$procurement->tor_file}}" width="100%" style="height:100%;">
                            </embed>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="{{route('procurement.file.download.all', [$procurement])}}">Download Semua</a>
                <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).on('click', '#viewTor', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.dokumen-detail').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.dokumen-detail').html('');    
            $('.dokumen-detail').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).on('click', '#viewSpph', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.dokumen-detail').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.dokumen-detail').html('');    
            $('.dokumen-detail').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).on('click', '#viewTenderEvaluasi', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.dokumen-detail').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.dokumen-detail').html('');    
            $('.dokumen-detail').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });
    
</script>