<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Merchant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(MerchantSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
