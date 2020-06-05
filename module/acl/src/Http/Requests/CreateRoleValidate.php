<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/4/2018
 * Time: 2:00 PM
 */

namespace Acl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleValidate extends FormRequest
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
			'name' => 'required|unique:roles,name',
			'display_name' => 'required'
		];
	}
	
	/**
	 * @return array
	 */
	public function messages()
	{
		return [
			'name.required' => 'Slug role must not be empty',
			'name.unique' => 'This slug was used',
			'display_name.required' => 'Role name must not be blank'
		];
	}
}