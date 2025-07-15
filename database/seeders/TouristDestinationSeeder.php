<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TouristDestination;

class TouristDestinationSeeder extends Seeder
{
    public function run()
    {
        $destinations = [
            [
                'name' => 'Candi Borobudur',
                'type' => 'historical',
                'address' => 'Jl. Badrawati, Borobudur, Magelang',
                'city' => 'Magelang',
                'description' => 'Candi Borobudur adalah candi Buddha terbesar di dunia yang dibangun pada abad ke-8.',
                'facilities' => ['Parkir', 'Toilet', 'Musholla', 'Toko Souvenir', 'Restoran'],
                'opening_hours' => '06:00 - 17:00',
                'entrance_fee' => 50000,
                'image_url' => 'https://example.com/borobudur.jpg',
                'latitude' => -7.6079,
                'longitude' => 110.2038,
                'is_active' => true
            ],
            [
                'name' => 'Candi Prambanan',
                'type' => 'historical',
                'address' => 'Jl. Raya Solo - Yogyakarta No.16, Prambanan, Sleman',
                'city' => 'Yogyakarta',
                'description' => 'Candi Prambanan adalah kompleks candi Hindu terbesar di Indonesia yang dibangun pada abad ke-9.',
                'facilities' => ['Parkir', 'Toilet', 'Musholla', 'Toko Souvenir', 'Restoran', 'Museum'],
                'opening_hours' => '06:00 - 17:00',
                'entrance_fee' => 50000,
                'image_url' => 'https://example.com/prambanan.jpg',
                'latitude' => -7.7520,
                'longitude' => 110.4915,
                'is_active' => true
            ],
            [
                'name' => 'Lawang Sewu',
                'type' => 'historical',
                'address' => 'Jl. Pemuda, Sekayu, Semarang',
                'city' => 'Semarang',
                'description' => 'Lawang Sewu adalah gedung bersejarah peninggalan Belanda yang terkenal dengan seribu pintunya.',
                'facilities' => ['Parkir', 'Toilet', 'Museum', 'Toko Souvenir', 'Cafe'],
                'opening_hours' => '07:00 - 21:00',
                'entrance_fee' => 30000,
                'image_url' => 'https://example.com/lawangsewu.jpg',
                'latitude' => -6.9833,
                'longitude' => 110.4083,
                'is_active' => true
            ],
            [
                'name' => 'Pantai Marina',
                'type' => 'beach',
                'address' => 'Jl. Marina, Semarang',
                'city' => 'Semarang',
                'description' => 'Pantai Marina adalah pantai yang terkenal dengan sunset dan kuliner seafoodnya.',
                'facilities' => ['Parkir', 'Toilet', 'Musholla', 'Warung Makan', 'Tempat Camping'],
                'opening_hours' => '24 jam',
                'entrance_fee' => 10000,
                'image_url' => 'https://example.com/marina.jpg',
                'latitude' => -6.9666,
                'longitude' => 110.4167,
                'is_active' => true
            ]
        ];

        foreach ($destinations as $destination) {
            TouristDestination::create($destination);
        }
    }
} 