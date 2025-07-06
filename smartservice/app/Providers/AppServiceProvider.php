<?php

namespace App\Providers;

use App\Interfaces\ServiceCategoryRepositoryInterface;
use App\Repositories\ServiceCategoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       $this->app->bind(ServiceCategoryRepositoryInterface::class, ServiceCategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
