<?php

namespace App\Http\Controllers;

use App\Models\Tourism;
use Illuminate\Http\Request;

class TourismController extends Controller
{
    public function index(Request $request)
    {
        $query = Tourism::active();

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kota
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sorting
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');
        
        if (in_array($sortBy, ['name', 'rating', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $tourism = $query->paginate(12);
        
        // Data untuk filter dropdown
        $cities = Tourism::active()->distinct()->pluck('city')->sort();
        $categories = Tourism::active()->distinct()->pluck('category')->sort();

        return view('tourism.index', compact('tourism', 'cities', 'categories'));
    }

    public function show($id)
    {
        $tourism = Tourism::active()->findOrFail($id);
        
        // Destinasi wisata terkait (kategori sama, kecuali yang sedang dilihat)
        $relatedTourism = Tourism::active()
            ->where('category', $tourism->category)
            ->where('id', '!=', $tourism->id)
            ->take(4)
            ->get();

        return view('tourism.show', compact('tourism', 'relatedTourism'));
    }
}