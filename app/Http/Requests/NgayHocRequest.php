<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NgayHocRequest extends FormRequest
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
            'start' => 'required',
            'end' => 'required',
            'id_monhoc'=>'integer|required'
            
        ];
    }
    public function messages()
    {
        return [
            'start.required' => 'Bạn phải nhập ngày bắt đầu',
            'end.required' => 'Bạn phải nhập ngày kết thúc',
            'id_monhoc.required'=>'Bạn phải nhập môn học'

        ];
    }
}
