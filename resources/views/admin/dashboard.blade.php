<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .sidebar .nav a:hover, .sidebar .nav a.active {
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
            max-width: 1100px;
        }
        .dashboard-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #185a9d;
            margin-bottom: 2.5rem;
            letter-spacing: 1px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }
        .stat-card {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 4px 24px rgba(24,90,157,0.10);
            padding: 2rem 1.2rem 1.5rem 1.2rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.7rem;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .stat-card:hover {
            box-shadow: 0 8px 32px rgba(24,90,157,0.16);
            transform: translateY(-4px) scale(1.02);
        }
        .stat-icon {
            font-size: 2.2rem;
            border-radius: 0.7rem;
            padding: 0.7rem;
            margin-bottom: 0.5rem;
        }
        .stat-hospital { background: #e0f2fe; color: #2563eb; }
        .stat-user { background: #fef9c3; color: #eab308; }
        .stat-tourism { background: #d1fae5; color: #059669; }
        .stat-contact { background: #f3e8ff; color: #a21caf; }
        .stat-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: #185a9d;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #43cea2;
        }
        .stat-desc {
            font-size: 1rem;
            color: #64748b;
        }
        @media (max-width: 800px) {
            .main-content { margin-left: 0; padding: 1rem; }
            .sidebar { position: static; width: 100%; min-height: auto; flex-direction: row; box-shadow: none; }
            .sidebar .brand { padding: 1rem; }
            .sidebar .nav { flex-direction: row; padding: 0 1rem; gap: 0.5rem; }
            .sidebar .logout-btn { margin: 0 0 0 1rem; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">HappyCare Admin</div>
        <div class="nav">
            <a href="/admin/users">Users</a>
            <a href="/admin/hospitals">Hospitals</a>
            <a href="/admin/tourism">Tourism</a>
            <a href="/admin/contacts">Contacts</a>
            <a href="/admin/settings" id="general-settings-link">General Settings</a>
            <a href="/" class="active">Ke Website Utama</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
    <div class="main-content">
        <div class="dashboard-title">Dashboard Admin</div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon stat-hospital"><i class="fas fa-hospital"></i></div>
                <div class="stat-label">Rumah Sakit</div>
                <div class="stat-value">50</div>
                <div class="stat-desc">Total Rumah Sakit</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-user"><i class="fas fa-users"></i></div>
                <div class="stat-label">Pengguna</div>
                <div class="stat-value">10K+</div>
                <div class="stat-desc">Total Pengguna</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-tourism"><i class="fas fa-map-marked-alt"></i></div>
                <div class="stat-label">Wisata</div>
                <div class="stat-value">100+</div>
                <div class="stat-desc">Total Destinasi Wisata</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-contact"><i class="fas fa-envelope"></i></div>
                <div class="stat-label">Kontak</div>
                <div class="stat-value">5</div>
                <div class="stat-desc">Pesan Masuk</div>
            </div>
        </div>
    </div>
</body>
</html> 