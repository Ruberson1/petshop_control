<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Cliente\Cliente;
use App\Repositories\Cliente\ClienteRepository;
use App\Services\Cliente\ClienteService;
use Illuminate\Support\ServiceProvider;

class ClienteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ClienteService::class, function ($app) {
           return new ClienteService(new ClienteRepository(new Cliente()));
        });
    }
}
