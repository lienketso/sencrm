<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 10:47 PM
 */

namespace Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}
	
	public function rules()
	{
		return [
			'email' => 'required|min:5',
			'password' => 'required'
		];
	}
	
	public function messages()
	{
		return [
			'email.required' => 'Email address is required',
			'email.min' => 'Minimum length for email address is 5 characters',
			'password.required' => 'Password is required'
		];
	}
}