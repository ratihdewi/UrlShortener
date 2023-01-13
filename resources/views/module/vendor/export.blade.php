
<table class="table" style="table-layout: fixed;">
    <thead>
        <tr>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">No Vendor</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">Nama Vendor</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">Alamat</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">Bidang Usaha</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">No Telp</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">PIC</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">Email</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">No Rekening</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">Nama Bank</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">NPWP</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">Penilaian</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:200%; word-wrap: break-word; text-align: center;">Afiliasi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($vendors as $vendor)
        @if($vendor->temporary == 0)
        <tr>
            <td style="text-align: center;">{{ $vendor->no }}</td>
            <td>{{ $vendor['name'] }}</td>
            <td>{{ $vendor['address'] }}</td>
            <td>
                @if(isset($vendor->afiliasi))
                    @foreach($vendor->categories as $row) {{$row->category['name']}}, @endforeach
                @endif
            </td>
            <td style="text-align: center;">{{ $vendor['no_telp'] }}</td>
            <td>{{ $vendor['pic_name'] }}</td>
            <td>{{ $vendor['email'] }}</td>
            <td style="text-align: center;">{{ $vendor['no_rek'] }}</td>
            <td style="text-align: center;">{{ $vendor['bank_name'] }}</td>
            <td>{{ $vendor['no_tax'] }}</td>
            <td style="text-align: center;">{{ $vendor['score'] }}</td>
            <td style="text-align: center;">@if($vendor->afiliasi==1) Ya @else Tidak @endif</td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>