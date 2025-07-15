<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
        <h1>🔐 Reset Password</h1>
        <p>Permintaan Reset Password</p>
    </div>
    
    <div class="content">
        <h2>Halo {{ $user->name }}!</h2>
        
        <p>Kami menerima permintaan untuk mereset password akun Anda. Jika Anda tidak melakukan permintaan ini, abaikan email ini.</p>
        
        <div style="text-align: center;">
            <a href="{{ $resetUrl }}" class="button">
                🔑 Reset Password
            </a>
        </div>
        
        <div class="warning">
            <strong>⚠️ Penting:</strong>
            <ul>
                <li>Link reset password ini hanya berlaku selama 60 menit</li>
                <li>Jangan bagikan link ini kepada siapapun</li>
                <li>Jika Anda tidak meminta reset password, abaikan email ini</li>
            </ul>
        </div>
        
        <p>Jika tombol di atas tidak berfungsi, Anda dapat menyalin dan menempelkan link berikut ke browser Anda:</p>
        
        <p style="word-break: break-all; background: #f8f9fa; padding: 10px; border-radius: 5px; font-size: 12px;">
            {{ $resetUrl }}
        </p>
        
        <p>Setelah reset password berhasil, Anda dapat login dengan password baru.</p>
        
        <p>Terima kasih,<br>
        <strong>Tim {{ config('app.name') }}</strong></p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim otomatis, mohon tidak membalas email ini.</p>
        <p>Jika Anda memiliki pertanyaan, silakan hubungi tim support kami.</p>
    </div>
</body>
</html> 