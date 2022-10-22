<?php

namespace Tests\Feature;

use App\Models\Merchant;
use App\Models\Store;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    public function testGetStores()
    {
        $merchant = Merchant::factory()->create();

        Store::factory()->count(3)->create(['merchant_id' => $merchant->id]);

        $res = $this->get('api/stores');

        $res->assertJsonStructure([
            'data' => [
                [
                    "id",
                    "name",
                    "merchant" => [
                        "id",
                        "name",
                        "email",
                        "phone",
                    ],
                ],
            ],
        ]);

        $res->assertStatus(200);
    }

    public function testShowStore()
    {
        $merchant = Merchant::factory()->create();

        $store = Store::factory()->create(['merchant_id' => $merchant->id]);

        $res = $this->json('get', 'api/stores/' . $store->id);

        $res->assertJsonStructure([
            'data' => [
                "id",
                "name",
                "products",
            ],
        ]);

        $res->assertStatus(200);
    }

    public function testCreateStore()
    {
        $merchant = Merchant::factory()->create();

        $store = Store::factory()->create(['merchant_id' => $merchant->id])->getAttributes();

        $res = $this->post('api/stores', $store);

        $this->assertDatabaseHas('stores', [
            'id'          => $res['data']['id'],
            'merchant_id' => $merchant->id,
        ]);

        $res->assertJsonStructure([
            'data' => [
                "id",
                "name",
            ],
        ]);

        $res->assertStatus(201);
    }

    public function testUpdateStore()
    {
        $merchant = Merchant::factory()->create();

        $store = Store::factory()->create(['merchant_id' => $merchant->id]);

        $updatedStore = Store::factory()->make(['merchant_id' => $merchant->id])->getAttributes();

        $res = $this->put('api/stores/' . $store->id, $updatedStore);

        $this->assertDatabaseHas('stores', [
            'id'          => $store->id,
            "name"        => $updatedStore['name'],
            "merchant_id" => $merchant->id,
        ]);

        $res->assertJsonStructure([
            'data' => [
                "id",
                "name",
            ],
        ]);

        $res->assertStatus(200);
    }

    public function testDeleteStore()
    {
        $merchant = Merchant::factory()->create();

        $store = Store::factory()->create(['merchant_id' => $merchant->id]);

        $res = $this->delete('api/stores/' . $store->id, [
            'merchant_id' => $store->merchant_id,
        ]);

        $this->assertDatabaseMissing('stores', [
            'id' => $store->id,
        ]);

        $res->assertStatus(204);
    }
}
