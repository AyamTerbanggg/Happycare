<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management</title>
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
            padding: 2.5rem 2rem 1.5rem 1.5rem;
            max-width: 96vw;
            width: calc(100vw - 210px - 2vw);
        }
        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: #185a9d;
            margin-bottom: 2rem;
            letter-spacing: 1px;
        }
        .add-btn {
            background: #43cea2;
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 0.7rem;
            margin-bottom: 1.5rem;
            transition: background 0.2s;
            box-shadow: 0 2px 8px rgba(67,206,162,0.08);
            display: inline-block;
        }
        .add-btn:hover {
            background: #185a9d;
            color: #ffe066;
        }
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.5rem;
        }
        th, td {
            padding: 0.7rem 0.8rem;
            background: #fff;
            text-align: left;
        }
        th {
            color: #185a9d;
            font-size: 0.95rem;
            font-weight: 700;
            border-bottom: 1.5px solid #e5e7eb;
            background: #e0f2fe;
        }
        td {
            font-size: 0.95rem;
            color: #22223b;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }
        tr {
            border-radius: 0.7rem;
            box-shadow: 0 1px 4px rgba(24,90,157,0.04);
            transition: box-shadow 0.2s;
        }
        tr:hover td {
            background: #f0fdfa;
        }
        .img-thumb {
            height: 38px;
            width: 38px;
            object-fit: cover;
            border-radius: 0.4rem;
            border: 1.5px solid #43cea2;
        }
        .action-btn {
            font-weight: 600;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 0.4rem;
            margin: 0.1rem 0.2rem 0.1rem 0;
            cursor: pointer;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            box-shadow: 0 1px 4px rgba(24,90,157,0.04);
        }
        .edit-btn {
            background: #e0f2fe;
            color: #2563eb;
            border: 1.5px solid #bcdffb;
        }
        .edit-btn:hover {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 2px 8px #2563eb22;
        }
        .delete-btn {
            background: #fee2e2;
            color: #ef4444;
            border: 1.5px solid #fbb6b6;
        }
        .delete-btn:hover {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 2px 8px #ef444422;
        }
        .action-group {
            display: flex;
            flex-direction: row;
            gap: 0.3rem;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        @media (max-width: 600px) {
            .action-group {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.2rem;
            }
            .action-btn span { display: none; }
            .action-btn i { font-size: 1.1rem; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="page-title">Tourism Management</div>
        <a href="{{ route('admin.tourism.create') }}" class="add-btn"><i class="fas fa-plus"></i> Add New Tourism Spot</a>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Contact</th>
                        <th>Website</th>
                        <th>Facilities</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Hapus baris khusus Dieng Plateau, tampilkan hanya data dinamis -->
                    @foreach ($tourisms as $tourism)
                    <tr>
                        <td>{{ $tourism->id }}</td>
                        <td>
                            @if ($tourism->image)
                                <img src="{{ asset('storage/' . $tourism->image) }}" alt="{{ $tourism->name }}" class="img-thumb">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $tourism->name }}</td>
                        <td>{{ Str::limit($tourism->description, 50) }}</td>
                        <td>{{ $tourism->address }}</td>
                        <td>{{ $tourism->city }}</td>
                        <td>{{ $tourism->contact }}</td>
                        <td><a href="{{ $tourism->website }}" target="_blank" style="color:#2563eb;text-decoration:underline;">{{ $tourism->website }}</a></td>
                        <td>
                            @if(is_array($tourism->facilities) || $tourism->facilities instanceof \Illuminate\Support\Collection)
                                @foreach ($tourism->facilities as $facility)
                                    <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1">{{ $facility }}</span>
                                @endforeach
                            @else
                                {{ $tourism->facilities }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.tourism.edit', $tourism->id) }}" class="action-btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('admin.tourism.destroy', $tourism->id) }}" method="POST" class="inline-block" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this tourism spot?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 