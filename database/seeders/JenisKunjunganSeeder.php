<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            ['nama' => "Observasi tanaman"],
            ['nama' => "Memberi makan ternak"],
            ['nama' => "Menghias roti"],
            ['nama' => "Petik buah atau sayur"],
            ['nama' => "Mengenal habitat hewan ternak"],
            ['nama' => "Membuat burger sederhana"],
            ['nama' => "Menghitung hasil panen"],
            ['nama' => "Mengamati siklus pertumbuhan ternak"],
            ['nama' => "Merancang bentuk roti"],
            ['nama' => "Analisis produktivitas tanaman"],
            ['nama' => "Simulasi manajemen ternak"],
            ['nama' => "Produksi dan pengemasan"],
        ];

        foreach ($jenis as $item) {
            \App\Models\JenisKunjungan::create($item);
        }
    }
}
