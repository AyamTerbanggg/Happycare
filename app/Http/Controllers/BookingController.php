<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hospital;
use App\Models\Tourism;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['hospital', 'tourism'])
            ->orderBy('booking_date', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function bookHospital(Request $request, $id)
    {
        $request->validate([
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required',
            'specialty' => 'required|string',
            'notes' => 'nullable|string|max:500'
        ]);

        $hospital = Hospital::findOrFail($id);

        // Check if user already has booking on same date and time
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('hospital_id', $id)
            ->where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'Anda sudah memiliki janji pada tanggal dan waktu tersebut.');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'hospital_id' => $id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'specialty' => $request->specialty,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Janji temu berhasil dibuat! Kami akan menghubungi Anda untuk konfirmasi.');
    }

    public function bookTourism(Request $request, $id)
    {
        $request->validate([
            'booking_date' => 'required|date|after:today',
            'total_person' => 'required|integer|min:1|max:50',
            'notes' => 'nullable|string|max:500'
        ]);

        $tourism = Tourism::findOrFail($id);
        $totalPrice = ($tourism->entrance_fee ?? 0) * $request->total_person;

        Booking::create([
            'user_id' => Auth::id(),
            'tourism_id' => $id,
            'booking_date' => $request->booking_date,
            'notes' => $request->notes,
            'status' => 'pending',
            'total_price' => $totalPrice
        ]);

        return back()->with('success', 'Booking wisata berhasil dibuat! Total biaya: Rp ' . number_format($totalPrice, 0, ',', '.'));
    }

    public function cancel($id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);
        
        if ($booking->status === 'completed') {
            return back()->with('error', 'Booking yang sudah selesai tidak dapat dibatalkan.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }

    public function show($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->with(['hospital', 'tourism'])
            ->findOrFail($id);

        return view('bookings.show', compact('booking'));
    }
}