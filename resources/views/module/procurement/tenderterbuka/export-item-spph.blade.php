<table>
    <thead>
        <tr>
            <th style="background-color:#d9d9d9; font-weight: bold; width:20px; text-align: center;">Kategori</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:35px; text-align: center;">Nama Barang</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:35px; text-align: center;">Spesifikasi</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:35px; text-align: center;">Satuan</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:20px; text-align: center;">Harga Satuan</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:20px; text-align: center;">Kuantitas</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:20px; text-align: center;">Harga Total</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:20px; text-align: center;">Keterangan</th>
        </tr>
    </thead>
    <tbody>
    @forelse($procurement->items as $item)
        <tr>
            <td style="text-align: center;">{{$item->category->name}}</td>
            <td style="text-align: center;">{{$item->name}}</td>
            <td style="text-align: center;">{{$item->specs}}</td>
            <td style="text-align: center;">{{$item->satuan}}</td>
            <td style="text-align: center;"></td>
            <td style="text-align: center;">{{$item->total_unit}}</td>
            <td style="text-align: center;"></td>
            <td style="text-align: center;"></td>
        </tr>
    @empty
        <tr>
            <td colspan="7"><center><i>Tidak ada data.</i></center></td>
        </tr>
    @endforelse
    </tbody>
</table>