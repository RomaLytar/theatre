<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
	        'email' => 'required|string|email|unique:users',
	        'password' => 'required|min:6',
            'firstName' => 'required|max:50',
            'lastName' => 'required|max:50',
            'phone' => 'required|max:15',
            'city' => 'max:50',
            'street' => 'max:50',
            'houseNumber' => 'nullable|integer',
        ];
    }
}
