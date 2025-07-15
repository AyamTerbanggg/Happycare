@extends('layouts.admin')

@section('title', 'Tambah Rumah Sakit - Admin HappyCare')
@section('page-title', 'Tambah Rumah Sakit')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Rumah Sakit Baru</h5>
                        <a href="{{ route('admin.hospitals.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.hospitals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-md-8">
                                <h6 class="fw-bold mb-3">Informasi Dasar</h6>
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Rumah Sakit <span class="text-muted">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi <span class="text-muted">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label for="address" class="form-label">Alamat <span class="text-muted">*</span></label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                               id="address" name="address" value="{{ old('address') }}" required>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="city" class="form-label">Kota <span class="text-muted">*</span></label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                               id="city" name="city" value="{{ old('city') }}" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Telepon <span class="text-muted">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                           id="website" name="website" value="{{ old('website') }}">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Facilities -->
                                <div class="mb-3">
                                    <label class="form-label">Fasilitas</label>
                                    <div id="facilities-container">
                                        @if(old('facilities'))
                                            @foreach(old('facilities') as $index => $facility)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="facilities[]" value="{{ $facility }}">
                                                    <button type="button" class="btn btn-outline-secondary remove-facility">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="facilities[]" placeholder="Contoh: IGD 24 Jam">
                                                <button type="button" class="btn btn-outline-secondary remove-facility">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-facility">
                                        <i class="fas fa-plus me-1"></i>Tambah Fasilitas
                                    </button>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="col-md-4">
                                <h6 class="fw-bold mb-3">Informasi Tambahan</h6>
                                
                                <div class="mb-3">
                                    <label for="image" class="form-label">Foto Rumah Sakit</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="opening_hours_start" class="form-label">Jam Buka <span class="text-muted">*</span></label>
                                        <input type="time" class="form-control @error('opening_hours_start') is-invalid @enderror" 
                                               id="opening_hours_start" name="opening_hours_start" value="{{ old('opening_hours_start') }}" required>
                                        @error('opening_hours_start')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="opening_hours_end" class="form-label">Jam Tutup <span class="text-muted">*</span></label>
                                        <input type="time" class="form-control @error('opening_hours_end') is-invalid @enderror" 
                                               id="opening_hours_end" name="opening_hours_end" value="{{ old('opening_hours_end') }}" required>
                                        @error('opening_hours_end')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="latitude" class="form-label">Latitude</label>
                                        <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror" 
                                               id="latitude" name="latitude" value="{{ old('latitude') }}">
                                        @error('latitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="longitude" class="form-label">Longitude</label>
                                        <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror" 
                                               id="longitude" name="longitude" value="{{ old('longitude') }}">
                                        @error('longitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="emergency_service" 
                                               name="emergency_service" {{ old('emergency_service') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="emergency_service">
                                            Layanan Darurat 24 Jam
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" 
                                               name="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Status Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.hospitals.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Add/Remove Facilities
document.getElementById('add-facility').addEventListener('click', function() {
    const container = document.getElementById('facilities-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="facilities[]" placeholder="Contoh: IGD 24 Jam">
        <button type="button" class="btn btn-outline-secondary remove-facility">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(div);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-facility') || e.target.parentElement.classList.contains('remove-facility')) {
        const container = document.getElementById('facilities-container');
        if (container.children.length > 1) {
            e.target.closest('.input-group').remove();
        }
    }
});
</script>
@endpush