<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MerchantController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function __invoke()
    {
        $merchants = Merchant::paginate();

        return view('merchant.index', [
            'title'  => 'Merchants',
            'models' => $merchants,
        ]);
    }
}
