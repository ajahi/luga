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
use Illuminate\Support\Facades\Auth;

Route::get('/', 'Api\LoginController@login');

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/login');
});

Route::get('/','ShopController@index');
Route::get('/add-to-cart/{id}','ProductController@getaddToCart');
Route::get('/shopingcart','ShopController@getCart');
Route::get('/buy','ProductController@buy');
Route::get('/checkout','ProductController@getCheckout');
Route::get('/reduce/{id}','ProductController@getReduceByOne');
Route::get('/increase/{id}','ProductController@IncreaseByOne');
Route::get('/remove/{id}','ProductController@remove');
Route::get('/product-detail/{slug}','ShopController@details');
Route::get('buynow/{id}','ProductController@buyNow');
Route::get('/shop','ShopController@shop');
Route::post('mails','MailController@store');

Route::get('/shop-category/{slug}','ShopController@shopcat');
Route::get('/about-us','ShopController@aboutus');
Route::get('/our-services','ShopController@ourservices');
Route::get('/our-gallery','ShopController@gallery');
Route::get('/contact-us','ShopController@contact');
Route::get('/our-blogs','ShopController@blogs');
Route::get('blog/{slug}','ShopController@singleblog');

Route::post('/login', 'Api\LoginController@login');
Route::get('/newcart',function(){
    Session::flush();
   
});
Route::get('ajaxrequest','HomeController@ajax');
Route::post('ajaxRequest','HomeController@ajaxpost');
Route::post('/order','ProductController@order');
Route::get('search','ShopController@search');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/post', 'PostController@index');
    Route::post('/posts', 'PostController@store');
    Route::get('/postcreate','PostController@create');
    Route::get('/postshow/{id}','PostController@show');
    Route::get('post/{id}','PostController@edit');
    Route::put('post/{id}','PostController@update');
    Route::delete('postdel/{id}','PostController@destroy');

    Route::get('order','OrderController@index');
    Route::get('order/{id}','OrderController@show');
    Route::delete('orderdel/{id}','OrderController@destroy');
    Route::put('orderadd/{id}','OrderController@addedit');
    Route::get('orderedit/{id}','OrderController@edit');
    Route::put('orderedit/{id}','OrderController@update');

    Route::get('/category','CategoryController@index');
    Route::get('/categorycreate','CategoryController@create');
    Route::post('/category','CategoryController@store');
    Route::get('/category/{id}','CategoryController@edit');
    Route::put('/category/{id}','CategoryController@update');
    Route::delete('/categorydel/{id}','CategoryController@destroy');

    Route::get('/tag','TagController@index');
    Route::get('/tagcreate','TagController@create');
    Route::post('/tag','TagController@store');
    Route::get('/tag/{id}','TagController@edit');
    Route::put('/tag/{id}','TagController@update');
    Route::delete('/tagdel/{id}','TagController@destroy');

    Route::get('/user','UserController@index');
    Route::get('usercreate','UserController@create');
    Route::post('/user','UserController@store');
    Route::get('/user/{id}','UserController@edit');
    Route::put('/user/{id}','UserController@update');
    Route::delete('/userdel/{id}','UserController@destroy');

    Route::get('/slider','SliderController@index');
    Route::post('/slider','SliderController@store');
    Route::get('/slidercreate','SliderController@create');
    Route::get('/slider/{id}','SliderController@edit');
    Route::put('/slider/{id}','SliderController@update');
    Route::delete('sliderdel/{id}','SliderController@destroy');

    Route::get('/site','SiteController@index');
    Route::get('/siteedit/{id}','SiteController@edit');
    Route::put('/site/{id}','SiteController@update');
    Route::get('/site/{id}','SiteController@show');

    Route::get('/contact','ContactController@index');
    Route::delete('/contactdel/{id}','ContactController@destroy');

    Route::get('/productcategory','ProductCategoryController@index');
    Route::get('/productcategorycreate','ProductCategoryController@create');
    Route::post('/productcategory','ProductCategoryController@store');
    Route::get('/productcategory/{id}','ProductCategoryController@edit');
    Route::put('/productcategory/{id}','ProductCategoryController@update');
    Route::delete('/productcategorydel/{id}','ProductCategoryController@destroy');
    

    Route::get('/product','ProductController@index');
    Route::get('/productcreate','ProductController@create');
    Route::post('/product','ProductController@store');
    Route::get('/productshow/{id}','ProductController@show');
    Route::get('/product/{id}','ProductController@edit');
    Route::put('/product/{id}','ProductController@update');
    Route::delete('/productdel/{id}','ProductController@destroy');
    Route::get('/indexajax','ProductController@indexajax');

    Route::get('/menu','MenuController@index');
    Route::get('/menucreate',"MenuController@create");
    Route::post('/menu','MenuController@store');
    Route::get('/menu/{id}','MenuController@edit');
    Route::put('/menu/{id}','MenuController@update');
    Route::delete('/menudel/{id}','MenuController@destroy');

    Route::get('/cms',function(){
        return redirect('/order');
    });
});
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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
