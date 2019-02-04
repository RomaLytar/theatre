<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Api\Auth', 'middleware' => 'api'], function () {
    Route::post('register', 'AuthController@register')->name('api.user.register');
    Route::post('activate', 'AuthController@activation')->name('api.user.activation');
    Route::post('login', 'AuthController@login')->name('api.user.login');
    Route::post('logout', 'AuthController@logout')->name('api.user.logout');
    Route::group(['prefix' => 'password'], function () {
        Route::post('create', 'PasswordResetController@create');
        Route::post('find', 'PasswordResetController@find');
        Route::post('reset', 'PasswordResetController@reset');
    });
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('profile', 'AuthController@user')->name('api.user.profile');
        Route::patch('profile/update', 'AuthController@updateUser')->name('api.user.register');
        Route::get('tickets', 'AuthController@tickets')->name('api.user.tickets');
    });
});

Route::group(['namespace' => 'Api\v1', 'prefix' => 'v1'], function() {
    Route::resource('performance', 'PerformanceController');
    Route::resource('calendar', 'CalendarController');
    Route::resource('album', 'AlbumController');
    Route::resource('album-festival', 'FestivalController');
    Route::get('media-albums', 'MediaController@indexAlbum');
    Route::get('media-videos', 'MediaController@indexVideo');
    Route::get('search', 'SearchController@index');
    Route::get('countries', 'CountryController@index');
    Route::get('menu', 'MenuController@index');
    Route::get('pages/{pageName}', 'PageController@show');
    Route::get('events/{id}/tickets', 'EventController@getTickets');
    Route::get('events/{id}/price-zones', 'EventController@getPriceZones');
    Route::get('performances/{id}/dates', 'EventController@getAllPerformanceDates');
    Route::post('tickets/information', 'TicketController@ticketsInformation');
    Route::post('tickets/details', 'TicketController@ticketsDetails');
    Route::post('tickets/reservation', 'TicketController@reservationTickets');
    Route::post('tickets/reservation/{dateId}', 'TicketController@reservationCount');
    Route::post('tickets/cancel-reservation', 'TicketController@cancelReservationTickets');
    Route::get('tickets/activate/{eventId}/{orderId}-{ticketId}', 'TicketController@activate', ['middleware' => ['permission:ticket-activation']]);

    Route::post('orders/create-order', 'OrderController@createOrderOnline');
    Route::get('orders/payment-code', 'OrderController@generatePaymentCode');
    Route::post('orders/update', 'OrderController@updateStatus')->name('api.v1.orders.update');
    Route::post('orders/details', 'OrderController@details');
    Route::get('ticket-template', 'TicketTemplateController@show');
    Route::post('donations/update', 'DonationController@store')->name('api.v1.donations.update');

    Route::get('settings', 'SettingController@index');
});

