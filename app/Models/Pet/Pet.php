<?php

declare(strict_types=1);

namespace App\Models\Pet;

use App\Models\Servico\Servico;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pet
 * @package App\Models\Pet
 */
class Pet extends Model
{
    //use Sluggable;

    /**
     * @var string
     */
    protected $table = 'pets';

    /**
     * @var string[]
     */
    protected $fillable = [
        'nome',
        'raca',
        'cliente_id',
        'porte'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array|string[]
     */
    public array $rules = [
        'nome' => 'required|min:2|max:20',
        'raca' => 'required|min:2|max:60',
        'cliente_id' => 'required|numeric',
        'porte' => 'required|min:2|max:60'
    ];

    public function servico()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => ['nome', 'sobrenome'],
    //             'onUpdate' => true
    //         ]
    //     ];
    // }
}