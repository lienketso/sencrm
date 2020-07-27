<?php


namespace Guest\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'fullname'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'repassword'=>'same:password'
        ];
    }
    public function messages()
    {
        return [
            'fullname.required'=>'Vui lòng nhập họ tên',
            'email.required'=>'Bạn chưa nhập email',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email đã được sử dụng',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu phải lớn hơn 6 ký tự',
            'repassword.same'=>'Xác nhận mật khẩu chưa đúng'
        ];
    }
}