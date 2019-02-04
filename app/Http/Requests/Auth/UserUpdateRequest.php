<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
	    $array = [
	        'login' => [
	        	'required',
	        	'string',
		        Rule::unique('users')->ignore(\Auth::user()->id),
	        ],
	        'email' => [
		        'required',
		        'string',
		        'email',
		        Rule::unique('users')->ignore(\Auth::user()->id),
	        ],
	        'firstName' => 'required|max:50',
	        'lastName' => 'required|max:50',
	        'phone' => 'required|max:15',
        ];

	    if(isset($this->password) && isset($this->password_new)) {
		    $array['password'] = 'required|min:6';
		    $array['password_new'] = 'required|min:6|different:password';
	    }

	    return $array;
    }
}
