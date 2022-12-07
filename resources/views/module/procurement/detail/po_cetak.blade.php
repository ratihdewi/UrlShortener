<?php 
    
    $hargaTotal = $spph->po->detail->harga_total;
    $hargaNego = $spph->po->detail->negosiasi;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>{{$procurement->no_memo}}</title>
    </head>
    <body style="margin-left:20px;font: normal 14px, Times New Roman, Times, serif;">
        <table>
        </table>
        <table class="garis" style="width:100%">
            <tr>
                <td colspan="2" class="garis">
                    <center>
                        <img src="{{public_path('img/up.png')}}" width="70px" height="70px"><br> 
                    </center>
                </td>
                <td style="padding-left:10px;" colspan="5" class="garis">
                    <b>Universitas Pertamina </b><br>
                    Komplek Universitas Pertamina<br>
                    Jalan Teuku Nyak Arief <br>
                    Simprug, Jakarta 12220
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top;" colspan="3" width="1000px">
                    <b>Purchase Order (PO)</b><br>
                    <b>{{$procurement->name}}</b>
                </td>
                <td class="garis" colspan="2" width="600px">
                    <b>Nomor SPMP/Tanggal</b><br>
                    {{$spph->po->no_spmp}}<br>
                    {{date('d m Y', strtotime($spph->created_at))}}
                </td>
                <td colspan="2">
                    <b>Alamat Pengiriman</b><br>
                    Universitas Pertamina<br>
                    Komplek Universitas Pertamina Jalan Teuku Nyak Arief Simprug, Jakarta 12220
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top;" colspan="3">
                    <b>Vendor:</b><br>
                    <b>{{$spph->vendor->name}}</b><br>
                    <b>{{$spph->vendor->address}}</b><br>
                </td>
                <td class="garis" colspan="2" >
                    <b>Nomor Vendor</b><br>
                    {{$spph->vendor->no}}<br>
                    <b>NPWP Vendor</b><br>
                    {{$spph->vendor->no_tax}}<br>
                </td>
                <td colspan="2">
                    
                </td>
            </tr>
            <tr>
                <td class="garis" style="vertical-align:top;" colspan="4">
                    <b>Ketentuan Pekerjaan</b>
                    {!!$spph->po->ketentuan_pekerjaan!!}
                </td>
                <td class="garis" colspan="3">
                    <b>Metode Pembayaran</b>  :  Transfer antar Bank <br>
                    <b>Kurs Mata Uang </b>    :  Rupiah<br>
                    <b>Nama Bank</b>          :  {{$spph->vendor->bank_name}}<br>
                    <b>Nomor Rekening </b>    :  {{$spph->vendor->no_rek}} <br><br>
                    Ketentuan Pembayaran <br>
                    {!!$spph->po->ketentuan_pembayaran!!}
                </td>
            </tr>
            <tr>
                <td class="garis" style="text-align: center; vertical-align:top;" colspan="7">
                    <b>Rincian Pembelian</b>
                </td>
            </tr>
            <tr>
                <td class="garis" style="text-align: center; vertical-align:top;" colspan="2">
                    <b>Nama Barang/Jasa</b>
                </td>
                <td class="garis" style="text-align: center; vertical-align:top;" colspan="3">
                    <b>Spesifikasi</b>
                </td>
                <td class="garis" style="text-align: center; vertical-align:top;" >
                    <b>Qty</b>
                </td>
                <td class="garis" style="text-align: center; vertical-align:top;" >
                    <b>Harga Penawaran</b>
                </td>
            </tr>
            @foreach($spph->penawarans as $penawaran)
                @if($penawaran->won==1)
                <tr>
                    <td class="garis" style="text-align: center;" colspan="2">
                        {{$penawaran->item->name}}
                    </td>
                    <td class="garis" style="text-align: center;" colspan="3">
                        {{$penawaran->item->specs}}
                    </td>
                    <td class="garis" style="text-align: center;" >
                        {{$penawaran->item->total_unit}}
                    </td>
                    <td class="garis" style="text-align: right;">
                        Rp{{number_format($penawaran->harga_total,2)}}
                    </td>
                </tr>
                @endif
            @endforeach
            <tr>
                <td class="garis" colspan="6" style="text-align: right;">Harga Total</td>
                <td class="garis" style="text-align: right;">Rp{{number_format($hargaTotal, 2)}}
            </tr>
            @if($spph->has_negosiasi)
            <tr>
                <td class="garis" colspan="6" style="text-align: right;">Negosiasi</td>
                <td class="garis" style="text-align: right;">Rp{{number_format($hargaNego,2)}}</td>
            </tr>
            @endif
            @if($spph->has_negosiasi)
            <tr>
                <td class="garis" colspan="6" style="text-align: right;">Harga Perolehan Setelah Negosiasi</td>
                <td class="garis" style="text-align: right;">Rp{{number_format($hargaTotal-$hargaNego,2)}}</td>
            </tr>
            @endif
            @if($spph->po->ppn==1)
            <tr>
                <td class="garis" colspan="6" style="text-align: right;">PPN ({{ $masterPo->nilai_ppn }}%) </td>
                @if($spph->has_negosiasi)
                <td class="garis" style="text-align: right;">Rp{{number_format($masterPo->nilai_ppn/100*($hargaTotal-$hargaNego), 2)}}</td>
                @else
                <td class="garis" style="text-align: right;">Rp{{number_format($masterPo->nilai_ppn/100*($hargaTotal), 2)}}</td>
                @endif
            </tr>
            <tr>
                <td class="garis" colspan="6" style="text-align: right;">Total Harga + PPN</td>
                @if($spph->has_negosiasi)
                <td class="garis" style="text-align: right;">Rp{{number_format(($hargaTotal-$hargaNego)+$masterPo->nilai_ppn/100*($hargaTotal-$hargaNego),2)}}</td>
                @else
                <td class="garis" style="text-align: right;">Rp{{number_format($hargaTotal+$masterPo->nilai_ppn/100*$hargaTotal,2)}}</td>
                @endif
            </tr>
            @else
            <tr>
                <td class="garis" colspan="6" style="text-align: right;">Total Harga</td>
                @if($spph->has_negosiasi)
                <td class="garis" style="text-align: right;">Rp{{number_format(($hargaTotal-$hargaNego),2)}}</td>
                @else
                <td class="garis" style="text-align: right;">Rp{{number_format($hargaTotal,2)}}</td>
                @endif
            </tr>
            @endif
            <tr>
                <td class="garis" style="text-align: center; vertical-align:top;" colspan="7">
                    Pekerjaan dianggap selesai apabila barang/pekerjaan telah diterima oleh Universitas Pertamina dan dituangkan ke dalam berita acara.
                </td>
            </tr>
            <tr>
                <td class="garis" style="vertical-align:top;" colspan="4" width="50%">
                    Kami menerima SPMP ini dan menyetujui ketentuan-ketentuan yang tercantum dalam SPMP ini <br>
                    Tertanda: <br>
                    <b>{{$spph->vendor->name}}</b>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
                <td class="garis" colspan="3" width="50%">
                    Disetujui oleh: <br>
                    <center><b>{{$spph->po->approvedBy->jabatan_caption}}</b></center>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center><b>{{$spph->po->approvedBy->name}}</b></center>
                </td>
            </tr>
            <tr>
                <td class="garis" style="vertical-align:top;" colspan="4" width="50%">
                    Tanggal: <br>
                    Tempat:
                </td>
                <td class="garis" style="vertical-align:top;" colspan="3" width="50%">
                    <br>
                    <br>
                </td>
            </tr>
        </table>
        <br>
    </body>

<style>
      .garis {
        border: 1px solid black;
        border-collapse: collapse;
        vertical-align:top;
      }

      .page-break {
        page-break-after: always;
    }
</style>

</html>