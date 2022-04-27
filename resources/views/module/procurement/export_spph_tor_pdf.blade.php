<!DOCTYPE html>
<html>
    <head>
        @if($procurement->mechanism_id!=6)
            <title>{{$spph->vendor->name}}</title>
        @else  
            <title>{{$procurement->name}}</title>
        @endif
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </head>
    <body style="margin-left:20px;font: normal 14px, Times New Roman, Times, serif;">
        <center>
            <img class="mt-2 mb-3" src="{{public_path('img/up.png')}}" width="20%"><br> 
        </center>
        Jakarta, {{date('d/m/Y')}}<br><br>
        <table style="margin-left:10px;">
            @if($procurement->mechanism_id!=6)
                <tr>
                    <td style="width:120px;">Nomor</td>
                    <td style="width:2px;">:</td>
                    <td style="width:250px;">{{$spph->no_spph}}</td>
                </tr>
            @endif
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td style="width:200px;"><b>Permintaan Penawaran Harga</b>
                @if($procurement->mechanism_id!=6) 
                    <b>{{$spph->procurement->name}}</b>
                @else 
                    <b>{{$procurement->name}}</b>
                @endif</td>
            </tr>
        </table>
        <br>
        @if($procurement->mechanism_id!=6)
            <b>Yth. {{$spph->vendor->name}}</b>
            <br>Di Tempat
        @endif
        <br><br>
        Dengan hormat, <br>
        <p align="justify">
        Berkaitan dengan memorandum nomor @if($procurement->mechanism_id!=6) {{$spph->procurement->no_memo}} @else {{$procurement->no_memo}} @endif dari Direktur Penegelolaan Sistem dan
        Teknologi Informasi, mengacu pada disposisi dengan nomor agenda 0491 tanggal 01-April-2021, dari Wakil
        Rekto II Bidang Keuangan dan Sumber Daya Organisasi, disposisi nomor 0079 tanggal 5-04-2021, dari Direktur
        Pengelolaan Fasilitas Universitas tentang Pengadaan Data Center Pendidikan dan Penelitian Universitas
        Pertamina kami dari Fungsi Pengadaan Barang dan Jasa Universitas Pertamina mengundang perusahaan
        Bapak/Ibu untuk mengajukan penawaran terkait pengadaan tersebut. Spesifikasi kebutuhan dapat dilihat pada
        Lampiran.</p>
        Berikut adalah penjelasan singkat dalam pengajuan permohonan penawaran tersebut:<br>
        1. Perusahaan yang telah diundang dipersilahkan untuk melampirkan penawaran harga dengan syarat sebagai
        berikut: <br>
            <div style="margin-left:35px">
            1) Company Profile.
                <div style="margin-left:35px;padding-top:-10px">
                {!! $master_spph->syarat !!}
                </div>
            2) Asli surat pernyataan di atas materai, dan Pakta Integritas (Format Terlampir)<br>
            3) Surat pengantar penawaran harga yang ditujukan Kepada: Fungsi Pengadaan Barang dan Jasa
            Universitas Pertamina.<br>
            </div>

        <div style="page-break-before:always">&nbsp;</div> 
        2. Penawaran harga harus sesuai dengan spesifikasi yang dilampirkan<br>
        @if($procurement->mechanism_id!=6) 
            3. Perusahaan yang telah menerima surat undangan resmi ini diberikan waktu untuk mengirimkan penawaran
            sampai dengan tanggal {{$spph->batas_penawaran_date}} pukul 16:00 WIB<br>
            4. Surat permohonan penawaran dalam bentuk softcopy dapat dikirimkan ke alamat email:<br>
            {{$manager->email}}<br>
            {{$spph->procurement->staff->email}}<br><br>
            Demikian surat undangan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih.<br><br>
        @else 
            3. Surat permohonan penawaran dalam bentuk softcopy dapat dikirimkan ke alamat email:<br>
            {{$manager->email}}<br>
            {{$procurement->staff->email}}<br><br>
            Demikian surat undangan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih.<br><br>
        @endif
        <b>Manager Pengadaan Barang dan Jasa<br><br><br>
        <img src="{{public_path('img/ttd.jpg')}}" width="31%">
        <br>
        {{$manager->name}}</b>

        <div class="page-break"></div>
        <br><br>
        {!! $master_spph->kriteria_penilaian !!}
        <br><br>
        @if($procurement->mechanism_id==6)
            <b>Link Upload Penawaran: https://apphub.universitaspertamina.ac.id/penawaran/input/{{$procurement->id}}</b>
            <!-- <b>Link Upload Penawaran: http://10.10.71.218:800/penawaran/input/{{$procurement->id}}</b> -->
            <!-- <b>Link Upload Penawaran: http://36.37.91.71:21880/penawaran/input/{{$procurement->id}}</b> -->
        @endif

        <div class="page-break"></div>
        <!-- Lampiran brosur:<br>
        @foreach($spph->penawarans as $penawaran)
            @if($penawaran->item->brosur_file!=NULL)
                <img src="{{public_path('brosurs/'.$penawaran->item->brosur_file)}}"><br> 
            @endif
        @endforeach -->
        
    </body>

<style>
    .page-break {
        page-break-after: always;
    }
</style>
</html>