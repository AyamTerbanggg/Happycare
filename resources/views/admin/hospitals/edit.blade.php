<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hospital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f7fafc;
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
            box-shadow: 2px 0 12px rgba(24,90,157,0.06);
        }
        .sidebar .brand {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 2rem 1.5rem 1.2rem 1.5rem;
        }
        .sidebar .nav {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            padding: 0 1.5rem;
        }
        .sidebar .nav a {
            color: #fff;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            padding: 0.5rem 1rem;
            border-radius: 0.6rem;
            font-size: 1rem;
        }
        .sidebar .nav a:hover, .sidebar .nav a.active {
            background: rgba(255,255,255,0.13);
            color: #ffe066;
        }
        .sidebar .logout-btn {
            background: #ef4444;
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 0.6rem;
            margin: 1.2rem 0 0 0;
            cursor: pointer;
            transition: background 0.2s;
            font-size: 1rem;
        }
        .sidebar .logout-btn:hover {
            background: #b91c1c;
        }
        .main-content {
            margin-left: 210px;
            padding: 2.5rem 1.5rem 1.5rem 1.5rem;
            max-width: 600px;
        }
        .page-title {
            font-size: 1.7rem;
            font-weight: 800;
            color: #185a9d;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }
        .form-card {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 12px rgba(24,90,157,0.06);
            padding: 2.5rem 2.2rem 2rem 2.2rem;
            max-width: 600px;
            margin: 0 auto;
            box-sizing: border-box;
            overflow-x: auto;
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
        input[type="text"], input[type="url"], input[type="file"] {
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
        input[type="text"]:focus, input[type="url"]:focus, input[type="file"]:focus {
            border-color: #185a9d;
            outline: none;
        }
        .img-preview {
            height: 42px;
            width: 42px;
            object-fit: cover;
            border-radius: 0.35rem;
            border: 1.2px solid #d1d5db;
            margin-bottom: 0.4rem;
        }
        .form-actions {
            display: flex;
            gap: 0.7rem;
            justify-content: flex-start;
            margin-top: 1.1rem;
        }
        .btn-primary {
            background: #185a9d;
            color: #fff;
            border: none;
            border-radius: 0.42rem;
            padding: 0.48rem 1.3rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: none;
        }
        .btn-primary:hover {
            background: #1271c2;
        }
        .btn-secondary {
            background: #f3f4f6;
            color: #185a9d;
            border: 1px solid #d1d5db;
            border-radius: 0.42rem;
            padding: 0.48rem 1.1rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: none;
            text-decoration: none;
        }
        .btn-secondary:hover {
            background: #e5e7eb;
        }
        @media (max-width: 800px) {
            .main-content { margin-left: 0; padding: 1rem; }
            .sidebar { position: static; width: 100%; min-height: auto; flex-direction: row; box-shadow: none; }
            .sidebar .brand { padding: 1rem; }
            .sidebar .nav { flex-direction: row; padding: 0 1rem; gap: 0.5rem; }
            .sidebar .logout-btn { margin: 0 0 0 1rem; }
        }
        @media (max-width: 600px) {
            .form-card { padding: 1rem 0.5rem; max-width: 98vw; }
            label { font-size: 0.95rem; }
            input[type="text"], input[type="url"], input[type="file"] { font-size: 0.95rem; }
            .form-actions { flex-direction: column; gap: 0.5rem; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">HappyCare Admin</div>
        <div class="nav">
            <a href="/admin/users">Users</a>
            <a href="/admin/hospitals" class="active">Hospitals</a>
            <a href="/admin/tourism">Tourism</a>
            <a href="/admin/contacts">Contacts</a>
            <a href="/">Ke Website Utama</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
    <div class="main-content">
        <div class="page-title">Edit Hospital: {{ $hospital->name }}</div>
        <div class="form-card">
            <form action="{{ route('admin.hospitals.update', $hospital->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $hospital->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $hospital->address) }}" required>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" value="{{ old('city', $hospital->city) }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $hospital->phone) }}" required>
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" name="website" id="website" value="{{ old('website', $hospital->website) }}" placeholder="https://example.com">
                </div>
                <div class="form-group">
                    <label>Current Image</label>
                    @if ($hospital->image)
                        <img src="{{ asset('storage/' . $hospital->image) }}" alt="{{ $hospital->name }}" class="img-preview">
                    @else
                        <p style="color:#888;font-size:0.95rem;">No image uploaded.</p>
                    @endif
                    <label for="image" style="margin-top:0.7rem;">New Image (optional)</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary"><i class="fas fa-save"></i><span>Update Hospital</span></button>
                    <a href="{{ route('admin.hospitals.index') }}" class="btn-secondary"><i class="fas fa-arrow-left"></i><span>Cancel</span></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 