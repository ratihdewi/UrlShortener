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
        Jakarta, {{date('d/m/Y')}}<br><br>
        <table>
            <tr>
                <td style="width:120px;">Kepada</td>
                <td style="width:2px;">:</td>
                <td style="width:250px;">{{ $procurement->bapp->userKepada->jabatan_caption }}</td>
            </tr>
            <tr>
                <td>Dari</td>
                <td>:</td>
                <td style="width:200px;">{{ $procurement->bapp->userDari->jabatan_caption }}</td>
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
        <br>Berkaitan dengan:
        <br>
        <table style="margin-left:10px;width:100%;">
            <tr>
                <td style="width:20px;vertical-align:top"><b>1.</b></td>
                {{-- <td style="text-align:justify">
                    Memorandum no. {{$procurement->no_memo}} 
                    @php $i = 1 @endphp
                    @foreach($memos as $memo)
                        @if($i == 1)
                            pada tanggal {{date('d M Y', strtotime($memo['approved_at']))}} dari {{$memo['dari']}} tentang {{$memo['perihal']}}, 
                            mengacu pada disposisi pada tanggal {{date('d M Y', strtotime($memo['tgl_disposisi']))}} dari {{$memo['nama_jabatan']}}@if($i==$total_disposisi).@else,@endif
                        @else
                            mengacu pada disposisi pada tanggal {{date('d M Y', strtotime($memo['tgl_disposisi']))}} dari {{$memo['nama_jabatan']}}@if($i==$total_disposisi).@else,@endif
                        @endif
                        @php $i++ @endphp
                    @endforeach
                </td> --}}
                <td style="text-align:justify">
                    Memorandum no. {{$procurement->no_memo}}
                    pada tanggal {{date('d M Y', strtotime($memos['approved_at']))}} dari {{$memos['dari']}} tentang {{$memos['perihal']}}, 
                    mengacu pada disposisi pada tanggal {{date('d M Y', strtotime($memos['tgl_disposisi']))}} dari {{$memos['nama_jabatan']}},
                </td>
            </tr>
            <tr>
                <td style="width:20px;vertical-align:top"><b>2.</b></td>
                <td style="text-align:justify">
                    Surat Permintaan Penawaran Harga yang dikirimkan kepada {{$vendor_count}} vendor pada tanggal {{date('d M Y', strtotime($procurement->spph_sending_date))}} sebagai berikut:
                </td>
            </tr>
        </table><br>
        <table width="100%" cellspacing="0" style="margin-left:30px;" class="garis">
            <thead>
                <tr>
                    <th class="garis" style="width:30%">Nama Vendor</th>
                    <th class="garis">Nomor SPPH</th>
                    <th class="garis">Nomor Surat Penawaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse($procurement->spphs as $row)
                 @if($row->status === 2)
                    <tr>
                        <td class="garis" style="padding-left:10px;">{{$row->vendor->name}}</td>
                        <td class="garis" style="text-align:center">{{$row->no_spph}}</td>
                        <td class="garis" style="text-align:center">{{$row->no_surat_penawaran}}</td>
                    </tr>
                     @endif
                @empty
                    <tr>
                        <td colspan="3"><center><i>Tidak ada data.</i></center></td>
                    </tr>
                @endforelse
            </tbody>
        </table><br>
        <table style="margin-left:10px;width:100%;">
            <tr>
                <td style="width:20px;vertical-align:top"><b>3.</b></td>
                <td style="text-align:justify">
                    Berdasarkan Surat Permintaan Penawaran Harga yang dikirimkan ke Vendor, terdapat {{$vendor_count}} vendor yang mengirimkan penawaran harga sebagai berikut:
                </td>
            </tr>
        </table><br>
        <table class="garis" id="myTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="garis">Nama Barang</th>
                    <th class="garis">Vendor</th>
                    <th class="garis">Spesifikasi</th>
                    <th class="garis">Qty</th>
                    <th class="garis">Harga Satuan</th>
                    <th class="garis">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse($procurement->penawarans as $row)
                    <tr>
                        @if($check_name==$row->item->name && $itemOccurences[$row->item->name] > 0)
                        @else
                            <td class="garis" rowspan="{{$itemOccurences[$row->item->name]}}" style="padding-left:10px;">{{$row->item->name}}</td> 
                        @endif
                        @if($row->won == 1)
                            <td class="garis" style="padding-left:10px;padding-right:10px;font-weight:bold">{{$row->spph->vendor->name}}</td>
                            <td class="garis" style="padding-left:10px;font-weight:bold">{{$row->evaluasi}}</td>
                            <td class="garis" style="text-align:center;font-weight:bold">{{$row->item->total_unit}}</td>
                            <td class="garis" style="padding-right:10px;text-align:right;font-weight:bold">Rp{{number_format($row->harga_satuan,2)}}</td>
                            <td class="garis" style="padding-right:10px;text-align:right;font-weight:bold">Rp{{number_format($row->item->total_unit*$row->harga_satuan, 2)}}</td>
                        @else
                            <td class="garis" style="padding-left:10px;">{{$row->spph->vendor->name}}</td>
                            <td class="garis" style="padding-left:10px;">{{$row->evaluasi}}</td>
                            <td class="garis" style="text-align:center">{{$row->item->total_unit}}</td>
                            <td class="garis" style="padding-right:10px;text-align:right;">Rp{{number_format($row->harga_satuan,2)}}</td>
                            <td class="garis" style="padding-right:10px;text-align:right;">Rp{{number_format($row->item->total_unit*$row->harga_satuan, 2)}}</td>
                        @endif
                    </tr>
                    @php $check_name = $row->item->name @endphp
                @empty
                    <tr>
                        <td colspan="6"><center><i>Tidak ada data.</i></center></td>
                    </tr>
                @endforelse
            </tbody>
        </table><br>
        <table style="margin-left:10px;width:100%;">
            <tr>
                <td style="width:20px;vertical-align:top"><b>4.</b></td>
                <td style="text-align:justify">
                Evaluasi Tender yang dibuat oleh Fungsi Pengguna ({{$procurement->pengaju->name}}) pada tanggal {{date('d/m/Y', strtotime($procurement->created_at))}} dengan metode evaluasi kesesuaian
                spesifikasi dan harga terendah. (terlampir)
                </td>
            </tr>
        </table>
        <p style="margin-left:30px;">Berdasarkan hal-hal diatas, maka berikut ini merupakan nama calon penyedia yang diajukan:</p>
        @foreach($procurement->spphsWon as $row)
            <table style="margin-left:30px;">
                <tr>
                    <td style="width:120px;">Nama Vendor</td>
                    <td style="width:2px;">:</td>
                    <td style="width:250px;">{{$row->vendor->name}}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td style="width:200px;">{{$row->vendor->address}}</td>
                </tr>
                <tr>
                    <td>NPWP</td>
                    <td>:</td>
                    <td>{{$row->vendor->no_tax}}</td>
                </tr>
            </table>
            <p style="margin-left:30px;"> Sebagai calon penyedia kebutuhan Universitas Pertamina dengan
            rincian pekerjaan sebagai berikut :</p>
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
        <p style="margin-left:10px;text-align:justify">
        Dengan diterbitkannya Berita Acara Penetapan Pemenang ini, maka kami memohon persetujuan <b>"{{ $procurement->bapp->userKepada->jabatan_caption }}"</b> atas 
        <b>"{{$procurement->name}}"</b>.<br><br>
        Demikian Berita Acara ini disampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p><br>
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