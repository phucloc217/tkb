<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'ngaysinh' => 'date|required',
            'email' => 'email|required|unique:users,email',
            'sdt' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,sdt'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn phải nhập tên giảng viên',
            'ngaysinh.required' => 'Bạn phải nhập ngày sinh giảng viên',
            'ngaysinh.date'=>'Ngày sinh sai định dạng',
            'email.requỉed'=>'Bạn phải nhập email',
            'email.email'=>'Email sai định dạng',
            'email.unique'=>'Email đã tồn tại',
            'sdt.required'=>'Bạn phải nhập số điện thoại',
            'sdt.regex'=>'Số điện thoại sai định dạng',
            'sdt.min'=>'Số điện thoại sai định dạng',
            'sdt.unique'=>'Số điện thoại đã tồn tại',
        ];
    }
}