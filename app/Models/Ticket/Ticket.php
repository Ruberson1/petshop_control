<?php

declare(strict_types=1);

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * @package App\Models\Ticket
 */
class Ticket extends Model
{
    /**
     * @var string
     */
    protected $table = 'tickets';

    /**
     * @var string[]
     */
    protected $fillable = [
        'value',
        'expiration_date',
        'payment_date',
        'provider_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public array $rules = [
        'value' => 'required',
        'expiration_date' => 'required',
        'payment_date' => 'required',
        'provider_id' => 'required|numeric'
    ];
}