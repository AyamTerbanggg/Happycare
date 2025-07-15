@extends('layouts.app')

@section('title', 'Daftar Rumah Sakit')

@push('styles')
<style>
    .hospital-card {
        border-radius: 15px;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .hospital-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    .hospital-card .card-img-top {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        height: 200px;
        object-fit: cover;
    }
    .hospital-card .card-body {
        padding: 1.5rem;
    }
    .hospital-card .badge {
        font-size: 0.8em;
    }
    .section-title {
        font-weight: 700;
        color: #333;
    }
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        transition: background-color 0.2s, border-color 0.2s;
    }
    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    /* Custom Pagination Styles */
    .pagination .page-item .page-link {
        color: #0d6efd;
        border-radius: 0.25rem;
        margin: 0 2px;
        border: 1px solid #dee2e6;
    }
    .pagination .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }
    .pagination .page-link:hover {
        z-index: 2;
        color: #0a58ca;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-8 mx-auto text-center">
            <h1 class="section-title">Temukan Rumah Sakit Terbaik</h1>
            <p class="lead text-muted">Jelajahi daftar rumah sakit berkualitas yang siap melayani Anda.</p>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <form action="{{ route('hospitals.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="search" class="form-label">Nama Rumah Sakit</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Contoh: RS Kariadi" value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <label for="city" class="form-label">Kota</label>
                    <select class="form-select" id="city" name="city">
                        <option value="">Semua Kota</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </form>
        </div>
    </div>

    @if($hospitals->count())
        <div class="row g-4">
            @foreach($hospitals as $hospital)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 hospital-card">
                        @if($hospital->image)
                            <img src="{{ Storage::url($hospital->image) }}" class="card-img-top" alt="{{ $hospital->name }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light card-img-top">
                                <i class="fas fa-hospital fa-4x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold mb-2">{{ $hospital->name }}</h5>
                            <div class="d-flex align-items-center text-muted mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span>{{ $hospital->city }}</span>
                            </div>
                            <p class="card-text text-muted mb-4 flex-grow-1">{{ Str::limit($hospital->address, 80) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <i class="fas fa-star text-warning me-1"></i>
                                    <span class="fw-bold">{{ $hospital->rating ?? 'N/A' }}</span>
                                </div>
                                @if($hospital->emergency_service)
                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary">IGD 24 Jam</span>
                                @endif
                            </div>
                            
                            <a href="{{ route('hospitals.show', $hospital->id) }}" class="btn btn-primary w-100 fw-semibold">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($hospitals->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $hospitals->appends(request()->query())->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Belum Ada Data Rumah Sakit</h4>
            <p class="text-muted">Silakan coba lagi nanti.</p>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.bg-secondary-subtle {
    background-color: rgba(108, 117, 125, 0.1);
}
</style>
@endpush