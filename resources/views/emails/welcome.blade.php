<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 12px;
        }
        .feature {
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #667eea;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Selamat Datang!</h1>
        <p>Terima Kasih Telah Bergabung</p>
    </div>
    
    <div class="content">
        <h2>Halo {{ $user->name }}!</h2>
        
        <p>Selamat datang di {{ config('app.name') }}! Kami sangat senang Anda telah bergabung dengan komunitas kami.</p>
        
        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="button">
                🚀 Mulai Jelajahi
            </a>
        </div>
        
        <h3>✨ Apa yang bisa Anda lakukan:</h3>
        
        <div class="feature">
            <strong>🏥 Informasi Rumah Sakit</strong><br>
            Temukan rumah sakit terdekat dengan informasi lengkap
        </div>
        
        <div class="feature">
            <strong>🏖️ Destinasi Wisata</strong><br>
            Jelajahi tempat wisata menarik di sekitar Anda
        </div>
        
        <div class="feature">
            <strong>📞 Layanan Kontak</strong><br>
            Hubungi kami untuk bantuan dan informasi
        </div>
        
        <div class="feature">
            <strong>🤖 Chatbot Pintar</strong><br>
            Dapatkan bantuan cepat melalui chatbot kami
        </div>
        
        <p><strong>💡 Tips:</strong></p>
        <ul>
            <li>Jelajahi fitur-fitur yang tersedia</li>
            <li>Simpan informasi penting untuk akses cepat</li>
            <li>Ikuti kami untuk update terbaru</li>
            <li>Bagikan pengalaman Anda dengan teman</li>
        </ul>
        
        <p>Jika Anda memiliki pertanyaan atau butuh bantuan, jangan ragu untuk menghubungi tim support kami.</p>
        
        <p>Selamat menikmati pengalaman terbaik bersama kami!</p>
        
        <p>Terima kasih,<br>
        <strong>Tim {{ config('app.name') }}</strong></p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim otomatis, mohon tidak membalas email ini.</p>
        <p>Jika Anda memiliki pertanyaan, silakan hubungi tim support kami.</p>
    </div>
</body>
</html> 