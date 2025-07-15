@extends('layouts.app')

@section('title', 'Kontak Kami - HappyCare')

@section('content')
<!-- Hero Section -->
<section class="hero-section py-5 mb-0" style="background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <h1 class="display-5 fw-bold mb-3">Hubungi HappyCare</h1>
                <p class="lead mb-0">Kami siap membantu Anda! Silakan hubungi kami untuk pertanyaan, saran, atau bantuan seputar layanan kesehatan dan wisata.</p>
            </div>
            <div class="col-lg-5 text-center">
                <img src="https://undraw.co/api/illustrations/undraw_contact_us_re_4qqt.svg" alt="Contact Us" style="max-width: 320px; width: 100%;">
            </div>
        </div>
    </div>
</section>

<!-- Info Kontak -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="card text-center border-0 shadow-sm h-100">
                    <div class="card-body py-4">
                        <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                            <i class="fas fa-phone text-white"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Telepon</h6>
                        @auth
                            <a href="tel:+62241234567" class="text-muted small d-block">(024) 123-4567</a>
                        @else
                            <a href="{{ route('login') }}" class="text-muted small d-block">Login untuk melihat</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-center border-0 shadow-sm h-100">
                    <div class="card-body py-4">
                        <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Email</h6>
                        @auth
                            <a href="mailto:info@happycare.id" class="text-muted small d-block">info@happycare.id</a>
                        @else
                            <a href="{{ route('login') }}" class="text-muted small d-block">Login untuk melihat</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-center border-0 shadow-sm h-100">
                    <div class="card-body py-4">
                        <div class="bg-warning bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Alamat</h6>
                        <div class="text-muted small">Jl. Pemuda No. 123, Semarang</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-center border-0 shadow-sm h-100">
                    <div class="card-body py-4">
                        <div class="bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                            <i class="fab fa-whatsapp text-white"></i>
                        </div>
                        <h6 class="fw-bold mb-1">WhatsApp</h6>
                        @auth
                            <a href="https://wa.me/6281234567890" target="_blank" class="text-muted small d-block">+62 812-3456-7890</a>
                        @else
                            <a href="{{ route('login') }}" class="text-muted small d-block">Login untuk melihat</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form Kontak & Map -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Kirim Pesan</h4>
                        @auth
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            <form action="{{ route('contact.store') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" placeholder="Nama Lengkap *" value="{{ old('name') }}" required>
                                        @if($errors->has('name'))<div class="invalid-feedback">{{ $errors->first('name') }}</div>@endif
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" placeholder="Email *" value="{{ old('email') }}" required>
                                        @if($errors->has('email'))<div class="invalid-feedback">{{ $errors->first('email') }}</div>@endif
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <input type="text" class="form-control @if($errors->has('subject')) is-invalid @endif" name="subject" placeholder="Subjek *" value="{{ old('subject') }}" required>
                                    @if($errors->has('subject'))<div class="invalid-feedback">{{ $errors->first('subject') }}</div>@endif
                                </div>
                                <div class="mt-3">
                                    <textarea class="form-control @if($errors->has('message')) is-invalid @endif" name="message" rows="5" placeholder="Pesan *" required>{{ old('message') }}</textarea>
                                    @if($errors->has('message'))<div class="invalid-feedback">{{ $errors->first('message') }}</div>@endif
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-info text-center" role="alert">
                                Anda harus <a href="{{ route('login') }}">login</a> untuk mengirim pesan.
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-0">
                        <iframe src="https://www.google.com/maps?q=-6.9845,110.4186&hl=id&z=15&output=embed" width="100%" height="260" style="border:0; border-radius:0.375rem;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-2"><i class="fas fa-clock me-2 text-primary"></i>Jam Operasional</h6>
                        <ul class="list-unstyled mb-0">
                            <li><strong>Senin - Jumat:</strong> <span class="text-muted">08:00 - 17:00 WIB</span></li>
                            <li><strong>Sabtu:</strong> <span class="text-muted">08:00 - 12:00 WIB</span></li>
                            <li><strong>Minggu:</strong> <span class="text-muted">Tutup</span></li>
                        </ul>
                        <div class="alert alert-info mt-3 mb-0 py-2 px-3">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>Customer service online 24/7 melalui chat dan email</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title fw-bold">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-muted">Temukan jawaban untuk pertanyaan umum seputar layanan HappyCare</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                <i class="fas fa-question-circle me-2 text-primary"></i>Bagaimana cara booking rumah sakit di HappyCare?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Anda dapat memilih rumah sakit, klik tombol "Booking", lalu isi formulir dan tunggu konfirmasi dari tim kami.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                <i class="fas fa-question-circle me-2 text-primary"></i>Apakah layanan customer service tersedia 24 jam?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, Anda dapat menghubungi kami kapan saja melalui WhatsApp, email, atau form kontak.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                <i class="fas fa-question-circle me-2 text-primary"></i>Apakah data saya aman di HappyCare?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Tentu, data Anda dijaga kerahasiaannya dan hanya digunakan untuk keperluan layanan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                <i class="fas fa-question-circle me-2 text-primary"></i>Bagaimana jika saya tidak menerima balasan email?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Silakan cek folder spam atau hubungi kami melalui WhatsApp untuk respon lebih cepat.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection