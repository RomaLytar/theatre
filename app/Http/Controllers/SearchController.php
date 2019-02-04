<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Repositories\PerformanceRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $performanceRepository;

    public function __construct(PerformanceRepository $performanceRepository)
    {
        $this->performanceRepository = $performanceRepository;
    }

    public function performance(Request $request)
    {
        return $this->performanceRepository->search($request);
    }
}
