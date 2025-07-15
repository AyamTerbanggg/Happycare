<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredHospitals = [
            [
                'id' => 1,
                'name' => 'RSUP Dr. Kariadi',
                'location' => 'Semarang',
                'image' => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?w=400',
                'rating' => 4.8,
                'specialties' => ['Jantung', 'Neurologi', 'Onkologi']
            ],
            [
                'id' => 2,
                'name' => 'RS Bethesda Yogyakarta',
                'location' => 'Yogyakarta',
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=400',
                'rating' => 4.7,
                'specialties' => ['Bedah', 'Anak', 'Kandungan']
            ],
            [
                'id' => 3,
                'name' => 'RSUD Prof. Dr. Margono',
                'location' => 'Purwokerto',
                'image' => 'https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=400',
                'rating' => 4.6,
                'specialties' => ['Mata', 'THT', 'Kulit']
            ]
        ];

        // Ambil 3 wisata terbaru dari database
        $featuredTourism = \App\Models\Tourism::orderBy('created_at', 'desc')->take(3)->get();

        return view('home', compact('featuredHospitals', 'featuredTourism'));

    }
}