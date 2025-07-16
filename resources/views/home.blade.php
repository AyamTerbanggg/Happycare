@extends('layouts.app')

@section('title', 'HappyCare - Kesehatan & Wisata Jawa Tengah')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="display-5 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100">
                    Sehat dan Bahagia Bersama <span class="text-warning">HappyCare</span>
                </h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="200">
                    Temukan rumah sakit terbaik dan destinasi wisata menarik di Jawa Tengah. 
                    Kesehatan dan kebahagiaan Anda adalah prioritas kami.
                </p>
                <div class="d-flex gap-3" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('hospitals.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-hospital me-2"></i>Cari Rumah Sakit
                    </a>
                    <a href="{{ route('tourism') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-map-marked-alt me-2"></i>Jelajahi Wisata
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-duration="1000">
                <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=500" 
                     alt="Healthcare" class="img-fluid rounded-3 shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-hospital fa-3x text-primary mb-3"></i>
                        <h3 class="fw-bold">50+</h3>
                        <p class="text-muted">Rumah Sakit</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-user-md fa-3x text-success mb-3"></i>
                        <h3 class="fw-bold">500+</h3>
                        <p class="text-muted">Dokter Ahli</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-map-marked-alt fa-3x text-warning mb-3"></i>
                        <h3 class="fw-bold">100+</h3>
                        <p class="text-muted">Destinasi Wisata</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-image.pngusers fa-3x text-info mb-3"></i>
                        <h3 class="fw-bold">10K+</h3>
                        <p class="text-muted">Pengguna Puas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Hospitals -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title fw-bold">Rumah Sakit Unggulan</h2>
            <p class="text-muted">Rumah sakit terpercaya dengan fasilitas terlengkap di Jawa Tengah</p>
        </div>
        
        <div class="row">
            @foreach($featuredHospitals as $hospital)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card h-100">
                    <img src="{{ $hospital['image'] }}" class="card-img-top" alt="{{ $hospital['name'] }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $hospital['name'] }}</h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $hospital['location'] }}
                        </p>
                        <div class="rating mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $hospital['rating'] ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                            <span class="ms-1">{{ $hospital['rating'] }}</span>
                        </div>
                        <div class="mb-3">
                            @foreach(array_slice($hospital['specialties'], 0, 3) as $specialty)
                                <span class="badge badge-category me-1">{{ $specialty }}</span>
                            @endforeach
                        </div>
                        <a href="{{ route('hospitals.show', $hospital['id']) }}" class="btn btn-primary">
                            Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('hospitals.index') }}" class="btn btn-outline-primary btn-lg">
                Lihat Semua Rumah Sakit <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Featured Tourism -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title fw-bold">Destinasi Wisata Populer</h2>
            <p class="text-muted">Jelajahi keindahan dan budaya Jawa Tengah</p>
        </div>
        
        <div class="row">
            @foreach($featuredTourism as $tourism)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            @if($tourism->image)
                                <img src="{{ asset('storage/' . $tourism->image) }}" class="card-img-top" alt="{{ $tourism->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400" class="card-img-top" alt="{{ $tourism->name }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <span class="badge badge-category position-absolute top-0 start-0 m-2">{{ $tourism->category }}</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $tourism->name }}</h5>
                            <div class="mb-2 text-muted" style="font-size:0.95em;"><i class="fas fa-map-marker-alt me-1"></i>{{ $tourism->city }}</div>
                            <p class="text-muted small mb-3">{{ Str::limit($tourism->description, 100) }}</p>
                            <a href="{{ route('tourism.show', $tourism->id) }}" class="btn btn-primary mt-auto w-100">Jelajahi <i class="fas fa-arrow-right ms-1"></i></a>
                            @if(!empty($tourism->maps_url))
                                <a href="{{ $tourism->maps_url }}" target="_blank" class="btn btn-success mt-2 w-100">
                                    <i class="fas fa-map-marked-alt me-1"></i> Google Maps
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('tourism') }}" class="btn btn-outline-primary btn-lg">
                Lihat Semua Destinasi <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);">
    <div class="container text-center text-white">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <h2 class="fw-bold mb-4">Siap Memulai Perjalanan Sehat Anda?</h2>
                <p class="lead mb-4">
                    Bergabunglah dengan ribuan pengguna yang telah merasakan kemudahan layanan HappyCare
                </p>
                <div class="d-flex justify-content-center gap-3" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-phone me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection