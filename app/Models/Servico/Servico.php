<?php

declare(strict_types=1);

namespace App\Models\Servico;

use App\Models\Cliente\Cliente;
use App\Models\Status\Status;
use App\Models\TipoServicos\TipoServicos;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Servico
 * @package App\Models\Servico
 */
class Servico extends Model
{
    /**
     * @var string
     */
    protected $table = 'servicos';

    /**
     * @var string[]
     */
    protected $fillable = [
        'cliente_id',
        'servico_tipo_id',
        'descricao',
        'status_id'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public array $rules = [
        'cliente_id' => 'required|numeric',
        'servico_tipo_id' => 'required|numeric',
        'descricao' => 'required|min:10|max:255',
        'status_id' => 'required|numeric'
    ];

    public function statusServico()
    {
        return $this->belongsTo(Status::class);
    }

    public function tipoServico()
    {
        return $this->belongsTo(TipoServicos::class, 'servico_tipo_id', 'id')->get();
    }

    public function clienteServico()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id')->get();
    }
}