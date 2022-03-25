<table class="table table-hover" width="100%" id="item_table" cellspacing="0">
    <thead>
        <tr>
            <th>Kategori</th>
            <th>Nama Barang</th>
            <th>Spesifikasi</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Unit</th>
            <th>Brosur</th>
            <th>Harga Total</th>
            <th>Rekomendasi Vendor</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tfoot>
        
    </tfoot>
    <tbody>
    @forelse($items as $row)
        <tr>
            <td>{{$row->category->name}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->specs}}</td>
            <td>{{$row->satuan}}</td>
            <td>{{number_format($row->price_est, 2)}}</td>
            <td>{{$row->total_unit}}</td>
            <td><a href="{{route('procurement.file.download', [$row->id, 'brosur'])}}"> Download </a></td>
            <td>{{number_format($row->price_total, 2)}}</td>
            <td>
                @foreach($row->vendorRecomendation as $recomendation) 
                    {{$recomendation->vendor['name']}}{{ $loop->last ? '' : ',' }} 
                @endforeach
            </td>
            <td class="text-center">
                <a class="btn btn-hapus-item btn-sm btn-danger" href="javascript:ajaxItemDelete('{{route('procurement.item.delete', [$row])}}')"><small>Hapus</small></a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="10"><center><i>Tidak ada data.</i></center></td>
        </tr>
    @endforelse
    </tbody>
</table>

<style>
    .dataTables_filter {
        display: none;
    }
</style>

<script type="text/javascript">
    $(document).ready( function () {
        $('#item_table').DataTable();
    } );
</script>