<?php

use Illuminate\Database\Seeder;

class DistributorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distributors = [
            'Distributor 1',
            'Distributor 2',
            'Distributor 3',
        ];

        foreach ($distributors as $distributorTitle) {
            $distributor = [
                'title' => $distributorTitle,
            ];
            \App\Models\Distributor::create($distributor);
        }
    }
}
