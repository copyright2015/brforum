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

//Главная, там будут доски, и панель для логина.
Route::get('/', ['uses'=>'WelcomeController@show','as'=>'welcome']);
Route::post('/', 'WelcomeController@login');

//Страница о борде с правилами.
Route::get('/about', ['uses'=>'AboutController@show','as'=>'about']);

//Страница доски, с тредами.
//Route::get('/board/{board_prefix}',['uses'=>'BoardContoller@show','as'=>'board']);
Route::get('/{board_prefix}/threads',['uses'=>'BoardContoller@show','as'=>'board']);
Route::post('/{board_prefix}/threads','BoardContoller@add');

//Страница треда с постами.
Route::get('/{board_prefix}/thread/{thread_id}',['uses'=>'ThreadContoller@show','as'=>'thread']);
Route::post('/{board_prefix}/thread/{thread_id}',['uses'=>'ThreadContoller@add']);

//Страница настроек юзера
Route::get('/user/settings',['uses'=>'SettingsController@show', 'as'=>'settings', 'middleware'=>'auth']);
Route::post('/user/settings','SettingsController@save')->middleware('auth');

//создание жалобы
Route::get('/report/{post_id}',['uses'=>'SendReportController@show','as'=>'send_report']);
Route::post('/report/{post_id}',['uses'=>'SendReportController@send']);

//Группа админских роутов с посредником auth
Route::group(['prefix'=>'/admin', 'middleware'=>['auth','acl']], function(){

    //Главная страница админки. Ссылки на другие разделы админки и еще ченить полезное
    Route::get('/dashboard',['uses'=>'Admin\DashboardController@show','as'=>'admin_dashboard']);

    //Глобальные настройки
    //Доступно только админу
    Route::get('/globalset',['uses'=>'Admin\GlobalsetController@show','as'=>'admin_globalset']);
    Route::post('/globalset',['uses'=>'Admin\GlobalsetController@edit']);

    //Создание доски
    Route::get('/newboard',['uses'=>'Admin\NewBoardController@show','as'=>'admin_newboard']);
    Route::post('/newboard',['uses'=>'Admin\NewBoardController@create']);

    //Список банов. С возможностью разбанить.
    Route::get('/bans',['uses'=>'Admin\BansController@show','as'=>'admin_bans']);
    Route::post('/bans',['uses'=>'Admin\BansController@unban']);

    //Сообщения работающие в пределах админок и модерок
    Route::get('/inbox',['uses'=>'Admin\MessagesController@show','as'=>'admin_inbox']);
    Route::get('/message/{message_id}',['uses'=>'Admin\MessagesController@showMessage','as'=>'admin_view_message']);
    Route::post('/inbox',['uses'=>'Admin\MessagesController@send']);

    //Настройки доски. По типу бамплимита, лимита новых тредов, назавния, описания, количества картинок у постов и тд.
    Route::get('/boardset',['uses'=>'Admin\BoardSetController@show','as'=>'admin_board_set']);
    Route::post('/boardset',['uses'=>'Admin\BoardSetController@edit']);

    //Список жалоб.
    Route::get('/reports',['uses'=>'Admin\ReportController@show','as'=>'admin_reports']);
    Route::get('/report/{report_id}',['uses'=>'Admin\ReportController@showReport','as'=>'admin_view_report']);
    Route::post('/reports',['uses'=>'Admin\ReportController@operate']);
    Route::post('/report/{report_id}',['uses'=>'Admin\ReportController@ban']);

    //Очередь премодерации
    Route::get('/premod',['uses'=>'Admin\PremodController@show','as'=>'admin_premod']);
    Route::post('/premod',['uses'=>'Admin\PremodController@approve']);

    //Страница с баннерами доски.
    Route::get('/banners',['uses'=>'Admin\BannersController@show','as'=>'admin_banners']);
    Route::post('/banners',['uses'=>'Admin\BannersController@add']);

    //Список пользователей, с возможностью менять их роли.
    //Доступно только админу
    Route::get('/users',['uses'=>'Admin\UsersController@show','as'=>'admin_users']);
    Route::post('/users',['uses'=>'Admin\BansController@update']);

});
//роуты для авторазации.
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
