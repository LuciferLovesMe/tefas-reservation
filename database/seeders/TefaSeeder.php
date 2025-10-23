<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TefaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tefa = [
            [
            "nama" => "Kebun Melon",
            "waktu_panen" => "1, 4, 8, 9, 10, 11, 12"
            ],
            [
            "nama" => "Kebun Bawang Merah",
            "waktu_panen" => "1"
            ],
            [
            "nama" => "Kebun Semangka",
            "waktu_panen" => "3, 9"
            ],
            [
            "nama" => "Kebun Jeruk Siam",
            "waktu_panen" => "6, 7, 8"
            ],
            [
            "nama" => "Kebun Jeruk RGL",
            "waktu_panen" => "6, 7, 8"
            ],
            [
            "nama" => "Kebun Jagung Manis",
            "waktu_panen" => "6"
            ],
            [
            "nama" => "Kebun Kopi",
            "waktu_panen" => "8, 9"
            ]
        ];

        foreach ($tefa as $item) {
            \App\Models\Tefa::create($item);
        }
    }
}
