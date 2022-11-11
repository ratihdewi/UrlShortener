
@if($procurement->status >= 5)
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
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Spesifikasi</th>
                                <th>Harga Satuan</th>
                                <th>Kuantitas</th>
                                <th>Total Harga</th>
                                <th>Nama Vendor</th>
                                <th>Proses Pengadaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($procurement->penawarans as $row)
                                @if(!$row->spph->hidden)
                                    <tr>
                                        <td>{{$row->item->name}}</td>
                                        <td>{{$row->item->category->name}}</td>
                                        <td>{{$row->item->specs}}</td>
                                        <td>Rp{{number_format($row->harga_satuan,2)}}</td>
                                        <td>{{$row->item->total_unit}}</td>
                                        <td>Rp{{number_format($row->item->total_unit*$row->harga_satuan, 2)}}</td>
                                        <td>{{$row->spph->vendor->name}}</td>
                                        <td>BAPP</td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="8"><center><i>Tidak ada data.</i></center></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($procurement->status >= 5)
                    @if($procurement->has_bapp)
                        <a data-toggle="modal" id="getShowBapp" data-target="#showBappModal" data-url="{{route('procurement.bapp.show', [$procurement])}}" href="#." class="btn btn-primary float-right" style="margin-left:10px">Lihat BAPP</a>
                        @if($procurement->status == 5)
                            <a data-toggle="modal" id="getEditBapp" data-target="#editBappModal" data-url="{{route('procurement.bapp.edit', [$procurement])}}" href="#." class="btn btn-warning float-right" style="margin-left:10px">Ubah BAPP</a>
                        @endif
                    @else
                        <a data-toggle="modal" id="getInputBapp" data-target="#inputBappModal" data-url="{{route('procurement.bapp.input', [$procurement])}}" href="#." class="btn btn-primary float-right" style="margin-left:10px">KIRIM BAPP</a>
                    @endif
                @endif
                @if($procurement->status == 5)
                    <button class="btn btn-danger float-left ml-2" id="btn-batal-procurement">Batalkan Pengajuan</button>
                    <form id="form-batal-procurement" method="POST" action="{{route('procurement.cancel', [$procurement])}}">
                        @csrf
                    </form>
                    <a href="{{route('procurement.bapp.done', [$procurement])}}" class="btn btn-primary float-left" style="margin-left:10px">Selesaikan BAPP</a>
                @endif
                <a href="{{route('procurement.index')}}" class="btn btn-light float-right" style="margin-left:10px">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="inputBappModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content input-bapp-modal">
            
        </div>
    </div>
</div>

<div class="modal fade" id="showBappModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content show-bapp-modal">
            
        </div>
    </div>
</div>

<div class="modal fade" id="editBappModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content edit-bapp-modal">
            
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).on('click', '#getInputBapp', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.input-bapp-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.input-bapp-modal').html('');    
            $('.input-bapp-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).on('click', '#getShowBapp', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.show-bapp-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.show-bapp-modal').html('');    
            $('.show-bapp-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).on('click', '#getEditBapp', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.edit-bapp-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.edit-bapp-modal').html('');    
            $('.edit-bapp-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).ready(function() {
       var span = 1;
       var prevTD = "";
       var prevTDVal = "";
       $("#dataTable tr td:first-child").each(function() { //for each first td in every tr
          var $this = $(this);
          if ($this.text() == prevTDVal) { // check value of previous td text
             span++;
             if (prevTD != "") {
                prevTD.attr("rowspan", span); // add attribute to previous td
                $this.remove(); // remove current td
             }
          } else {
             prevTD     = $this; // store current td 
             prevTDVal  = $this.text();
             span       = 1;
          }
       });
    });
</script>