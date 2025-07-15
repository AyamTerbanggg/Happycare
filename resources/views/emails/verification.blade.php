<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
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
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Selamat Datang!</h1>
        <p>Verifikasi Email Akun Anda</p>
    </div>
    
    <div class="content">
        <h2>Halo {{ $user->name }}!</h2>
        
        <p>Terima kasih telah mendaftar di aplikasi kami. Untuk menyelesaikan proses registrasi, silakan verifikasi alamat email Anda.</p>
        
        <div style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="button">
                ✅ Verifikasi Email
            </a>
        </div>
        
        <div class="warning">
            <strong>⚠️ Penting:</strong>
            <ul>
                <li>Link verifikasi ini hanya berlaku selama 24 jam</li>
                <li>Jangan bagikan link ini kepada siapapun</li>
                <li>Jika Anda tidak merasa mendaftar, abaikan email ini</li>
            </ul>
        </div>
        
        <p>Jika tombol di atas tidak berfungsi, Anda dapat menyalin dan menempelkan link berikut ke browser Anda:</p>
        
        <p style="word-break: break-all; background: #f8f9fa; padding: 10px; border-radius: 5px; font-size: 12px;">
            {{ $verificationUrl }}
        </p>
        
        <p>Setelah verifikasi berhasil, Anda dapat login ke akun Anda.</p>
        
        <p>Terima kasih,<br>
        <strong>Tim {{ config('app.name') }}</strong></p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim otomatis, mohon tidak membalas email ini.</p>
        <p>Jika Anda memiliki pertanyaan, silakan hubungi tim support kami.</p>
    </div>
</body>
</html> 