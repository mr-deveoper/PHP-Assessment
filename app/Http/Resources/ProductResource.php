<?php

namespace App\Http\Resources;

use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class ProductResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            "description" => $this->description,
            "quantity"    => round($this->quantity, 2),
            "sku"         => $this->sku,
            'price'       => $this->when($this->pivot?->price, fn() => round($this->pivot->price)),
            "stores"      => StoreResource::collection($this->whenLoaded('stores')),
            'merchant'    => MerchantResource::make($this->whenLoaded('merchant')),
        ];
    }
}
