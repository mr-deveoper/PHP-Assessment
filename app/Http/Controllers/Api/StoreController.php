<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $stores = Store::byMerchant((int) $request->get('merchant_id'))->with('merchant')->paginate();
        return StoreResource::collection($stores);
    }

    /**
     * @param Store $store
     * @return StoreResource
     */
    public function show(Store $store): StoreResource
    {
        $store = $store->load('products');
        return StoreResource::make($store);
    }

    /**
     * @param StoreRequest $request
     * @return StoreResource
     */
    public function store(StoreRequest $request): StoreResource
    {
        $store = Store::create($request->validated());
        return StoreResource::make($store);
    }

    /**
     * @param StoreRequest $request
     * @param Store $store
     * @return StoreResource
     */
    public function update(StoreRequest $request, Store $store): StoreResource
    {
        if ($store->merchant_id != $request->get('merchant_id')) {
            abort(Response::HTTP_FORBIDDEN, "You don't have access to delete this product");
        }
        $store->update($request->validated());
        return StoreResource::make($store);
    }


    /**
     * @param Store $store
     * @param Request $request
     * @return Response
     */
    public function delete(Store $store, Request $request): Response
    {
        if ($store->merchant_id != $request->get('merchant_id')) {
            abort(Response::HTTP_FORBIDDEN, "You don't have access to delete this product");
        }
        $store->products()->detach();
        $store->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
