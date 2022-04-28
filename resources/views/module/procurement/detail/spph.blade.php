
@if($procurement->status >= 2)
<!-- Account page navigation-->
<nav class="nav nav-borders">
    <a class="nav-link @if(!isset($tenderterbuka)) active ml-0 @endif" href="{{route('procurement.show', [$procurement, 2])}}#spphtender">Spph</a>
    @if($procurement->mechanism_id==6)<a class="nav-link @if(isset($tenderterbuka)) active ml-0 @endif" href="{{route('procurement.show.penawaran.tenderterbuka', [$procurement, 2])}}#penawarantender">Penawaran Terbuka</a>@endif
</nav>
<hr class="mt-0 mb-4" />

<div class="row" id="spphtender">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
                @if($procurement->status == 2 && $procurement->mechanism_id!=6)
                    <a href="" class="btn btn-sm btn-success float-right" style="margin-right:10px" data-toggle="modal" data-target="#uploadPenawaranModal">Unggah File Penawaran</a>
                @endif
            </div>
            <div class="card-body">
                @if($procurement->mechanism_id!=6)
                    <form action="{{route('procurement.spph.ajukan', [$procurement])}}" method="POST">
                    @csrf
                @endif
                <div class="datatable">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @if($procurement->mechanism_id!=6)
                                    <th class="text-center"><input type="checkbox" name="check-all" id="check-all" value=""/></th>
                                    <th>Status</th>
                                @endif
                                <th>Nama Vendor</th>
                                <th>Nomor SPPH</th>
                                <th>Penilaian Vendor</th>
                                <th>Batas Penawaran</th>
                                <th>Penawaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($procurement->spphs as $row)
                                <tr>
                                    @if($procurement->mechanism_id!=6)
                                        <td class="text-center">
                                        @if(Auth::user()->role_id <=3)
                                            @if($row->status == 1)
                                                <input type="checkbox" name="checkbox[]" value="{{$row->id}}" checked />
                                            @else
                                                <input type="checkbox" name="checkbox[]" value="{{$row->id}}"/>
                                            @endif
                                        @else
                                            <input type="checkbox" name="checkbox[]" value="{{$row->id}}"/>
                                        @endif
                                        </td>
                                        <td>{{$row->status_caption}}</td>
                                    @endif
                                    <td>{{$row->vendor->name}}</td>
                                    <td>{{$row->no_spph}} <a href="{{route('procurement.item.export', [$row->id])}}"><i data-feather="download"></i></a></td>
                                    <td class="text-center"><div class="rateit" data-rateit-value="{{$row->vendor->score}}" style="font-family:fontawesome" data-rateit-resetable="false" data-rateit-readonly="true"></div></td>
                                    <td>{{$row->batas_penawaran_date}} @if(!$row->has_penawaran) <a href="#." id="edit-batas" data-tanggal="{{$row->batas_penawaran_date}}" data-item-id="{{$row->id}}"> <i data-feather="edit"></i></a>@endif</td>
                                    <td>
                                        @if($row->has_penawaran) 
                                        <a class="btn btn-sm btn-light" data-toggle="modal" id="getDetailPenawaran" data-target="#penawaranDetailModal" data-url="{{route('procurement.penawaran.detail', [$row])}}" href="#."><small>Lihat Penawaran</small></a>
                                        @else 
                                            Belum ada penawaran 
                                        @endif
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
                    @if($procurement->mechanism_id != 6)
                    @if(Auth::user()->role_id==3)
                        <button type="submit" class="btn btn-warning float-left" style="margin-left:10px">Ajukan Kirim SPPH</button></form>
                    @else
                        <button type="submit" class="btn btn-warning float-left" style="margin-left:10px">Kirim SPPH</button></form>
                    @endif
                    <button class="btn btn-danger float-left ml-2" id="btn-batal-procurement">Batalkan Pengajuan</button>
                    <form id="form-batal-procurement" method="POST" action="{{route('procurement.cancel', [$procurement])}}">
                        @csrf
                    </form>
                    @endif
                    <a href="{{route('procurement.penawaran.done', [$procurement])}}" class="btn btn-primary float-right" style="margin-left:10px">Selesaikan Proses Penawaran</a>
                
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

@include('module.procurement.detail.spph_ubah_batas')

@endif

<script type="text/javascript">
    $("#check-all").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
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

    $(document).ready(function() {
        $('#penawaran-table').DataTable();

        $(document).on('click', "#edit-batas", function() {
            $(this).addClass('edit-batas-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
            'backdrop': 'static'
            };
            $('#ubahBatasModal').modal(options)
        })

        // on modal show
        $('#ubahBatasModal').on('show.bs.modal', function() {
            var el = $(".edit-batas-trigger-clicked"); // See how its usefull right here? 
            var row = el.closest(".data-row");

            // get the data
            var id = el.data('item-id');
            var tanggal = el.data('tanggal');

            // fill the data in the input fields
            $("#spph-id").val(id);
            $("#modal-tanggal").val(tanggal);
        })

        // on modal hide
        $('#ubahBatasModal').on('hide.bs.modal', function() {
            $('.edit-batas-trigger-clicked').removeClass('edit-batas-trigger-clicked')
            $("#edit-form").trigger("reset");
        })
    } );

    
</script>