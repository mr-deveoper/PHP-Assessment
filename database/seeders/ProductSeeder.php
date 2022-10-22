<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::factory()->count(50)->create();

        Store::get()->each(function (Store $store) {
            $data = Product::where('merchant_id', $store->merchant_id)->get()->mapWithKeys(fn(Product $product, $index) => [
                $product->id => [
                    'price' => rand(1,99999),
                ],
            ]);
            $store->products()->sync($data);
        });
    }
}
