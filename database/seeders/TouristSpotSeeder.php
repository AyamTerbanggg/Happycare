<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tourism;

class TouristSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spots = [
            ['name' => 'Lawang Sewu', 'city' => 'Semarang'],
            ['name' => 'Kota Lama', 'city' => 'Semarang'],
            ['name' => 'Pantai Menganti', 'city' => 'Kebumen'],
            ['name' => 'Candi Borobudur', 'city' => 'Magelang'],
            ['name' => 'Dieng Plateau', 'city' => 'Wonosobo'],
            ['name' => 'Owabong Waterpark', 'city' => 'Purbalingga'],
            ['name' => 'Karimunjawa', 'city' => 'Jepara'],
            ['name' => 'Keraton Surakarta Hadiningrat', 'city' => 'Surakarta'],
            ['name' => 'Umbul Manten & Umbul Cokro (OMAC)', 'city' => 'Klaten'],
        ];

        foreach ($spots as $spot) {
            Tourism::updateOrCreate(
                ['name' => $spot['name']],
                [
                    'city' => $spot['city'],
                    'description' => 'Deskripsi untuk ' . $spot['name'] . '.',
                    'address' => 'Alamat lengkap untuk ' . $spot['name'] . '.',
                    'category' => 'Populer',
                    'opening_hours_start' => '08:00',
                    'opening_hours_end' => '17:00',
                    'is_active' => true,
                ]
            );
        }
    }
} 