<?php

declare(strict_types=1);

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sale
 * @package App\Models\Sale
 */
class Sale extends Model
{
    /**
     * @var string
     */
    protected $table = 'sales';

    /**
     * @var string[]
     */
    protected $fillable = [
        'value',
        'sale_date',
        'sale'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public array $rules = [
        'value' => 'required|min:5|max:255',
        'sale_date' => 'required|min:5|max:255',
        'sale' => 'required|min:5|max:255',
    ];
}