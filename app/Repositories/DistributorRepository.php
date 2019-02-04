<?php

namespace App\Repositories;
use App\Models\Color;
use App\Models\Distributor;
use App\Models\PricePattern;
use App\Models\PriceZone;
use Illuminate\Container\Container as App;

class DistributorRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Distributor::class;
    }

    public function createDistributor($data)
    {
        $distributor = [
            'title' => $data['title'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'color_code' => $data['color_code'],
            'user_id' => $data['user_id'],
        ];
        $distributor = $this->create($distributor);

        return $distributor;
    }

    public function editDistributor($data, $id) {
        $array = [
            'title' => $data['title'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'color_code' => $data['color_code'],
        ];

        $this->update($array, ['id' => $id]);

        $distributor = $this->find($id);

        return $distributor;
    }
}
