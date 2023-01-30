<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Pet\Pet;
use App\Repositories\Pet\PetRepository;
use App\Services\Pet\PetService;
use Illuminate\Support\ServiceProvider;

class PetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PetService::class, function ($app) {
           return new PetService(new PetRepository(new Pet()));
        });
    }
}
