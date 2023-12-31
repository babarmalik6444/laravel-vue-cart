<?php

namespace App\Providers;

use App\Domain\User\Contracts\UserManagementInterface;
use App\Domain\User\Services\UserManagementService;
use Illuminate\Support\ServiceProvider;

use App\Domain\Product\Contracts\ProductManagementInterface;
use App\Domain\Product\Services\ProductService;

use App\Domain\Auth\Contracts\AuthManagementInterface;
use App\Domain\Auth\Services\AuthService;

use App\Domain\Cart\Contracts\CartManagementInterface;
use App\Domain\Cart\Services\CartService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserManagementInterface::class, UserManagementService::class);
        $this->app->bind(ProductManagementInterface::class, ProductService::class);
        $this->app->bind(AuthManagementInterface::class, AuthService::class);
        $this->app->bind(CartManagementInterface::class, CartService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
