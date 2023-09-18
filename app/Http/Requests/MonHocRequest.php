<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonHocRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tenmh' => 'required',
            'sotiet'=>'integer|required|min:0'
            
        ];
    }
    public function messages()
    {
        return [
            'tenmh.required' => 'Bạn phải nhập tên môn học',
            'sotiet.required' => 'Bạn phải nhập số tiết',
            'sotiet.min'=>'Số tiết phải lớn hơn 0',
            'sotiet.integer'=>'Số tiết phải là số nguyên'
        ];
    }
}
