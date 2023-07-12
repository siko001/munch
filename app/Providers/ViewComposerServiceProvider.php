<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        View::composer('components.layout', function ($view) {
            $user = auth()->user();
            $profilePicture = $user ? $user->profile_picture : null;
            $view->with(compact('user', 'profilePicture'));
        });
    }
}
