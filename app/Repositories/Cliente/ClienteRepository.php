<?php

declare(strict_types=1);

namespace App\Repositories\Cliente;

use App\Repositories\AbstractRepository;

/**
 * Class ClienteRepository
 * @package App\Repositories\Cliente
 */
class ClienteRepository extends AbstractRepository
{
    
    /**
     * @param string $param
     * @return array
     */
    public function findBy(string $param): array
    {
        $query = $this->model::query();

        if (is_numeric($param)) {
            $cliente = $query->findOrFail($param);
        } else {
            $cliente = $query->where('slug', $param)
                ->get();
        }

        return $cliente->toArray();
    }

    /**
     * @param string $param
     * @param array $data
     * @return bool
     */
    public function editBy(string $param, array $data): bool
    {
        if (is_numeric($param)) {
            $cliente = $this->model::find($param);
        } else {
            $cliente = $this->model::where('slug', $param);
        }

        return $cliente->update($data) ? true : false;
    }

    /**
     * @param string $param
     * @return bool
     */
    public function deleteBy(string $param): bool
    {
        if (is_numeric($param)) {
            $cliente = $this->model::destroy($param);
        } else {
            $cliente = $this->model::where('slug', $param)
                ->delete();
        }

        return $cliente ? true : false;
    }
}
