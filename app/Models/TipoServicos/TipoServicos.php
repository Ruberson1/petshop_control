<?php

declare(strict_types=1);

namespace App\Models\TipoServicos;

use App\Models\Servico\Servico;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoServicos
 * @package App\Models\TipoServicos
 */
class TipoServicos extends Model
{
    //use Sluggable;

    /**
     * @var string
     */
    protected $table = 'servicos_tipo';

    /**
     * @var string[]
     */
    protected $fillable = [
        'tipo'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;



   
    public function TipoServicos()
    {
        return $this->belongsToMany(Servico::class, 'servico_tipo_id', 'id');
    }

}