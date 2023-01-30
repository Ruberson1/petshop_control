<?php

declare(strict_types=1);

namespace App\Repositories\Servico;

use App\Models\Servico\Servico;
use App\Models\Status\Status;
use App\Repositories\AbstractRepository;

const PENDENCY = 0;

/**
 * Class ServicoRepository
 * @package App\Repositories\Servico
 */
class ServicoRepository extends AbstractRepository
{
    /**
     * @param int $limit
     * @param array $orderBy
     * @return array
     */
    public function findAllService(int $limit = 10, array $orderBy = [])
    {
        $results = $this->model::query();

        foreach ($orderBy as $key => $value) {
            if (strstr($key, '-')) {
                $key = substr($key, 1);
            }

            $results->orderBy($key, $value);
        }

        return $results->paginate($limit)
            ->appends([
                'order_by' => implode(',', array_keys($orderBy)),
                'limit' => $limit,
                'status' => Servico::with('statusServico')->get()
            ])
            ->toArray();
    }

    /**
     * @param int $clienteId
     * @return array
     */
    public function findByCliente(int $clienteId): array
    {
        return $this->model::where('cliente_id', $clienteId)
            ->get()
            ->toArray();
    }

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
            $cliente = $query->where('placa_veiculo', $param)
                ->get();
        }

        return $cliente->toArray();
    }

    /**
     * @param int clienteId
     * @return bool
     */
    public function deleteByCliente(int $clienteId): bool
    {
        $result = $this->model::where('cliente_id', $clienteId)
            ->delete();

        return $result ? true : false;
    }
}
