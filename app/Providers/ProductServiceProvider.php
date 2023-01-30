<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Product\Product;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductService::class, function ($app) {
           return new ProductService(new ProductRepository(new Product()));
        });
    }
}
