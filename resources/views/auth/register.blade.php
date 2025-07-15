@extends('layouts.app')

@section('title', 'Daftar Akun Baru - HappyCare')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="fw-bold my-1">Daftar Akun Baru</h3>
                    <p class="mb-0">Bergabunglah dengan HappyCare untuk kemudahan akses layanan kesehatan dan wisata.</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input class="form-control @if($errors->has('username')) is-invalid @endif" id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Username" required />
                            <label for="username">Username</label>
                            @if($errors->has('username'))
                                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control @if($errors->has('name')) is-invalid @endif" id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus />
                            <label for="name">Nama Lengkap</label>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control @if($errors->has('email')) is-invalid @endif" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required />
                            <label for="email">Alamat Email</label>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @if($errors->has('password')) is-invalid @endif" id="password" type="password" name="password" placeholder="Buat Password" required />
                                    <label for="password">Password</label>
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Konfirmasi Password" required />
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button class="btn btn-primary btn-lg w-100" type="submit">Daftar Akun</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="{{ route('login') }}">Sudah punya akun? Masuk di sini!</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Optional: Add password strength indicator or toggle visibility here if desired
    // Example for password strength (basic)
    const passwordInput = document.getElementById('password');
    // const passwordStrengthText = document.createElement('small');
    // passwordStrengthText.classList.add('text-muted', 'mt-1');
    // passwordInput.parentNode.appendChild(passwordStrengthText);

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 'Sangat Lemah';
        let color = 'text-danger';

        if (password.length > 0) {
            strength = 'Lemah';
            color = 'text-danger';
        }
        if (password.length >= 6) {
            strength = 'Sedang';
            color = 'text-warning';
        }
        if (password.length >= 8 && password.match(/[a-z]/) && password.match(/[A-Z]/) && password.match(/[0-9]/)) {
            strength = 'Kuat';
            color = 'text-success';
        }
        if (password.length >= 12 && password.match(/[a-z]/) && password.match(/[A-Z]/) && password.match(/[0-9]/) && password.match(/[^a-zA-Z0-9]/)) {
            strength = 'Sangat Kuat';
            color = 'text-primary';
        }
        // passwordStrengthText.textContent = `Kekuatan Password: ${strength}`;
        // passwordStrengthText.className = `mt-1 small ${color}`;
    });
</script>
@endpush