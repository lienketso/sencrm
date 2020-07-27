<?php


namespace Members\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class MemberEditRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'email'=>'required',
            'fullname'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Email đăng nhập không được để trống',
            'fullname.required'=>'Họ tên không được để trống'
        ];
    }

}