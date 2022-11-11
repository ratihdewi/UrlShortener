
@if($procurement->status >= 4)
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-hover" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Vendor</th>
                                <th>Nomor SPPH</th>
                                <th>Harga Dasar</th>
                                @if($procurement->mechanism_id!=3)<th>Penilaian Vendor</th>@endif
                                <th>Harga Vendor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($procurement->spphs as $row)
                                @if($row->has_penawaran)
                                    @if(!$row->hidden)
                                        <tr>
                                            <td>{{$row->vendor->name}}</td>
                                            <td>{{$row->no_spph}}</td>
                                            <td></td>
                                            @if($procurement->mechanism_id!=3)<td>{{$row->penawaran_score}}</td>@endif
                                            <td></td>
                                            <td>
                                                @if($row->has_negosiasi)
                                                    @if($procurement->status == 4)
                                                        <a class="btn btn-sm btn-light" data-toggle="modal" id="getEditNegosiasi" data-target="#editNegosiasiModal" data-url="{{route('procurement.banegosiasi.edit', [$row])}}" href="#."><small>Ubah Negosiasi</small></a>
                                                    @endif
                                                    <a class="btn btn-sm btn-warning" data-toggle="modal" id="getShowNegosiasi" data-target="#showNegosiasiModal" data-url="{{route('procurement.banegosiasi.show', [$row])}}" href="#."><small>Lihat Negosiasi</small></a>
                                                @else
                                                    <a class="btn btn-sm btn-light" data-toggle="modal" id="getInputNegosiasi" data-target="#inputNegosiasiModal" data-url="{{route('procurement.banegosiasi.input', [$row])}}" href="#."><small>Buat Negosiasi</small></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($row->penawarans as $penawaran)
                                        @if(!$penawaran->spph->hidden)
                                            <tr @if($penawaran->can_win == 0) style="color:red" @endif>
                                                <td></td>
                                                <td>{{$penawaran->item->name}} x {{$penawaran->item->total_unit}}</td>
                                                <td>Rp{{number_format($penawaran->item->price_total*$penawaran->item->total_unit,2)}}</td>
                                                <td>{{$penawaran->nilai}}</td>
                                                <td>Rp{{number_format($penawaran->harga_total,2)}}</td>
                                                <td>@if($penawaran->can_win == 1 && $procurement->status == 4)<a class="btn btn-sm btn-danger" href="{{route('procurement.banegosiasi.lose', [$penawaran])}}"><small>X</small></a>@elseif($penawaran->can_win == 0 && $procurement->status == 4)<a class="btn btn-sm btn-warning" href="{{route('procurement.banegosiasi.loseundo', [$penawaran])}}"><small>Undo</small></a>@endif </td>
                                            </tr>
                                        @endif
                                    @endforeach
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
                @if($procurement->status == 4)
                    <button class="btn btn-danger float-left ml-2" id="btn-batal-procurement">Batalkan Pengajuan</button>
                    <form id="form-batal-procurement" method="POST" action="{{route('procurement.cancel', [$procurement])}}">
                        @csrf
                    </form>
                    <a href="{{route('procurement.banegosiasi.done', [$procurement])}}" class="btn btn-primary float-right" style="margin-left:10px">Selesaikan Proses BA Negosiasi</a>
                @endif
                <a href="{{route('procurement.index')}}" class="btn btn-light float-right" style="margin-left:10px">Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inputNegosiasiModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content input-banegosiasi-modal">
            
        </div>
    </div>
</div>

<div class="modal fade" id="showNegosiasiModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content show-banegosiasi-modal">
            
        </div>
    </div>
</div>

<div class="modal fade" id="editNegosiasiModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content edit-banegosiasi-modal">
            
        </div>
    </div>
</div>

@endif

<script type="text/javascript">

   

    $(document).on('click', '#getInputNegosiasi', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.input-banegosiasi-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.input-banegosiasi-modal').html('');    
            $('.input-banegosiasi-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).on('click', '#getShowNegosiasi', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.show-banegosiasi-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.show-banegosiasi-modal').html('');    
            $('.show-banegosiasi-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).on('click', '#getEditNegosiasi', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.edit-banegosiasi-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.edit-banegosiasi-modal').html('');    
            $('.edit-banegosiasi-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

</script>




