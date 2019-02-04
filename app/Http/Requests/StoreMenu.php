<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class StoreMenu extends FormRequest
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
            'url' => 'required|max:100',
            'menu_ru' => 'required|max:100',
            'menu_en' => 'required|max:100',
            'menu_ua' => 'required|max:100',
        ];
    }
  
    public function messages()
    {
        return [
            'url.required' => Lang::get('errors.urlRequired'),
            'menu_ru.required' => Lang::get('errors.menuRuRequired'),
            'menu_en.required' => Lang::get('errors.menuEnRequired'),
            'menu_ua.required' => Lang::get('errors.menuUaRequired'),
        ];
    }
}
