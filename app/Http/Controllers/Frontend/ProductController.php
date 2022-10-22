<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * @param Store $store
     * @return Application|Factory|View
     */
    public function __invoke(Store $store)
    {
        $products = $store->products()->paginate();

        return view('product.index', [
            'title'    => 'Product' . ' | ' . $store->name,
            'models'   => $products,
            'back_url' => route('stores', $store->merchant),
        ]);
    }
}
