<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class StoreSetting extends FormRequest
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
          'slug' => 'required|max:45',
          'title_ru' => 'required|max:100',
          'title_en' => 'required|max:100',
          'title_ua' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'title_ru.required' => Lang::get('errors.titleRuRequired'),
            'title_en.required' => Lang::get('errors.titleEnRequired'),
            'title_ua.required' => Lang::get('errors.titleUaRequired'),
        ];
    }
}
