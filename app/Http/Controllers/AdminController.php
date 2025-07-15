<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hospital;
use App\Models\Tourism;
use App\Models\Contact;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $hospitalCount = Hospital::count();
        $tourismCount = Tourism::count();
        $contactCount = Contact::count();

        // Simple stats array
        $stats = [
            'users' => $userCount,
            'hospitals' => $hospitalCount,
            'tourism' => $tourismCount,
            'contacts' => $contactCount
        ];

        return view('admin.dashboard', compact('userCount', 'hospitalCount', 'tourismCount', 'contactCount', 'stats'));
    }
}