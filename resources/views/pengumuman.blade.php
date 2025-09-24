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
      padding-bottom: 2px;
      margin-bottom: 2px;
    }
    .nomor {
      margin-top: 10px;
      margin-bottom: 20px;
    }
    .isi {
      text-align: justify;
    }
    .ttd {
      margin-top: 15px;
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
    @media print {
      body {
        margin: 0.5cm;
      }
      .kop {
        border-bottom: 3px solid black;
        padding-bottom: 2px;
        margin-bottom: 2px;
      }
      .nomor {
        margin-top: 10px;
        margin-bottom: 20px;
      }
      .isi {
        text-align: justify;
      }
      .ttd {
        margin-top: 15px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        page-break-after: always;
      }
      .ttd div {
        width: 40%;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <!-- KOP SURAT -->
  <div class="kop">
    <img src="/img/kop_smk.jpg" alt="Kop Surat" style="width: 100%;">
  </div>

  <!-- Nomor Surat -->
  <div class="nomor">
    <p><strong>Nomor :</strong> 421.5/SMK-MM/SPMB/2025/001</p>
    <p><strong>Hal :</strong> Pengumuman SPMB</p>
  </div>

  <!-- Isi Surat -->
  <div class="isi">
    <p>Assalamu’alaikum Wr. Wb.</p>
    <p>
      Berdasarkan hasil seleksi Tes Fisik Sistem Penerimaan Murid Baru (SPMB) 
      SMK Muhammadiyah Mungkid Tahun Pelajaran {{$siswa->tahun->nama_tahun}}, dengan ini kami 
      mengumumkan bahwa <strong>{{$siswa->nama}}</strong>,
      dinyatakan <strong>DITERIMA</strong> sebagai calon siswa SMK Muhammadiyah Mungkid.
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
      <li>Membayar biaya daftar ulang sebesar Rp. {{number_format($siswa->tagihan->jumlah_tagihan, 2, ',','.')}}</li>
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
      <br><br><br>
      <p><u>Marzuni, M.Pd</u></p>
    </div>
    <div>
      <p>Mungkid, 23 September 2025</p>
      <p>Ketua PPDB</p>
      <br><br><br>
      <p><u>Mujabirul Khoir, S.Pd</u></p>
    </div>
  </div>
  {{-- Halaman detail pembayaran. --}}
  <div class="kop">
    <img src="/img/kop_smk.jpg" alt="Kop Surat" style="width: 100%;">
  </div>
  <div class="judul" style="text-align: center; margin-top: 10px; margin-bottom: 20px;">
    <h3>Detail Pembayaran Daftar Ulang</h3>
  </div>
  <div class="isi">
    <p>Berikut adalah rincian pembayaran daftar ulang untuk calon siswa <strong>{{$siswa->nama}}</strong>:</p>
    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
      <thead>
        <tr>
          <th style="border: 1px solid black; padding: 8px; text-align: left;">No</th>
          <th style="border: 1px solid black; padding: 8px; text-align: left;">Uraian</th>
          <th style="border: 1px solid black; padding: 8px; text-align: right;">Jumlah (Rp)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="border: 1px solid black; padding: 8px;">1</td>
          <td style="border: 1px solid black; padding: 8px;">Biaya Daftar Ulang</td>
          <td style="border: 1px solid black; padding: 8px; text-align: right;">
            {{number_format($siswa->tagihan->jumlah_tagihan, 2, ',','.')}}
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid black; padding: 8px;" colspan="2"><strong>Total</strong></td>
          <td style="border: 1px solid black; padding: 8px; text-align: right;">
            <strong>{{number_format($siswa->tagihan->jumlah_tagihan, 2, ',','.')}}</strong>
          </td>
        </tr>
      </tbody>
    </table>
    <p style="margin-top: 20px;">
      Harap melakukan pembayaran sesuai dengan jumlah yang tertera di atas pada saat
      proses daftar ulang di SMK Muhammadiyah Mungkid.
    </p>
    <p>Terima kasih atas perhatian Anda.</p>
  </div>

</body>
</html>
