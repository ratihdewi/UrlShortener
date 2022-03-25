<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_po')->insert([
            ['ketentuan_pekerjaan' => '<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',
            'ketentuan_pembayaran' => '<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.&nbsp;</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>'],
        ]);

        DB::table('master_spph')->insert([
            ['kriteria_penilaian' => '<p>Kriteria Penilaian:<br>1. Spesfikasi: Mandatory (Wajib Terpenuhi)<br>2. Garansi:<br>Minimum sebagai berikut:<br>a. Garansi penuh (service, penggantian part) selama 1 tahun, biaya dan pengerjaan ditanggungkan kepada pihak vendor selama penyebab kerusakan tersebut tidak disebabkan oleh kesalahan pemakaian.<br>b. Ketersediaan layanan service dan ketersediaan part minimal 5 tahun. Untuk tahun ke 2 sampai tahun ke 5 biaya akan dihitung berdasarkan kondisi layanan dan part. 3. Harga: 100%</p><p>Vendor wajib mencantukan sebagai berikut pada surat penawaran: 1. Spesifikasi lengkap dan rincian harga penawaran<br>2. Rincian garansi yang diberikan<br>3. Waktu Pekerjaan</p><p>* Spesifikasi/merk/brand (jika disebutkan) yang dituliskan pada surat ini adalah referensi minimum dengan tujuan supaya vendor mudah dalam menentukan produk yang akan ditawarkan, vendor boleh menawarkan dengan spesifikasi yang sama atau lebih baik/brand lain dengan syarat brand yang ditawarkan memiliki reputasi baik.</p>',
                'syarat' => '<p>a) Copy Surat Izin Tempat Usaha / Surat Keterangan Domisili Perusahaan dari instansi yang berwenang&nbsp;<br>b) Copy Nomor Pokok Wajib Pajak (NPWP)<br>c) Copy Nomor Rekening Bank megandi<br>d) Copy surat pengukuhan pengusaha kena pajak<br>e) Copy Tanda Daftar Perusahaan (TDP)<br>f) Copy Surat Ijin Usaha Perdagangan (SIUP)<br>g) Copy neraca perusahaan (kualifikasi perusahaan) (Jika Ada)<br>h) Copy akte pendirian/anggaran dasar penyedia barang /jasa<br>i) Copy tanda pengenal pengurus<br>j) Daftar Pengalaman Kerja Sejenis.</p>'],

        ]);
    }
}
