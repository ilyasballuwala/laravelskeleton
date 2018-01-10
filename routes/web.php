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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/our_community', 'PropertyController@index');


// Add new routes for admin login, registration, forgot and reset password
Route::get('/admin','Adminauth\LoginController@showLoginForm');
Route::get('/admin/login','Adminauth\LoginController@showLoginForm');
Route::post('/admin/login','Adminauth\LoginController@adminLogin');
Route::get('/admin/register','Adminauth\LoginController@showRegistrationForm');
Route::post('/admin/register','Adminauth\RegisterController@register');
Route::get('/admin/password/reset','Adminauth\ForgotPasswordController@showForgotPasswordForm');
Route::post('/admin/password/email','Adminauth\ForgotPasswordController@sendResetLinkEmail');
Route::get('/admin/password/reset/{token}','Adminauth\ResetPasswordController@showResetPasswordForm');
Route::post('/admin/password/reset','Adminauth\ResetPasswordController@reset');

/** General Property Listing and CMS Info **/
Route::get('/property/{propertyurl?}', 'PropertyController@propertydetail')->where(['propertyurl' => '[A-Za-z_.-]+']);
Route::get('/property/gallary/{propertyurl?}', 'PropertyController@propertygallary')->where(['propertyurl' => '[A-Za-z_.-]+']);
Route::get('/property/contact/{propertyurl?}', 'PropertyController@getPropertycontact')->where(['propertyurl' => '[A-Za-z_.-]+']);
Route::post('/property/contact/{propertyurl?}', 'PropertyController@propertycontact')->where(['propertyurl' => '[A-Za-z_.-]+']);
Route::get('/apartments/{statename?}/efficient_property_management', 'PropertyController@propertylisting')->where(['statename' => '[A-Za-z_.-]+']);
Route::get('/contact', 'HomeController@getEfficientcontact');
Route::post('/contact', 'HomeController@efficientcontact');
Route::post('/findpropertyzipcode', 'HomeController@findpropertyzipcode');
Route::get('/{cmspage?}', 'HomeController@cmspage')->where(['cmspage' => '[a-z_.-]+']);

// Add new routes for admin
Route::group(['prefix' => '/admin'],function(){
    Route::get('/','admin\DashboardController@index');
	Route::get('/dashboard','admin\DashboardController@index');
});

// Add new route for 'admin' middleware
Route::group(['middleware' => ['admin']],function(){
	
	// Logout routes
    Route::post('/admin/logout','Adminauth\LoginController@logout');
	Route::get('/admin/logout','Adminauth\LoginController@logout');
	// Change password routes 
	Route::get('/admin/changepass','admin\AdminController@getChangePass');
	Route::post('/admin/changepass','admin\AdminController@changePass');
	// Change Profile routes
	Route::get('/admin/profile','admin\AdminController@profile');
	Route::post('/admin/profile','admin\AdminController@postprofile');
	// Community routes
	
	//Admin Module Routes
	Route::get('/admin/websitecontact','admin\DashboardController@websitecontact');
	Route::get('/admin/propertycontact','admin\DashboardController@propertycontact');
	Route::get('/admin/dashboard/homepagefields','admin\DashboardController@homepagefields');
	Route::post('/admin/dashboard/homepagefields','admin\DashboardController@postHomepagefields');
	Route::resource('admin/state', 'admin\StateController',['except' => ['destroy']]);
	Route::resource('admin/city', 'admin\CityController',['except' => ['destroy']]);
	Route::resource('admin/cms', 'admin\CMSController',['except' => ['destroy']]);
	Route::resource('admin/property', 'admin\PropertyController',['except' => ['destroy']]);
	Route::post('/admin/property/getcity','admin\PropertyController@getcity');
	Route::post('/admin/property/savegeneralinfo','admin\PropertyController@savegeneralinfo');
	Route::post('/admin/property/saveroomsinfo','admin\PropertyController@saveroomsinfo');
	Route::post('/admin/property/saveamenitiesinfo','admin\PropertyController@saveamenitiesinfo');
	Route::post('/admin/property/saveseoinfo','admin\PropertyController@saveseoinfo');
	Route::post('/admin/property/savepropertyimages','admin\PropertyController@savepropertyimages');
	Route::post('/admin/property/deletepropertyimage','admin\PropertyController@deletepropertyimage');
	
	//State Delete
	Route::get('admin/delete/state/{table?}/{field?}/{id?}', 'admin\StateController@delete')->where(['table' => '[a-z_]+', 'id' => '[0-9]+']);
	//City Delete
	Route::get('admin/delete/city/{table?}/{field?}/{id?}', 'admin\CityController@delete')->where(['table' => '[a-z_]+', 'id' => '[0-9]+']);
	//Property Delete
	Route::get('admin/delete/property/{table?}/{field?}/{id?}', 'admin\PropertyController@delete')->where(['table' => '[a-z_]+', 'id' => '[0-9]+']);
	//Property Delete
	Route::get('admin/delete/dashboard/{table?}/{field?}/{id?}', 'admin\DashboardController@deleteimage')->where(['table' => '[a-z_]+', 'id' => '[0-9]+']);
	
	//Common Delete Route
	Route::get('admin/delete/{controller?}/{table?}/{field?}/{id?}', 'admin\Controller@generaldelete')->where(['table' => '[a-z_]+', 'id' => '[0-9]+']);
	
});

Route::prefix('api/v1')->group(function() {
    //Route::get('/ecabs/{mode?}', 'APIController@index')->where(['mode' => '[a-zA-Z_]+']);
	Route::post('/globalaction', 'api\APIController@index');
	Route::get('/verifyrider/{riderid?}/{verificationcode?}', 'api\APIController@verifyrider')->where(['riderid' => '[0-9]+', 'verificationcode' => '[a-zA-Z0-9_]+']);
	Route::get('/verifydriver/{driverid?}/{verificationcode?}', 'api\APIController@verifydriver')->where(['driverid' => '[0-9]+', 'verificationcode' => '[a-zA-Z0-9_]+']);
});
