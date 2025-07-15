<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index(Request $request)
    {
        $query = Hospital::query()->where('is_active', true);

        // Filter by search query
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', $request->input('city'));
        }

        $hospitals = $query->orderBy('rating', 'desc')->paginate(12);

        // Get all unique cities for the filter dropdown
        $cities = Hospital::select('city')->distinct()->orderBy('city')->pluck('city');

        return view('hospitals.index', compact('hospitals', 'cities'));
    }

    public function show(Hospital $hospital)
    {
        // Get related hospitals in the same city, excluding the current one
        $relatedHospitals = Hospital::where('city', $hospital->city)
            ->where('id', '!=', $hospital->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(4)
            ->get();
            
        return view('hospitals.show', compact('hospital', 'relatedHospitals'));
    }
}