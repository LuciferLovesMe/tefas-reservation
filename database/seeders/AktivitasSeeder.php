<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aktivitas = [
            ['nama' => "Pertanian"],
            ['nama' => "Peternakan"],
            ['nama' => "Pengolahan Pangan"],
        ];

        foreach ($aktivitas as $item) {
            \App\Models\Aktivitas::create($item);
        }
    }
}
