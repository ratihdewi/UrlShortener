<?php 
    use App\Http\Controllers\ProcurementController;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>{{$procurement->no_memo}}</title>
    </head>
    <body style="margin-left:20px;font: normal 14px, Times New Roman, Times, serif;">
        <center>
            <img src="{{public_path('img/up.png')}}" width="100px" height="100px"><br> 
        </center>
        <center>
            <u><b>BERITA ACARA</b></u><br>
            No. {{$procurement->bapp->no_surat}}
        </center>
        <br><br>
        Jakarta, {{ProcurementController::formatDate(date('Y-m-d'))}} <br><br>
        <table>
            <tr>
                <td style="width:120px;">Kepada</td>
                <td style="width:2px;">:</td>
                <td style="width:500px;">{{ $procurement->bapp->userKepada->jabatan_caption }}</td>
            </tr>
            <tr>
                <td>Dari</td>
                <td>:</td>
                <td style="width:300px;">{{ $procurement->bapp->userDari->jabatan_caption }}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>1 Bundel</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td><b>{{$procurement->name}}</b></td>
            </tr>
        </table>
        <br>
        <table>
            <td style="text-align:justify">
                Sehubungan dengan diposisi 
                @php $i = 1 @endphp
                @foreach($memos as $memo)
                    @if($i == 1)
                        tanggal {{ ProcurementController::formatDate($memo['tgl_disposisi']) }} dari {{$memo['nama_jabatan']}},
                    @else
                        dan mengacu pada disposisi pada tanggal {{ ProcurementController::formatDate($memo['tgl_disposisi']) }} dari {{$memo['nama_jabatan']}},
                    @endif
                    @php $i++ @endphp
                @endforeach 
                tentang {{$procurement->name}}, maka dengan ini kami mengajukan permohonan penunjukan langsung kepada {{$procurement->vendor->name}}. Landasan dalam pengajuan Penunjukan Langsung ini adalah sebagai berikut:
            </td>
        </table>
        <table style="margin-left:10px;width:100%;">
            <td>
                {!!$procurement->bapp->reason!!}
            </td>
        </table>
        <table>
            <td style="text-align:justify">
        Berdasarkan landasan-landasan yang disebutkan diatas, maka berikut merupakan pengajuan penyedia {{$procurement->name}} yang akan diadakan dengan metode penunjukan langsung di {{$procurement->vendor->name}}.
            </td>
        </table>
        <br>
        <table width="100%">
            <thead>
                <tr>
                    <th style="width:100px;text-align:left;">Nama Perusahaan</th>
                    <th style="width:5px;text-align:left;">:</th>
                    <th style="width:400px;text-align:left;">{{$procurement->vendor->name}}</th>
                </tr>
                <tr>
                    <th style="width:100px;text-align:left;">Alamat</th>
                    <th style="width:5px;text-align:left;">:</th>
                    <th style="width:400px;text-align:left;">{{$procurement->vendor->address}}</th>
                </tr>
                <tr>
                    <th style="width:100px;text-align:left;">NPWP</th>
                    <th style="width:5px;text-align:left;">:</th>
                    <th style="width:400px;text-align:left;">{{$procurement->vendor->no_tax}}</th>
                </tr>
            </thead>
        </table>
        <br>
        Berikut di bawah ini kami sajikan tabel {{$procurement->name}} yang pengadaannya akan dilakukan oleh {{$procurement->vendor->name}}
        <br><br>
        @foreach($procurement->spphsWon as $row)
            <table width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="garis">Nama Barang</th>
                        <th class="garis">Spesifikasi</th>
                        <th class="garis">Kuantitas</th>
                        <th class="garis">Harga Satuan</th>
                        <th class="garis">Harga Total</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($row->penawarans as $penawaran)
                    @if($penawaran->won==1)
                    <tr>
                        <td class="garis" style="padding-left:10px">{{$penawaran->item->name}}</td>
                        <td class="garis" style="padding-left:10px">{{$penawaran->item->specs}}</td>
                        <td class="garis" style="text-align:center">{{$penawaran->item->total_unit}}</td>
                        <td class="garis" style="padding-right:10px;text-align:right;">Rp{{number_format($penawaran->harga_satuan, 2)}}</td>
                        <td class="garis" style="padding-right:10px;text-align:right;">Rp{{number_format($penawaran->harga_total,2)}}</td>
                    </tr>
                    @endif
                @endforeach
                @if($row->has_negosiasi)
                <tr>
                    <td class="garis" colspan="4" style="padding-right:10px;text-align:right;">Negosiasi</td>
                    <td class="garis" style="padding-right:10px;text-align:right;">Rp{{number_format($row->negosiasi->negosiasi,2)}}</td>
                </tr>
                @endif
                <tr>
                    <td class="garis" colspan="4" style="padding-right:10px;text-align:right;">Total</td>
                    @if($row->has_negosiasi)
                    <td class="garis" style="padding-right:10px;text-align:right;">Rp{{number_format($row->penawarans->where('won', 1)->sum('harga_total')-$row['negosiasi']['negosiasi'],2)}}</td>
                    @else
                    <td class="garis" style="padding-right:10px;text-align:right;">Rp{{number_format($row->penawarans->where('won', 1)->sum('harga_total'),2)}}</td>
                    @endif
                </tr>
                </tbody>
            </table><br>
        @endforeach


        <p style="text-align:justify">
        Bersama diterbitkannya berita acara ini, maka dengan ini kami memohon Bapak {{ $procurement->bapp->userKepada->jabatan_caption }} untuk memberikan persetujuan atas Berita Acara Penunjukan Langsung {{$procurement->name}} di {{$procurement->vendor->name}}. Demikian Berita Acara ini disampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
        <table width="100%">
            <tr>
                <td style="vertical-align:top;">
                    <center><b>(Setuju/Tidak Setuju)</b></center>
                    <center><b>{{$procurement->bapp->userKepada->jabatan_caption}}</b></center>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center><b>{{$procurement->bapp->userKepada->name}}</b></center>
                </td>
                <td style="vertical-align:top;">
                    <center>&nbsp;</center>
                    <center><b>{{$procurement->bapp->userDari->jabatan_caption}}</b></center>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center><b>{{$procurement->bapp->userDari->name}}</b></center>
                </td>
            </tr>
        </table>
    </body>

<style>
      .garis {
        border: 1px solid black;
        border-collapse: collapse;
      }
      .page-break {
        page-break-after: always;
    }
</style>

</html>