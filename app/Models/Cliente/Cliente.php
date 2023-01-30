<?php

declare(strict_types=1);

namespace App\Models\Cliente;

use App\Models\Servico\Servico;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 * @package App\Models\Cliente
 */
class Cliente extends Model
{
    //use Sluggable;

    /**
     * @var string
     */
    protected $table = 'clientes';

    /**
     * @var string[]
     */
    protected $fillable = [
        'nome',
        'bairro',
        'rua',
        'numero',
        'cpf',
        'telefone'
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
        'bairro' => 'required|min:2|max:60',
        'rua' => 'required|min:2|max:60',
        'cpf' => 'required',
        'telefone' => 'required|max:20'
    ];

    public function petCliente()
    {
        return $this->hasMany(Pets::class, 'cliente_id', 'id');
    }

    public function servicoCliente()
    {
        return $this->hasMany(Servico::class, 'cliente_id', 'id');
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