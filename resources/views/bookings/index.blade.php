@extends('layouts.app')

@section('title', 'Booking Saya - HappyCare')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Booking Saya</h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('hospitals') }}" class="btn btn-outline-primary">
                        <i class="fas fa-hospital me-2"></i>Book Rumah Sakit
                    </a>
                    <a href="{{ route('tourism') }}" class="btn btn-outline-success">
                        <i class="fas fa-map-marked-alt me-2"></i>Book Wisata
                    </a>
                </div>
            </div>

            @if($bookings->count() > 0)
                <div class="row">
                    @foreach($bookings as $booking)
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div>
                                        @if($booking->hospital)
                                            <h6 class="mb-0">
                                                <i class="fas fa-hospital text-primary me-2"></i>
                                                {{ $booking->hospital->name }}
                                            </h6>
                                        @else
                                            <h6 class="mb-0">
                                                <i class="fas fa-map-marked-alt text-success me-2"></i>
                                                {{ $booking->tourism->name }}
                                            </h6>
                                        @endif
                                    </div>
                                    <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning' : ($booking->status === 'cancelled' ? 'danger' : 'info')) }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <strong>Tanggal:</strong><br>
                                                {{ $booking->booking_date->format('d M Y') }}
                                            </p>
                                            @if($booking->booking_time)
                                                <p class="mb-2">
                                                    <strong>Waktu:</strong><br>
                                                    {{ date('H:i', strtotime($booking->booking_time)) }}
                                                </p>
                                            @endif
                                            @if($booking->specialty)
                                                <p class="mb-2">
                                                    <strong>Spesialisasi:</strong><br>
                                                    {{ $booking->specialty }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            @if($booking->total_price)
                                                <p class="mb-2">
                                                    <strong>Total Biaya:</strong><br>
                                                    <span class="text-success fw-bold">
                                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                                    </span>
                                                </p>
                                            @endif
                                            <p class="mb-2">
                                                <strong>Status:</strong><br>
                                                <span class="text-capitalize">{{ $booking->status }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    @if($booking->notes)
                                        <div class="mt-3">
                                            <strong>Catatan:</strong>
                                            <p class="text-muted mb-0">{{ $booking->notes }}</p>
                                        </div>
                                    @endif

                                    <div class="mt-3 d-flex gap-2">
                                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </a>
                                        @if($booking->status === 'pending')
                                            <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('Yakin ingin membatalkan booking ini?')">
                                                    <i class="fas fa-times me-1"></i>Batal
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($bookings->hasPages())
                    <div class="d-flex justify-content-center">
                        {{ $bookings->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <h4>Belum Ada Booking</h4>
                    <p class="text-muted mb-4">Anda belum memiliki booking apapun. Mulai jelajahi layanan kami!</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('hospitals') }}" class="btn btn-primary">
                            <i class="fas fa-hospital me-2"></i>Cari Rumah Sakit
                        </a>
                        <a href="{{ route('tourism') }}" class="btn btn-success">
                            <i class="fas fa-map-marked-alt me-2"></i>Jelajahi Wisata
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection