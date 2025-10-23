<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CapaianPembelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $capaian = [
            ['nama' => "Mengenal bentuk, warna, dan nama tanaman"],
            ['nama' => "Mengenal jenis hewan ternak dan makanannya"],
            ['nama' => "Melatih motorik halus dan kreativitas anak"],
            ['nama' => "Memahami bagian tanaman d manfaatnya"],
            ['nama' => "Menjelaskan kebutuhan dasa hewan ternak"],
            ['nama' => "Mempraktikkan tahapan membuat makanan sehat sederhana"],
            ['nama' => "Menerapkan matematika das dalam konteks pertanian"],
            ['nama' => "Menganalisis siklus hidup dan produktivitas ternak"],
            ['nama' => "Mengembangkan kreativitas d pemahaman estetika pangan"],
            ['nama' => "Menganalisis faktor yang mempengaruhi hasil pertania"],
            ['nama' => "Membuat perencanaan manajemen peternakan skala kecil"],
            ['nama' => "Memahami konsep wirausaha pangan dan pengemasan produk"],
        ];

        foreach ($capaian as $item) {
            \App\Models\CapaianPembelajaran::create($item);
        }
    }
}
