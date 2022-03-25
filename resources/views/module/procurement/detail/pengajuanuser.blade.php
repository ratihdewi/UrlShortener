<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
                @if($procurement->status == 0)
                    <a href="" class="btn btn-sm btn-primary float-right" style="margin-right:10px" data-toggle="modal" data-target="#addItemNoJsModal">Tambah Item</a>
                    <a href="" class="btn btn-sm btn-success float-right" style="margin-right:10px" data-toggle="modal" data-target="#importItemModal">Import Item</a>
                @endif
            </div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Unit</th>
                                <th>Spesifikasi</th>
                                <th>Brosur</th>
                                <th>Harga Total</th>
                                @if($procurement->mechanism_id!=3 && $procurement->mechanism_id!=4 && $procurement->mechanism_id!=6)
                                    <th>@if($procurement->mechanism_id==1) Rekomendasi Vendor @else Vendor @endif</th>
                                @endif
                                @if($procurement->status==0 || $procurement->status==1)<th class="text-center">Aksi</th>@endif
                            </tr>
                        </thead>
                        <tfoot>
                            
                        </tfoot>
                        <tbody>
                            @forelse($procurement->items as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->category['name']}}</td>
                                    <td>{{number_format($row->price_est, 2)}}</td>
                                    <td>{{$row->total_unit}}</td>
                                    <td>{{$row->specs}}</td>
                                    <td>@if($row->brosur_file!=NULL)<a href="{{route('procurement.file.download', [$row->id, 'brosur'])}}"> Download </a>@endif</td>
                                    <td>{{number_format($row->price_total, 2)}}</td>
                                    @if($procurement->mechanism_id==1)
                                        <td>
                                            @foreach($row->vendorRecomendation as $recomendation) 
                                                {{$recomendation->vendor['name']}}{{ $loop->last ? '' : ',' }}
                                            @endforeach
                                        </td>
                                    @elseif($procurement->mechanism_id==2 || $procurement->mechanism_id==5 || $procurement->mechanism_id==7)
                                        @if(Auth::user()->role_id==4)
                                            <td>@if($row->has_vendor_bast) {{$row->vendorBast->vendor->name}} @endif</td>
                                        @else
                                        <td>
                                            <form action="{{route('procurement.umk.vendor.assign', [$row])}}" method="POST" id="form-assign-{{$row->id}}">
                                                @csrf
                                                <select class="form-control select2" style="width:250px" name="vendor_id" id="select-assign-{{$row->id}}">
                                                    <option value="0">Belum ada vendor dipilih</option>
                                                    @foreach($vendors as $vendor)
                                                        <option value="{{$vendor->id}}" @if($row->has_vendor_bast) @if($vendor->id == $row->vendorBast->vendor_id) selected @endif @endif>{{$vendor->name}}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <script type="text/javascript">
                                            $(function(){
                                                $('#select-assign-{{$row->id}}').on('change', function () {
                                                     document.getElementById('form-assign-{{$row->id}}').submit();
                                                });
                                            });
                                        </script>
                                        @endif
                                    @endif
                                    @if($procurement->status==0 || $procurement->status==1)
                                    <td class="text-center">
                                        <a class="btn btn-hapus-item btn-sm btn-danger" href="{{route('procurement.item.delete', [$row])}}"><small>Hapus</small></a>
                                        <a class="btn btn-sm btn-primary" data-toggle="modal" id="update-item" data-target="#itemUpdateModal" data-url="{{route('procurement.item.edit', [$row])}}" href="#.">
                                            Ubah
                                        </a>
                                    </td>
                                    @endif
                                </tr>
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
                @if($procurement->status == 0)
                    <button class="btn btn-primary float-right" id="btn-ajukan-procurement" style="margin-left:10px">Kirim</button>
                @elseif($procurement->status == 1 && Auth::user()->role_id != 4)
                    @if(Auth::user()->role_id == 2)
                        <button class="btn btn-danger float-left" id="btn-batal-procurement">Batalkan Pengajuan</button>
                    @endif
                    <a href="{{route('procurement.spph.input', [$procurement])}}" @if($status_dispo) class="btn btn-primary float-right" @else class="btn btn-primary float-right disabled" @endif style="margin-left:10px">Submit</a>
                @endif
                <a href="{{route('procurement.index')}}" class="btn btn-light float-right" style="margin-left:10px">Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="itemUpdateModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content item-update-modal">
            
        </div>
    </div>
</div>


<form id="form-batal-procurement" method="POST" action="{{route('procurement.cancel', [$procurement])}}">
    @csrf
</form>

<script type="text/javascript">

    $(document).ready(function() {

    $(document).on('click', '#update-item', function(e){
            e.preventDefault();
            var url = $(this).data('url');
            $('.item-update-modal').html(''); 
            $('#modal-loader').show();  
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data){
            // console.log(data);  
                $('.item-update-modal').html('');    
                $('.item-update-modal').html(data); // load response 
                $('#modal-loader').hide();        // hide ajax loader   
            })
            .fail(function(){
                $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                $('#modal-loader').hide();
            });
        });

    } );

    
</script>

