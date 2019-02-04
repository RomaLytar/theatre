<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\TicketTemplate;
use App\Transformers\TicketTemplateTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketTemplateController extends Controller
{
    public function show(Request $request) {
        $param = $request->input('template');
        $param = $param === 'cash-box' ? 'is_active_cash_box' : 'is_active_online';
        if(!$ticketTemplate = TicketTemplate::where($param, true)->latest()->first()) {
            return response()->json([
                'status' => false,
                'message' => 'No active templates found'
            ]);
        }

        return fractal()
            ->item($ticketTemplate)
            ->transformWith(new TicketTemplateTransformer);
    }
}
