<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $page->update($request->only('title', 'content'));
        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }
} 