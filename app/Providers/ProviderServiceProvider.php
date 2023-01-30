<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Provider\Provider;
use App\Repositories\Provider\ProviderRepository;
use App\Services\Provider\ProviderService;
use Illuminate\Support\ServiceProvider;

class ProviderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProviderService::class, function ($app) {
           return new ProviderService(new ProviderRepository(new Provider()));
        });
    }
}
