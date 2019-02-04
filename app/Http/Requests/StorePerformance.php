<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class StorePerformance extends FormRequest
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
            'descriptions_en' => 'nullable',
            'descriptions_ru' => 'nullable',
            'descriptions_ua' => 'nullable',
            'author_en' => 'nullable',
            'author_ru' => 'nullable',
            'author_ua' => 'nullable',
            'price' => 'nullable',
            'lang_ru' => 'nullable',
            'lang_ua' => 'nullable',
            'lang_en' => 'nullable',
            'duration' => ['nullable', 'regex:/^([01][ 0-9]:[0-5][0-9]|2[0-3]:[0-5][0-9])$/'],
            'type_id' => 'required',
            'general_actors' => 'nullable',
            'synapsis_en' => 'nullable',
            'synapsis_ru' => 'nullable',
            'synapsis_ua' => 'nullable',
            'program_en' => 'nullable|mimes:pdf',
            'program_ru' => 'nullable|mimes:pdf',
            'program_ua' => 'nullable|mimes:pdf',
            'tagline_en' => 'nullable',
            'tagline_ru' => 'nullable',
            'tagline_ua' => 'nullable',
        ];
        return $rules;
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
            'author_en.required' => Lang::get('errors.authorEnRequired'),
            'author_ru.required' => Lang::get('errors.authorRuRequired'),
            'author_ua.required' => Lang::get('errors.authorUaRequired'),
            'price.required' => Lang::get('errors.priceRequired'),
            'lang_ru.required' => Lang::get('errors.langRuRequired'),
            'lang_en.required' => Lang::get('errors.langEnRequired'),
            'lang_ua.required' => Lang::get('errors.langUaRequired'),
            'duration.required' => Lang::get('errors.durationRequired'),
            'duration.regex' => Lang::get('errors.durationRegex'),
            'type_id.required' => Lang::get('errors.typeIdRequired'),
            'general_actors.required' => Lang::get('errors.GeneralActorsRequired'),
            'tagline_en.required' => Lang::get('errors.tagline_en'),
            'tagline_ru.required' => Lang::get('errors.tagline_ru'),
            'tagline_ua.required' => Lang::get('errors.tagline_ua'),
        ];
    }
}
