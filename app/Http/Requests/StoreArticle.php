<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class StoreArticle extends FormRequest
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
        'descriptions_en' => 'required',
        'descriptions_ru' => 'required',
        'descriptions_ua' => 'required',
        'poster' => 'image|mimes:jpg,jpeg,png',
        'category_id' => 'required',
      ];
    }

  public function messages()
  {
    return [
      'title_ru.required' => Lang::get('errors.titleRuRequired'),
      'title_en.required' => Lang::get('errors.titleEnRequired'),
      'title_ua.required' => Lang::get('errors.titleUaRequired'),
      'descriptions_en.required' => Lang::get('errors.descriptionsEnRequired'),
      'descriptions_ru.required' => Lang::get('errors.descriptionsRuRequired'),
      'descriptions_ua.required' => Lang::get('errors.descriptionsUaRequired'),
      "poster.*.image|mimes:jpg,jpeg,png" => Lang::get('errors.poster'),
      'category_id.required' => Lang::get('errors.categoryIdRequired'),
    ];
  }
}
