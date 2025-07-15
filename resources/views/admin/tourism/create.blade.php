<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Tourism Spot</title>
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
        input[type="text"], input[type="url"], input[type="file"], textarea {
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
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        input[type="text"]:focus, input[type="url"]:focus, input[type="file"]:focus, textarea:focus {
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
        .cancel-btn {
            background: #f3f4f6;
            color: #185a9d;
            border: 1px solid #d1d5db;
            border-radius: 0.42rem;
            padding: 0.55rem 1.1rem;
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
        .cancel-btn:hover {
            background: #e5e7eb;
        }
        @media (max-width: 600px) {
            .form-card { padding: 1rem 0.5rem; max-width: 98vw; }
            label { font-size: 0.95rem; }
            input[type="text"], input[type="url"], input[type="file"], textarea { font-size: 0.95rem; }
            .form-actions { flex-direction: column; gap: 0.5rem; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">HappyCare Admin</div>
        <div class="nav">
            <a href="/admin/users">Users</a>
            <a href="/admin/hospitals">Hospitals</a>
            <a href="/admin/tourism" class="active">Tourism</a>
            <a href="/admin/contacts">Contacts</a>
            <a href="/">Ke Website Utama</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
    <div class="main-content">
        <div class="page-title">Add New Tourism Spot</div>
        <div class="form-card">
            <form action="{{ route('admin.tourism.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" required>
                </div>
                <div class="form-group">
                    <label for="maps_url">Google Maps Link</label>
                    <input type="url" name="maps_url" id="maps_url" value="{{ old('maps_url') }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="facilities">Facilities (comma-separated)</label>
                    <input type="text" name="facilities" id="facilities">
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn"><i class="fas fa-plus"></i> Create Tourism Spot</button>
                    <a href="{{ route('admin.tourism.index') }}" class="cancel-btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 