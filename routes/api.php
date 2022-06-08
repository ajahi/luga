<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::group(['middleware' => ['cors']], function() {
//     Route::post('/login', 'Api\LoginController@login');
//     Route::get('/site', 'SiteController@index');
//     Route::get('/post', 'PostController@index');
//     Route::get('/post/categories','PostController@getTitleByCategories');
//     Route::get('/post/quicklink','PostController@getPostByKeyIfTrue');
//     Route::get('/post/{id}', 'PostController@show');
//     Route::get('/post/slug/{slug}', 'PostController@slug');
//     Route::get('/category', 'CategoryController@index');
//     Route::get('/category/{id}', 'CategoryController@show');
//     Route::get('/menu', 'MenuController@index');
//     Route::get('/menu/{id}', 'MenuController@show');
//     Route::get('/tag','TagController@index');
//     Route::get('/tag/{id}','TagController@show');
//     Route::get('/slider','SliderController@index');
//     Route::get('/slider/{id}','SliderController@show');


// });


// Route::group(['middleware' => ['cors','auth:api']], function() {

//     Route::get('/logout', 'Api\LoginController@logout');
//     Route::get('/auth/user', 'Api\LoginController@user');
//     Route::resource('site', 'SiteController', array('except' => array('index','show','update','destroy')));
//     Route::resource('user', 'UserController');
//     Route::resource('role', 'RoleController');
//     Route::resource('permission', 'PermissionController');
//     Route::resource('post', 'PostController', array('except' => array('index','show')));
//     Route::resource('category', 'CategoryController', array('except' => array('index','show')));
//     Route::resource('menu', 'MenuController', array('except' => array('index','show')));
//     Route::resource('slider', 'SliderController', array('except'=>array('index','show')));
//     Route::resource('tag','TagController');
//     Route::resource('contact','ContactController');
//     Route::post('/post/uploads', 'PostController@uploads');
//     Route::get('/media/{id}/{mediaID}', 'PostController@deleteMedia');
//     Route::post('/gallery/uploads', 'SiteController@uploadsGallery');
//     Route::get('/gallery/{id}/{mediaID}', 'SiteController@deleteMediaGallery');
//     Route::post('/site/upload', 'SiteController@uploadMedia');
//     Route::post('/site/media/delete', 'SiteController@deleteMedia');

//     Route::post('/tag','TagController@store');
//     Route::put('/tag/{id}','TagController@update');
//     Route::delete('/tag/{id}','TagController@destroy');

//     Route::put('/slider/{id','SliderController@update');
//     Route::delete('/slider/{id}','SliderController@delete');

// }); 
