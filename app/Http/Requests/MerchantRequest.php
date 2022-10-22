<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MerchantRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        $merchantId = $this->merchant->id ?? $this->merchant;
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('merchants', 'email')->ignore($merchantId)],
            'phone' => ['required', 'string', Rule::unique('merchants', 'phone')->ignore($merchantId)],
        ];
    }
}
