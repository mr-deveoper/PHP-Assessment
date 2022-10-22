<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        $id = $this->product->id ?? $this->product;
        return [
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['required', 'string', 'max:640000'],
            'quantity'       => ['required', 'integer', 'min:1', 'max:999999'],
            'sku'            => ['required', 'string', 'max:255', Rule::unique('products')->ignore($id)],
            'merchant_id'    => ['required', Rule::exists('merchants', 'id')],
            'stores'         => ['required', 'array'],
            'stores.*.id'    => ['required', Rule::exists('stores', 'id')->where('merchant_id', $this->get('merchant_id'))],
            'stores.*.price' => ['required', 'numeric', 'min:1', 'max:99999'],
        ];
    }
}
