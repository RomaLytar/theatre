<?php

namespace App\Http\Controllers\Admin;

use App\Models\Leftover;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LeftoverController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tickets-sold');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $leftover = [
            'user_id' => \Auth::user()->id,
            'start_sum' => $data['start_sum'],
        ];
        Leftover::create($leftover);

        Session::flash('message', 'Сума успішно встановлена');
        return redirect()->back();
    }
}
