<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class StoreQuery extends Builder
{
    /**
     * @param $id
     * @return $this
     */
    public function byId($id): self
    {
        if (!$id) {
            return $this;
        }
        return $this->where('id', $id);
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
        return $this->where('merchant_id', $merchantId);
    }
}

