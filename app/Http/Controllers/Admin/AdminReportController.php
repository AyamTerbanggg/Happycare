<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Tourism;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function index()
    {
        // Basic statistics
        $stats = [
            'total_users' => User::count(),
            'total_admins' => User::where('is_admin', true)->count(),
            'total_hospitals' => Hospital::count(),
            'active_hospitals' => Hospital::where('is_active', true)->count(),
            'total_tourism' => Tourism::count(),
            'active_tourism' => Tourism::where('is_active', true)->count(),
            'total_contacts' => Contact::count(),
        ];

        // User registration by month (last 6 months)
        $userRegistrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top cities for hospitals
        $topHospitalCities = Hospital::selectRaw('city, COUNT(*) as total')
            ->groupBy('city')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Top cities for tourism
        $topTourismCities = Tourism::selectRaw('city, COUNT(*) as total')
            ->groupBy('city')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Recent contacts
        $recentContacts = Contact::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.reports.index', compact(
            'stats',
            'userRegistrations',
            'topHospitalCities',
            'topTourismCities',
            'recentContacts'
        ));
    }
} 