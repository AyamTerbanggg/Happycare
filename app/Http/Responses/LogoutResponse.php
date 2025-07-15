<?php

namespace App\Http\Responses;

// use Filament\Http\Responses\Auth\Contracts\LogoutResponse as Responsable;
use Illuminate\Http\RedirectResponse;

class LogoutResponse
{
    public function toResponse($request): RedirectResponse
    {
        // Change this to your desired route, 'home' is the route name for your main homepage
        return redirect()->route('home');
    }
} 