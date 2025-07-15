<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
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
        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: #185a9d;
            margin-bottom: 2rem;
            letter-spacing: 1px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.7rem;
        }
        th, td {
            padding: 0.9rem 1rem;
            background: #fff;
            text-align: left;
        }
        th {
            color: #185a9d;
            font-size: 0.98rem;
            font-weight: 700;
            border-bottom: 2px solid #e5e7eb;
            background: #e0f2fe;
        }
        td {
            font-size: 0.97rem;
            color: #22223b;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }
        tr {
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(24,90,157,0.06);
            transition: box-shadow 0.2s;
        }
        tr:hover td {
            background: #f0fdfa;
        }
        .action-btn {
            font-weight: 600;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 0.5rem;
            margin-right: 0.3rem;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .view-btn {
            background: #e0f2fe;
            color: #2563eb;
        }
        .view-btn:hover {
            background: #2563eb;
            color: #fff;
        }
        .delete-btn {
            background: #fee2e2;
            color: #ef4444;
        }
        .delete-btn:hover {
            background: #ef4444;
            color: #fff;
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
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="page-title">Contact Messages</div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ Str::limit($contact->message, 50) }}</td>
                        <td>
                            <span class="px-2 py-1 text-xs font-semibold leading-tight rounded-full {{ $contact->status == 'replied' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($contact->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="action-btn view-btn"><i class="fas fa-eye"></i> View/Reply</a>
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="inline-block" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this contact message?');">
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