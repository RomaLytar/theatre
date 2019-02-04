<?php

namespace App\Transformers;

use App\Models\Distributor;
use League\Fractal\TransformerAbstract;

class DistributorTransformer extends TransformerAbstract
{
    public function transform(Distributor $distributor) {
        return [
            'id' => $distributor->id,
            'title' => $distributor->title,
            'email' => $distributor->email,
            'phone' => $distributor->phone,
            'color_code' => $distributor->color_code,
        ];
    }
}