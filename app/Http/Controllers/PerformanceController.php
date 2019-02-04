<?php

namespace App\Http\Controllers;

use App\Models\PerformanceTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerformanceController extends Controller
{
  public function index() {
    //
  }
  
  public function search()
  {

    return PerformanceTranslation::where('title', 'like', '%'.request('q').'%')->select([
            DB::raw('title'),
            'performance_id as id'
          ])->paginate(10);

  }
}
