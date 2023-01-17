<?php 
    
    function isComplete ($vendor) {
        
        $res = true;
        foreach ($vendor->getFillable() as $keyword) {
            if (is_null($vendor->$keyword)) {
                $res = false;
                break;
            }
        }

        return $res;
    }

    function getCatId ($vendor) {

        $cat = "";
        foreach($vendor->categories as $key=>$row){
            $cat = $cat.strval($row->category['id']);
            if (isset($vendor->categories[$key+1])){
                $cat = $cat.",";
            }
        }
        
        return $cat;
    }

?>

<table class="table" style="table-layout: fixed;">
    <thead>
        <tr>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">Nama Vendor</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">Email</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">Alamat</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">No Telp</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">No Rekening</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">Nama Bank</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">NPWP</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">Afiliasi</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">PIC</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;">Kategori *)</th>
        </tr>
    </thead>
    <tbody>
    @foreach($vendors as $vendor)
        @if (!isComplete($vendor))
        <tr>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['name'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['email'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['address'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['no_telp'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['no_rek'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['bank_name'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{ $vendor['no_tax'] }}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">@if($vendor->afiliasi==1) Ya @else Tidak @endif</td>
            <td style="vertical-align: middle; word-wrap: break-word; text-align: center;">{{ $vendor['pic_name'] }}</td>
            @if (isset($vendor->afiliasi))
                <td style="vertical-align: middle; word-wrap: break-word; text-align: center;"> {{ getCatId ($vendor) }} </td>
            @endif
        </tr>
        @endif
    @endforeach
    </tbody>
</table>