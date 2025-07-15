<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => config('app.name', 'HappyCare'),
            'site_description' => 'Platform kesehatan dan wisata Jawa Tengah',
            'contact_email' => 'info@happycare.com',
            'contact_phone' => '+62 123 456 789',
            'contact_address' => 'Jawa Tengah, Indonesia',
            'social_facebook' => 'https://facebook.com/happycare',
            'social_instagram' => 'https://instagram.com/happycare',
            'social_twitter' => 'https://twitter.com/happycare',
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'contact_address' => 'required|string',
            'social_facebook' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update settings (in real app, you'd save to database or config file)
        // For now, we'll just show success message
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }
} 