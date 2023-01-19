
@if($procurement->status >= 6)
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Vendor</th>
                                <th>Nomor SPPH</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($procurement->spphsWon as $row)
                                <tr>
                                    <td>{{$row->vendor->name}}</td>
                                    <td>{{$row->no_spph}}</td>
                                    @if ($row->vendor->temporary == 1)
                                    <td class="text-center"> Rp {{ number_format($row->po->detail->harga_total) }} </td>
                                    @else
                                    <td class="text-center">Rp {{number_format($row->penawarans->where('won', 1)->sum('harga_total')-$row['negosiasi']['negosiasi'],2)}}</td>
                                    @endif
                                    <td>
                                        @if($row->has_po)
                                            @if($procurement->status == 6)
                                                <a class="btn btn-sm btn-light" data-toggle="modal" id="getEditPo" data-target="#editPoModal" data-url="{{route('procurement.po.edit', [$row])}}" href="#."><small>Ubah PO</small></a>
                                            @endif
                                            <a class="btn btn-sm btn-warning" data-toggle="modal" id="getShowPo" data-target="#showPoModal" data-url="{{route('procurement.po.show', [$row])}}" href="#."><small>Lihat PO</small></a>
                                        @else
                                            <a class="btn btn-sm btn-light" data-toggle="modal" id="getInputPo" data-target="#inputPoModal" data-url="{{route('procurement.po.input', [$row])}}" href="#."><small>Buat PO</small></a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"><center><i>Tidak ada data.</i></center></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($procurement->status == 6)
                <button class="btn btn-danger float-left ml-2" id="btn-batal-procurement">Batalkan Pengajuan</button>
                    <form id="form-batal-procurement" method="POST" action="{{route('procurement.cancel', [$procurement])}}">
                        @csrf
                    </form>
                    <a href="{{route('procurement.po.done', [$procurement])}}" class="btn btn-primary float-right" style="margin-left:10px">Selesaikan Proses PO</a>
                @endif
                <a href="{{route('procurement.index')}}" class="btn btn-light float-right" style="margin-left:10px">Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inputPoModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content input-po-modal">
            
        </div>
    </div>
</div>

<div class="modal fade" id="showPoModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content show-po-modal">
            
        </div>
    </div>
</div>

<div class="modal fade" id="editPoModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content edit-po-modal">
            
        </div>
    </div>
</div>

@endif

<script type="text/javascript">

    $(document).on('click', '#getInputPo', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.input-po-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.input-po-modal').html('');    
            $('.input-po-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).on('click', '#getShowPo', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.show-po-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.show-po-modal').html('');    
            $('.show-po-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).on('click', '#getEditPo', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.edit-po-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.edit-po-modal').html('');    
            $('.edit-po-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

</script>




