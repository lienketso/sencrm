<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/8/2018
 * Time: 2:03 PM
 */

namespace Transaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'name' => 'required|min:3'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The field Transaction Title must be present in the input data and not empty.',
            'name.min' => 'The field Transaction Title must have a minimum value 3 characters'
        ];
    }
}