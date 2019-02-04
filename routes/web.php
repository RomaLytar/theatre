<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/user', function () {
    return view('layouts.user');
})->name('front.user.index');

Route::get('/user/{param}', function () {
    return view('layouts.user');
});
Route::get('/user/{param}/{param2}', function () {
    return view('layouts.user');
});
Route::get('/user/{param}/{param2}/{param3}', function () {
    return view('layouts.user');
});

Route::get('/ticket', function () {
    return view('layouts.ticket');
})->name('front.ticket.index');
Route::get('/ticket/{param}', function () {
    return view('layouts.ticket');
});
Route::get('/ticket/{param}/{param2}', function () {
    return view('layouts.ticket');
});
Route::get('/ticket/{param}/{param2}/{param3}', function () {
    return view('layouts.ticket');
});

Route::group(['prefix' => '', 'middleware' => ['front']], function () {
    Route::get('/', 'SiteController@index')->name('front.home');
    Route::get('/search', function () {
        return view('pages.theatre.pages.search');
    })->name('front.page.search');
    Route::get('/calendar', 'CalendarController@index')->name('front.calendar.index');
    Route::get('/repertoire', 'EventController@index')->name('front.events.index');
    Route::get('/events/{id}-{slug}', 'EventController@show')->name('front.events.show');
    Route::get('/synopsis/{id}-{slug}', 'EventController@synopsis')->name('front.events.synopsis');
    Route::get('/team', 'ActorController@index')->name('front.actors.index');
    Route::get('/team/artistic-management', 'ActorController@artistic_management')->name('front.team.artistic-management');
    Route::get('/team/management', 'ActorController@management')->name('front.team.management');
    Route::get('/team/directors', 'ActorController@directors')->name('front.team.directors');
    Route::get('/team/conductors', 'ActorController@conductors')->name('front.team.conductors');
    Route::get('/team/artists', 'ActorController@artists')->name('front.team.artists');
    Route::get('/team/troupe', function () {
        return redirect(route('front.team.troupe.opera-troupe'));
    })->name('front.team.troupe');
    Route::get('/team/troupe/opera-troupe', 'ActorController@troupe_opera')->name('front.team.troupe.opera-troupe');
    Route::get('/team/troupe/ballet-troupe', 'ActorController@troupe_ballet')->name('front.team.troupe.ballet-troupe');
    Route::get('/team/troupe/choir', 'ActorController@troupe_choir')->name('front.team.troupe.choir');
    Route::get('/team/troupe/orchestra', 'ActorController@troupe_orchestra')->name('front.team.troupe.orchestra');
    Route::get('/guest-artists', 'ActorController@guest_artists')->name('front.team.guest-artists');
    Route::get('/artist/{id}-{slug}', 'ActorController@show')->name('front.actors.show');
    Route::get('/festivals/{id}-{slug}', 'FestivalController@show')->name('front.festivals.show');
    Route::get('/albums', 'AlbumController@index')->name('front.albums.index');
    Route::get('/albums/{id}-{slug}', 'AlbumController@show')->name('front.albums.show');
    Route::get('/videos', 'VideoController@index')->name('front.videos.index');
    Route::get('/releases', 'ArticleController@releases')->name('front.articles.releases');
    Route::get('/releases/{id}-{slug}', 'ArticleController@release')->name('front.articles.release');
    Route::get('/about', 'ArticleController@about')->name('front.articles.about');
    Route::get('/articles/{id}-{slug}', 'ArticleController@article')->name('front.articles.article');
    Route::post('/subscribe', 'SubscribeController@subscribe')->name('front.subscribe.subscribe');
    Route::get('/verify/{token}', 'SubscribeController@verify')->name('front.subscribe.verify');
    Route::get('/partners', 'PartnerController@index')->name('front.partners.index');
    Route::get('/partners/{id}', 'PartnerController@show')->name('front.partners.show');
    Route::get('/faq', 'FaqController@index')->name('front.faqs.index');
    Route::get('/documentations/{id}-{slug}', 'DocController@index')->name('front.docs.index');
    Route::get('/ebooks', 'EbookController@index')->name('front.ebooks.index');
    Route::get('/friends', 'PageController@friendsMaecenas')->name('front.pages.friends');
    Route::get('/jobs', 'PageController@jobs')->name('front.pages.jobs');
    Route::get('/halls', 'PageController@halls')->name('front.pages.halls');
    Route::get('/hall/{id}-{slug}', 'HallController@show')->name('front.hall.show');
    Route::get('/projects/{id}-{slug}', 'ProjectController@show')->name('front.projects.show');
    Route::get('/educations', 'PageController@educations')->name('front.projects.educations');
    Route::get('/educational-programs', 'PageController@educationalPrograms')->name('front.projects.educationalPrograms');
    Route::get('/international-partnership', 'PageController@internationalPartnership')->name('front.projects.internationalPartnership');
    Route::get('/contests', 'PageController@contests')->name('front.contests.contests');
    Route::get('/contests/{id}-{slug}', 'ProjectController@contests')->name('front.contests.contest');
    Route::get('/where-to-go', 'PageController@whereToGo')->name('front.page.wheretogo');
    Route::get('/support', 'PageController@support')->name('front.page.support');
    Route::get('/virtual-tour', 'PageController@virtual')->name('front.page.virtual');
    Route::get('/other', 'PageController@other')->name('front.page.different');
    Route::get('/creative-projects/{id}-{slug}', 'ProjectController@creative')->name('front.creative.show');
    Route::get('/vacancies/{id}-{slug}', 'VacancyController@show')->name('front.vacancies.show');
    Route::get('/services', 'ServiceController@index')->name('front.services.index');
    Route::get('/offstage', 'PageController@offstage')->name('front.pages.offstage');
    Route::get('/board-of-trustees', 'PageController@teamTrust')->name('front.pages.teamTrust');
    Route::get('/join-the-league-of-patrons', 'PageController@joinLeague')->name('front.pages.joinLeague');
    Route::get('/join-the-club', 'PageController@joinClub')->name('front.pages.joinClub');
    Route::get('/season-premiere', 'PageController@seasonPremiere')->name('front.pages.seasonPremiere');
    Route::get('/tour-schedule', 'PageController@tourSchedule')->name('front.pages.tourSchedule');
    Route::get('/special-events', 'PageController@specialEvents')->name('front.pages.specialEvents');
    Route::get('/muzhab', 'PageController@muzhab')->name('front.pages.muzhab');
    Route::get('/festivals', 'PageController@festivals')->name('front.pages.festivals');
    Route::get('/{name}', 'PageController@show')->name('front.pages.show');

    Route::get('ticket-download/{orderHash}', 'Api\v1\OrderController@formPdf');
});

Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\controllers\LfmController@show');
Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\controllers\UploadController@upload');
Route::get('/actor/search', 'ActorController@search');
Route::get('/performance/search', 'PerformanceController@search');
Route::post('/language/change', 'LanguageController@change');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'permission:admin-browse']], function () {
    Route::get('dashboard', 'Admin\IndexController@index');
    Route::resource('banners', 'Admin\BannerController');
    Route::get('homepage', 'Admin\HomePageController@index');
    Route::post('homepage', 'Admin\HomePageController@store');
    Route::get('homepage/edit', 'Admin\HomePageController@edit');
    Route::get('search/performance', 'SearchController@performance');
    Route::get('performance/get-new-date-section', 'Admin\PerformanceController@getNewDateSection');
    Route::post('/show', 'Admin\MessageController@show')->name('front.messages.show');
    Route::resource('performance', 'Admin\PerformanceController');
    Route::resource('performance-types', 'Admin\PerformanceTypeController');
    Route::resource('performance-roles', 'Admin\PerformanceRoleController')->only(['edit', 'update']);
    Route::resource('actor', 'Admin\ActorController');
    Route::resource('actor_groups', 'Admin\ActorGroupController');
    Route::resource('actor-roles', 'Admin\ActorRoleController');
    Route::resource('articles', 'Admin\ArticleController');
    Route::resource('article-categories', 'Admin\ArticleCategoryController');
    Route::resource('festival', 'Admin\FestivalController');
    Route::resource('menu', 'Admin\MenuController');
    Route::resource('settings', 'Admin\SettingController');
    Route::resource('users', 'Admin\UserController');
    Route::get('profile', 'Admin\ProfileController@edit')->name('profile.edit');
    Route::patch('profile', 'Admin\ProfileController@update')->name('profile.update');
    Route::resource('roles', 'Admin\RoleController');
    Route::resource('permissions', 'Admin\PermissionController');
    Route::resource('albums', 'Admin\AlbumController');
    Route::resource('album-categories', 'Admin\AlbumCategoryController');
    Route::resource('videos', 'Admin\VideoController');
    Route::resource('video-categories', 'Admin\VideoCategoryController');
    Route::resource('seasons', 'Admin\SeasonController');
    Route::resource('subscribers', 'Admin\SubscribeController');
    Route::resource('faqs', 'Admin\FaqController');
    Route::resource('ebooks', 'Admin\EbookController');
    Route::resource('faqs-categories', 'Admin\FaqCategoryController');
    Route::resource('programs', 'Admin\ProgramsController');
    Route::resource('documentations', 'Admin\DocumentationController');
    Route::resource('documentation-categories', 'Admin\DocumentationCategoryController');
    Route::resource('partners', 'Admin\PartnerController');
    Route::resource('partner-categories', 'Admin\PartnerCategoryController');
    Route::resource('pages', 'Admin\PageController');
    Route::resource('attributes', 'Admin\AttributeController');
    Route::resource('services', 'Admin\ServiceController');
    Route::resource('projects', 'Admin\ProjectController');
    Route::resource('project-categories', 'Admin\ProjectCategoryController');
    Route::resource('vacancies', 'Admin\VacancyController');
    Route::resource('messages', 'Admin\MessageController');
    Route::resource('price-patterns', 'Admin\PricePatternController');
    Route::resource('hall-price-patterns', 'Admin\HallPricePatternController');
    Route::resource('distributors', 'Admin\DistributorController');
    Route::resource('halls', 'Admin\HallController');
    Route::resource('leftovers', 'Admin\LeftoverController')->only('store');
    Route::resource('ticket-templates', 'Admin\TicketTemplateController')->except(['create', 'edit']);
    Route::resource('donations', 'Admin\DonationController')->only(['index']);

    Route::get('distributors-list', 'Admin\DistributorController@getList'); // API
    Route::put('price-patterns/{id}/price-zones', 'Admin\PricePatternController@updatePriceZones')
        ->name('price-patterns.updatePriceZones');
    Route::get('hallWithSeats/{hallPricePatternId}', 'Admin\HallPricePatternController@getHallWithSeats'); // API
    Route::get('pricePatterns/{pricePatternId}', 'Admin\PricePatternController@getPricePattern'); // // API get price zones list from price pattern
    Route::put('hall-price-patterns/{id}/seat-prices', 'Admin\HallPricePatternController@updateSeatPrice')
        ->name('hall-price-patterns.updateSeatPrices'); // API
    Route::put('hall-price-patterns/{id}/seat-prices-simple', 'Admin\HallPricePatternController@updateSeatPriceSimple')
        ->name('hall-price-patterns.updateSeatPricesSimple');

    Route::get('halls/{id}/images', 'Admin\HallController@showImages')
        ->name('halls.show-images');
    Route::get('hallSeats/{id}', 'Admin\HallController@getHallSeats')
        ->name('halls.getSeats'); // API
    Route::put('halls/{id}/updateSeats', 'Admin\HallController@updateHallSeats')
        ->name('halls.updateSeats'); // API
    Route::put('halls/{id}/update-seat-posters', 'Admin\HallController@updateHallSeatPosters')
        ->name('halls.updateSeatPosters'); // API

    Route::put('performance/{id}/updateDates', 'Admin\PerformanceController@updateDates')
        ->name('performance.updateDates');
    Route::get('performanceCalendars/{id}/generateTickets', 'Admin\PerformanceCalendarController@generateTickets')
        ->name('performanceCalendar.generateTickets');
    Route::get('performanceCalendars/{id}/manageTickets', 'Admin\PerformanceCalendarController@manageTickets')
        ->name('performanceCalendar.manageTickets');
    Route::get('performanceCalendars/{id}/getDateWithTickets', 'Admin\PerformanceCalendarController@getDateWithTickets')
        ->name('performanceCalendar.getDateWithTickets'); // API
    Route::put('performanceCalendars/{id}/updateDateTickets', 'Admin\PerformanceCalendarController@updateDateTickets')
        ->name('performanceCalendar.updateDateTickets'); // API
    Route::put('performanceCalendars/{id}/updateDateTicketsSimple', 'Admin\PerformanceCalendarController@updateDateTicketsSimple')
        ->name('performanceCalendar.updateDateTicketsSimple'); // API
    Route::get('performanceCalendars/{id}/dropTickets', 'Admin\PerformanceCalendarController@dropTickets')
        ->name('performanceCalendar.dropTickets');

    // For CashBox
    Route::group(['prefix' => 'cash-box', 'middleware' => ['permission:tickets-sold']], function () {
        Route::post('orders/create', 'Admin\OrderController@create')
            ->name('cash-box.orders.create');
        Route::post('orders/create-for-distributor', 'Admin\OrderController@createForDistributor')
            ->name('cash-box.orders.create-for-distributor');
        Route::get('orders/search', 'Admin\OrderController@search')
            ->name('cash-box.orders.search');
        Route::post('orders/{id}/return', 'Admin\OrderController@return')
            ->name('cash-box.orders.return');
        Route::post('orders/{id}/confirm', 'Admin\OrderController@confirm')
            ->name('cash-box.orders.confirm');
        Route::delete('orders/{id}', 'Admin\OrderController@deleteBooking')
            ->name('cash-box.orders.delete-booking');
        Route::get('coming-dates', 'Admin\CashBoxController@comingDates'); // API for retrieving coming dates with events
        Route::get('events-date', 'Admin\CashBoxController@eventsDate'); // API for retrieving events on defined date
        Route::get('orders-date', 'Admin\OrderController@getPerDay'); // API for retrieving orders on defined date for cashier
    });

    Route::group(['prefix' => 'reports', 'middleware' => ['permission:report-list']], function () {
        Route::get('', 'Admin\ReportController@index')
            ->name('reports.index');
        Route::get('employee-sold', 'Admin\ReportController@employeeSold', ['middleware' => ['permission:report-list-own']])
            ->name('reports.employee-sold');
        Route::group(['middleware' => ['permission:report-list-total']], function () {
            Route::get('sold-period', 'Admin\ReportController@soldPeriod')
                ->name('reports.sold-period');
            Route::get('distributors-sold', 'Admin\ReportController@distributorsSold')
                ->name('reports.distributors-sold');
            Route::get('sold-price-groups', 'Admin\ReportController@soldPriceGroups')
                ->name('reports.sold-price-groups');
            Route::get('event-sold-price-groups', 'Admin\ReportController@eventSoldPriceGroups')
                ->name('reports.event-sold-price-groups');
            Route::get('event-tickets-sold', 'Admin\ReportController@eventTicketsSold')
                ->name('reports.event-tickets-sold');
            Route::get('detailed-sold', 'Admin\ReportController@detailedSold')
                ->name('reports.detailed-sold');
        });
    });

    Route::get('concierge', 'Admin\ConciergeController@index')->name('concierge.index');

    Route::group(['prefix' => 'cash-box', 'middleware' => ['permission:tickets-sold']], function () {
        Route::get('/', function () {
            return view('layouts.cash-box');
        })->name('cash-box.index');
        Route::get('/{param}', function () {
            return view('layouts.cash-box');
        });
        Route::get('/{param}/{param2}', function () {
            return view('layouts.cash-box');
        });
        Route::get('/{param}/{param2}/{param3}', function () {
            return view('layouts.cash-box');
        });
    });

    Route::group(['prefix' => 'tickets-designer', 'middleware' => ['permission:ticket-designer-manage']], function () {
        Route::get('/', function () {
            return view('layouts.tickets-designer');
        })->name('tickets-designer.index');
        Route::get('/{param}', function () {
            return view('layouts.tickets-designer');
        });
        Route::get('/{param}/{param2}', function () {
            return view('layouts.tickets-designer');
        });
        Route::get('/{param}/{param2}/{param3}', function () {
            return view('layouts.tickets-designer');
        });
    });
});

Route::get('dev/update', 'DevController@update');
