<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class ProductQuery extends Builder
{
    /**
     * @param $storeId
     * @return $this
     */
    public function byStore($storeId): self
    {
        if (!$storeId) {
            return $this;
        }

        return $this->whereHas('stores', fn($q) => $q->where('id', $storeId));
    }

    /**
     * @param $merchantId
     * @return $this
     */
    public function byMerchant($merchantId): self
    {
        if (!$merchantId) {
            return $this;
        }

        return $this->whereHas('stores', fn($q) => $q->where('merchant_id', $merchantId));
    }

    /**
     * @param int|null $storeId
     * @param int|null $merchantId
     * @return ProductQuery
     */
    public function withStores(?int $storeId = null, ?int $merchantId = null): ProductQuery
    {
        return $this->with(['stores' => fn($q) => $q->byId($storeId)->byMerchant($merchantId)]);
    }
}
