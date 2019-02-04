<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', compact('html'));
    }
}
