<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tourism;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTourismController extends Controller
{
    public function index()
    {
        $tourism = Tourism::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.tourism.index', compact('tourism'));
    }

    public function create()
    {
        return view('admin.tourism.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'facilities' => 'nullable|string',
            'opening_hours_start' => 'required|date_format:H:i',
            'opening_hours_end' => 'required|date_format:H:i|after:opening_hours_start',
            'ticket_price' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tourism', 'public');
        }

        Tourism::create($data);

        return redirect()->route('admin.tourism.index')
            ->with('success', 'Wisata berhasil ditambahkan.');
    }

    public function show(Tourism $tourism)
    {
        return view('admin.tourism.show', compact('tourism'));
    }

    public function edit(Tourism $tourism)
    {
        return view('admin.tourism.edit', compact('tourism'));
    }

    public function update(Request $request, Tourism $tourism)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'facilities' => 'nullable|string',
            'opening_hours_start' => 'required|date_format:H:i',
            'opening_hours_end' => 'required|date_format:H:i|after:opening_hours_start',
            'ticket_price' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($tourism->image) {
                Storage::disk('public')->delete($tourism->image);
            }
            $data['image'] = $request->file('image')->store('tourism', 'public');
        }

        $tourism->update($data);

        return redirect()->route('admin.tourism.index')
            ->with('success', 'Wisata berhasil diperbarui.');
    }

    public function destroy(Tourism $tourism)
    {
        // Delete image if exists
        if ($tourism->image) {
            Storage::disk('public')->delete($tourism->image);
        }

        $tourism->delete();

        return redirect()->route('admin.tourism.index')
            ->with('success', 'Wisata berhasil dihapus.');
    }
} 