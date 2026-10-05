<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = [
            'Elektronik' => [
                ['Smartphone Android 6/128GB', 2899000],
                ['Earbuds Bluetooth TWS', 249000],
                ['Power Bank 20000mAh', 329000],
                ['Smartwatch Fitness Band', 459000],
                ['Speaker Bluetooth Portable', 399000],
                ['Keyboard Mekanikal 75 Persen', 649000],
                ['Mouse Wireless Ergonomis', 179000],
            ],
            'Fashion Pria' => [
                ['Kemeja Flanel Lengan Panjang', 189000],
                ['Kaos Polos Cotton Combed 30s', 79000],
                ['Celana Chino Slim Fit', 259000],
                ['Jaket Bomber Waterproof', 349000],
                ['Sepatu Sneakers Kanvas', 299000],
                ['Topi Baseball Polos', 69000],
                ['Ikat Pinggang Kulit Asli', 159000],
            ],
            'Fashion Wanita' => [
                ['Dress Midi Floral', 229000],
                ['Blouse Linen Lengan Panjang', 169000],
                ['Hijab Pashmina Ceruty', 59000],
                ['Rok Plisket Panjang', 119000],
                ['Tas Selempang Kulit Sintetis', 249000],
                ['Cardigan Rajut Oversize', 179000],
                ['Sandal Wedges Nyaman', 139000],
            ],
            'Rumah Tangga' => [
                ['Rice Cooker 1.8 Liter', 459000],
                ['Set Panci Anti Lengket 5 Pcs', 389000],
                ['Blender Kaca 1.5 Liter', 329000],
                ['Lampu LED Meja Belajar', 119000],
                ['Vacuum Cleaner Genggam Nirkabel', 549000],
                ['Set Sprei Katun 160x200', 249000],
                ['Dispenser Air Galon Bawah', 899000],
            ],
            'Olahraga' => [
                ['Matras Yoga Anti Slip 6mm', 129000],
                ['Dumbbell Set Adjustable 10kg', 349000],
                ['Sepatu Lari Ringan', 479000],
                ['Raket Badminton Karbon', 289000],
                ['Botol Minum Stainless 750ml', 99000],
                ['Tas Gym Duffel Waterproof', 199000],
                ['Skipping Rope Speed', 59000],
            ],
            'Buku dan Alat Tulis' => [
                ['Buku Pemrograman Web Laravel Praktis', 135000],
                ['Buku Catatan Hardcover A5', 45000],
                ['Pulpen Gel 0.5mm Isi 12 Pcs', 39000],
                ['Set Spidol Warna 24 Warna', 85000],
                ['Kalkulator Ilmiah 240 Fungsi', 169000],
                ['Map Plastik Dokumen Isi 10 Pcs', 29000],
                ['Kertas HVS A4 80gsm 1 Rim', 55000],
            ],
            'Kesehatan dan Kecantikan' => [
                ['Serum Vitamin C 20ml', 129000],
                ['Pelembap Wajah SPF 30', 99000],
                ['Sabun Cuci Muka Gentle', 49000],
                ['Masker Medis 3 Ply Isi 50', 35000],
                ['Vitamin D3 1000 IU 60 Kapsul', 119000],
                ['Termometer Digital Infrared', 189000],
                ['Hand Sanitizer 500ml', 39000],
            ],
            'Makanan dan Minuman' => [
                ['Kopi Arabika Gayo 250g', 89000],
                ['Teh Hijau Organik 20 Kantong', 45000],
                ['Madu Hutan Murni 500ml', 119000],
                ['Keripik Tempe Original 200g', 29000],
                ['Granola Oat Madu 300g', 59000],
                ['Minyak Zaitun Extra Virgin 500ml', 139000],
                ['Cokelat Hitam 70 Persen 100g', 42000],
            ],
        ];

        $owners = User::orderBy('id')->get();
        $tagIds = Tag::pluck('id')->all();
        $index = 0;

        foreach ($catalog as $categoryName => $items) {
            $category = Category::where('name', $categoryName)->firstOrFail();

            foreach ($items as [$name, $price]) {
                $owner = $owners[$index % $owners->count()];

                $product = Product::factory()->create([
                    'category_id' => $category->id,
                    'user_id' => $owner->id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $name.' dengan kualitas terjamin, cocok untuk kebutuhan sehari-hari.',
                    'price' => $price,
                    'stock' => random_int(5, 200),
                    'is_active' => $index % 10 !== 9,
                ]);

                $product->tags()->attach(Arr::random($tagIds, random_int(1, 3)));

                $index++;
            }
        }
    }
}
