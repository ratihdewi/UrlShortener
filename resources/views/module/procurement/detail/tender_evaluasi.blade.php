
@if($procurement->status >= 3)
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
            @if($procurement->status == 3)
                <a href="" class="btn btn-sm btn-success float-right" style="margin-left:10px" data-toggle="modal" data-target="#uploadEvaluasiModal">Unggah Tender Evaluasi</a>
                <a class="btn btn-sm btn-warning float-right" href="{{route('procurement.evaluasitender.export', [$procurement->id])}}">Download Template</a>
            @endif
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
                                <th>Evaluasi</th>
                                @if($procurement->mechanism_id!=3)<th>Nilai</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($procurement->penawarans as $row)
                                <tr>
                                    <td>{{$row->item->name}}</td>
                                    <td>{{$row->item->category->name}}</td>
                                    <td>{{$row->item->specs}}</td>
                                    <td>Rp{{number_format($row->harga_satuan,2)}}</td>
                                    <td>{{$row->item->total_unit}}</td>
                                    <td>Rp{{number_format($row->item->total_unit*$row->harga_satuan, 2)}}</td>
                                    <td>{{$row->spph->vendor->name}}</td>
                                    <td>{{$row->evaluasi}}</td>
                                    @if($procurement->mechanism_id!=3)<td>{{$row->nilai}}</td>@endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9"><center><i>Tidak ada data.</i></center></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($procurement->status == 3 && Auth::user()->role_id!=4)
                    <a href="{{route('procurement.evaluasitender.done', [$procurement])}}" class="btn btn-primary float-right" style="margin-left:10px">Selesaikan Evaluasi Tender</a>
                    <button class="btn btn-danger float-left ml-2" id="btn-batal-procurement">Batalkan Pengajuan</button>
                    <form id="form-batal-procurement" method="POST" action="{{route('procurement.cancel', [$procurement])}}">
                        @csrf
                    </form>
                @endif
                <a href="{{route('procurement.index')}}" class="btn btn-light float-right" style="margin-left:10px">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="penawaranDetailModal" role="dialog">
    <div class="modal-dialog mw-100 w-75">
      <!-- Modal content-->
        <div class="modal-content penawaran-modal">
            
        </div>
    </div>
</div>

<script type="text/javascript">
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