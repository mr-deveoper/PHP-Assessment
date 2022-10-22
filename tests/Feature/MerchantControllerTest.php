<?php

namespace Tests\Feature;

use App\Models\Merchant;
use Tests\TestCase;

class MerchantControllerTest extends TestCase
{
    public function testGetMerchants()
    {
        Merchant::factory()->count(3)->create();

        $res = $this->get('api/merchants');

        $res->assertJsonStructure([
            'data' => [
                [
                    "id",
                    "name",
                    "email",
                    "phone",
                ],
            ],
        ]);

        $res->assertStatus(200);
    }

    public function testShowMerchant()
    {
        $merchant = Merchant::factory()->create();

        $res = $this->get('api/merchants/' . $merchant->id);

        $res->assertJsonStructure([
            'data' => [
                "id",
                "name",
                "email",
                "phone",
            ],
        ]);

        $res->assertStatus(200);
    }

    public function testCreateMerchant()
    {
        $merchant = Merchant::factory()->make()->getAttributes();

        $res = $this->post('api/merchants', $merchant);

        $this->assertDatabaseHas('merchants', [
            'id' => $res['data']['id'],
        ]);

        $res->assertJsonStructure([
            'data' => [
                "id" ,
                "name",
                "email",
                "phone",
            ],
        ]);

        $res->assertStatus(201);
    }

    public function testUpdateMerchant()
    {
        $merchant = Merchant::factory()->create();

        $updateMerchant = Merchant::factory()->make()->getAttributes();

        $res = $this->put('api/merchants/' . $merchant->id, $updateMerchant, ['Accept' => 'application/json']);

        $this->assertDatabaseHas('merchants', [
            'id'    => $merchant->id,
            "name"  => $updateMerchant['name'],
            "phone" => $updateMerchant['phone'],
            "email" => $updateMerchant['email'],
        ]);

        $res->assertJsonStructure([
            'data' => [
                "id",
                "name",
                "email",
                "phone",
            ],
        ]);

        $res->assertStatus(200);
    }

    public function testDeleteMerchant()
    {
        $merchant = Merchant::factory()->create();

        $res = $this->delete('api/merchants/' . $merchant->id);

        $this->assertDatabaseMissing('merchants', [
            'id' => $merchant->id,
        ]);

        $res->assertStatus(204);
    }
}
