<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('hospitals')->truncate();
        Schema::enableForeignKeyConstraints();

        $hospitalsData = [
            // Semarang
            ['name' => 'RS Kariadi Semarang', 'city' => 'Semarang', 'rating' => 4.8, 'address' => 'Jl. Dr. Sutomo No.16, Randusari', 'image' => 'hospitals/RS_Kariadi_Semarang.jpg.webp'],
            ['name' => 'RS Telogorejo Semarang', 'city' => 'Semarang', 'rating' => 4.6, 'address' => 'Jl. KH. Ahmad Dahlan, Pekunden', 'image' => 'hospitals/RS_Telogorejo_Semarang.jpg.webp'],
            ['name' => 'RS Panti Wilasa Citarum', 'city' => 'Semarang', 'rating' => 4.5, 'address' => 'Jl. Citarum No.98, Bugangan', 'image' => 'hospitals/RS_Panti_Wilasa_Citarum.jpg.webp'],
            ['name' => 'RS Hermina Pandanaran', 'city' => 'Semarang', 'rating' => 4.4, 'address' => 'Jl. Pandanaran No.24, Pekunden', 'image' => 'hospitals/RS_Hermina_Pandanaran.jpg.webp'],
            ['name' => 'RS Roemani Semarang', 'city' => 'Semarang', 'rating' => 4.3, 'address' => 'Jl. Wonodri Baru Raya, Wonodri', 'image' => 'hospitals/RS_Roemani_Semarang.jpg.webp'],
            ['name' => 'RS Columbia Asia Semarang', 'city' => 'Semarang', 'rating' => 4.4, 'address' => 'Jl. Siliwangi No.143, Kalibanteng Kulon', 'image' => 'hospitals/RS_Columbia_Asia_Semarang.jpg.webp'],
            ['name' => 'RS Ken Saras', 'city' => 'Semarang', 'rating' => 4.2, 'address' => 'Jl. Soekarno Hatta, Bergas, Kab. Semarang', 'image' => 'hospitals/RS_Ken_Saras.jpg.webp'],
            ['name' => 'RS Nasional Diponegoro', 'city' => 'Semarang', 'rating' => 4.3, 'address' => 'Jl. Prof. Soedarto, Tembalang', 'image' => 'hospitals/RS_Nasional_Diponegoro.jpg.webp'],
            ['name' => 'RS Bhayangkara Semarang', 'city' => 'Semarang', 'rating' => 4.1, 'address' => 'Jl. Majapahit No.140, Gayamsari', 'image' => 'hospitals/RS_Bhayangkara_Semarang.jpg.webp'],

            // Kebumen
            ['name' => 'Klinik Pratama Ayodya', 'city' => 'Kebumen', 'rating' => 3.7, 'address' => 'Jl. Ayah - Karangbolong', 'image' => 'hospitals/placeholder_klinik_ayodya.jpg'],
            ['name' => 'RSUD Kebumen', 'city' => 'Kebumen', 'rating' => 4.2, 'address' => 'Jl. HM Sarbini No.135, Bumirejo', 'image' => 'hospitals/RSUD Kebumen.jpg.webp'],
            ['name' => 'RS PKU Muhammadiyah Kebumen', 'city' => 'Kebumen', 'rating' => 4.0, 'address' => 'Jl. Pahlawan No.193', 'image' => 'hospitals/RS_PKU_Muhammadiyah_Kebumen.jpg'],
            ['name' => 'RS Anna Medika Kebumen', 'city' => 'Kebumen', 'rating' => 3.9, 'address' => 'Jl. Raya Sruweng', 'image' => 'hospitals/RS_Anna_Medika_Kebumen.jpg'],
            ['name' => 'RS Permata Bunda Kebumen', 'city' => 'Kebumen', 'rating' => 3.8, 'address' => 'Jl. Indrakila No. 25', 'image' => 'hospitals/RS_Permata_Bunda_Kebumen.jpg'],
            ['name' => 'Puskesmas Ayah', 'city' => 'Kebumen', 'rating' => 3.6, 'address' => 'Jl. Raya Ayah', 'image' => 'hospitals/placeholder_puskesmas_ayah.jpg'],

            // Magelang
            ['name' => 'Klinik Borobudur Medical Center', 'city' => 'Magelang', 'rating' => 3.8, 'address' => 'Jl. Syailendra Raya, Borobudur', 'image' => 'hospitals/Klinik_Borobudur_Medical_Center.jpg'],
            ['name' => 'RSUD Tidar Magelang', 'city' => 'Magelang', 'rating' => 4.3, 'address' => 'Jl. Tidar No.30A, Kemirirejo', 'image' => 'hospitals/RSUD_Tidar_Magelang.jpg.webp'],
            ['name' => 'RS Bhayangkara Magelang', 'city' => 'Magelang', 'rating' => 4.1, 'address' => 'Jl. Pahlawan No.81', 'image' => 'hospitals/RS_Bhayangkara_Magelang.jpg'],
            ['name' => 'RS PKU Muhammadiyah Magelang', 'city' => 'Magelang', 'rating' => 4.0, 'address' => 'Jl. Tentara Pelajar', 'image' => 'hospitals/RS_PKU_Muhammadiyah_Magelang.jpeg'],
            ['name' => 'RS Permata Hati Magelang', 'city' => 'Magelang', 'rating' => 3.9, 'address' => 'Jl. Urip Sumoharjo', 'image' => 'hospitals/RS_Permata_Hati.jpg'],
            ['name' => 'RS Magelang Medical Center', 'city' => 'Magelang', 'rating' => 3.8, 'address' => 'Jl. Pahlawan', 'image' => 'hospitals/RS_Magelang_Medical_Center.jpg'],

            // Wonosobo
            ['name' => 'Puskesmas Dieng', 'city' => 'Wonosobo', 'rating' => 3.5, 'address' => 'Kawasan Wisata Dieng', 'image' => 'hospitals/placeholder_puskesmas_dieng.jpg'],
            ['name' => 'Klinik Pratama Dieng Sehat', 'city' => 'Wonosobo', 'rating' => 3.6, 'address' => 'Jl. Raya Dieng', 'image' => 'hospitals/Klinik_Pratama_Dieng.jpg'],
            ['name' => 'RSUD Setjonegoro Wonosobo', 'city' => 'Wonosobo', 'rating' => 4.1, 'address' => 'Jl. Setjonegoro No.1', 'image' => 'hospitals/RSUD_setjonegoro_wonosobo.jpg.webp'],
            ['name' => 'RS PKU Muhammadiyah Wonosobo', 'city' => 'Wonosobo', 'rating' => 3.9, 'address' => 'Jl. Gatot Subroto', 'image' => 'hospitals/RS_PKU_Muhammdiyah_wonosobo.jpg.webp'],
            ['name' => 'RS Kristen Ngesti Waluyo', 'city' => 'Wonosobo', 'rating' => 3.8, 'address' => 'Parakan, Temanggung (dekat Wonosobo)', 'image' => 'hospitals/RS_Kriste_Ngesti_Waluyo.jpg.webp'],
            ['name' => 'Puskesmas Kejajar', 'city' => 'Wonosobo', 'rating' => 3.4, 'address' => 'Jl. Raya Dieng Km. 10', 'image' => 'hospitals/placeholder_puskesmas_kejajar.jpg'],

            // Purbalingga & Purwokerto
            ['name' => 'Klinik Owabong Medical', 'city' => 'Purbalingga', 'rating' => 3.7, 'address' => 'Komplek Owabong', 'image' => 'hospitals/Klinik_Owabong.jpg'],
            ['name' => 'RSUD Prof. Dr. Margono Soekarjo', 'city' => 'Purwokerto', 'rating' => 4.5, 'address' => 'Jl. Dr. Gumbreg No.1', 'image' => 'hospitals/RSUD_Prof.Dr.Margono_Soekarjo_Purwokerto.jpg'],
            ['name' => 'RS Hermina Purwokerto', 'city' => 'Purwokerto', 'rating' => 4.3, 'address' => 'Jl. Yos Sudarso', 'image' => 'hospitals/RS_Hermina_Purwokerto.jpg'],
            ['name' => 'RS Ananda Purwokerto', 'city' => 'Purwokerto', 'rating' => 4.1, 'address' => 'Jl. Pemuda No.30', 'image' => 'hospitals/RS_Ananda_Purwokerto.jpg'],
            ['name' => 'RSUD Purbalingga', 'city' => 'Purbalingga', 'rating' => 4.0, 'address' => 'Jl. Tentara Pelajar', 'image' => 'hospitals/RSUD Purbalingga.jpg'],
            ['name' => 'RS Wijaya Kusuma Purwokerto', 'city' => 'Purwokerto', 'rating' => 3.9, 'address' => 'Jl. Jend. Soedirman', 'image' => 'hospitals/RS_Wijaya_Kusuma_Purwokerto.jpg.webp'],

            // Jepara
            ['name' => 'Klinik Bahari Karimunjawa', 'city' => 'Jepara', 'rating' => 3.6, 'address' => 'Karimunjawa', 'image' => 'hospitals/Klinik_Bahari.jpg'],
            ['name' => 'Puskesmas Karimunjawa', 'city' => 'Jepara', 'rating' => 3.8, 'address' => 'Karimunjawa', 'image' => 'hospitals/placeholder_puskesmas_karimunjawa.jpg'],
            ['name' => 'Pos Kesehatan Kemujan', 'city' => 'Jepara', 'rating' => 3.4, 'address' => 'Pulau Kemujan, Karimunjawa', 'image' => 'hospitals/Pos_kesehatan_kemujan.jpg'],
            ['name' => 'RSUD RA Kartini Jepara', 'city' => 'Jepara', 'rating' => 4.2, 'address' => 'Jl. Aipda Tubun No.1, Bapangan', 'image' => 'hospitals/RSUD_R.A_Kartini_Jepara.jpg.webp'],
            ['name' => 'RS Aisyiyah Jepara', 'city' => 'Jepara', 'rating' => 4.0, 'address' => 'Jl. Kolonel Sugiono', 'image' => 'hospitals/RS_Aisyiyah_Jepara.jpg.webp'],
            ['name' => 'RS Mitra Husada Jepara', 'city' => 'Jepara', 'rating' => 3.9, 'address' => 'Jl. MT Haryono', 'image' => 'hospitals/RS_Mitra_Husada_Jepara.jpg.webp'],

            // Solo
            ['name' => 'RSUD Dr. Moewardi Solo', 'city' => 'Solo', 'rating' => 4.7, 'address' => 'Jl. Kolonel Sutarto No.132, Jebres', 'image' => 'hospitals/w4BRQrY3DRwClrf7035bdh74PMWJ4QBev0dqNmQx.png'],
            ['name' => 'RS Kasih Ibu Solo', 'city' => 'Solo', 'rating' => 4.3, 'address' => 'Jl. Slamet Riyadi No.404', 'image' => 'hospitals/RS_Kasih_Ibu.jpg.webp'],
            ['name' => 'RS Hermina Solo', 'city' => 'Solo', 'rating' => 4.4, 'address' => 'Jl. Kolonel Sutarto No.16, Jebres', 'image' => 'hospitals/RS_Hermina_Solo.jpg.webp'],
            ['name' => 'RS Panti Kosala Solo', 'city' => 'Solo', 'rating' => 4.2, 'address' => 'Jl. Dr. Wahidin No. 32', 'image' => 'hospitals/RS_Panti_Kosala_Solo.jpg'],
            ['name' => 'RS Dr. Oen Solo Baru', 'city' => 'Solo', 'rating' => 4.6, 'address' => 'Kawasan Terpadu The Park, Jl. Ir. Soekarno', 'image' => 'hospitals/placeholder_rs_oen_solo_baru.jpg'],
            ['name' => 'RS Brayat Minulya Solo', 'city' => 'Solo', 'rating' => 4.1, 'address' => 'Jl. Setiabudi No.106', 'image' => 'hospitals/RS_Brayat_Minulya_Solo.jpg.webp'],

            // Klaten
            ['name' => 'Klinik Pratama OMAC', 'city' => 'Klaten', 'rating' => 3.5, 'address' => 'Area Umbul Cokro', 'image' => 'hospitals/Klinik_Pratama_OMAC.jpg'],
            ['name' => 'Puskesmas Tulung', 'city' => 'Klaten', 'rating' => 3.6, 'address' => 'Jl. Raya Tulung', 'image' => 'hospitals/placeholder_puskesmas_tulung.jpg'],
            ['name' => 'RSUD Klaten', 'city' => 'Klaten', 'rating' => 4.0, 'address' => 'Jl. Ir. Soekarno-Hatta', 'image' => 'hospitals/RSUD_Klaten.jpg.webp'],
            ['name' => 'RS Bethesda Klaten', 'city' => 'Klaten', 'rating' => 3.9, 'address' => 'Jl. Pramuka No.10', 'image' => 'hospitals/RS_Bethesda_Klaten.jpg'],
            ['name' => 'RSUD Dr. Sayidiman Magetan', 'city' => 'Klaten', 'rating' => 4.1, 'address' => 'Jl. Pahlawan, Magetan (data anomali, dimasukkan ke Klaten)', 'image' => 'hospitals/RSUD_Dr._Sayidiman_Magetan.jpg.webp'],
            ['name' => 'RS PKU Muhammadiyah Klaten', 'city' => 'Klaten', 'rating' => 3.8, 'address' => 'Jl. Raya Klaten-Solo', 'image' => 'hospitals/RS_PKU_Muhammadiyah_Klaten.png'],
        ];

        $uniqueHospitals = [];
        foreach ($hospitalsData as $hospital) {
            $uniqueHospitals[$hospital['name']] = $hospital;
        }

        $hospitalsToInsert = [];
        foreach (array_values($uniqueHospitals) as $hospital) {
            $hospitalsToInsert[] = array_merge($hospital, [
                'description' => 'Informasi detail untuk ' . $hospital['name'] . ' belum tersedia.',
                'phone' => 'N/A',
                'email' => 'N/A',
                'website' => 'https://www.example.com',
                'facilities' => json_encode(['Dasar']),
                'opening_hours_start' => '08:00',
                'opening_hours_end' => '17:00',
                'emergency_service' => false,
                'latitude' => 0,
                'longitude' => 0,
                'image' => $hospital['image'] ?? null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('hospitals')->insert($hospitalsToInsert);
    }
}