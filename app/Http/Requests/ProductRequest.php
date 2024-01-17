<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_title' => 'required|min:2',
            'product_slug' => 'required|min:2',
            'product_quantity' => 'required|integer',
            'product_image' => 'required|min:6',
            'product_price' => 'required|min:6',
            'product_desc' => 'required|min:6',
            'product_content' => 'required|min:6',

            'brand_id' => ['required', 'integer', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn thương hiệu cho sản phẩm');
                }
            }],
            'category_id' => ['required', 'integer', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn danh mục cho sản phẩm');
                }
            }],
            'product_status' => ['required', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn trạng thái cho sản phẩm');
                }
            }],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute có độ dài từ :min ký tự',
            'integer' => ':attribute phải là số',
        ];
    }

    public function attributes()
    {
        return [
            'product_title' => 'Tên sản phẩm',
            'product_slug' => 'Slug',
            'product_quantity' => 'Số lượng sản phẩm',
            'product_image' => 'Hình ảnh sản phẩm',
            'product_price' => 'Giá sản phẩm',
            'product_desc' => 'Mô tả sản phẩm',
            'product_content' => 'Nội dung sản phẩm',
            'brand_id' => 'Thương hiệu sản phẩm',
            'category_id' => 'Danh mục sản phẩm',
            'product_status' => 'Trạng thái sản phẩm',
        ];
    }
}
