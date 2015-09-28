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

//Route::get('/', 'WelcomeController@index');

//Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


//Beginning of all the routes
Route::get('/','HomeController@index'); 
Route::get('home','HomeController@home'); 

Route::group(['prefix'=>'authenticate'],function(){
	Route::get('signup','HomeController@sign_up'); 
	Route::get('signin','HomeController@sign_in'); 
	Route::post('signup','AuthenticateController@register');
	Route::post('signin','AuthenticateController@login');  
}); 

//CRUD Activities
Route::resource('activity','ActivityController'); 
Route::get('activity/delete/{id}','ActivityController@destroy'); 

//CRUD Events
Route::resource('event','EventController'); 
Route::get('event/delete/{id}','EventController@destroy');

//CRUD special Events
Route::resource('special','SpecialEventsController');  
Route::get('special/delete/{id}','SpecialEventsController@destroy');


Route::get('subscribe','SubscriberController@getAllActivities'); 
Route::post('subscribe','SubscriberController@firstTimeSubscribe'); 


Route::post('contact','ContactController@getMessage');

Route::get('get/activities','ActivityController@getActivities'); 
Route::get('get/events','EventController@getEvents'); 
Route::get('get/special','SpecialEventsController@getSpecials'); 
//Route::get('test','HomeController@sign_up'); 