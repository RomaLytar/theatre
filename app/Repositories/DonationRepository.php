<?php

namespace App\Repositories;

use App\Models\Donation;


class DonationRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Donation::class;
    }

    public function createDonation($data)
    {
        $donation = [
            'payment_id' => $data['payment_id'] ?? '',
            'payment_status' => $data['status'] ?? '',
            'first_name' => $data['sender_first_name'] ?? '',
            'last_name' => $data['sender_last_name'] ?? '',
            'phone' => $data['sender_phone'] ?? '',
            'amount' => $data['amount'] ?? '',
            'comment' => $data['description'] ?? '',
        ];
        $this->create($donation);
    }

    public function editDonation($data, $id)
    {
        $array = [
            'payment_id' => $data['payment_id'] ?? '',
            'payment_status' => $data['status'] ?? '',
            'first_name' => $data['sender_first_name'] ?? '',
            'last_name' => $data['sender_last_name'] ?? '',
            'phone' => $data['sender_phone'] ?? '',
            'amount' => $data['amount'] ?? '',
            'comment' => $data['description'] ?? '',
        ];
        $this->update($array, ['id' => $id]);
    }
}
