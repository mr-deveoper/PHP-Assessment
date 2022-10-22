<?php

namespace App\Models;

use App\QueryBuilders\StoreQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'merchant_id',
    ];

    /**
     * @param $query
     * @return StoreQuery
     */
    public function newEloquentBuilder($query): StoreQuery
    {
        return new StoreQuery($query);
    }

    #region Relations

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'store_product')->withPivot('price');
    }
    #endregion
}
