<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Ticket\Ticket;
use App\Repositories\Ticket\TicketRepository;
use App\Services\Ticket\TicketService;
use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TicketService::class, function ($app) {
           return new TicketService(new TicketRepository(new Ticket()));
        });
    }
}
