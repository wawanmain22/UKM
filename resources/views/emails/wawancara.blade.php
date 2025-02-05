<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Jadwal Wawancara UKM</h2>
        </div>
        
        <div class="content">
            <p>Halo {{ $pendaftaran->mahasiswa->nama }},</p>
            
            <p>Selamat! Pengajuan Anda untuk bergabung dengan UKM {{ $pendaftaran->ukm->nama_ukm }} telah diproses.</p>
            
            <p>Anda dijadwalkan untuk wawancara pada:</p>
            <p style="font-weight: bold; font-size: 16px;">
                {{ $pendaftaran->tanggal_wawancara->format('l, d F Y') }}<br>
                Pukul: {{ $pendaftaran->tanggal_wawancara->format('H:i') }} WIB
            </p>
            
            <p>Mohon hadir tepat waktu dan mempersiapkan diri dengan baik.</p>
            
            <p>Terima kasih,<br>
            Tim UKM {{ $pendaftaran->ukm->nama_ukm }}</p>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html> 