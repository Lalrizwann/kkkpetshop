<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $data = [
        ['nama_layanan' => 'Home Care', 'harga' => 150000],
        ['nama_layanan' => 'Pet Grooming', 'harga' => 100000],
        ['nama_layanan' => 'Pet Training', 'harga' => 200000],
        ['nama_layanan' => 'Pet Hotel', 'harga' => 120000],
    ];

    foreach ($data as $val) {
        \App\Models\Service::create($val);
    }
}
}
