@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Detail Rumah Sakit</h1>
<div class="bg-white p-6 rounded shadow max-w-2xl">
    @if($hospital->image)
        <img src="{{ asset('storage/'.$hospital->image) }}" alt="Gambar Rumah Sakit" class="mb-4 w-full h-48 object-cover rounded">
    @endif
    <div class="mb-2"><span class="font-semibold">Nama:</span> {{ $hospital->name }}</div>
    <div class="mb-2"><span class="font-semibold">Deskripsi:</span> {{ $hospital->description }}</div>
    <div class="mb-2"><span class="font-semibold">Alamat:</span> {{ $hospital->address }}</div>
    <div class="mb-2"><span class="font-semibold">Kota:</span> {{ $hospital->city }}</div>
    <div class="mb-2"><span class="font-semibold">Telepon:</span> {{ $hospital->phone }}</div>
    <div class="mb-2"><span class="font-semibold">Email:</span> {{ $hospital->email }}</div>
    <div class="mb-2"><span class="font-semibold">Website:</span> <a href="{{ $hospital->website }}" class="text-blue-600 hover:underline" target="_blank">{{ $hospital->website }}</a></div>
    <div class="mb-2"><span class="font-semibold">Fasilitas:</span> {{ is_array($hospital->facilities) ? implode(', ', $hospital->facilities) : $hospital->facilities }}</div>
    <div class="mb-2"><span class="font-semibold">Jam Buka:</span> {{ $hospital->opening_hours_start }} - {{ $hospital->opening_hours_end }}</div>
    <div class="mb-2"><span class="font-semibold">Layanan Gawat Darurat:</span> {{ $hospital->emergency_service ? 'Ya' : 'Tidak' }}</div>
    <div class="mb-2"><span class="font-semibold">Latitude:</span> {{ $hospital->latitude }}</div>
    <div class="mb-2"><span class="font-semibold">Longitude:</span> {{ $hospital->longitude }}</div>
    <div class="mb-2"><span class="font-semibold">Status:</span> {{ $hospital->is_active ? 'Aktif' : 'Nonaktif' }}</div>
    <div class="mt-6 flex gap-4">
        <a href="{{ route('admin.hospitals.edit', $hospital) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        <a href="{{ route('admin.hospitals.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
    </div>
</div>
@endsection 