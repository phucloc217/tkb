<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
                'name' => 'sometimes|required',
                'ngaysinh' => 'sometimes|date|required',
                'email' => 'sometimes|email|required', \Illuminate\Validation\Rule::unique('users')->ignore($this->user()->id),
                'sdt' => 'sometimes|required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',\Illuminate\Validation\Rule::unique('users')->ignore($this->user()->id),
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
