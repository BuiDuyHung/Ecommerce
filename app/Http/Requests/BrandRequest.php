<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'brand_product_title' => 'required|min:3',
            'brand_product_desc' => 'required|min:6',
            'brand_product_keywords' => 'required|min:3',
            'brand_product_status' => ['required', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn trạng thái cho thương hiệu');
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
            'brand_product_title' => 'Tên thương hiệu',
            'brand_product_desc' => 'Mô tả thương hiệu',
            'brand_product_status' => 'Trạng thái thương hiệu',
            'brand_product_keywords' => 'Từ khóa thương hiệu',
        ];
    }
}
