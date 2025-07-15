@extends('layouts.app')

@section('title', 'Destinasi Wisata - HappyCare')

@section('content')
<!-- Hero Section -->
<section class="py-5 mb-0" style="background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <h1 class="display-5 fw-bold mb-2">Destinasi Wisata Jawa Tengah</h1>
                <p class="lead mb-0">Jelajahi keindahan alam dan kekayaan budaya Jawa Tengah yang memukau</p>
            </div>
            <div class="col-lg-4 text-center position-relative">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400" alt="Wisata Jawa Tengah" style="max-width: 260px; width: 100%; border-radius: 1rem; box-shadow: 0 4px 16px rgba(24,90,157,0.10); opacity: 0.55; filter: blur(0.5px) saturate(1.2); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
            </div>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="py-4 bg-light">
    <div class="container">
        <form method="GET" action="{{ route('tourism') }}">
            <div class="row g-2 align-items-center">
                <div class="col-md-4 mb-2 mb-md-0">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="Cari destinasi wisata..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2 mb-2 mb-md-0">
                    <select class="form-select" name="city">
                        <option value="">Semua Kota</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <select class="form-select" name="category">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2 mb-md-0">
                    <select class="form-select" name="sort">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i></button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Results Section -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6 text-md-end">
                @if(request()->hasAny(['search', 'city', 'category']))
                    <a href="{{ route('tourism') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-times me-1"></i>Reset Filter
                    </a>
                @endif
            </div>
        </div>

        <div class="row">
            <!-- Hapus card khusus Dieng Plateau, tampilkan hanya data wisata dinamis -->
            @forelse($tourism as $destination)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            @if($destination->image)
                                <img src="{{ asset('storage/' . $destination->image) }}" class="card-img-top" alt="{{ $destination->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400" class="card-img-top" alt="{{ $destination->name }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <span class="badge badge-category position-absolute top-0 start-0 m-2">{{ $destination->category }}</span>
                            @if($destination->entrance_fee)
                                <span class="badge bg-warning position-absolute top-0 end-0 m-2">Rp {{ number_format($destination->entrance_fee, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $destination->name }}</h5>
                            <div class="mb-2 text-muted" style="font-size:0.95em;"><i class="fas fa-map-marker-alt me-1"></i>{{ $destination->city }}</div>
                            @if($destination->rating > 0)
                            <div class="mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $destination->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                                <span class="ms-1">{{ $destination->rating }} ({{ $destination->total_reviews }} ulasan)</span>
                            </div>
                            @endif
                            <p class="text-muted small mb-3">{{ Str::limit($destination->description, 100) }}</p>
                            <a href="{{ route('tourism.show', $destination->id) }}" class="btn btn-primary mt-auto w-100">Jelajahi <i class="fas fa-arrow-right ms-1"></i></a>
                            @if(!empty($destination->maps_url))
                                <a href="{{ $destination->maps_url }}" target="_blank" class="btn btn-success mt-2 w-100">
                                    <i class="fas fa-map-marked-alt me-1"></i> Google Maps
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Dummy Destinasi jika data kosong -->
                @php
                $dummy = [
                    [
                        'name' => 'Candi Borobudur',
                        'city' => 'Magelang',
                        'category' => 'Sejarah',
                        'image' => 'https://images.unsplash.com/photo-1555400082-6c3b6d6d5b8b?w=400',
                        'rating' => 4.9,
                        'total_reviews' => 1200,
                        'entrance_fee' => 50000,
                        'description' => 'Candi Buddha terbesar di dunia dan warisan budaya UNESCO.'
                    ],
                    [
                        'name' => 'Pantai Parangtritis',
                        'city' => 'Bantul',
                        'category' => 'Pantai',
                        'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400',
                        'rating' => 4.7,
                        'total_reviews' => 800,
                        'entrance_fee' => 15000,
                        'description' => 'Pantai legendaris dengan pemandangan sunset yang indah.'
                    ],
                    [
                        'name' => 'Dieng Plateau',
                        'city' => 'Wonosobo',
                        'category' => 'Alam',
                        'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400',
                        'rating' => 4.8,
                        'total_reviews' => 950,
                        'entrance_fee' => 20000,
                        'description' => 'Dataran tinggi dengan kawah, telaga, dan budaya unik.'
                    ],
                ];
                @endphp
                @foreach($dummy as $destination)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            <img src="{{ $destination['image'] }}" class="card-img-top" alt="{{ $destination['name'] }}" style="height: 200px; object-fit: cover;">
                            <span class="badge badge-category position-absolute top-0 start-0 m-2">{{ $destination['category'] }}</span>
                            <span class="badge bg-warning position-absolute top-0 end-0 m-2">Rp {{ number_format($destination['entrance_fee'], 0, ',', '.') }}</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $destination['name'] }}</h5>
                            <div class="mb-2 text-muted" style="font-size:0.95em;"><i class="fas fa-map-marker-alt me-1"></i>{{ $destination['city'] }}</div>
                            <div class="mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $destination['rating'] ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                                <span class="ms-1">{{ $destination['rating'] }} ({{ $destination['total_reviews'] }} ulasan)</span>
                            </div>
                            <p class="text-muted small mb-3">{{ Str::limit($destination['description'], 100) }}</p>
                            <a href="#" class="btn btn-primary mt-auto w-100 disabled">Jelajahi <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endforelse
        </div>

        <!-- Pagination -->
        @if($tourism->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $tourism->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</section>
@endsection