<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHospitalController extends Controller
{
    public function index(Request $request)
    {
        $query = Hospital::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->has('status')) {
            $query->where('is_active', $request->status);
        }

        $hospitals = $query->orderBy('created_at', 'desc')->paginate(15);
        $cities = Hospital::distinct()->pluck('city')->sort();

        return view('admin.hospitals.index', compact('hospitals', 'cities'));
    }

    public function create()
    {
        return view('admin.hospitals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:100',
            'opening_hours_start' => 'required|date_format:H:i',
            'opening_hours_end' => 'required|date_format:H:i|after:opening_hours_start',
            'emergency_service' => 'boolean',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['emergency_service'] = $request->has('emergency_service');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hospitals', 'public');
        }

        Hospital::create($data);

        return redirect()->route('admin.hospitals.index')
            ->with('success', 'Rumah sakit berhasil ditambahkan.');
    }

    public function show(Hospital $hospital)
    {
        return view('admin.hospitals.show', compact('hospital'));
    }

    public function edit(Hospital $hospital)
    {
        return view('admin.hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:100',
            'opening_hours_start' => 'required|date_format:H:i',
            'opening_hours_end' => 'required|date_format:H:i|after:opening_hours_start',
            'emergency_service' => 'boolean',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['emergency_service'] = $request->has('emergency_service');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($hospital->image) {
                Storage::disk('public')->delete($hospital->image);
            }
            $data['image'] = $request->file('image')->store('hospitals', 'public');
        }

        $hospital->update($data);

        return redirect()->route('admin.hospitals.index')
            ->with('success', 'Rumah sakit berhasil diperbarui.');
    }

    public function destroy(Hospital $hospital)
    {
        // Delete image if exists
        if ($hospital->image) {
            Storage::disk('public')->delete($hospital->image);
        }

        $hospital->delete();

        return redirect()->route('admin.hospitals.index')
            ->with('success', 'Rumah sakit berhasil dihapus.');
    }

    public function deleteMultiple(Request $request)
    {
        $request->validate([
            'hospital_names' => 'required|array',
            'hospital_names.*' => 'string|max:255',
        ]);

        $namesToDelete = $request->input('hospital_names');

        foreach ($namesToDelete as $name) {
            $hospital = Hospital::where('name', $name)->first();
            if ($hospital) {
                if ($hospital->image) {
                    Storage::disk('public')->delete($hospital->image);
                }
                $hospital->delete();
            }
        }

        return redirect()->route('admin.hospitals.index')
            ->with('success', 'Selected hospitals have been deleted.');
    }
}