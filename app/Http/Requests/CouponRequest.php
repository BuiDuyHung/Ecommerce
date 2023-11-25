<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon_name' => 'required|min:2',
            'coupon_code' => 'required|min:2',
            'coupon_qty' => 'required|min:2',
            'coupon_value' => 'required|min:2',
            'coupon_condition' => ['required', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn tính năng mã giảm giá');
                }
            }],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute có độ dài từ :min ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'coupon_name' => 'Tên mã giảm giá',
            'coupon_code' => 'Mã giảm giá',
            'coupon_qty' => 'Số lượng mã giảm giá',
            'coupon_value' => 'Giá trị mã giảm giá',
            'coupon_condition' => 'Tính năng mã giảm giá',
        ];
    }
}
