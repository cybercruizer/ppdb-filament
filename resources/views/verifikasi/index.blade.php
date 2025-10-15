<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Verifikasi Dokumen</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9;">

  <div style="background-color: #fff; padding: 30px; border: 1px solid #ccc; max-width: 800px; margin: auto; box-shadow:0px 4px 6px rgba(0, 0, 0, 0.1)">
    
    <div style="text-align: center; margin-bottom: 40px;">
      <h2 style="margin: 0;">Verifikasi Dokumen</h2>
      <p style="margin: 0;">SPMB {{$sekolah}}</p>
    </div>
    @if($data)
        <div style="font-size: 16px; line-height: 1.6;">
            <p><strong>Ditandatangani Oleh :</strong> {{ $kepsek }}</p>
            <p><strong>Jabatan :</strong> Kepala {{ $sekolah }}</p>
            <hr>
            <p><strong>Nama Calon Murid :</strong> {{ $data->nama }}</p>
            <p><strong>Nomor Pendaftaran :</strong> {{ $data->nomor_pendaftaran }}</p>
            <p><strong>Status:</strong> <span style="color: green;"><strong>{{ $data->is_accepted==true ? 'Diterima' : 'Tidak Diterima' }}</strong></span></p>
            <p><strong>Kompetensi Keahlian :</strong> {{ $data->jurusan->nama_jurusan }}</p>            
            <p><strong>Tanggal Pendaftaran :</strong> {{ $data->created_at }}</p>
            <hr>
            <p style="text-align: center"><strong>Status dokumen:<br></strong> <span style="color: green; font-size:16pt"><strong>✅ Terverifikasi</strong></span></p>
        </div>
    @else
        <div style="font-size: 16px; line-height: 1.6;text-align:center">
            <div style="font-size: 120px; color: red;">&#10060;</div>
            <h2 style="color: red;">Data Tidak Ditemukan</h2>
            <p>Nomor pendaftaran tidak valid atau belum terdaftar.</p>
        </div>
    @endif
  </div>

</body>
</html>
