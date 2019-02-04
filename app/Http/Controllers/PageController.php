<?php

namespace App\Http\Controllers;


use App\Models\Festival;
use App\Models\LiqPay;
use App\Models\Performance;

use App\Models\Actor;
use App\Models\ActorGroup;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\PerformanceCalendar;
use App\Models\PerformanceType;
use App\Models\Season;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Request;
use Lavary\Menu\Collection;
use SEO;
use App\Models\Page;
use App\Models\Project;
use App\Models\Hall;
use App\Models\ProjectCategory;
use Carbon\Carbon;

class PageController extends Controller
{

    public function show(Page $name)
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')->find($name)->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);

        $viewName = 'pages.theatre.pages.' . $page->name;
        if (\View::exists($viewName)) {
            return view($viewName, compact('page'));
        }
        return abort(404);
    }

    public function offstage()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')->where('name', 'offstage')->first();
        $articleCategory = ArticleCategory::where('page', 'offstage')->first();
        $articles = Article::with('translate', 'media')->where('category_id', $articleCategory->id)->paginate(6);
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);
        return view('pages.theatre.pages.offstage', compact('page', 'articles'));
    }

    public function teamTrust()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')->where('name', 'board-of-trustees')->first();
        $actorGroup = ActorGroup::where('name', 'board-of-trustees')->first();
        $actors = Actor::with('translate')->where('group_id', $actorGroup->id)->paginate(8);
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);
        return view('pages.theatre.pages.board-of-trustees', compact('page', 'actors'));
    }

    public function joinLeague()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'join-the-league-of-patrons')->first();
        $projectCategory = ProjectCategory::with('translate')->where('name', 'opera-projects')->first();
        $projects = Project::with('translate')->where('category_id', $projectCategory->id)->get();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);
        return view('pages.theatre.pages.join-the-league-of-patrons', compact('page', 'projects'));
    }

    public function joinClub()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'join-the-club')->first();

        $projectCategory = ProjectCategory::with('translate')->where('name', 'opera-projects')->first();
        $projects = Project::with('translate')->where('category_id', $projectCategory->id)->get();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);
        return view('pages.theatre.pages.join-the-club', compact('page', 'projects'));
    }

    public function friendsMaecenas()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'friends-maecenas')->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);

        $projectCategory = ProjectCategory::with('translate')->where('name', 'friends-maecenas')->first();
        $project = Project::with('translate')->where('category_id', $projectCategory->id)->get();

        return view('pages.theatre.pages.friends-maecenas', compact('projectCategory', 'page', 'project', 'projects'));
    }

    public function contests()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'contests')->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);

        $projectCategory = ProjectCategory::with('translate')->where('name', 'contests')->first();

        $projects = Project::with('translate')->where('category_id', $projectCategory->id)->get();

        return view('pages.theatre.pages.helpful_creative_competitions',
            compact('projectCategory', 'page', 'projects'));
    }

    public function halls()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'halls')->first();

        $halls = Hall::with('translate')->get();

        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);

        return view('pages.theatre.pages.visit_plan_halls', compact('page', 'halls'));
    }

    public function jobs()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'helpful-job')->first();

        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);

        $vacancy = Vacancy::with('translate')->where('is_active', 1)->get();

        return view('pages.theatre.pages.helpful-job', compact('vacancy', 'page'));
    }

    public function educations()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'education')->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);

        $education_category = ProjectCategory::where('name', 'education')->first();
        $projects = Project::with('translate')->where('category_id', $education_category->id)->get();

        return view('pages.theatre.pages.helpful_education', compact('page', 'projects'));
    }

    public function educationalPrograms()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'educational-programs')->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);

        $education_category = ProjectCategory::where('name', 'education')->first();
        $projects = Project::with('translate', 'media')->where('category_id', $education_category->id)->paginate(9);
        $articles = Article::with('translate', 'media')->latest()->limit(3)->get();

        return view('pages.theatre.pages.educational-programs', compact('page', 'projects', 'articles'));
    }

    public function internationalPartnership()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'international-partnership')->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);

        $education_category = ProjectCategory::where('name', 'international-partnership')->first();
        $projects = Project::with('translate', 'media')->where('category_id', $education_category->id)->paginate(9);
        $articles = Article::with('translate', 'media')->latest()->limit(3)->get();

        return view('pages.theatre.pages.international-partnership', compact('page', 'projects', 'articles'));
    }

    public function whereToGo()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'where-to-go')->first();

        $events = PerformanceCalendar::where('date', '>', date('Y-m-d'))->orderBy('date')->limit(3)->get();

        $articleCategory = ArticleCategory::where('page', 'exhibitions')->first();
        $articles = Article::with('translate', 'media')->where('category_id', $articleCategory->id)->get();

        $recommended = Performance::with('dates')->whereHas('dates', function ($query) {
            $query->whereDate('date', '>=', Carbon::now());
        })->limit(3)->offset(0)->get();;

        return view('pages.theatre.pages.visit_where_to_go', compact('page', 'events', 'articles', 'promo', 'recommended'));
    }

    public function support()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'support')->first();

        $paymentData = $this->formDataForPayment();

        $projects = Project::with('translate')->limit(12)->get();

        return view('pages.theatre.pages.support_project', compact('page', 'projects', 'paymentData'));
    }

    public function seasonPremiere()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')->where('name', 'season-premiere')->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);
        $categoryId = \Input::get('category_id');
        $currentCategory = null;
        $season = Season::latest()->first();

        $events = Performance::with('translate', 'type', 'type.translate')->where('isPremiere', 1);
        if ($categoryId) {
            $events = $events->where(['type_id' => $categoryId]);
            $currentCategory = PerformanceType::find($categoryId);
        }
        $events = $events->where(['season_id' => $season->id])->latest();
        if (!$categoryId) {
            $events = $events->limit(3);
        }
        $events = $events->get();

        $categories = PerformanceType::with('translate')->get();

        $articles = new \Illuminate\Database\Eloquent\Collection;
        foreach ($events as $event) {
            $articles = $articles->merge($event->articles);
        }
        $articles = $articles->sortBy('created_at')->slice(0, 3);

        if (\count($articles) === 0) {
            $articles = Article::with('translate')->latest()->limit(3)->get();
        }

        foreach ($page->blocks as $block):
            foreach ($block->getMedia('album-images') as $images):
                $images = $block->getMedia('album-images');
            endforeach;
        endforeach;

        return view('pages.theatre.pages.season-premieres', compact('page', 'categories', 'events', 'articles', 'currentCategory', 'images'));
    }

    public function tourSchedule()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')->where('name', 'tour-schedule')->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);

        $currentCategory = PerformanceType::where('name', 'tour')->first();
        $season = Season::latest()->first();

        $events = Performance::with('translate', 'type', 'type.translate')
            ->where('type_id', $currentCategory->id)
            ->where(['season_id' => $season->id])
            ->latest()
            ->limit(6)
            ->get();
        $articles = new \Illuminate\Database\Eloquent\Collection;
        foreach ($events as $event) {
            $articles = $articles->merge($event->articles);
        }
        $articles = $articles->sortBy('created_at')->slice(0, 3);

        if (\count($articles) === 0) {
            $articles = Article::with('translate')->latest()->limit(3)->get();
        }

        return view('pages.theatre.pages.tour-schedule', compact('page', 'events', 'articles'));
    }

    public function other()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'other')->first();

        $performance = Performance::with('translate')->paginate(6);

        return view('pages.theatre.pages.visit_tour_other', compact('page', 'performance'));
    }

    public function virtual()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')
            ->where('name', 'virtual-tour')->first();
        foreach ($page->blocks as $block):
            $pages = $page->paginate();
            foreach ($block->getMedia('album-images') as $images):
                $images = $block->getMedia('album-images');
                $images = $this->paginate($images, 8, \Input::get('page'));
            endforeach;
        endforeach;
        return view('pages.theatre.pages.virtual-tour', compact('page', 'performance', 'item', 'images', 'pages'));
    }


    public function specialEvents()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')->where('name', 'special-events')->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);


        $categoryId = \Input::get('category_id');
        $currentCategory = null;
        $season = Season::latest()->first();

        $events = Performance::with('translate', 'type', 'type.translate')->where('isSpecial', 1);
        if ($categoryId) {
            $events = $events->where(['type_id' => $categoryId]);
            $currentCategory = PerformanceType::find($categoryId);
        }
        $events = $events->where(['season_id' => $season->id])->latest();

        if (!$categoryId) {
            $events = $events->limit(3);
        }
        $events = $events->get();
        $categories = PerformanceType::with('translate')->get();

        $articles = new \Illuminate\Database\Eloquent\Collection;
        foreach ($events as $event) {
            $articles = $articles->merge($event->articles);
        }
        $articles = $articles->sortBy('created_at')->slice(0, 3);

        if (\count($articles) === 0) {
            $articles = Article::with('translate')->latest()->limit(3)->get();
        }

        foreach ($page->blocks as $block):
            foreach ($block->getMedia('album-images') as $images):
                $images = $block->getMedia('album-images');
            endforeach;
        endforeach;

        return view('pages.theatre.pages.special-events', compact('page', 'categories', 'events', 'articles', 'currentCategory', 'images'));
    }

    public function muzhab()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')->where('name', 'muzhab')->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);
        $date = date('Y-m-d H:i:s');
        $events = PerformanceCalendar::whereDate('date', '>=', $date)->orderBy('date')->limit(3)->get();

        $articles = new \Illuminate\Database\Eloquent\Collection;
        foreach ($events as $event) {
            if ($event->articles !== null) {
                $articles = $articles->merge($event->articles);
            }
        }
        $articles = $articles->sortBy('created_at')->slice(0, 3);

        if (\count($articles) === 0) {
            $articles = Article::with('translate')->latest()->limit(3)->get();
        }
        foreach ($page->blocks as $block):
            foreach ($block->getMedia('album-images') as $images):
                $images = $block->getMedia('album-images');
            endforeach;
        endforeach;
        return view('pages.theatre.pages.muzhab', compact('page', 'events', 'articles', 'images'));
    }


    public function festivals()
    {
        $page = Page::with('translate', 'blocks', 'blocks.translate', 'media', 'blocks.media')->where('name', 'festivals')->first();
        SEO::setTitle($page->translate->seo_title ?: $page->translate->title);
        SEO::setDescription($page->translate->seo_description);

        $festivals = Festival::with('translate', 'media')->latest()->get();

        $articles = Article::with('translate')->latest()->limit(3)->get();

        foreach ($page->blocks as $block):
            foreach ($block->getMedia('album-images') as $images):
                $images = $block->getMedia('album-images');
            endforeach;
        endforeach;

        return view('pages.theatre.pages.festivals', compact('page', 'festivals', 'articles', 'images'));
    }

    protected function formDataForPayment() {
        $language = session('lang');
        $publicKey = env('LIQ_PAY_PUBLIC_KEY');
        $privateKey = env('LIQ_PAY_PRIVATE_KEY');

        $liqPay = new LiqPay($publicKey, $privateKey);
        $liqPayParams = $liqPay->cnb_form(array(
            'action'         => 'paydonate',
            'amount'         => '',
            'currency'       => 'UAH',
            'description'    => 'Пожертва, ресурс - ' . route(\Route::currentRouteName()),
            'server_url'     => route('api.v1.donations.update'),
            'result_url'     => route(\Route::currentRouteName()),
            'language'       => $language,
            'version'        => '3',
            'sandbox'        => env('LIQ_PAY_SANDBOX')
        ));

        return $liqPayParams;
    }
}
