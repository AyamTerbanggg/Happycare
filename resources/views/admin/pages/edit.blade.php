@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Halaman: {{ $page->title }}</h1>
<form action="{{ route('admin.pages.update', $page->slug) }}" method="POST" class="bg-white p-6 rounded shadow max-w-2xl">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Judul Halaman</label>
        <input type="text" name="title" value="{{ old('title', $page->title) }}" class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror">
        @error('title')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Konten</label>
        <textarea name="content" rows="12" class="w-full border rounded px-3 py-2 @error('content') border-red-500 @enderror">{{ old('content', $page->content) }}</textarea>
        @error('content')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
    </div>
    <div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.pages.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection 