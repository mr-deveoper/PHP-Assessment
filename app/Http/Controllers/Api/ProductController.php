<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $products = Product::byStore((int) $request->get('store_id'))
            ->byMerchant((int) $request->get('merchant_id'))
            ->withStores((int) $request->get('store_id'),(int) $request->get('merchant_id'))
            ->paginate();
        return ProductResource::collection($products);
    }


    /**
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        $product->load('stores', 'merchant');
        return ProductResource::make($product);
    }

    /**
     * @param ProductRequest $request
     * @return ProductResource
     */
    public function store(ProductRequest $request): ProductResource
    {
        DB::beginTransaction();
        $product = Product::create($request->validated());
        $this->savePrices($request->get('stores'), $product);
        DB::commit();
        $product->load('stores', 'merchant');
        return ProductResource::make($product);
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function update(ProductRequest $request, Product $product): ProductResource
    {
        DB::beginTransaction();
        $product->update($request->validated());
        $this->savePrices($request->get('stores', 'merchant'), $product);
        DB::commit();
        $product->load('stores');
        return ProductResource::make($product);
    }


    /**
     * @param Product $product
     * @param Request $request
     * @return Response
     */
    public function delete(Product $product, Request $request): Response
    {
        if ($product->merchant_id != $request->get('merchant_id')) {
            abort(Response::HTTP_FORBIDDEN, "You don't have access to delete this product");
        }
        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param array $stores
     * @param Product $product
     * @return void
     */
    private function savePrices(array $stores, Product $product): void
    {
        $stores = collect($stores)->mapWithKeys(fn(array $store) => [
            $store['id'] => [
                'price' => $store['price'],
            ],
        ]);
        $product->stores()->sync($stores);
    }
}
