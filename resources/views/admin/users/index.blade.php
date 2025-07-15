<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
            padding: 2.5rem 2rem 1.5rem 1.5rem;
            max-width: 96vw;
            width: calc(100vw - 210px - 2vw);
        }
        .page-title {
            font-size: 1.7rem;
            font-weight: 800;
            color: #185a9d;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }
        .add-btn {
            background: #43cea2;
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 0.6rem;
            margin-bottom: 1.2rem;
            transition: background 0.2s;
            box-shadow: 0 2px 8px rgba(67,206,162,0.06);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }
        .add-btn i { font-size: 1rem; }
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
        @media (max-width: 900px) {
            .main-content { padding: 1rem; }
            th:nth-child(1), td:nth-child(1) { display: none; }
        }
        @media (max-width: 800px) {
            .main-content { margin-left: 0; padding: 1rem; }
            .sidebar { position: static; width: 100%; min-height: auto; flex-direction: row; box-shadow: none; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="page-title">User Management</div>
        <a href="{{ route('admin.users.create') }}" class="add-btn"><i class="fas fa-plus"></i> Add New User</a>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="action-btn edit-btn"><i class="fas fa-edit"></i><span>Edit</span></a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn"><i class="fas fa-trash"></i><span>Delete</span></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 