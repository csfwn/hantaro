<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => ['required', 'string', 'max:20'],
            'customer_address' => 'required|string|max:1000',
            'customer_email' => 'required|email|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('phone')) {
            $mobile_no = $this->string('phone');
            if (Str::startsWith($mobile_no, '+')) {
                $mobile_no = ltrim($mobile_no, '+');
            }
            $this->merge([
                'phone' => $mobile_no,
            ]);
        }
    }
}
