<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\View\View;

class StoreControllor extends Controller
{
    /**
     * @param Merchant $merchant
     * @return View
     */
    public function __invoke(Merchant $merchant): View
    {
        $stores = $merchant->stores()->withCount('products')->paginate();
        return view('store.index', [
            'title'    => 'Stores' . ' | ' . $merchant->name,
            'models'   => $stores,
            'back_url' => route('home'),
        ]);
    }
}
