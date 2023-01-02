
@if($procurement->status >= 8)
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
                                @if(Auth::user()->role_id!=4)<th>Penawaran</th>@endif
                                <th>Penilaian Vendor</th>
                                <th>Nilai Anda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(Auth::user()->role_id!=4)
                                @forelse($procurement->spphs as $row)
                                    @if($row->has_penawaran)
                                    <tr>
                                        <td>{{$row->vendor->name}}</td>
                                        <td>{{$row->no_spph}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-light" data-toggle="modal" id="getDetailPenawaran" data-target="#penawaranDetailModal" data-url="{{route('procurement.penawaran.detail', [$row])}}" href="#."><small>Lihat Penawaran</small></a>
                                        </td>
                                        <td class="text-center"><div class="rateit" data-rateit-value="{{$row->vendor->score}}" style="font-family:fontawesome" data-rateit-resetable="false" data-rateit-readonly="true"></div></td>
                                        <td>
                                            @php $hasNilai = App\Models\VendorScore::where('user_id', 3)->where('spph_id', $row->id)->first() @endphp
                                            @if(!App\Models\VendorScore::where('user_id', Auth::user()->id)->where('spph_id', $row->id)->exists())
                                                <a class="btn btn-sm btn-light" href="#." id="edit-nilai" data-item-id="{{$row->id}}"> Masukkan Nilai</a
                                            @else 
                                                @php $score = App\Models\VendorScore::where('user_id', Auth::user()->id)->where('spph_id', $row->id)->first() @endphp
                                                <a data-toggle="modal" id="update-nilai" data-target="#nilaiVendorUpdateModal" data-url="{{route('procurement.penilaian.mine', [$score])}}" href="#.">
                                                    <div class="rateit" data-rateit-value="{{$score->score}}" style="font-family:fontawesome" data-rateit-resetable="false" data-rateit-readonly="true"></div>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="5"><center><i>Tidak ada data.</i></center></td>
                                    </tr>
                                @endforelse
                            @else
                                @forelse($procurement->spphsWon as $row)
                                    <tr>
                                        <td>{{$row->vendor->name}}</td>
                                        <td>{{$row->no_spph}}</td>
                                        <td class="text-center"><div class="rateit" data-rateit-value="{{$row->vendor->score}}" style="font-family:fontawesome" data-rateit-resetable="false" data-rateit-readonly="true"></div></td>
                                        <td>
                                            @php $hasNilai = App\Models\VendorScore::where('user_id', 3)->where('spph_id', $row->id)->first() @endphp
                                            @if(!App\Models\VendorScore::where('user_id', Auth::user()->id)->where('spph_id', $row->id)->exists())
                                                <a class="btn btn-sm btn-light" href="#." id="edit-nilai" data-item-id="{{$row->id}}"> Masukkan Nilai</a
                                            @else 
                                                @php $score = App\Models\VendorScore::where('user_id', Auth::user()->id)->where('spph_id', $row->id)->first() @endphp
                                                <a data-toggle="modal" id="update-nilai" data-target="#nilaiVendorUpdateModal" data-url="{{route('procurement.penilaian.mine', [$score])}}" href="#.">
                                                    <div class="rateit" data-rateit-value="{{$score->score}}" style="font-family:fontawesome" data-rateit-resetable="false" data-rateit-readonly="true"></div>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"><center><i>Tidak ada data.</i></center></td>
                                    </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($procurement->status == 8 && Auth::user()->role_id != 4)
                <button class="btn btn-danger float-left ml-2" id="btn-batal-procurement">Batalkan Pengajuan</button>
                    <form id="form-batal-procurement" method="POST" action="{{route('procurement.cancel', [$procurement])}}">
                        @csrf
                    </form>
                <a href="{{route('procurement.penilaian.done', [$procurement])}}" class="btn btn-primary float-right" style="margin-left:10px">Selesaikan Penilaian</a>
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

<div class="modal fade" id="nilaiVendorUpdateModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content nilai-vendor-update-modal">
            
        </div>
    </div>
</div>

@include('module.procurement.detail.penilaian_input')

@endif

<script type="text/javascript">

    $(document).ready(function() {

        $(document).on('click', "#edit-nilai", function() {
            $(this).addClass('edit-nilai-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
            'backdrop': 'static'
            };
            $('#nilaiVendorModal').modal(options)
        })

        // on modal show
        $('#nilaiVendorModal').on('show.bs.modal', function() {
            var el = $(".edit-nilai-trigger-clicked"); // See how its usefull right here? 
            var row = el.closest(".data-row");

            // get the data
            var id = el.data('item-id');

            // fill the data in the input fields
            $("#spph-id").val(id);
        })

        // on modal hide
        $('#nilaiVendorModal').on('hide.bs.modal', function() {
            $('.edit-nilai-trigger-clicked').removeClass('edit-nilai-trigger-clicked')
            $("#edit-form").trigger("reset");
        })


        $(document).on('click', '#update-nilai', function(e){
            e.preventDefault();
            var url = $(this).data('url');
            $('.nilai-vendor-update-modal').html(''); 
            $('#modal-loader').show();  
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data){
            // console.log(data);  
                $('.nilai-vendor-update-modal').html('');    
                $('.nilai-vendor-update-modal').html(data); // load response 
                $('#modal-loader').hide();        // hide ajax loader   
            })
            .fail(function(){
                $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                $('#modal-loader').hide();
            });
        });


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

        
    } );

    
</script>