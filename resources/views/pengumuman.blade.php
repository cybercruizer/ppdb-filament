<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pengumuman SPMB {{$tahun}}</title>
  <style>
    @page {
      size: 21.5cm 33cm;
      margin: 1cm;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Arial,
        sans-serif;
      font-size: 11pt;
      line-height: 1.3;
      margin: 0;
      padding: 1cm;
      background: white;
    }

    .page {
      width: 21.5cm;
      min-height: 33cm;
      margin: 0 auto;
      background: white;
      page-break-after: always;
      position: relative;
      padding-top: 0;
    }

    .page:last-child {
      page-break-after: auto;
    }

    .letterhead {
      width: 100%;
      height: 3.2cm;
      margin-bottom: 5px;
      border-bottom: 2px solid #000;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f8f9fa;
    }

    .letterhead img {
      height: 3cm;
      width: auto;
    }

    .header {
      margin-bottom: 10px;
    }

    .header p {
      margin: 3px 0;
    }

    .recipient-box {
      border: 1px solid #000;
      padding: 8px 25px 8px 25px;
      margin: 0px 0px 0px 20px;
      display: inline-block;
    }

    .recipient-box p {
      margin: 3px 0;
      font-weight: bold;
    }

    .content {
      text-align: justify;
      margin: 10px 0;
    }

    .content p {
      margin: 8px 0;
    }

    .status-box {
      text-align: center;
      /*margin: 15px 0 15px 40px; */
      font-weight: bold;
    }

    .status-box p {
      margin: 5px 0;
    }

    .requirements {
      margin: 10px 0;
    }

    .requirements ol {
      margin-left: 20px;
    }

    .requirements li {
      margin: 6px 0;
    }

    .requirements ul {
      list-style-type: none;
      margin: 4px 0;
      padding-left: 20px;
    }

    .requirements ul li:before {
      content: "- ";
      margin-right: 5px;
    }

    .uniform-table {
      width: 100%;
      margin: 8px 0;
    }

    .uniform-table td {
      width: 50%;
      padding: 4px 10px;
      vertical-align: top;
    }

    .signature-section {
      margin-top: 30px;
    }

    .signature-table {
      width: 100%;
    }

    .signature-table td {
      text-align: center;
      vertical-align: top;
      padding: 5px;
    }

    .signature-name {
      font-weight: bold;
      text-decoration: underline;
      margin-top: 50px;
    }

    .notes {
      margin-top: 15px;
    }

    .notes ul {
      list-style-type: none;
      padding-left: 0;
    }

    .notes ul li:before {
      content: "- ";
      margin-right: 5px;
    }

    .payment-table {
      width: 98%;
      border-collapse: collapse;
      margin: 20px 2px;
      font-size: 11pt;
      border-right: 1px solid #000;
    }

    .payment-table th,
    .payment-table td {
      border: 1px solid #000;
      padding: 8px;
      text-align: left;
    }

    .payment-table th {
      background-color: #f0f0f0;
      font-weight: bold;
      text-align: center;
    }

    .section-header {
      background-color: #ffff00;
      font-weight: bold;
    }

    .indent-cell {
      padding-left: 30px;
    }

    .highlight-yellow {
      background-color: #ffff00;
    }

    .center {
      text-align: center;
    }

    .underline {
      text-decoration: underline;
    }

    .signature-container {
      border: 1px solid #000;
      width: 350px;
      display: table;
      margin-left: auto;
      margin-right: 8px;
    }

    .signature-row {
      display: table-row;
    }

    .qr-cell {
      display: table-cell;
      width: 100px;
      text-align: center;
      vertical-align: middle;
      padding: 1px;
      border-right: 1px solid #000;
    }

    .qr-code {
      width: 90px;
      height: 90px;
    }

    .text-cell {
      display: table-cell;
      padding: 4px 8px;
      vertical-align: middle;
    }

    .text-small {
      font-size: 10px;
      line-height: 1.3;
    }

    .text-medium {
      font-size: 12px;
      font-weight: bold;
      line-height: 1.3;
    }

    .text-name {
      font-size: 12px;
      font-weight: bold;
      line-height: 1.3;
    }

    .border-bottom {
      border-bottom: 2px solid #000;
    }

    .strikethrough {
      text-decoration-line: line-through;
      text-decoration-thickness: 2px;
      text-decoration-color: black;
    }

    @media print {
      body {
        padding: 0;
      }

      .page {
        margin: 0;
        page-break-after: always;
      }

      .payment-table {
        border-right: 1px solid #000 !important;
      }
    }
  </style>
</head>

<body>
  <!-- Halaman 1 -->
  <div class="page">
    <!-- Kop Surat -->
    <div class="letterhead">
      <img src="/img/kop.png" alt="Kop Surat SMK Muhammadiyah Mungkid" />
    </div>

    <div class="header">
      <p>Nomor &nbsp &nbsp: {{$pengaturan->where('key', 'nomor_surat_pengumuman')->value('value')}}</p>
      <p>
        Hal &nbsp &nbsp &nbsp &nbsp &nbsp:
        <strong>PENGUMUMAN SPMB {{$tahun}}</strong>
      </p>
      <p>Lamp &nbsp &nbsp &nbsp: 1</p>
    </div>

    <div>
      <p>
        <em><strong>Kepada calon murid :</strong></em>
      </p>
      <div class="recipient-box">
        <p><u>{{strtoupper($siswa->nama)}}</u></p>
        <p>{{strtoupper($siswa->nomor_pendaftaran)}}</p>
      </div>
    </div>

    <p style="margin: 12px 0">
      <em><strong>Assalamu'alaikum Wr. Wb.</strong></em>
    </p>

    <div class="content">
      <p>
        Berdasarkan hasil seleksi kesehatan dan wawancara tim Seleksi
        Penerimaan Murid Baru SMK Muhammadiyah Mungkid tahun pelajaran
        {{$tahun}} menyatakan bahwa nama dan nomor pendaftaran tersebut diatas
        :
      </p>
    </div>

    <div class="status-box">
      <p>DITERIMA / <s>TIDAK DITERIMA</s></p>
      <p style="margin-top: 5px">Pada Kompetensi Keahlian :</p>
      <p>{{strtoupper($siswa->jurusan->nama_jurusan)}}</p>
    </div>

    <div class="requirements">
      <p><strong>Calon murid yang diterima wajib :</strong></p>
      <ol style="margin-left: 0px;">
        <li>
          <strong>Melengkapi administrasi pendaftaran</strong>
          <em>(Setelah masuk)</em>
          <ul>
            <li>Foto Hitam Putih ( 3 X 4 ) = 6 Lembar</li>
            <li>FC Akta Kelahiran</li>
            <li>FC Kartu Keluarga ( KK )</li>
            <li>FC KTP Orang Tua</li>
            <li>FC Raport ( Semester 1 – 5 ) / FC Surat keterangan Nilai Raport ( SKNR )</li>

            {{-- <li>
              FC KIP <em><u>Jika ada</u></em>
            </li> --}}
            <li>FC NISN</li>
            <li>
              FC Piagam/sertifikat Prestasi ( Minimal tingkat Kabupaten )
              <em><u>Jika ada</u></em>
            </li>
          </ul>
        </li>

        <li>
          Menyerahkan Surat keterangan yang dinyatakan LULUS dari sekolah Asal.
          <em>(Setelah masuk)</em>
        </li>

        {{-- <li>
          Menyerahkan Surat keterangan yang dinyatakan LULUS dari sekolah Asal.
          <em>(Setelah masuk)</em>
        </li> --}}

        <li>
          Membayar <strong>Biaya Daftar Ulang</strong> untuk keperluan sbb :
        </li>
      </ol>
    </div>

    <p><strong>Murid mendapatkan seragam:</strong></p>

    <table class="uniform-table">
      <tr>
        <td>
          a. Bahan OSIS (Putih - Abu)<br />
          b. Bahan Hizbhul Wathan<br />
          c. Atasan Batik<br />
          d. Olah Raga<br />
          e. Wearpack<br />
          f. Jas Almamater
        </td>
        <td>
          g. Kaos Identitas<br />
          h. Topi<br />
          i. Dasi<br />
          j. Atribut<br />
          k. Hasduk<br />
          l. ID card murid
        </td>
      </tr>
    </table>

    <div class="content">
      <p>
        Dengan mempertimbangkan jumlah kuota masing-masing Kompetensi
        keahlian/Jurusan. Adapun besar pembayaran daftar ulang terlampir.
      </p>
      <p>Demikian untuk diketahui dan harap menjadikan maklum.</p>
      <p style="margin-top: 12px">
        <em><strong>Wassalamu'alaikum Wr. Wb.</strong></em>
      </p>
    </div>
    @php
      $url = url('/');
      $nomorPendaftaran = $siswa->nomor_pendaftaran;
    @endphp
    <div class="signature-container">
      <div class="signature-row">
        <div class="qr-cell" style="height: 100px">
          <img
            src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{$url}}/verifikasi/{{$nomorPendaftaran}}"
            alt="QR Code" class="qr-code" />
        </div>
        <div style="display: table-cell; vertical-align:top;">
          <div style="border-bottom: 1px solid #000; padding: 4px 8px">
            <div class="text-medium">
              Ditandatangani secara elektronik oleh:<br />
              Kepala {{$pengaturan->where('key', 'nama_sekolah')->value('value')}}
            </div>
          </div>
          <div style="padding: 4px 8px;">
            <div class="text-name">{{$pengaturan->where('key', 'nama_kepala_sekolah')->value('value')}}.</div>
          </div>
        </div>
      </div>
    </div>

    <div class="notes">
      <p><strong>Catatan :</strong></p>
      <ul>
        <li>
          <em>Kami dahulukan bagi calon murid yang mendaftar ulang untuk
            mengisi kuota kelas pada masing-masing kompetensi keahlian.</em>
        </li>
      </ul>
    </div>
  </div>

  <!-- Halaman 2 - Lampiran -->
  <div class="page">
    <h3 class="center"><u>Lampiran 1</u></h3>
    <h4 class="center">
      Pembayaran Daftar Ulang Calon Murid Tahun {{$tahun}}
    </h4>

    <table class="payment-table">
      <thead>
        <tr>
          <th style="width: 5%">No</th>
          <th style="width: 45%">Tahap Pembayaran</th>
          <th style="width: 25%">Biaya Daftar Ulang Dibayarkan</th>
          <th style="width: 25%">Ket</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="center section-header highlight-yellow">1</td>
          <td class="section-header highlight-yellow">
            <strong>Biaya Daftar Ulang</strong>
          </td>
          <td class="highlight-yellow"></td>
          <td class="highlight-yellow"></td>
        </tr>
        @foreach ($gelombang as $gel)
              <tr>
                <td></td>
                <td colspan="3">
                  <strong>- {{strtoupper($gel->nama_gelombang)}} ( {{
          date('d-m-Y', strtotime($gel->tanggal_mulai)) }} s/d {{
          date('d-m-Y', strtotime($gel->tanggal_selesai)) }}
                    )</strong>
                </td>
              </tr>
              <tr>
                <td></td>
                <td class="indent-cell"></td>
                @if($gel->diskon > 0)
                  <td>
                    <span class="strikethrough">@rupiah($gel->biaya)</span>
                    <br /><strong>@rupiah($gel->biaya - $gel->diskon)</strong>
                  </td>
                @else
                  <td class=""><strong>@rupiah($gel->biaya)</strong></td>
                @endif
                <td class="">
                  @if($gel->diskon > 0)
                    <strong>Diskon @rupiah($gel->diskon)</strong><br />
                  @endif
                  <strong>Lunas Maksimal {{ date('d-m-Y', strtotime($gel->tanggal_selesai)) }}</strong>
                </td>
              </tr>
        @endforeach
        <tr>
          <td class="center"><strong>2</strong></td>
          <td><strong>SPP</strong></td>
          <td><strong>Rp. 150.000,00</strong></td>
          <td><strong>Bulan Berjalan</strong></td>
        </tr>
        <tr>
          <td class="center"><strong>3</strong></td>
          <td><strong>Biaya Pendidikan Kelas X ( Sepuluh )</strong></td>
          <td><strong>Rp. 3.900.000,00</strong></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <div style="margin-top: 20px">
      <p>
        <em><strong>Keterangan : </strong>Biaya Pendidikan Kelas X ( Sepuluh )
          dibayarkan pada awal pembelajaran sebesar Rp. 1.500.000,- ( Satu
          Juta Lima Ratus Ribu Rupiah ) paling lambat 31 Agustus 2027.</em>
      </p>
    </div>
  </div>
</body>

</html>