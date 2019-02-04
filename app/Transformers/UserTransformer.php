<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user) {
        return [
            'id' => $user->id,
            'login' => $user->login,
            'email' => $user->email,
            'firstName' => $user->firstName,
            'lastName' => $user->lastName,
            'phone' => $user->phone,
            'country' => $user->country->translate->title,
            'city' => $user->city,
            'street' => $user->street,
            'houseNumber' => $user->houseNumber,
        ];
    }
}