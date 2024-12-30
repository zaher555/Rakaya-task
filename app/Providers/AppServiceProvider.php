<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\User;
use App\Policies\RolePolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Gate::define('update-book', function (User $user) {
            return $user->role === 'admin';
        });
        Gate::define('create-book', function (User $user) {
            return $user->role === 'admin';
        });
        Gate::define('delete-book', function (User $user) {
            return $user->role === 'admin';
        });
    }
}