<!DOCTYPE html>
<html>
    <head>
        <title>Surat Pertanggungjawaban Uang Muka Kerja</title>
    </head>
    <body style="margin-left:20px;font: normal 14px, Times New Roman, Times, serif;">
        <center>
            <img src="{{public_path('img/up.png')}}" width="100px" height="100px"><br> 
        </center>
        <table style="margin-left:10px;">
            <tr>
                <td style="width:120px;">No</td>
                <td style="width:2px;">:</td>
                <td style="width:250px;">{{$procurement->pjumk->no_memo_umk}}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td style="width:200px;">{{date('Y-m-d', strtotime($procurement->created_at))}}</td>
            </tr>
            <tr>
                <td>Kepada</td>
                <td>:</td>
                <td style="width:200px;">Direktur {{$procurement->pengaju->name}}</td>
            </tr>
            <tr>
                <td>Dari</td>
                <td>:</td>
                <td style="width:200px;">Direktur Sarana Prasarana & IT</td>
            </tr>
        </table>
        <hr>
        <br>
        <center>Bersama ini kami kirimkan Pertanggung jawaban Uang Muka Kerja {{$procurement->name}}</center>
        <br>
        <table style="margin-left:10px;">
            <tr>
                <td style="width:120px;">Nama</td>
                <td style="width:2px;">:</td>
                <td style="width:250px;">&nbsp;&nbsp;&nbsp;&nbsp;{{$procurement->pjumk->name}}</td>
            </tr>
            <tr>
                <td>No. Pekerja</td>
                <td>:</td>
                <td style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;{{$procurement->pjumk->no_pekerja}}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;{{$procurement->pjumk->jabatan}}</td>
            </tr>
            <tr>
                <td>Fungsi</td>
                <td>:</td>
                <td style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;{{$procurement->pjumk->fungsi}}</td>
            </tr>
            <tr>
                <td>GL Account/ Cost Element</td>
                <td>:</td>
                <td style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;{{$procurement->pjumk->gl_account}}</td>
            </tr>
            <tr>
                <td>Cost Center </td>
                <td>:</td>
                <td style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;{{$procurement->pjumk->cost_center}}</td>
            </tr>
            <tr>
                <td>Pengambilan Uang Muka Kerja </td>
                <td>:</td>
                <td style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Rp{{number_format($procurement->items->sum('price_total'),2)}}</td>
            </tr>
            <tr>
                <td>Penggunaaan </td>
                <td>:</td>
                <td style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;1. Pengadaan Barang </td>
                <td>:</td>
                <td style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Rp{{number_format($procurement->pjumk->total, 2)}}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Jumlab Netto </td>
                <td>:</td>
                <td style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Rp{{number_format($procurement->pjumk->total, 2)}}</td>
            </tr>
            <tr>
                <td><b>Diterima/Disetor Kembali **</b> </td>
                <td>:</td>
                <td style="width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Rp{{number_format($procurement->items->sum('price_total') - $procurement->pjumk->total,2)}}</td>
            </tr>
        </table>
        <br><br><br>
        Catatan&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;Bila diperlukan dapat dirinci dalam lembaran tersendiri<br>
        <b>Keterangan&nbsp;&nbsp;:<br>
        <i>Dengan ini kami menyatakan bahwa transaksi yang ditagihkan ini benar dan absah untuk dibayar dan 
        menjadi tanggungjawab sepenuhnya Penerima UMK dan Pengaju Permintaan UMK. Dokumen-dokumen   
        terkait yang tidak dilampirkan dalam dokumen pertanggungjawaban uang muka kerja ini disimpan di tempat 
        kami dan dapat diperlihatkan kepada Fungsi Keuangan apabila diperlukan.</i></b><br><br>
        Atas perhatian dan kerja sama yang baik kami ucapkan terima kasih. Kami harapkan Saudara dapat segera 
        memproses pertanggungjawaban ini lebih lanjut.<br><br>
        <table style="width:100%">
            <tr>
                <td style="vertical-align:top;" width="50%">
                    Pengaju UMK <br>
                    Direktur Sarana Prasana & IT: <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <b>Erwin Setiawan</b>
                </td>
                <td class="garis" colspan="3" width="50%">
                    Penerima UMK <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <b>{{$procurement->pjumk->name}}</b>
                </td>
            </tr>
        </table>
        <br>
        <i>* Lampirkan rincian penggunaan Uang Muka Kerja </i>
        <br><i>**Coret Salah Satu</i>
    </body>

<style>
    .page-break {
        page-break-after: always;
    }
</style>
</html>