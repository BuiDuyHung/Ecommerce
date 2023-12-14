<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeshipRequest extends FormRequest
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
            'city' => ['required', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn tỉnh thành phố');
                }
            }],
            'district' => ['required', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn quận huyện');
                }
            }],
            'commune' => ['required', function($attribute, $value, $fail) {
                if($value == '0'){
                    $fail('Vui lòng chọn xã phường');
                }
            }],
            'feeship' => 'required|min:2',
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
            'city' => 'Tỉnh thành phố',
            'district' => 'Quận huyện',
            'commune' => 'Xã phường',
            'feeship' => 'Phí vận chuyển',
        ];
    }
}
