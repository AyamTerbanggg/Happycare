@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Laporan & Statistik</h1>
    <p class="text-gray-600 mt-1">Analisis data dan ringkasan kinerja sistem.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Ringkasan Pengguna</h2>
        <p class="text-gray-600">Total Pengguna: <span class="font-bold text-blue-600">{{ $stats['total_users'] }}</span></p>
        <p class="text-gray-600">Total Admin: <span class="font-bold text-blue-600">{{ $stats['total_admins'] }}</span></p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Ringkasan Rumah Sakit</h2>
        <p class="text-gray-600">Total Rumah Sakit: <span class="font-bold text-green-600">{{ $stats['total_hospitals'] }}</span></p>
        <p class="text-gray-600">Rumah Sakit Aktif: <span class="font-bold text-green-600">{{ $stats['active_hospitals'] }}</span></p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Ringkasan Wisata</h2>
        <p class="text-gray-600">Total Wisata: <span class="font-bold text-purple-600">{{ $stats['total_tourism'] }}</span></p>
        <p class="text-gray-600">Wisata Aktif: <span class="font-bold text-purple-600">{{ $stats['active_tourism'] }}</span></p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Pesan Kontak</h2>
        <p class="text-gray-600">Total Pesan Kontak: <span class="font-bold text-red-600">{{ $stats['total_contacts'] }}</span></p>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Pendaftaran Pengguna (6 Bulan Terakhir)</h2>
    <canvas id="userRegistrationsChart"></canvas>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Kota Teratas untuk Rumah Sakit</h2>
        <ul>
            @forelse($topHospitalCities as $city)
                <li class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                    <span class="text-gray-700">{{ $city->city }}</span>
                    <span class="px-2 py-1 bg-gray-200 text-gray-800 rounded-full text-xs font-semibold">{{ $city->total }}</span>
                </li>
            @empty
                <li class="text-gray-500">Tidak ada data kota rumah sakit.</li>
            @endforelse
        </ul>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Kota Teratas untuk Wisata</h2>
        <ul>
            @forelse($topTourismCities as $city)
                <li class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                    <span class="text-gray-700">{{ $city->city }}</span>
                    <span class="px-2 py-1 bg-gray-200 text-gray-800 rounded-full text-xs font-semibold">{{ $city->total }}</span>
                </li>
            @empty
                <li class="text-gray-500">Tidak ada data kota wisata.</li>
            @endforelse
        </ul>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Pesan Kontak Terbaru</h2>
    <ul class="divide-y divide-gray-200">
        @forelse($recentContacts as $contact)
            <li class="py-3">
                <p class="text-sm font-semibold text-gray-800">{{ $contact->name }} ({{ $contact->email }})</p>
                <p class="text-sm text-gray-600">{{ Str::limit($contact->message, 100) }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $contact->created_at->diffForHumans() }}</p>
            </li>
        @empty
            <li class="text-gray-500 py-3">Tidak ada pesan kontak terbaru.</li>
        @endforelse
    </ul>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userRegistrationsData = @json($userRegistrations);
        const months = userRegistrationsData.map(item => {
            const date = new Date();
            date.setMonth(item.month - 1); // Bulan dimulai dari 0
            return date.toLocaleString('id-ID', { month: 'long' });
        });
        const totals = userRegistrationsData.map(item => item.total);

        const ctx = document.getElementById('userRegistrationsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Jumlah Pendaftaran Pengguna',
                    data: totals,
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection 