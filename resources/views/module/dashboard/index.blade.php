@extends("master.main")

@section("title","Dashboard")

@section("content")

<?php 
    use App\Http\Controllers\ProcurementController;
    $cls = new ProcurementController();
    $tahun = $cls->getYearProcurement();
?>

<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container"><br>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-n10">
    <div class="row">
        <div class="col-xxl-10 col-xl-10 mb-4">
        </div>
        <div class="col-xxl-2 col-xl-2 mb-4">
            <select class="form-control" name="year_select" id="year_select">
                @for($i = $tahun[1]; $i >= $tahun[0]; $i--)
                    <option value="{{route('dashboard.index.with.year', [$i])}}" @if($year == $i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-6 col-xl-6 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                <center>Monthly Chart Total Procurement</center>    
                    <div class="row align-items-center">
                        <div class="chart-area"><canvas id="chartPemasukan" width="100%" height="30"></canvas></div>
                    </div>
                </div>
                <div style="margin-bottom: 10px;">
                    <center>
                        <font style="color:rgba(230, 126, 34);font-size:10pt;">• Menunggu Persetujuan</font>
                        <font style="color:rgba(46, 204, 113);font-size:10pt;">• Sedang Berjalan</font>
                        <font style="color:rgba(52, 152, 219);font-size:10pt;">• Selesai</font>
                        <font style="color:rgba(192, 57, 43);font-size:10pt;">• Batal</font>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-xl-6 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                <center>Last 4 Weeks Chart Total Procurement</center>    
                    <div class="row align-items-center">
                        <div class="chart-area"><canvas id="chartPemasukan2" width="100%" height="30"></canvas></div>
                    </div>
                </div>
                <div style="margin-bottom: 10px;">
                    <center>
                        <font style="color:rgba(230, 126, 34);font-size:10pt;">• Menunggu Persetujuan</font>
                        <font style="color:rgba(46, 204, 113);font-size:10pt;">• Sedang Berjalan</font>
                        <font style="color:rgba(52, 152, 219);font-size:10pt;">• Selesai</font>
                        <font style="color:rgba(192, 57, 43);font-size:10pt;">• Batal</font>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-6 col-xl-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    Top 5 Procurement
                    <select class="form-control float-right" style="font-size:10pt;width:150px;" id="sortby">
                        <option value="waktu">Sort by Waktu</option>
                        <option value="total">Sort by Total</option>
                    </select>
                </div>  
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                    <div class="datatable">
                        <table class="table table-hover" width="100%" style="font-size:10pt" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                
                            </tfoot>
                            <tbody id="sort_waktu">
                                @forelse($procs as $proc)
                                    <tr onclick="window.location='{{route('procurement.show', [$proc, $proc->status])}}';" @if($proc->status_caption=="Selesai") style="color:rgba(52, 152, 219);" @elseif($proc->status_caption=="Dibatalkan") style="color:rgba(192, 57, 43);" @endif>
                                        <td>{{$proc->tanggal_caption}}</td>
                                        <td>{{$proc->name}}</td>
                                        <td>Rp{{number_format($proc->items->sum('price_total'),2)}}</td>
                                @empty
                                    <tr>
                                        <td colspan="7"><center><i>Tidak ada data.</i></center></td>
                                    </tr>
                                @endforelse
                            </tbody>

                            <tbody id="sort_total">
                                @forelse($procs_total as $proc)
                                    <tr onclick="window.location='{{route('procurement.show', [$proc['id'], $proc['status']])}}';" @if($proc['status_caption']=="Selesai") style="color:rgba(52, 152, 219);" @elseif($proc['status_caption']=="Dibatalkan") style="color:rgba(192, 57, 43);" @endif>
                                        <td>{{$proc['tanggal_caption']}}</td>
                                        <td>{{$proc['name']}}</td>
                                        <td>Rp{{number_format($proc['total'],2)}}</td>
                                @empty
                                    <tr>
                                        <td colspan="7"><center><i>Tidak ada data.</i></center></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="margin-bottom: 10px;">
                    <center>
                        <font style="color:rgba(230, 126, 34);font-size:10pt;">• Menunggu Persetujuan</font>
                        <font style="color:rgba(46, 204, 113);font-size:10pt;">• Sedang Berjalan</font>
                        <font style="color:rgba(52, 152, 219);font-size:10pt;">• Selesai</font>
                        <font style="color:rgba(192, 57, 43);font-size:10pt;">• Batal</font>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-xl-6 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                    <center></center><br>
                    <form action="{{route('dashboard.date')}}" method="GET">
                        <div class="row">
                            <div class="col-xl-2">
                                <input type="hidden" name="year" value="{{$year}}">
                            </div>
                            <div class="col-xl-3">
                                <select class="form-control" name="month">
                                    <option value="1" @if($month == 1) selected @endif>Januari</option>
                                    <option value="2" @if($month == 2) selected @endif>Februari</option>
                                    <option value="3" @if($month == 3) selected @endif>Maret</option>
                                    <option value="4" @if($month == 4) selected @endif>April</option>
                                    <option value="5" @if($month == 5) selected @endif>Mei</option>
                                    <option value="6" @if($month == 6) selected @endif>Juni</option>
                                    <option value="7" @if($month == 7) selected @endif>Juli</option>
                                    <option value="8" @if($month == 8) selected @endif>Agustus</option>
                                    <option value="9" @if($month == 9) selected @endif>September</option>
                                    <option value="10" @if($month == 10) selected @endif>Oktober</option>
                                    <option value="11" @if($month == 11) selected @endif>November</option>
                                    <option value="12" @if($month == 12) selected @endif>Desember</option>
                                </select>
                            </div>
                            <div class="col-xl-3">
                                <select class="form-control" name="mechanism_id" id="mechanism_id">
                                    <option value="0" @if($mechanisms_choosen == 0) selected @endif>ALL</option>
                                    @foreach($mechanisms as $row)
                                        <option value="{{$row->id}}" @if($mechanisms_choosen == $row->id) selected @endif>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-2">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                            <div class="col-xl-2"></div>
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 mb-4">  
                            <div class="row align-items-center">
                                <div class="chart-area"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                            </div>
                            <br><center>Total Procurement</center>  
                        </div>
                        <div class="col-xxl-6 col-xl-6 mb-4">
                            <div class="row align-items-center">
                                <div class="chart-area"><canvas id="myPieChart2" width="100%" height="50"></canvas></div>
                            </div>
                            <br><center>Total OE Procurement (Rp)</center>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('module.dashboard.chart')

<script type="text/javascript">
    $(document).ready(function () {
        $("#sort_waktu").show();
        $("#sort_total").hide();
    });
    $('#sortby').change(function() {
        sort = $(this).val()
        if(sort=='waktu') {
            $("#sort_waktu").show();
            $("#sort_total").hide();
        } else {
            $("#sort_waktu").hide();
            $("#sort_total").show();
        }
    })

    $(function(){
      // bind change event to select
      $('#year_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    })
</script>

@endsection