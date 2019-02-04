<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomePage;
use App\Repositories\HomePageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class HomePageController extends Controller
{
    /**
     * @var HomePageRepository
     */
    protected $homepageRepository;

    public function __construct(HomePageRepository $homePageRepository)
    {
        $this->middleware('permission:home-page-list');
        $this->middleware('permission:home-page-edit', ['only' => ['edit', 'store']]);

        $this->homepageRepository = $homePageRepository;
    }

    public function index()
    {
        $components = $this->homepageRepository->all();
        return view('admin.homepage.index', compact('components'));
    }

    public function edit()
    {
        $components = $this->homepageRepository->all();
        return view('admin.homepage.edit', compact('components'));
    }

    public function store(Request $request)
    {
        $homepageComponents = $request->all();
        $this->homepageRepository->saveComponents(
          HomePage::PROMO_SLIDER_MINI_TYPE,
          $homepageComponents[HomePage::PROMO_SLIDER_MINI_TYPE] ?? []
        );
        $this->homepageRepository->saveComponents(
          HomePage::PROMO_SLIDER_TYPE,
          $homepageComponents[HomePage::PROMO_SLIDER_TYPE] ?? []
        );
        $this->homepageRepository->saveComponents(
          HomePage::RECOMMENDED_TYPE,
          $homepageComponents[HomePage::RECOMMENDED_TYPE] ?? []
        );
        $this->homepageRepository->saveComponents(
          HomePage::SPECIAL_PROJECTS_TYPE,
          $homepageComponents[HomePage::SPECIAL_PROJECTS_TYPE] ?? []
        );
        return Redirect::to('/admin/homepage');
    }
}
