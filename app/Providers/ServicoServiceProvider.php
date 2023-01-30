<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Servico\Servico;
use App\Repositories\Servico\ServicoRepository;
use App\Services\Servico\ServicoService;
use Illuminate\Support\ServiceProvider;

class ServicoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ServicoService::class, function ($app) {
           return new ServicoService(new ServicoRepository(new Servico()));
        });
    }
}
