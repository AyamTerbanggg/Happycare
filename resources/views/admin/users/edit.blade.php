<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-gray-800 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/admin/dashboard" class="text-xl font-bold">Admin Panel</a>
            <div>
                <a href="/admin/users" class="mr-4 hover:text-gray-300">Users</a>
                <a href="/admin/hospitals" class="mr-4 hover:text-gray-300">Hospitals</a>
                <a href="/admin/tourism" class="mr-4 hover:text-gray-300">Tourism</a>
                <a href="/admin/contacts" class="mr-4 hover:text-gray-300">Contacts</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="ml-4 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-10 p-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit User: {{ $user->name }}</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password (leave blank to keep current):</label>
                    <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="is_admin" class="block text-gray-700 text-sm font-bold mb-2">Admin User:</label>
                    <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }} class="leading-tight">
                    <span class="text-gray-700 text-sm ml-2">Check if this user should have admin privileges.</span>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update User</button>
                    <a href="{{ route('admin.users.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html> 