<?php

declare(strict_types=1);

namespace App\Models\Provider;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Provider
 * @package App\Models\Provider
 */
class Provider extends Model
{
    /**
     * @var string
     */
    protected $table = 'providers';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'document',
        'contact',
        'email',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public array $rules = [
        'name' => 'required|min:5|max:255',
        'document' => 'required|min:5|max:255',
        'contact' => 'required|min:5|max:255',
        'email' => 'required|email|max:100|email:rfc,dns'
    ];
}