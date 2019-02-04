<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class StorePage extends FormRequest
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
        'title_ru' => 'required',
        'title_en' => 'required',
        'title_ua' => 'required',
        'descriptions_en' => 'required',
        'descriptions_ru' => 'required',
        'descriptions_ua' => 'required',
        'poster' => 'image|mimes:jpg,jpeg,png',
        'name' => 'required',
      ];
    }
  public function messages()
  {
    return [
      'title_ru.required' => Lang::get('errors.title_ru'),
      'title_en.required' => Lang::get('errors.title_en'),
      'title_ua.required' => Lang::get('errors.title_ua'),
      'descriptions_en.required' => Lang::get('errors.descriptions_en'),
      'descriptions_ru.required' => Lang::get('errors.descriptions_ru'),
      'descriptions_ua.required' => Lang::get('errors.descriptions_ua'),
      'performances.required' => Lang::get('errors.performances'),
      'poster.required' => Lang::get('errors.poster'),
      'name.required' => Lang::get('errors.name'),
    ];
  }
}
