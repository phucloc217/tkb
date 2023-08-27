<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LopHocRequest extends FormRequest
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
            'id' => 'required',
            'tenlop' => 'required',
            'siso'=>'integer|required',
            'khoahoc'=>'integer|required'
            
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Bạn phải nhập mã lớp',
            'tenlop.required' => 'Bạn phải nhập tên lớp',
            'siso.required'=>'Bạn phải nhập sĩ số lớp',
            'siso.integer'=>'Sĩ số phải là số nguyên',
            'khoahoc.required'=>'Bạn phải nhập sĩ khóa học',
            'khoahoc.integer'=>'Khóa học phải là số',

        ];
    }
}
