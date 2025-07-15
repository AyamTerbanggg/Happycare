<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email</title>
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
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #007bff;
        }
        .content {
            padding: 20px;
            background-color: #ffffff;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .custom-message {
            background-color: #f8f9fa;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #007bff;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Email dari Sistem</h2>
    </div>
    
    <div class="content">
        {!! $content !!}
        
        @if(isset($customMessage))
        <div class="custom-message">
            <strong>Pesan Tambahan:</strong><br>
            {!! nl2br(e($customMessage)) !!}
        </div>
        @endif
    </div>
    
    <div class="footer">
        <p>Email ini dikirim dari sistem email server.</p>
        <p>&copy; {{ date('Y') }} - Semua hak dilindungi.</p>
    </div>
</body>
</html> 