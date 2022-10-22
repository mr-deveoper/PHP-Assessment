<?php

namespace App\Http\Resources;

use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Store
 */
class StoreResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'products'      => ProductResource::collection($this->whenLoaded('products')),
            'merchant'      => MerchantResource::make($this->whenLoaded('merchant')),
            'product_price' => $this->when($this->pivot?->price, fn() => round($this->pivot->price, 2)),
        ];
    }
}
