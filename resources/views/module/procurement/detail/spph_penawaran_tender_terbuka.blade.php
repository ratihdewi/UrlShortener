
@if($procurement->status >= 2)
<!-- Account page navigation-->
<nav class="nav nav-borders">
    <a class="nav-link @if(!isset($tenderterbuka)) active ml-0 @endif" href="{{route('procurement.show', [$procurement, 2])}}#spphtender">Spph</a>
    <a class="nav-link @if(isset($tenderterbuka)) active ml-0 @endif" href="{{route('procurement.show.penawaran.tenderterbuka', [$procurement, 2])}}#penawarantender">Penawaran Terbuka</a>
</nav>
<hr class="mt-0 mb-4" />

<div class="row" id="penawarantender">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
                <font class="float-left" style="color:grey;margin-right:10px;">Batas Penawaran: {{date('Y-m-d', strtotime($procurement->tanggal_batas_tender_terbuka))}}</font>
                <a href="#." id="edit-batas-tenderterbuka" data-tanggal-batas="{{date('Y-m-d', strtotime($procurement->tanggal_batas_tender_terbuka))}}" data-item-id="{{$procurement->id}}" class="btn btn-sm btn-warning float-left" style="margin-right:10px">Ubah</a> 
                <a href="{{route('procurement.tenderterbuka.spph.download', [$procurement])}}" class="btn btn-sm btn-info float-right" style="margin-right:10px">Download File SPPH</a>
                <a target="_blank" href="{{route('procurement.tenderterbuka.input', [$procurement->id])}}" class="btn btn-sm btn-primary float-right" style="margin-right:10px">Link Penawaran</a>
            </div>
            <div class="card-body">
                @csrf
                <div class="datatable">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Vendor</th>
                                <th>Email Vendor</th>
                                <th>Status</th>
                                <th>Penawaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($procurement->penawaranterbukas as $row)
                                <tr>
                                    <td>{{$row->vendor->name}}</td>
                                    <td>{{$row->vendor->email}}</td>
                                    <td>{{$row->status_caption}}</td>
                                    <td>
                                        @php $date = \Carbon\Carbon::now()->format('Y-m-d') @endphp
                                        <a class="btn btn-sm btn-light" data-toggle="modal" id="getDetailPenawaran" data-target="#penawaranDetailModal" data-url="{{route('procurement.tenderterbuka.penawaran.detail', [$row])}}" href="#."><small>@if($procurement->tanggal_batas_tender_terbuka > $date) Lihat Vendor @else Lihat Penawaran @endif</small></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"><center><i>Tidak ada data.</i></center></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($procurement->status == 2)
                    <a href="{{route('procurement.penawaran.done', [$procurement])}}" class="btn btn-primary float-right" style="margin-left:10px">Selesaikan Proses Penawaran</a>
                @endif
                <a href="{{route('procurement.index')}}" class="btn btn-light float-right" style="margin-left:10px">Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="penawaranDetailModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content penawaran-modal">
            
        </div>
    </div>
</div>

@include('module.procurement.tenderterbuka.ubah_batas')

@endif

<script type="text/javascript">
    $(document).on('click', '#getDetailPenawaran', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.penawaran-modal').html(''); 
        $('#modal-loader').show();  
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
           // console.log(data);  
            $('.penawaran-modal').html('');    
            $('.penawaran-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });

    $(document).ready(function() {
        $(document).on('click', "#edit-batas-tenderterbuka", function() {
            $(this).addClass('edit-batas-tenderterbuka-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
            'backdrop': 'static'
            };
            $('#ubahBatasTenderTerbukaModal').modal(options)
        })

        // on modal show
        $('#ubahBatasTenderTerbukaModal').on('show.bs.modal', function() {
            var el = $(".edit-batas-tenderterbuka-trigger-clicked"); // See how its usefull right here? 
            var row = el.closest(".data-row");

            // get the data
            var id = el.data('item-id');
            var tanggal = el.data('tanggal-batas');

            // fill the data in the input fields
            $("#procurement-id").val(id);
            $("#modal-tanggal").val(tanggal);
        })

        // on modal hide
        $('#ubahBatasTenderTerbukaModal').on('hide.bs.modal', function() {
            $('.edit-batas-tenderterbuka-trigger-clicked').removeClass('edit-batas-tenderterbuka-trigger-clicked')
            $("#edit-form").trigger("reset");
        })
    } );

    
</script>