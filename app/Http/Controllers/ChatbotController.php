<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Tourism;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function getHospitalsByCity(Request $request)
    {
        $city = $request->query('city');
        if (!$city) {
            return response()->json(['message' => 'Mohon berikan nama kota.'], 400);
        }

        $hospitals = Hospital::byCity($city)->take(3)->get();

        if ($hospitals->isEmpty()) {
            return response()->json(['message' => 'Tidak ditemukan rumah sakit di kota ' . ucfirst($city) . '.', 'link' => route('hospitals.index')]);
        }

        $hospitalList = [];
        foreach ($hospitals as $hospital) {
            $hospitalList[] = '- ' . $hospital->name . ' (Alamat: ' . $hospital->address . ')';
        }
        $responseMessage = 'Beberapa rumah sakit di ' . ucfirst($city) . ':\n' . implode('\n', $hospitalList);
        if (Hospital::byCity($city)->count() > 3) {
            $responseMessage .= '\n...dan lainnya.';
        }

        return response()->json(['message' => $responseMessage, 'link' => route('hospitals.index')]);
    }

    public function getTourismByCity(Request $request)
    {
        $city = $request->query('city');
        if (!$city) {
            return response()->json(['message' => 'Mohon berikan nama kota.'], 400);
        }

        $tourisms = Tourism::byCity($city)->take(3)->get();

        if ($tourisms->isEmpty()) {
            return response()->json(['message' => 'Tidak ditemukan tempat wisata di kota ' . ucfirst($city) . '.', 'link' => route('tourism')]);
        }

        $tourismList = [];
        foreach ($tourisms as $tourism) {
            $tourismList[] = '- ' . $tourism->name . ' (Kategori: ' . $tourism->category . ')';
        }
        $responseMessage = 'Beberapa tempat wisata di ' . ucfirst($city) . ':\n' . implode('\n', $tourismList);
        if (Tourism::byCity($city)->count() > 3) {
            $responseMessage .= '\n...dan lainnya.';
        }

        return response()->json(['message' => $responseMessage, 'link' => route('tourism')]);
    }
} 