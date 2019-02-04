<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Menu;
use App\Repositories\HomePageRepository;
use App\Repositories\PerformanceRepository;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
    * @var PerformanceRepository
    */
    protected $performanceRepository;

    /**
    * @var HomePageRepository
    */
    protected $homePageRepository;

    public function __construct(
      PerformanceRepository $performanceRepository,
      HomePageRepository $homePageRepository
    ) {
        $this->performanceRepository = $performanceRepository;
        $this->homePageRepository = $homePageRepository;
    }

    public function index()
    {
        $performances = $this->performanceRepository->getUpcomingPerformances(0, 3);

        $homePageComponents = $this->homePageRepository->getAllComponents();
        $articles = Article::with('translate', 'media')->latest()->limit(3)->get();

        return view(
          'pages.theatre.pages.index',
          compact('performances', 'homePageComponents', 'articles')
        );
    }
}
