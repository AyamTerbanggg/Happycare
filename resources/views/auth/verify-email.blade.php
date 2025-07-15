@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Verifikasi Email</h4>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <i class="fas fa-envelope-open-text fa-3x text-primary mb-3"></i>
                        <h5>Verifikasi Email Anda</h5>
                        <p class="text-muted">
                            Sebelum melanjutkan, silakan cek email Anda untuk link verifikasi.
                            Jika Anda tidak menerima email, kami akan mengirim ulang.
                        </p>
                    </div>

                    @auth
                        <div class="alert alert-info">
                            <strong>📧 Cek Email Anda</strong><br>
                            Kami telah mengirim link verifikasi ke: <strong>{{ auth()->user()->email }}</strong>
                        </div>
                    @endauth


                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-paper-plane"></i> Kirim Ulang Email
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-block">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    <hr>

                    <div class="text-center">
                        <small class="text-muted">
                            <strong>💡 Tips:</strong><br>
                            • Cek folder spam/junk jika email tidak ada di inbox<br>
                            • Pastikan alamat email yang Anda daftar sudah benar<br>
                            • Link verifikasi berlaku selama 24 jam
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 