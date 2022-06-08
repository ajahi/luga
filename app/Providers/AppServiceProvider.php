<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\ProductCategory;
use View;
use App\Site;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
       
        View::composer(['partials.shopfooter'],function($view){
            $view->with('categories',['categories'=>ProductCategory::where('parent_id',null)->get(),'site'=>Site::find(1)->get()]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
