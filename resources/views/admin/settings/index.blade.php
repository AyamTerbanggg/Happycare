<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Settings</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f4f6fa;
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
        }
        .sidebar {
            background: linear-gradient(180deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            width: 210px;
            min-height: 100vh;
            position: fixed;
            left: 0; top: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 10;
            box-shadow: 2px 0 12px rgba(24,90,157,0.08);
        }
        .sidebar .brand {
            font-size: 1.7rem;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 2rem 1.5rem 1.5rem 1.5rem;
        }
        .sidebar .nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0 1.5rem;
        }
        .sidebar .nav a {
            color: #fff;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            padding: 0.6rem 1rem;
            border-radius: 0.7rem;
        }
        .sidebar .nav a:hover, .sidebar .nav a.active, .sidebar .nav a#general-settings-link {
            background: rgba(255,255,255,0.15);
            color: #ffe066;
        }
        .sidebar .logout-btn {
            background: #ef4444;
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 0.7rem;
            margin: 1.5rem 0 0 0;
            cursor: pointer;
            transition: background 0.2s;
        }
        .sidebar .logout-btn:hover {
            background: #b91c1c;
        }
        .main-content {
            margin-left: 210px;
            padding: 2.5rem 1.5rem 1.5rem 1.5rem;
            max-width: 700px;
        }
        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: #185a9d;
            margin-bottom: 2rem;
            letter-spacing: 1px;
        }
        .form-card {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 4px 24px rgba(24,90,157,0.08);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            max-width: 700px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 0.85rem;
        }
        label {
            display: block;
            font-weight: 700;
            color: #185a9d;
            margin-bottom: 0.25rem;
            font-size: 0.97rem;
            letter-spacing: 0.2px;
        }
        input[type="text"], input[type="url"], select {
            width: 100%;
            padding: 0.48rem 0.85rem;
            border: 1.2px solid #d1d5db;
            border-radius: 0.42rem;
            font-size: 0.96rem;
            color: #22223b;
            background: #f8fafc;
            transition: border 0.2s;
            box-shadow: none;
            box-sizing: border-box;
        }
        input[type="text"]:focus, input[type="url"]:focus, select:focus {
            border-color: #185a9d;
            outline: none;
        }
        .form-actions {
            display: flex;
            gap: 0.7rem;
            justify-content: flex-start;
            margin-top: 1.1rem;
        }
        .submit-btn {
            background: #43cea2;
            color: #fff;
            font-weight: 700;
            border: none;
            padding: 0.55rem 1.3rem;
            border-radius: 0.42rem;
            font-size: 1rem;
            transition: background 0.2s;
            box-shadow: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .submit-btn:hover {
            background: #185a9d;
            color: #ffe066;
        }
        @media (max-width: 600px) {
            .form-card { padding: 1rem 0.5rem; max-width: 98vw; }
            label { font-size: 0.95rem; }
            input[type="text"], input[type="url"], select { font-size: 0.95rem; }
            .form-actions { flex-direction: column; gap: 0.5rem; }
            .main-content { margin-left: 0; padding: 1rem; }
            .sidebar { position: static; width: 100%; min-height: auto; flex-direction: row; box-shadow: none; }
            .sidebar .brand { padding: 1rem; }
            .sidebar .nav { flex-direction: row; padding: 0 1rem; gap: 0.5rem; }
            .sidebar .logout-btn { margin: 0 0 0 1rem; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="page-title">General Settings</div>
        <div class="form-card">
            @if(session('success'))
                <div style="color: #22c55e; font-weight: 600; margin-bottom: 1rem;">{{ session('success') }}</div>
            @endif
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="app_name">Website Name</label>
                    <input type="text" name="app_name" id="app_name" value="{{ $settings['app_name'] }}" required>
                </div>
                <div class="form-group">
                    <label for="app_url">Website URL</label>
                    <input type="url" name="app_url" id="app_url" value="{{ $settings['app_url'] }}" required>
                </div>
                <div class="form-group">
                    <label for="app_locale">Language</label>
                    <select name="app_locale" id="app_locale" required>
                        <option value="id" {{ $settings['app_locale'] == 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                        <option value="en" {{ $settings['app_locale'] == 'en' ? 'selected' : '' }}>English</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="app_timezone">Timezone</label>
                    <select name="app_timezone" id="app_timezone" required>
                        <option value="Asia/Jakarta" {{ $settings['app_timezone'] == 'Asia/Jakarta' ? 'selected' : '' }}>Asia/Jakarta</option>
                        <option value="UTC" {{ $settings['app_timezone'] == 'UTC' ? 'selected' : '' }}>UTC</option>
                        <option value="Asia/Makassar" {{ $settings['app_timezone'] == 'Asia/Makassar' ? 'selected' : '' }}>Asia/Makassar</option>
                        <option value="Asia/Jayapura" {{ $settings['app_timezone'] == 'Asia/Jayapura' ? 'selected' : '' }}>Asia/Jayapura</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn"><i class="fas fa-save me-2"></i>Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 