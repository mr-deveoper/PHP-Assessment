<?php

namespace Tests\Feature;

use App\Models\Merchant;
use App\Models\Product;
use App\Models\Store;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function testGetProducts()
    {
        $merchant = Merchant::factory()->create();

        $stores = Store::factory()->count(3)->create(['merchant_id' => $merchant->id]);

        $product = Product::factory()->create(['merchant_id' => $merchant->id]);

        foreach ($stores as $store) {
            $store->products()->sync([
                $product->id => [
                    'price' => rand(1, 99999),
                ],
            ]);
        }

        $res = $this->get('api/products');

        $res->assertJsonStructure([
            'data' => [
                [
                    "id",
                    "title",
                    "description",
                    "stores",
                ],
            ],
        ]);

        $res->assertStatus(200);
    }

    public function testShowProduct()
    {
        $merchant = Merchant::factory()->create();

        $stores = Store::factory()->count(3)->create(['merchant_id' => $merchant->id]);

        $product = Product::factory()->create(['merchant_id' => $merchant->id]);

        foreach ($stores as $store) {
            $store->products()->sync([
                $product->id => [
                    'price' => rand(1, 99999),
                ],
            ]);
        }

        $res = $this->get("/api/products/" . $product->id);

        $res->assertJsonStructure([
            'data' => [
                "id",
                "title",
                "description",
                "stores",
                "merchant",
            ],
        ]);

        $res->assertStatus(200);
    }

    public function testCreateProduct()
    {
        $merchant = Merchant::factory()->create();

        $stores = Store::factory()->count(3)->create(['merchant_id' => $merchant->id])->keyBy('id')->toArray();

        $storesPrices = array_map(
            function ($element) {
                return array_merge($element, ['price' => rand(100, 99999)]);;
            },
            $stores
        );

        $product = Product::factory()->make(['merchant_id' => $merchant->id, 'stores' => $storesPrices])->getAttributes();

        $res = $this->post('api/products', $product);

        $this->assertDatabaseHas('products', [
            'id'          => $res['data']['id'],
            'merchant_id' => $merchant->id,
        ]);

        $res->assertStatus(201);
    }

    public function testUpdateProduct()
    {
        $merchant = Merchant::factory()->create();

        $stores = Store::factory()->count(3)->create(['merchant_id' => $merchant->id])->keyBy('id')->toArray();

        $storesPrices = array_map(
            function ($element) {
                return array_merge($element, ['price' => rand(100, 99999)]);;
            },
            $stores
        );

        $product = Product::factory()->create(['merchant_id' => $merchant->id]);

        $updatedProduct = Product::factory()->make(['merchant_id' => $merchant->id, 'stores' => $storesPrices])->getAttributes();

        $res = $this->put('api/products/' . $product->id, $updatedProduct);

        $this->assertDatabaseHas('products', [
            'id'          => $product->id,
            "title"        => $updatedProduct['title'],
            "description" => $updatedProduct['description'],
            "quantity" => $updatedProduct['quantity'],
            "sku" => $updatedProduct['sku'],
            "merchant_id" => $merchant->id,
        ]);

        $res->assertJsonStructure([
            'data' => [
                "id",
                "title",
                "description",
                "quantity",
                "sku",
                "stores"
            ],
        ]);

        $res->assertStatus(200);
    }

    public function testDeleteStore()
    {
        Merchant::factory()->create();

        $product = Product::factory()->create();

        $res = $this->delete('api/products/' . $product->id, [
            'merchant_id' => $product->merchant_id,
        ]);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);

        $res->assertStatus(204);
    }
}
