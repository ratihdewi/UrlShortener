
<table class="table" style="table-layout: fixed;">
    <thead>
        <tr>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">No Vendor</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">Nama Vendor</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:275%; text-align: center;">Alamat</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:250%; text-align: center;">Bidang Usaha</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">No Telp</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">PIC</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:230%; text-align: center;">Email</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">No Rekening</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">Nama Bank</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:240%; text-align: center;">NPWP</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:125%; text-align: center;">Penilaian</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:125%; text-align: center;">Afiliasi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($vendors as $vendor)
        @if($vendor->temporary == 0)
        <tr>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor->no }}</td>
            <td style="vertical-align: middle; word-wrap: break-word;">{{ $vendor['name'] }}</td>
            <td style="vertical-align: middle; word-wrap: break-word;">{{ $vendor['address'] }}</td>
            <td style="vertical-align: middle; word-wrap: break-word;">
                @if(isset($vendor->afiliasi))
                    @foreach($vendor->categories as $row) {{$row->category['name']}}, @endforeach
                @endif
            </td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['no_telp'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['pic_name'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['email'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['no_rek'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['bank_name'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['no_tax'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['score'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">@if($vendor->afiliasi==1) Ya @else Tidak @endif</td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>