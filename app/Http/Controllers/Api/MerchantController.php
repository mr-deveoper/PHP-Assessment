<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantRequest;
use App\Http\Resources\MerchantResource;
use App\Models\Merchant;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MerchantController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $merchants = Merchant::paginate();

        return MerchantResource::collection($merchants);
    }

    /**
     * @param Merchant $merchant
     * @return MerchantResource
     */
    public function show(Merchant $merchant): MerchantResource
    {
        $merchant->load('stores.products');
        return MerchantResource::make($merchant);
    }

    /**
     * @param MerchantRequest $request
     * @return MerchantResource
     */
    public function store(MerchantRequest $request): MerchantResource
    {
        $merchant = Merchant::create($request->validated());
        return MerchantResource::make($merchant);
    }

    /**
     * @param MerchantRequest $request
     * @param Merchant $merchant
     * @return MerchantResource
     */
    public function update(MerchantRequest $request, Merchant $merchant): MerchantResource
    {
        $merchant->update($request->validated());
        return MerchantResource::make($merchant);
    }

    /**
     * @param Merchant $merchant
     * @return Response
     */
    public function delete(Merchant $merchant): Response
    {
        $merchant->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
