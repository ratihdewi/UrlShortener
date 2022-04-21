
        <table>
            <thead>
                <tr>
                    <th style="background-color:#d9d9d9; font-weight: bold; width:200px; text-align: center;">ID</th>
                    <th style="background-color:#d9d9d9; font-weight: bold; width:300px; text-align: center;">Nama Barang</th>
                    <th style="background-color:#d9d9d9; font-weight: bold; width:200px; text-align: center;">Kategori</th>
                    <th style="background-color:#d9d9d9; font-weight: bold; width:300px; text-align: center;">Spesifikasi</th>
                    <th style="background-color:#d9d9d9; font-weight: bold; width:200px; text-align: center;">Harga Satuan</th>
                    <th style="background-color:#d9d9d9; font-weight: bold; width:200px; text-align: center;">Kuantitas</th>
                    <th style="background-color:#d9d9d9; font-weight: bold; width:200px; text-align: center;">Harga Total</th>
                    <th style="background-color:#d9d9d9; font-weight: bold; width:200px; text-align: center;">Nama Vendor</th>
                    <th style="background-color:#d9d9d9; font-weight: bold; width:200px; text-align: center;">Evaluasi</th>
                    @if($procurement->mechanism_id!=3)<th style="background-color:#d9d9d9; font-weight: bold; width:20px; text-align: center;">Nilai</th>@endif
                </tr>
            </thead>
            <tbody>
            @foreach($procurement->penawarans as $penawaran)
                <tr>
                    <td style="text-align: center;">{{ $penawaran->id }}</td>
                    <td style="text-align: center;">{{ $penawaran['item']['name'] }}</td>
                    <td style="text-align: center;">{{ $penawaran['item']['category']['name'] }}</td>
                    <td style="text-align: center;">{{ $penawaran['item']['specs'] }}</td>
                    <td style="text-align: center;">{{ $penawaran['harga_satuan'] }}</td>
                    <td style="text-align: center;">{{ $penawaran['item']['total_unit'] }}</td>
                    <td style="text-align: center;">{{ $penawaran['harga_satuan']*$penawaran['item']['total_unit'] }}</td>
                    <td style="text-align: center;">{{ $penawaran['spph']['vendor']['name'] }}</td>
                    <td style="text-align: center;"></td>
                    @if($procurement->mechanism_id!=3)<td style="text-align: center;"></td>@endif
                </tr>
            @endforeach
            </tbody>
        </table>