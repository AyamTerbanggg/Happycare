@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Daftar Halaman</h1>
</div>
@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
@endif
<div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($pages as $page)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $page->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $page->slug }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('admin.pages.edit', $page->slug) }}" class="text-yellow-600 hover:underline">Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada data halaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 