<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Sale\Sale;
use App\Repositories\Sale\SaleRepository;
use App\Services\Sale\SaleService;
use Illuminate\Support\ServiceProvider;

class SaleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SaleService::class, function ($app) {
           return new SaleService(new SaleRepository(new Sale()));
        });
    }
}
