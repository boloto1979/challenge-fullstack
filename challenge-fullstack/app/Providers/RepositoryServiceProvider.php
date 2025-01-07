<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Registra os bindings no container de serviços.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
