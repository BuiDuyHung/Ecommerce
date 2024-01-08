<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'slider_name' => 'required|min:2',
            'slider_image' => 'required|min:2',
            'slider_desc' => 'required|min:6',
            'slider_status' => ['required', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn trạng thái cho slider');
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
            'slider_name' => 'Tên slider',
            'slider_image' => 'Hình ảnh slider',
            'slider_desc' => 'Mô tả slider',
            'slider_status' => 'Trạng thái slider',
        ];
    }
}
