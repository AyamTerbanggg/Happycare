<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Since contacts are created from the public side, this method is not typically needed in admin.
        abort(404); // Or redirect to index
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Since contacts are created from the public side, this method is not typically needed in admin.
        abort(404); // Or redirect to index
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // We are using the show method for viewing and replying, so edit form is not needed separately.
        // If you need a dedicated edit form for other fields, you can implement it here.
        abort(404); // Or redirect to show
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'reply' => 'required|string',
            'status' => 'required|in:pending,replied',
        ]);

        $contact->update([
            'reply' => $request->reply,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.contacts.index')->with('success', 'Contact updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact deleted successfully!');
    }
}
