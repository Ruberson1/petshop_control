<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Employe\Employe;
use App\Repositories\Employe\EmployeRepository;
use App\Services\Employe\EmployeService;
use Illuminate\Support\ServiceProvider;

class EmployeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EmployeService::class, function ($app) {
           return new EmployeService(new EmployeRepository(new Employe()));
        });
    }
}
