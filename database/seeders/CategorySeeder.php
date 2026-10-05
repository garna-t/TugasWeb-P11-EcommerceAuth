<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Elektronik' => 'Gadget dan perangkat elektronik harian.',
            'Fashion Pria' => 'Pakaian dan aksesori untuk pria.',
            'Fashion Wanita' => 'Pakaian dan aksesori untuk wanita.',
            'Rumah Tangga' => 'Perlengkapan dapur dan rumah.',
            'Olahraga' => 'Peralatan olahraga dan kebugaran.',
            'Buku dan Alat Tulis' => 'Buku, alat tulis, dan perlengkapan belajar.',
            'Kesehatan dan Kecantikan' => 'Perawatan diri dan kesehatan.',
            'Makanan dan Minuman' => 'Makanan ringan, kopi, teh, dan bahan pangan.',
        ];

        foreach ($categories as $name => $description) {
            Category::factory()->create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
            ]);
        }
    }
}
