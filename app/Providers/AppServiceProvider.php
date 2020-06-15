<?php

namespace App\Providers;

use App\User;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \DB::listen(function ($event) {
        //     dump($event->sql);
        //     dump($event->bindings);
        // });
        // comment out all in here to run migration
        $new_request = User::whereActive(0)->count();

        View::share('newRequest', $new_request);
    }
}
