<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules() {
        return [
            'coupon' => 'required',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $couponCode = $this->input('coupon');

            if (!empty($couponCode)) {
                $validator->errors()->add('coupon', 'Coupon code is already set and cannot be modified.');
            }
        });
    }
}
