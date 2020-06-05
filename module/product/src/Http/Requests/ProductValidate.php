<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 8/29/2018
 * Time: 11:56 AM
 */

namespace Product\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ProductValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The field Name must be present in the input data and not empty.',
            'name.min' => 'The field Author must have a minimum value 2 characters',
        ];
    }
}