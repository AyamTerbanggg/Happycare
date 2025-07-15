@extends('layouts.app')

@section('title', 'Tentang Kami - HappyCare')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Tentang HappyCare</h1>
                <p class="lead">
                    Kami berkomitmen untuk menjadi jembatan antara kesehatan dan kebahagiaan masyarakat Jawa Tengah 
                    melalui layanan informasi yang terpercaya dan komprehensif.
                </p>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('img/Logo.png') }}">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-bullseye fa-3x text-primary"></i>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Misi Kami</h3>
                        <p class="text-muted">
                            Menyediakan platform digital yang memudahkan masyarakat dalam mengakses informasi 
                            kesehatan dan wisata di Jawa Tengah, serta menghubungkan mereka dengan layanan 
                            berkualitas tinggi untuk meningkatkan kualitas hidup.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-eye fa-3x text-success"></i>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Visi Kami</h3>
                        <p class="text-muted">
                            Menjadi platform terdepan dan terpercaya di Indonesia yang mengintegrasikan 
                            layanan kesehatan dan pariwisata untuk menciptakan masyarakat yang sehat, 
                            bahagia, dan sejahtera.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title fw-bold">Nilai-Nilai Kami</h2>
            <p class="text-muted">Prinsip yang memandu setiap langkah perjalanan kami</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-heart fa-2x text-white"></i>
                    </div>
                    <h5 class="fw-bold">Kepedulian</h5>
                    <p class="text-muted">Kami peduli dengan kesehatan dan kebahagiaan setiap pengguna</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt fa-2x text-white"></i>
                    </div>
                    <h5 class="fw-bold">Kepercayaan</h5>
                    <p class="text-muted">Informasi akurat dan layanan terpercaya adalah komitmen kami</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-lightbulb fa-2x text-white"></i>
                    </div>
                    <h5 class="fw-bold">Inovasi</h5>
                    <p class="text-muted">Terus berinovasi untuk memberikan pengalaman terbaik</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-users fa-2x text-white"></i>
                    </div>
                    <h5 class="fw-bold">Kolaborasi</h5>
                    <p class="text-muted">Bekerja sama dengan berbagai pihak untuk hasil terbaik</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title fw-bold">Tim Kami</h2>
            <p class="text-muted">Profesional berpengalaman yang berdedikasi untuk Anda</p>
        </div>
        
        <div class="row justify-content-center">
            @foreach($teamMembers as $member)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body p-4">
                        <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" 
                             class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                        <h5 class="fw-bold">{{ $member['name'] }}</h5>
                        <p class="text-primary fw-medium">{{ $member['position'] }}</p>
                        <div class="social-links">
                            <a href="#" class="text-muted me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-muted me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-muted"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Statistics -->
<section class="py-5" style="background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);">
    <div class="container text-white">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Pencapaian Kami</h2>
            <p>Angka yang menunjukkan dedikasi kami</p>
        </div>
        
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <h2 class="fw-bold display-4">5+</h2>
                <p>Tahun Pengalaman</p>
            </div>
            <div class="col-md-3 mb-4">
                <h2 class="fw-bold display-4">50K+</h2>
                <p>Pengguna Aktif</p>
            </div>
            <div class="col-md-3 mb-4">
                <h2 class="fw-bold display-4">100+</h2>
                <p>Mitra Rumah Sakit</p>
            </div>
            <div class="col-md-3 mb-4">
                <h2 class="fw-bold display-4">98%</h2>
                <p>Tingkat Kepuasan</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="py-5">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4">Ingin Tahu Lebih Lanjut?</h2>
                <p class="text-muted mb-4">
                    Hubungi tim kami untuk informasi lebih detail tentang layanan HappyCare
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-envelope me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection