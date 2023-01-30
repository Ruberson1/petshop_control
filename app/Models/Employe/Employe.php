<?php

declare(strict_types=1);

namespace App\Models\Employe;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Employe
 * @package App\Models\Employe
 */
class Employe extends Model
{
    /**
     * @var string
     */
    protected $table = 'employees';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'position',
        'hiring_date',
        'resignation_date',
        'contact',
        'document'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public array $rules = [
        'name' => 'required|min:10|max:70',
        'position' => 'required|min:10|max:70',
        'hiring_date' => 'required',
        'contact' => 'required',
        'document' => 'required'
    ];
}