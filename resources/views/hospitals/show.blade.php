@extends('layouts.app')
@section('title', $hospital->name . ' - HappyCare')
@section('content')
<div class="py-5" style="background: linear-gradient(135deg, #f7fafc 60%, #e0f2fe 100%); min-height: 100vh;">
    <div class="container" style="max-width: 1100px; margin: 0 auto; padding-left: 16px; padding-right: 16px;">
        <div class="d-flex flex-column flex-lg-row gap-4 align-items-stretch">
            <!-- Card Gambar & Info -->
            <div class="flex-fill" style="min-width:320px;max-width:650px;">
                <div class="card shadow border-0 h-100" style="border-radius: 1.2rem; overflow:hidden;">
                    <img src="{{ $hospital->image ? Storage::url($hospital->image) : asset('img/default-hospital.jpg') }}" class="img-fluid w-100" alt="Foto {{ $hospital->name }}" style="object-fit:cover; min-height:220px; max-height:320px;">
                    <div class="p-4">
                        <h2 class="fw-bold mb-2" style="color:#185a9d;">{{ $hospital->name }}</h2>
                        <div class="mb-2 text-muted"><i class="fas fa-map-marker-alt me-1"></i> {{ $hospital->address }}, {{ $hospital->city }}</div>
                        <div class="mb-2 text-muted">
                            @if($hospital->emergency_service)
                                <span class="badge bg-danger">Layanan 24 Jam</span>
                            @else
                                <span>Jam Operasional: {{ $hospital->opening_hours_start ?? '00:00' }} - {{ $hospital->opening_hours_end ?? '00:00' }}</span>
                            @endif
                        </div>
                        <div class="mb-2">{{ $hospital->description }}</div>
                        @if($hospital->facilities)
                        <div class="mb-2">
                            <span class="fw-semibold">Fasilitas:</span>
                            <div class="d-flex flex-wrap gap-2 mt-1">
                                @foreach($hospital->facilities as $facility)
                                    <span class="badge bg-light text-dark border px-3 py-2" style="border-radius:8px;">
                                        <i class="fas fa-check-circle text-success me-1"></i>{{ $facility }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Card Kontak & Aksi -->
            <div class="d-flex flex-column gap-4 flex-fill" style="min-width:280px;max-width:400px;">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 1rem;">
                    <div class="fw-semibold mb-2" style="color:#185a9d;"><i class="fas fa-info-circle me-1"></i>Kontak</div>
                    <div class="mb-1"><i class="fas fa-phone me-1"></i> <a href="tel:{{ $hospital->phone }}">{{ $hospital->phone }}</a></div>
                    @if($hospital->email)
                    <div class="mb-1"><i class="fas fa-envelope me-1"></i> <a href="mailto:{{ $hospital->email }}">{{ $hospital->email }}</a></div>
                    @endif
                    @if($hospital->website)
                    <div class="mb-1"><i class="fas fa-globe me-1"></i> <a href="{{ $hospital->website }}" target="_blank">Website</a></div>
                    @endif
                </div>
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 1rem;">
                    <div class="fw-semibold mb-2" style="color:#185a9d;"><i class="fas fa-bolt me-1"></i>Aksi Cepat</div>
                    <a href="tel:{{ $hospital->phone }}" class="btn btn-outline-primary w-100 mb-2"><i class="fas fa-phone me-1"></i>Hubungi</a>
                    <button class="btn btn-outline-success w-100 mb-2" onclick="openWhatsApp()"><i class="fab fa-whatsapp me-1"></i>WhatsApp</button>
                    <button class="btn btn-outline-info w-100" onclick="openMaps()"><i class="fas fa-map-marked-alt me-1"></i>Maps</button>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('hospitals.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Rumah Sakit</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openWhatsApp() {
    const phone = '{{ $hospital->phone }}';
    const message = 'Halo, saya ingin bertanya tentang layanan di {{ $hospital->name }}';
    const url = `https://wa.me/${phone.replace(/[^0-9]/g, '')}?text=${encodeURIComponent(message)}`;
    window.open(url, '_blank');
}
function openMaps() {
    @if($hospital->latitude && $hospital->longitude)
        const url = `https://www.google.com/maps?q={{ $hospital->latitude }},{{ $hospital->longitude }}`;
    @else
        const address = '{{ $hospital->address }}, {{ $hospital->city }}';
        const url = `https://www.google.com/maps/search/${encodeURIComponent(address)}`;
    @endif
    window.open(url, '_blank');
}
</script>
@endpush