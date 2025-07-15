@extends('layouts.app')

@section('title', $tourism->name . ' - HappyCare')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 mb-4">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="{{ $tourism->image ? asset('storage/' . $tourism->image) : asset('img/default-tourism.jpg') }}" class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="{{ $tourism->name }}" style="min-height:300px;max-height:400px;object-fit:cover;">
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-between p-4">
                        <div>
                            <span class="badge badge-category mb-2 px-3 py-2 fs-6">{{ $tourism->category }}</span>
                            <h2 class="fw-bold mb-2">{{ $tourism->name }}</h2>
                            <p class="text-muted mb-2"><i class="fas fa-map-marker-alt me-1"></i>{{ $tourism->city }}, {{ $tourism->address }}</p>
                            <p class="mb-3">{{ $tourism->description }}</p>
                        </div>
                        @if($tourism->facilities && is_array($tourism->facilities))
                        <div>
                            <h5 class="fw-semibold mb-2">Fasilitas:</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($tourism->facilities as $facility)
                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        <i class="fas fa-check-circle text-success me-1"></i>{{ ucfirst($facility) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @if(!empty($tourism->price))
                        <div class="mt-3">
                            <span class="fw-semibold">Harga Tiket:</span> {{ $tourism->price }}
                        </div>
                        @endif
                        @if(!empty($tourism->contact))
                        <div class="mt-2">
                            <span class="fw-semibold">Kontak:</span> {{ $tourism->contact }}
                        </div>
                        @endif
                        @if(!empty($tourism->maps_url))
                        <div class="mt-3">
                            <a href="{{ $tourism->maps_url }}" target="_blank" class="btn btn-success">
                                <i class="fas fa-map-marked-alt me-1"></i> Lihat di Google Maps
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{ route('tourism') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Wisata
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.object-fit-cover {
    object-fit: cover;
}
.badge-category {
    background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
    color: #fff;
    font-weight: 500;
    border-radius: 8px;
}
</style>
@endpush