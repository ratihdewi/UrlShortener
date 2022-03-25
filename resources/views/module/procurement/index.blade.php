@extends("master.main")

@section("title","Daftar Pengadaan")

@section("content")

<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container"><br>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-n10">
    @include('partial.alert')
    <div class="card mb-4">
        <div class="card-header">
            Daftar Pengadaan
            @if(Auth::user()->role_id==4)
            <a style="margin-left:10px;" class="btn btn-sm btn-primary float-right" href="{{route('procurement.create')}}">
                <i class="mr-1" data-feather="plus-square"></i>
                Tambah Pengadaan
            </a>
            @endif
            <select class="form-control float-right" style="font-size:10pt;width:150px;" id="sortby">
                <option value="{{route('procurement.index')}}" @if($select_sort=='waktu') selected @endif>Sort by Waktu</option>
                <option value="{{route('procurement.index.sort')}}" @if($select_sort=='total') selected @endif>Sort by Total</option>
            </select>
        </div>
        <div class="card-body">
            <div class="datatable">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nomor Memo</th>
                            <th>Perihal</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Total</th>
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <th>PIC</th>
                            @endif
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($procs as $proc)
                            <tr @if($proc->status_caption=="Selesai") style="color:rgba(52, 152, 219);" @elseif($proc->status_caption=="Dibatalkan") style="color:rgba(192, 57, 43);" @endif>
                                <td>{{$proc->tanggal_caption}}</td>
                                <td>{{$proc->no_memo}}</td>
                                <td>{{$proc->name}}</td>
                                <td>{{$proc->mechanism->name}}</td>
                                <td>{{$proc->status_caption}}</td>
                                <td>Rp{{number_format($proc->items->sum('price_total'),2)}}</td>
                                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    @if($proc->staff_id != NULL)
                                        <td>{{$proc->staff->name}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @endif
                                <td class="text-center">
                                    <a href="{{route('procurement.show', [$proc, $proc->status])}}" class="btn btn-light btn-sm"><small>Detail</small></a>
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
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#dataTable').DataTable( {
            "ordering": false
        } );
    } );

    $(function(){
      // bind change event to select
      $('#sortby').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });

</script>

@endsection