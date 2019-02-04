<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class StoreVideo extends FormRequest
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
            'title_ru' => 'required|max:255',
            'title_en' => 'required|max:255',
            'title_ua' => 'required|max:255',
            'category_id' => 'required',
            'season_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title_ru.required' => Lang::get('errors.titleRuRequired'),
            'title_en.required' => Lang::get('errors.titleEnRequired'),
            'title_ua.required' => Lang::get('errors.titleUaRequired'),
            'category_id.required' => Lang::get('errors.categoryIdRequired'),
            'season_id.required' => Lang::get('errors.seasonIdRequired'),
        ];
    }
}
