<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Pengumuman</title>
  <style>
    body {
      font-family: "Times New Roman", serif;
      margin: 0.5cm;
      font-size: 12pt;
      line-height: 1.5;
    }
    .kop {
      text-align: center;
      border-bottom: 3px solid black;
      padding-bottom: 5px;
      margin-bottom: 20px;
    }
    .kop h2 {
      margin: 0;
      font-size: 16pt;
    }
    .kop h3 {
      margin: 0;
      font-size: 14pt;
      text-transform: uppercase;
    }
    .kop p {
      margin: 2px 0;
      font-size: 11pt;
    }
    .nomor {
      margin-top: 10px;
      margin-bottom: 20px;
    }
    .isi {
      text-align: justify;
    }
    .ttd {
      margin-top: 40px;
      width: 100%;
      display: flex;
      justify-content: space-between;
    }
    .ttd div {
      width: 40%;
      text-align: center;
    }
    @page {
      size: A4;
      margin: 2cm;
    }
  </style>
</head>
<body>
  <!-- KOP SURAT -->
  <div class="kop">
    <h2>MAJELIS PENDIDIKAN DASAR DAN MENENGAH</h2>
    <h3>SMK MUHAMMADIYAH MUNGKID</h3>
    <p>Jl. Pemandian Blabak, Mungkid, Telp. (0293) 123456</p>
    <p>Email: smkmuhmungkid@gmail.com | Website: smkmuhmungkid.sch.id</p>
  </div>

  <!-- Nomor Surat -->
  <div class="nomor">
    <p><strong>Nomor :</strong> 421.5/SMK-MM/PPDB/2025/001</p>
    <p><strong>Hal :</strong> Pengumuman Hasil Tes Fisik {{$siswa->nama}}</p>
  </div>

  <!-- Isi Surat -->
  <div class="isi">
    <p>Assalamu’alaikum Wr. Wb.</p>
    <p>
      Berdasarkan hasil seleksi Tes Fisik Penerimaan Peserta Didik Baru (PPDB) 
      SMK Muhammadiyah Mungkid Tahun Pelajaran {{$siswa->tahun->nama_tahun}}, dengan ini kami 
      mengumumkan bahwa nama-nama yang tercantum dalam lampiran surat ini 
      <strong>DINYATAKAN DITERIMA</strong> sebagai calon siswa SMK Muhammadiyah Mungkid.
    </p>
    <p>
      Selanjutnya, bagi calon siswa yang dinyatakan diterima diwajibkan untuk melakukan 
      <strong>DAFTAR ULANG</strong> dengan ketentuan sebagai berikut:
    </p>
    <ul>
      <li>Waktu : 1 – 5 Juli 2025, pukul 08.00 – 14.00 WIB</li>
      <li>Tempat : Ruang Tata Usaha SMK Muhammadiyah Mungkid</li>
      <li>Membawa fotokopi akta kelahiran, kartu keluarga, dan ijazah SMP/MTs (jika sudah keluar)</li>
      <li>Membawa pas foto berwarna ukuran 3x4 sebanyak 3 lembar</li>
      <li>Membayar biaya daftar ulang sebesar Rp. xxx.xxx,-</li>
    </ul>
    <p>
      Demikian pengumuman ini kami sampaikan. Atas perhatian dan kerjasamanya, 
      kami ucapkan terima kasih.
    </p>
    <p>Wassalamu’alaikum Wr. Wb.</p>
  </div>

  <!-- Tanda Tangan -->
  <div class="ttd">
    <div>
      <p>Mengetahui,</p>
      <p>Kepala Sekolah</p>
      <br><br><br><br>
      <p><u>Marzuni, M.Pd</u></p>
    </div>
    <div>
      <p>Mungkid, 23 September 2025</p>
      <p>Ketua PPDB</p>
      <br><br><br><br>
      <p><u>Mujabirul Khoir, S.Pd</u></p>
    </div>
  </div>
</body>
</html>
