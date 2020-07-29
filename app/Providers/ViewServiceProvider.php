<?php

namespace App\Providers;

use App\Blog;
use App\Category;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.frontend', function ($view) {
            $data = [];
            $data['categories'] = Category::where('status', true)->get();
            $data['blogs'] = Blog::where('status', true)->orderByRaw('RAND()')->take(2)->get();
            return $view->with('data', $data);
        });
    }
}
