<!DOCTYPE html>
<html>
    <head>
        <title>{{$spph->no_spph}}</title>
    </head>
    <body style="margin-left:20px;font: normal 14px, Times New Roman, Times, serif;">
        <center>
            <img src="{{public_path('img/up.png')}}" width="100px" height="100px"><br> 
        </center>
        <br>
        <center>
            <b>BERITA ACARAKLARIFIKASI DAN NEGOSIASI<br>
            PENGADAAN VIDEO PROFILE PROGRAM STUDI UNIVERSITAS PERTAMINA</b><br><br>
        </center>
        <table style="width:100%;">
            <tr>
                <td style="width:30%;padding-left:10px">Nomor</td>
                <td style="padding-left:10px">{{$spph->no_spph}}</td>
            </tr>
            <tr>
                <td style="padding-left:10px">Tanggal</td>
                <td style="padding-left:10px">{{date('Y/m/d', strtotime($spph->negosiasi->date))}}</td>
            </tr>
            <tr>
                <td style="width:30%;padding-left:10px">Waktu</td>
                <td style="padding-left:10px">{{$spph->negosiasi->time}} WIB s/d Selesai</td>
            </tr>
            <tr>
                <td style="width:30%;padding-left:10px">Tempat</td>
                <td style="padding-left:10px">{{$spph->negosiasi->location}}</td>
            </tr>
            <tr>
                <td style="width:30%;padding-left:10px">Peserta Rapat</td>
                <td style="padding-left:10px">
                    @foreach($spph->negosiasi->pesertas as $row)
                        {{$row->user->name}} <br>
                    @endforeach
                    @foreach($peserta_eksternal as $row)
                        {{$row}} <br>
                    @endforeach
                </td>
            </tr>
        </table>
        <p align="justify">Melalui berita acara ini, Fungsi Pengadaan Barang dan Jasa dan Fungsi Pengguna (Sekretaris Universitas)
        melakukan Klarifikasi kepada {{$spph->vendor->name}} untuk pekerjaan {{$spph->procurement->name}}
        Universitas Pertamina.</p>
        <b>1. Klarifikasi Kesesuaian Spesifikasi dan Harga Penawaran</b>
        <br><br>
        <center>
            <b>Tabel Spesifikasi Penawaran {{$spph->vendor->name}}<br>
        </center>
        <br>
        <table width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Spesifikasi</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Harga Total</th>
                </tr>
            </thead>
            <tbody>
            @forelse($spph->penawarans as $penawaran)
                @if($penawaran->negosiasi!=null)
                <tr>
                    <td style="padding-left:10px">{{$penawaran->item->name}}</td>
                    <td style="padding-left:10px">{{$penawaran->item->specs}}</td>
                    <td style="text-align:center">{{$penawaran->item->total_unit}}</td>
                    <td style="padding-right:10px;text-align:right;">Rp{{number_format($penawaran->harga_satuan, 2)}}</td>
                    <td style="padding-right:10px;text-align:right;">Rp{{number_format($penawaran->harga_total,2)}}</td>
                </tr>
                @endif
            @empty
                <tr>
                    <td colspan="5"><center><i>Tidak ada data.</i></center></td>
                </tr>
            @endforelse
                <tr>
                    <td colspan="4" style="padding-right:10px;text-align:right;">Harga Awal</td>
                    <td style="padding-right:10px;text-align:right;">Rp{{number_format($spph->penawarans->where('negosiasi', '<>', null)->sum('harga_total'),2)}}</td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-right:10px;text-align:right;">Negosiasi</td>
                    <td style="padding-right:10px;text-align:right;">Rp{{number_format($spph->negosiasi->negosiasi,2)}}</td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-right:10px;text-align:right;">Total Akhir</td>
                    <td style="padding-right:10px;text-align:right;">Rp{{number_format($spph->penawarans->where('negosiasi', '<>', null)->sum('harga_total')-$spph->negosiasi->negosiasi,2)}}</td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <b>Hasil Meeting</b>
        <p align="justify" style="margin-left:20px;">{{$spph->negosiasi->meeting_result}}</p>
        <img style="margin-left:20px;" src="{{public_path('negosiasidoc/'.$spph->negosiasi->photo_doc)}}" width="200px" height="200px"><br> 
    </body>

<style>
      table,
      th,
      td {
        border: 1px solid black;
        border-collapse: collapse;
      }
</style>
</html>