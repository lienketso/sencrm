<?php


namespace Members\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class MemberCreateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
    return [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        're_password' => 'required|same:password',
        'fullname' => 'required'
    ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Định dạng Email không đúng',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu tối thiểu là 6 ký tự',
            're_password.required' => 'Mật khẩu nhập lại không được bỏ trống',
            're_password.same' => 'Mật khẩu nhắc lại không đúng',
            'fullname.required' => 'Họ tên không được bỏ trống'
        ];
    }

}