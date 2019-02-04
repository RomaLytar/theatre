<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FestivalUpdateRequest extends FormRequest
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
      $rules = [
        'title_ru' => 'required|max:255',
        'title_en' => 'required|max:255',
        'title_ua' => 'required|max:255',
        'descriptions_en' => 'required',
        'descriptions_ru' => 'required',
        'descriptions_ua' => 'required',
        'performances' => 'required',
        'poster' => 'image|mimes:jpeg,jpg,png'
      ];
      if ($this->file('images')) {
        $images = count($this->file('images'));
        foreach (range(0, $images) as $index) {
          $rules['images.' . $index] = 'image|mimes:jpeg,jpg,bmp,png|max:5000';
        }
      }
      return $rules;
    }
}
