@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Detail Wisata</h1>
<div class="bg-white p-6 rounded shadow max-w-2xl">
    @if($tourism->image)
        <img src="{{ asset('storage/'.$tourism->image) }}" alt="Gambar Wisata" class="mb-4 w-full h-48 object-cover rounded">
    @endif
    <div class="mb-2"><span class="font-semibold">Nama:</span> {{ $tourism->name }}</div>
    <div class="mb-2"><span class="font-semibold">Deskripsi:</span> {{ $tourism->description }}</div>
    <div class="mb-2"><span class="font-semibold">Alamat:</span> {{ $tourism->address }}</div>
    <div class="mb-2"><span class="font-semibold">Kota:</span> {{ $tourism->city }}</div>
    <div class="mb-2"><span class="font-semibold">Fasilitas:</span> {{ is_array($tourism->facilities) ? implode(', ', $tourism->facilities) : $tourism->facilities }}</div>
    <div class="mb-2"><span class="font-semibold">Jam Buka:</span> {{ $tourism->opening_hours_start }} - {{ $tourism->opening_hours_end }}</div>
    <div class="mb-2"><span class="font-semibold">Harga Tiket:</span> {{ $tourism->ticket_price }}</div>
    <div class="mb-2"><span class="font-semibold">Status:</span> {{ $tourism->is_active ? 'Aktif' : 'Nonaktif' }}</div>
    <div class="mt-6 flex gap-4">
        <a href="{{ route('admin.tourism.edit', $tourism) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        <a href="{{ route('admin.tourism.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
    </div>
</div>
@endsection 