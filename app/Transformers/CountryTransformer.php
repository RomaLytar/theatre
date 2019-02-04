<?php
/**
 * Created by PhpStorm.
 * User: Rise
 * Date: 10/16/2018
 * Time: 2:41 PM
 */

namespace App\Transformers;


use App\Models\Country;
use League\Fractal\TransformerAbstract;

class CountryTransformer extends TransformerAbstract
{
    public function transform(Country $country) {
        return [
            'id' => $country->id,
            'country_name' => $country->translate->title
        ];
    }
}