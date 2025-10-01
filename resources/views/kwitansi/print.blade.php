<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Pembayaran - {{ $pembayaran->tagihan->siswa->nama }}</title>
    <style>
        @page {
            size: A5 landscape;
            margin: 0cm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Helvetica', Sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            background: white;
        }
        
        .kwitansi-container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            padding: 15px;
            /* border: 2px solid #000; */
            min-height: 130mm;
        }
        
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }
        
        .logo-container {
            flex: 0 0 70px;
            margin-right: 15px;
        }
        
        .logo {
            width: 70px;
            height: 70px;
            /* border: 1px solid #ddd; */
            display: flex;
            align-items: center;
            justify-content: center;
            /* background-color: #f8f8f8; */
        }
        
        .logo-placeholder {
            font-size: 10px;
            text-align: center;
            /* color: #666; */
        }
        
        .header-info {
            flex: 1;
            text-align: center;
        }
        
        .header-info h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .header-info h2 {
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .header-info p {
            font-size: 12px;
            margin-bottom: 3px;
        }
        
        .kwitansi-title {
            text-align: center;
            margin: 15px 0;
        }
        
        .kwitansi-title h3 {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }
        
        .kwitansi-no {
            text-align: right;
            margin-bottom: 5px;
            font-size: 11px;
        }
        
        .content {
            margin-bottom: 10px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 8px;
            align-items: baseline;
        }
        
        .info-label {
            width: 120px;
            font-weight: normal;
            flex-shrink: 0;
        }
        
        .info-separator {
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        
        .info-value {
            flex: 1;
            border-bottom: 1px dotted #000;
            min-height: 18px;
            padding-bottom: 2px;
            font-weight: bold;
        }
        
        .amount-section {
            margin: 5px 0;
            padding: 5px;
            border: 1px solid #000;
            background-color: #f9f9f9;
        }
        
        .amount-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 13px;
        }
        
        .amount-total {
            font-weight: bold;
            font-size: 14px;
            border-top: 1px solid #000;
            padding-top: 6px;
            margin-top: 6px;
        }
        
        .status-section {
            margin: 5px 0;
            text-align: center;
        }
        
        .status {
            display: inline-block;
            padding: 6px 12px;
            border: 2px solid #000;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
        }
        
        .status.lunas {
            background-color: #d4edda;
            color: #155724;
            border-color: #28a745;
        }
        
        .status.kurang {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #dc3545;
        }
        
        .signature-section {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box {
            text-align: center;
            width: 45%;
        }
        
        .signature-line {
            border-bottom: 1px solid #000;
            height: 50px;
            margin-bottom: 5px;
        }
        
        .signature-label {
            font-size: 11px;
            font-weight: bold;
        }
        
        .date-location {
            text-align: right;
            margin-bottom: 5px;
            font-size: 12px;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            z-index: 1000;
        }
        
        .print-button:hover {
            background: #0056b3;
        }
        
        @media print {
            .print-button {
                display: none;
            }
            
            .kwitansi-container {
                border: 1px solid #303030;
                margin: 0;
                padding-top: 5px;
                padding-left: 10px;
                padding-right: 10px;
                break-after: page;
            }
            
            body {
                margin: 0;
                padding: 0;
            }
        }
        
        .terbilang {
            font-style: italic;
            margin-top: 5px;
            padding: 5px;
            background-color: #f0f0f0;
            border-left: 3px solid #007bff;
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">🖨️ Print Kuitansi</button>
    
    <div class="kwitansi-container">
        <!-- Header/Kop Surat dengan Logo -->
        <div class="header">
            <div class="logo-container">
                <div class="logo">
                    <!-- Ganti dengan path logo sekolah Anda -->
                    <img src="/img/logo.png" alt="Logo Sekolah" style="max-width: 100%; max-height: 100%;">
                    {{-- <div class="logo-placeholder">
                        LOGO<br>SEKOLAH
                    </div> --}}
                </div>
            </div>
            <div class="header-info">
                <h1>{{$pengaturan->where('key','nama_sekolah')->value('value')}}</h1>
                <p>{{$pengaturan->where('key','alamat_sekolah')->value('value')}}</p>
                <p>Telp:{{$pengaturan->where('key','no_telp_sekolah')->value('value')}} | Email: {{$pengaturan->where('key','email_sekolah')->value('value')}}</p>
            </div>
        </div>
        
        <!-- Judul Kwitansi -->
        <div class="kwitansi-title">
            <h3>Kuitansi Pembayaran</h3>
        </div>
        
        <!-- Nomor Kwitansi -->
        <div class="kwitansi-no">
            No. Kuitansi: SPMB/{{ substr($pembayaran->siswa->tahun->nama_tahun, 0, 4) }}/{{ str_pad($pembayaran->id, 4, '0', STR_PAD_LEFT) }}
        </div>
        
        <!-- Tanggal dan Tempat -->
        <div class="date-location">
            {{ ucfirst(\Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->locale('id')->isoFormat('D MMMM Y')) }}
        </div>
        
        <!-- Detail Pembayaran -->
        <div class="content">
            <div class="info-row">
                <div class="info-label">Telah terima dari</div>
                <div class="info-separator">:</div>
                <div class="info-value">{{ $pembayaran->tagihan->siswa->nama }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Nomor Pendaftaran</div>
                <div class="info-separator">:</div>
                <div class="info-value">{{ $pembayaran->tagihan->siswa->nomor_pendaftaran ?? '-' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Untuk pembayaran</div>
                <div class="info-separator">:</div>
                <div class="info-value">{{ $pembayaran->tagihan->nama_tagihan ?? 'Pembayaran Sekolah' }}</div>
            </div>
        </div>
        
        <!-- Detail Jumlah -->
        <div class="amount-section">
            <div class="amount-row">
                <span>Total Tagihan:</span>
                <span>Rp {{ number_format($totalTagihan, 0, ',', '.') }}</span>
            </div>
            
            <div class="amount-row">
                <span>Total Sudah Dibayar:</span>
                <span>Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</span>
            </div>
            
            <div class="amount-row">
                <span>Pembayaran Hari Ini:</span>
                <span>Rp {{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}</span>
            </div>
            
            <div class="amount-row amount-total">
                <span>Sisa Tagihan:</span>
                <span>{{ $sisaTagihan > 0 ? 'Rp ' . number_format($sisaTagihan, 0, ',', '.') : 'Rp 0' }}</span>
            </div>
            
            <div class="terbilang">
                <strong>Terbilang:</strong> {{ ucwords(terbilang($pembayaran->jumlah_pembayaran)) }} Rupiah
            </div>
        </div>
        
        <!-- Status Pembayaran -->
        <div class="status-section">
            <div class="status {{ $sisaTagihan <= 0 ? 'lunas' : 'kurang' }}">
                {{ $status }}
            </div>
        </div>
        
        <!-- Tanda Tangan -->
        <div class="signature-section">
            <div class="signature-box">

            </div>
            
            <div class="signature-box">
                <div>Teller,</div><br><br><br>
                {{-- <div class="signature-line"></div> --}}
                <div class="signature-label">( {{$bendahara }} )</div>
            </div>
        </div>
    </div>
    
    <script>
        // Auto print ketika halaman dimuat (opsional)
        // window.onload = function() {
        //     window.print();
        // }
        
        // Fungsi untuk konversi angka ke terbilang (sederhana)
        function terbilang(angka) {
            const bilangan = [
                '', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan',
                'sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas',
                'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'
            ];
            
            // Implementasi sederhana - untuk implementasi lengkap, gunakan library atau buat fungsi yang lebih kompleks
            if (angka < 20) {
                return bilangan[angka];
            }
            // ... implementasi lengkap terbilang dapat ditambahkan di sini
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }
    </script>
</body>
</html>