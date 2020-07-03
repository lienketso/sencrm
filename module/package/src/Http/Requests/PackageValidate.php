<?php


namespace Package\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PackageValidate extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=> 'required|min:3',
            'price'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Bạn chưa nhập tên gói',
            'name.min'=>'Tiêu đề phải lớn hơn 3 ký tự',
            'price.required'=>'Bạn chưa nhập giá trị gói'
        ];
    }

}