<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhongHocRequest extends FormRequest
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
            'tenphong' => 'required',
            'succhua' => 'required|integer|min:0',
        ];
    }
    public function messages()
    {
        return [
            'tenphong.required' => 'Bạn phải nhập tên phòng',
            'succhua.required' => 'Bạn phải nhập sức chứa',
            'succhua.integer' => 'Sức chứa phải là số',
            'succhua.min' => 'Sức chứa tối thiểu phải là 0',
           
        ];
    }
}
