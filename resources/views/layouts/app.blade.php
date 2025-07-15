<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HappyCare - Kesehatan & Wisata Jawa Tengah')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #2c5aa0 !important;
        }
        
        .navbar-nav .nav-link {
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: #2c5aa0 !important;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            color: white;
            padding: 100px 0;
        }
        
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #2fa07a 0%, #14487a 100%);
        }
        
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 50px 0 20px;
        }
        
        .rating {
            color: #ffc107;
        }
        
        .badge-category {
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
        }
        
        .section-title {
            position: relative;
            margin-bottom: 50px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
        }

        /* Chatbot Styles */
        #chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        #chatbot-toggle-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            border: none;
            color: white;
            margin-bottom: 0;
        }

        #chatbot-toggle-button:hover {
            background: linear-gradient(135deg, #2fa07a 0%, #14487a 100%);
        }

        #chatbot-window {
            display: none; /* Hidden by default */
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 350px;
            height: 450px;
            flex-direction: column;
            overflow: hidden;
            position: absolute;
            bottom: 80px; /* Position above the toggle button */
            right: 0;
        }

        #chatbot-window.active {
            display: flex; /* Show when active */
        }

        .chatbot-header {
            background: linear-gradient(135deg, #185a9d 0%, #43cea2 100%);
            color: white;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .chatbot-header .btn-close {
            filter: invert(1);
        }

        .chatbot-header #chatbot-clear-history-button {
            font-size: 0.9rem;
            padding: 0 10px;
            border-radius: 0;
            font-weight: 400;
        }

        .chatbot-header #chatbot-clear-history-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .chatbot-body {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }

        .message {
            padding: 8px 12px;
            border-radius: 15px;
            margin-bottom: 10px;
            max-width: 80%;
            word-wrap: break-word;
        }

        .user-message {
            background-color: #dcf8c6;
            align-self: flex-end;
            margin-left: auto;
        }

        .bot-message {
            background-color: #e0e0e0;
            align-self: flex-start;
            margin-right: auto;
        }

        .chatbot-footer {
            padding: 15px;
            border-top: 1px solid #eee;
            display: flex;
            background-color: #fff;
        }

        #chatbot-input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            margin-right: 10px;
            outline: none;
        }

        #chatbot-input:focus {
            border-color: #185a9d;
            box-shadow: 0 0 0 0.2rem rgba(24, 90, 157, 0.25);
        }

        #chatbot-send-button {
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 500;
        }

        /* Membesarkan tombol bubble Tawk.to agar tidak tertutup tombol chatbot */
        #tawkchat-minified {
            transform: scale(1.7);
            transform-origin: bottom right;
            z-index: 2000 !important;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div id="app">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('img/Logo.png') }}" alt="HappyCare Logo" style="height: 24px; margin-right: 8px;">
                    HappyCare
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="fas fa-home me-1"></i>Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                                <i class="fas fa-info-circle me-1"></i>Tentang
                            </a>
                        </li>
                        @auth
                            @if(Auth::user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/admin') }}">Admin Panel</a>
                                </li>
                            @endif
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('hospitals*') ? 'active' : '' }}" href="{{ route('hospitals.index') }}">
                                <i class="fas fa-hospital me-1"></i>Rumah Sakit
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('tourism*') ? 'active' : '' }}" href="{{ route('tourism') }}">
                                <i class="fas fa-map-marked-alt me-1"></i>Wisata
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                                <i class="fas fa-envelope me-1"></i>Kontak
                            </a>
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                                    {{-- <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user-circle me-2"></i>Profil</a></li> --}}
                                    @if(Auth::user()->is_admin)
                                    <li><a class="dropdown-item" href="{{ url('/admin') }}"><i class="fas fa-tachometer-alt me-2"></i>Admin Panel</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-secondary" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-1"></i>Register
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main style="margin-top: 100px;">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="text-uppercase mb-4 text-white">HappyCare</h5>
                        <p class="text-white">Platform terpercaya untuk informasi kesehatan dan wisata di Jawa Tengah.</p>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="text-uppercase mb-4 text-white">Tautan Cepat</h5>
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                            <li><a href="{{ route('about') }}" class="text-white text-decoration-none">Tentang Kami</a></li>
                            <li><a href="{{ route('hospitals.index') }}" class="text-white text-decoration-none">Rumah Sakit</a></li>
                            <li><a href="{{ route('tourism') }}" class="text-white text-decoration-none">Wisata</a></li>
                            <li><a href="{{ route('contact') }}" class="text-white text-decoration-none">Kontak</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-uppercase mb-4 text-white">Hubungi Kami</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="text-white"><i class="fas fa-map-marker-alt me-2"></i>Jl. Contoh No. 123, Semarang</li>
                            <li class="text-white"><i class="fas fa-envelope me-2"></i>info@happycare.com</li>
                            <li class="text-white"><i class="fas fa-phone me-2"></i>(024) 123-4567</li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4 border-light">
                <div class="row">
                    <div class="col text-center">
                        <p class="text-white mb-0">&copy; {{ date('Y') }} HappyCare. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- Vite JS -->
    @vite(['resources/js/app.js'])
    @stack('scripts')

    <!-- Chatbot Container -->
    <div id="chatbot-container">
        <button id="chatbot-toggle-button" class="btn btn-primary rounded-circle">
            <i class="fas fa-comments"></i>
        </button>
        <div id="chatbot-window">
            <div class="chatbot-header">
                Chatbot HappyCare
                <button id="chatbot-clear-history-button" class="btn btn-link text-danger me-2" title="Hapus Riwayat">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <button id="chatbot-close-button" class="btn-close"></button>
            </div>
            <div class="chatbot-body" id="chatbot-messages">
                <!-- Chat messages will be appended here -->
                <div class="message bot-message">Halo! Ada yang bisa saya bantu terkait HappyCare?</div>
            </div>
            <div class="chatbot-footer">
                <input type="text" id="chatbot-input" placeholder="Ketik pesan Anda...">
                <button id="chatbot-send-button" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </div>
</body>
</html> 