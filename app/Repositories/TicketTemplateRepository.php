<?php

namespace App\Repositories;

use App\Models\TicketTemplate;


class TicketTemplateRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return TicketTemplate::class;
    }

    public function createTicketTemplate($data)
    {
        $ticketTemplate = [
            'title' => $data['title'],
            'json_code' => $data['json_code'],
            'width' => $data['width'],
            'height' => $data['height'],
            'is_active_cash_box' => $data['is_active_cash_box'],
            'is_active_online' => $data['is_active_online'],
        ];
        $ticketTemplate = $this->create($ticketTemplate);

        return $ticketTemplate;
    }

    public function editTicketTemplate($data, $id)
    {
        $array = [
            'title' => $data['title'],
            'json_code' => $data['json_code'],
            'width' => $data['width'],
            'height' => $data['height'],
            'is_active_cash_box' => $data['is_active_cash_box'],
            'is_active_online' => $data['is_active_online'],
        ];
        $this->update($array, ['id' => $id]);
    }
}
