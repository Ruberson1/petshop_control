<?php

declare(strict_types=1);

namespace App\Models\Status;

use App\Models\Servico\Servico;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package App\Models\Status
 */
class Status extends Model
{
    //use Sluggable;

    /**
     * @var string
     */
    protected $table = 'status';

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

    
    public function status()
    {
        return $this->belongsToMany(Servico::class, 'status_id', 'id')->get();
    }

}