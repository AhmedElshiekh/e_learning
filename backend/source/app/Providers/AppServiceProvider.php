<?php

namespace App\Providers;

use App\CategoryProduct;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
   public function register()
{
    if ($this->app->environment() == 'local') {
        $this->app->register('Hesto\MultiAuth\MultiAuthServiceProvider');
    }
}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            Schema::defaultStringLength(191);

        // $categoriesProduct = CategoryProduct::all();
        // View::share('categoriesProduct',$categoriesProduct);
    }
}
