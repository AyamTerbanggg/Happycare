<?php

namespace App\Services;

use App\Models\Hospital;
use App\Models\Tourism;

class ChatbotService
{
    public function getInitialGreeting()
    {
        return [
            'type' => 'bot',
            'message' => 'Halo! Saya HappyCare Assistant. Ada yang bisa saya bantu? Coba tanyakan \'rumah sakit di Semarang\' atau \'wisata di Bandung\'.'
        ];
    }

    public function processMessage(string $message)
    {
        $lowerMessage = strtolower($message);

        if (str_contains($lowerMessage, 'rumah sakit')) {
            return $this->handleHospitalQuery($lowerMessage);
        } elseif (str_contains($lowerMessage, 'wisata') || str_contains($lowerMessage, 'destinasi')) {
            return $this->handleTourismQuery($lowerMessage);
        } else {
            return [
                'type' => 'bot',
                'message' => 'Maaf, saya tidak mengerti. Anda bisa mencoba bertanya tentang \'rumah sakit\' atau \'destinasi wisata\'.'
            ];
        }
    }

    protected function handleHospitalQuery(string $message)
    {
        $city = $this->extractCity($message);

        if ($city) {
            $hospitals = Hospital::where('city', 'like', '%' . $city . '%')->limit(3)->get();
            if ($hospitals->isEmpty()) {
                return [
                    'type' => 'bot',
                    'message' => 'Maaf, tidak ditemukan rumah sakit di ' . ucfirst($city) . '.'
                ];
            }
            return [
                'type' => 'hospital_list',
                'message' => 'Berikut adalah beberapa rumah sakit di ' . ucfirst($city) . ':',
                'data' => $hospitals->map(function($hospital) {
                    return [
                        'name' => $hospital->name,
                        'address' => $hospital->address,
                        'phone' => $hospital->phone,
                        'rating' => $hospital->rating,
                        'emergency' => $hospital->emergency_service ? 'Ya' : 'Tidak',
                        'image' => $hospital->image_url,
                        'url' => route('hospitals.show', $hospital->id)
                    ];
                })
            ];
        } else {
            return [
                'type' => 'bot',
                'message' => 'Untuk mencari rumah sakit, mohon sebutkan nama kota. Contoh: \'rumah sakit di Jakarta\'.'
            ];
        }
    }

    protected function handleTourismQuery(string $message)
    {
        $city = $this->extractCity($message);

        if ($city) {
            $tourism = Tourism::where('city', 'like', '%' . $city . '%')->limit(3)->get();
            if ($tourism->isEmpty()) {
                return [
                    'type' => 'bot',
                    'message' => 'Maaf, tidak ditemukan destinasi wisata di ' . ucfirst($city) . '.'
                ];
            }
            return [
                'type' => 'tourism_list',
                'message' => 'Berikut adalah beberapa destinasi wisata di ' . ucfirst($city) . ':',
                'data' => $tourism->map(function($item) {
                    return [
                        'name' => $item->name,
                        'location' => $item->address . ', ' . $item->city,
                        'category' => $item->type,
                        'rating' => null, 
                        'price' => $item->entrance_fee,
                        'image' => $item->image_url,
                        'url' => route('tourism.show', $item->id)
                    ];
                })
            ];
        } else {
            return [
                'type' => 'bot',
                'message' => 'Untuk mencari destinasi wisata, mohon sebutkan nama kota. Contoh: \'wisata di Yogyakarta\'.'
            ];
        }
    }

    protected function extractCity(string $message)
    {
        $cities = ['semarang', 'bandung', 'jakarta', 'yogyakarta', 'surabaya', 'malang', 'solo', 'bali']; // Tambahkan kota lain jika perlu
        foreach ($cities as $city) {
            if (str_contains($message, $city)) {
                return $city;
            }
        }
        return null;
    }
} 