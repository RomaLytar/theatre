<?php

namespace App\Transformers;

use App\Models\TicketTemplate;
use League\Fractal\TransformerAbstract;

class TicketTemplateTransformer extends TransformerAbstract
{
    public function transform(TicketTemplate $template)
    {
        return [
            'id' => $template->id,
            'title' => $template->title,
            'json_code' => $template->json_code,
            'html_code' => $template->html_code,
            'width' => $template->width,
            'height' => $template->height,
            'is_active_cash_box' => $template->is_active_cash_box,
            'is_active_online' => $template->is_active_online,
            'poster' => $template->getFirstMediaUrl('posters'),
        ];
    }
}
