<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category_product_title' => 'required|min:3',
            'category_product_desc' => 'required|min:6',
            'category_product_keywords' => 'required|min:3',
            'category_product_status' => ['required', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn trạng thái cho danh mục');
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
            'category_product_title' => 'Tên danh mục',
            'category_product_desc' => 'Mô tả danh mục',
            'category_product_status' => 'Trạng thái danh mục',
            'category_product_keywords' => 'Từ khóa danh mục',
        ];
    }
}
