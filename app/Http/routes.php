<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\User;
use App\SiteSettings;
use App\Listing;
use Http\Controllers\AuthController;
use Http\Controllers\PasswordController;


// Authentication routes...
Route::get('/', 'Auth\AuthController@getLogin');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::controllers([
   'password' => 'Auth\PasswordController',
]);

/////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////
//	Dashboard Routes 										   //
////////////////////////////////////////////////////////////////
Route::get('/dashboard/home','DashboardController@getDashboard');

//Attachments Routes
Route::get('/dashboard/attachments/delete/{id}', 'AttachmentController@destroy');

//5 Minute Topic Routes
Route::get('/dashboard/5mintopics/all', 'DashboardController@get5MinuteTopics');
Route::get('/dashboard/5mintopics/view/{id}', 'FiveMinuteController@show');
Route::post('/dashboard/5mintopics/update/{id}', 'FiveMinuteController@update');
Route::post('/dashboard/5mintopics/create', 'FiveMinuteController@store');
Route::get('/dashboard/5mintopics/delete/{id}', 'FiveMinuteController@destroy');

//Search Routes
Route::get('/dashboard/5mintopics/search', 'SearchController@searchTopics');
Route::get('/dashboard/documents/search/', 'SearchController@searchDocuments');
Route::get('/dashboard/videos/search/', 'SearchController@searchVideos');

//Profile Routes
Route::get('/dashboard/profile', 'DashboardController@getProfile');
Route::post('/dashboard/profile/update/{id}', 'UserController@update');

//Users Routes
Route::get('/dashboard/users', 'DashboardController@getUsers');
Route::get('/dashboard/users/create', 'UserController@create');
Route::post('/dashboard/users/store', 'UserController@store');
Route::get('/dashboard/users/edit/{id}','UserController@edit');
Route::post('/dashboard/users/update/{id}', 'UserController@update');
Route::get('/dashboard/users/delete/', 'UserController@destroy');

//Site Setting Routes
Route::get('/dashboard/sitesettings', 'DashboardController@getSiteSettings');
Route::post('/dashboard/sitesettings/update/{id}', 'SiteSettingsController@update');

//Email Setting Routes
Route::get('/dashboard/emailsettings', 'DashboardController@getEmailSettings');

//Document Routes
Route::get('/dashboard/documents/view/cat/{document_category}', 'DocumentController@getDocuments');
Route::get('/dashbaord/documents/view/{id}', 'DocumentController@viewDocument');
Route::post('/dashboard/documents/upload', 'DocumentController@store');
Route::get('/dashboard/documents/delete/{id}', 'DocumentController@destroy');
Route::post('/dashboard/documents/update/{id}', 'DocumentController@update');
Route::get('/dashboard/documents/edit/{id}', 'DocumentController@edit');

//Video Routes
Route::get('/dashboard/videos/view/cat/{video_category}', 'VideoController@getVideos');
Route::get('/dashboard/videos/view/{id}', 'VideoController@viewVideo');
Route::post('/dashboard/videos/upload/', 'VideoController@store');
Route::get('/dashboard/videos/delete/{id}', 'VideoController@destroy');
Route::post('/dashboard/videos/update/{id}', 'VideoController@update');
Route::get('/dashboard/videos/edit/{id}', 'VideoController@edit');

//Post Routes
Route::post('/dashboard/posts/new', 'PostController@store');
Route::post('/dashboard/posts/update/{id}', 'PostController@update');
Route::get('/dashboard/posts/edit/{id}', 'PostController@edit');
Route::get('/dashboard/posts/delete/{id}', 'PostController@destroy');


Route::get('contact', function()
{
    $sitesettings = SiteSettings::find(1);
    return View::make('pages.contact' ,compact('sitesettings'));
});

