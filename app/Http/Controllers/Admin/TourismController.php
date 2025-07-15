<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tourism;
use Illuminate\Support\Facades\Storage;

class TourismController extends Controller
{
    public function index()
    {
        $tourisms = Tourism::all();
        return view('admin.tourism.index', compact('tourisms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tourism.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'category' => 'required|string', // tambahkan validasi category
            'description' => 'required|string',
            'price' => 'required|string', // tambahkan validasi price
            'maps_url' => 'nullable|url', // validasi maps_url
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facilities' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tourism_images', 'public');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $idx => $galleryImage) {
                if ($idx >= 4) break; // Maksimal 4 foto
                $galleryPaths[] = $galleryImage->store('tourism_gallery', 'public');
            }
        }

        Tourism::create([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'category' => $request->category, // tambahkan simpan category
            'description' => $request->description,
            'price' => $request->price, // tambahkan simpan price
            'maps_url' => $request->maps_url, // simpan maps_url
            'image' => $imagePath,
            'gallery' => $galleryPaths,
            'facilities' => $request->facilities ? array_map('trim', explode(',', $request->facilities)) : null,
        ]);

        return redirect()->route('admin.tourism.index')->with('success', 'Tourism destination created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // We don't need a separate show view for this simplified CRUD
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tourism = Tourism::findOrFail($id);
        return view('admin.tourism.edit', compact('tourism'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tourism = Tourism::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string', // tambahkan validasi price
            'maps_url' => 'nullable|url', // validasi maps_url
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facilities' => 'nullable|string',
        ];

        $request->validate($rules);

        $imagePath = $tourism->image; // Keep existing image by default

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($tourism->image) {
                Storage::disk('public')->delete($tourism->image);
            }
            $imagePath = $request->file('image')->store('tourism_images', 'public');
            \Log::info('Image updated for tourism ID ' . $tourism->id . ': ' . $imagePath);
        }

        $galleryPaths = $tourism->gallery ?? [];
        if ($request->hasFile('gallery')) {
            // Jika upload baru, replace galeri lama dengan yang baru (maksimal 4 foto)
            $galleryPaths = [];
            foreach ($request->file('gallery') as $idx => $galleryImage) {
                if ($idx >= 4) break;
                $galleryPaths[] = $galleryImage->store('tourism_gallery', 'public');
            }
        }

        $tourism->update([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'description' => $request->description,
            'price' => $request->price, // tambahkan update price
            'maps_url' => $request->maps_url, // simpan maps_url
            'image' => $imagePath,
            'gallery' => $galleryPaths,
            'facilities' => $request->facilities ? array_map('trim', explode(',', $request->facilities)) : null,
        ]);

        return redirect()->route('admin.tourism.index')->with('success', 'Tourism destination updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tourism = Tourism::findOrFail($id);

        // Delete associated image if exists
        if ($tourism->image) {
            Storage::disk('public')->delete($tourism->image);
        }

        $tourism->delete();

        return redirect()->route('admin.tourism.index')->with('success', 'Tourism destination deleted successfully!');
    }

    /**
     * Hapus gambar wisata.
     */
    public function deleteImage($id)
    {
        $tourism = Tourism::findOrFail($id);
        if ($tourism->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($tourism->image);
            $tourism->image = null;
            $tourism->save();
        }
        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }
}
