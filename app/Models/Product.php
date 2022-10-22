<?php

namespace App\Models;

use App\QueryBuilders\ProductQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'quantity',
        'sku',
        'merchant_id'
    ];

    /**
     * @param $query
     * @return ProductQuery
     */
    public function newEloquentBuilder($query): ProductQuery
    {
        return new ProductQuery($query);
    }

    /**
     * @return BelongsToMany
     */
    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'store_product')->withPivot('price');
    }

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
    #endergion
}
