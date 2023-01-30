<?php

declare(strict_types=1);

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models\Product
 */
class Product extends Model
{
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var string[]
     */
    protected $fillable = [
        'value',
        'amount',
        'name',
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
        'amount' => 'required',
        'name' => 'required|min:5|max:255',
        'provider_id' => 'required|numeric'
    ];
}