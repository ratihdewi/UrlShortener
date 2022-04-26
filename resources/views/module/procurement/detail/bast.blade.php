
@if($procurement->status >= 7)
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
                            @if($row->has_po)
                                <tr>
                                    <td>{{$row->vendor->name}}</td>
                                    <td>{{$row->no_spph}}</td>
                                    <td class="text-center">Rp{{number_format($row->penawarans->where('won', 1)->sum('harga_total')-$row['negosiasi']['negosiasi'],2)}}</td>
                                    <td>
                                        @if($row->has_bast)
                                        <a class="btn btn-sm btn-warning" data-toggle="modal" id="getShowBast" data-target="#showBastModal" data-url="{{route('procurement.bast.show', [$row])}}" href="#."><small>Lihat BAST</small></a>
                                        @else
                                            <a class="btn btn-sm btn-light" data-toggle="modal" id="getInputBast" data-target="#inputBastModal" data-url="{{route('procurement.bast.input', [$row])}}" href="#."><small>Buat BAST</small></a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
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
                @if($procurement->status == 7)
                <button class="btn btn-danger float-left ml-2" id="btn-batal-procurement">Batalkan Pengajuan</button>
                    <form id="form-batal-procurement" method="POST" action="{{route('procurement.cancel', [$procurement])}}">
                        @csrf
                    </form>
                    <a href="{{route('procurement.bast.done', [$procurement])}}" class="btn btn-primary float-right" style="margin-left:10px">Selesaikan Proses BAST</a>
                @endif
                <a href="{{route('procurement.index')}}" class="btn btn-light float-right" style="margin-left:10px">Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inputBastModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content input-bast-modal">
            
        </div>
    </div>
</div>

<div class="modal fade" id="showBastModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content show-bast-modal">
            
        </div>
    </div>
</div>

@endif

<script type="text/javascript">

    $(document).on('click', '#getInputBast', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.input-bast-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.input-bast-modal').html('');    
            $('.input-bast-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).on('click', '#getShowBast', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.show-bast-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.show-bast-modal').html('');    
            $('.show-bast-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

</script>




