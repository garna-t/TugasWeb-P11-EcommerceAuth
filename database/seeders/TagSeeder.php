<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Terlaris',
            'Diskon',
            'Baru',
            'Premium',
            'Hemat',
            'Ramah Lingkungan',
            'Garansi Resmi',
            'Pre-Order',
            'Stok Terbatas',
            'Rekomendasi',
        ];

        foreach ($tags as $name) {
            Tag::factory()->create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
