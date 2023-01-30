<?php

declare(strict_types=1);

namespace App\Repositories\Sale;

use App\Models\Sale\Sale;
use App\Repositories\AbstractRepository;

const PENDENCY = 0;

/**
 * Class SaleRepository
 * @package App\Repositories\Sale
 */
class SaleRepository extends AbstractRepository
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
            $cliente = $query->where('sale_date', $param)
                ->get();
        }

        return $cliente->toArray();
    }
}
