<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $buyers = User::role(User::ROLE_USER)->get();
        $products = Product::where('is_active', true)->get();

        for ($i = 0; $i < 25; $i++) {
            $order = Order::factory()->create([
                'user_id' => $buyers->random()->id,
                'status' => Arr::random(Order::STATUSES),
            ]);

            $total = 0;

            foreach ($products->random(random_int(1, 4)) as $product) {
                $qty = random_int(1, 3);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'price' => $product->price,
                ]);

                $total += $qty * $product->price;
            }

            $order->update(['total_amount' => $total]);
        }
    }
}