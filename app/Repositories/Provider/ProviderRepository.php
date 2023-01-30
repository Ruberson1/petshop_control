<?php

declare(strict_types=1);

namespace App\Repositories\Provider;

use App\Models\Provider\Provider;
use App\Repositories\AbstractRepository;

const PENDENCY = 0;

/**
 * Class ProviderRepository
 * @package App\Repositories\Provider
 */
class ProviderRepository extends AbstractRepository
{

      /**
     * @param string $param
     * @return array
     */
    public function findBy(string $param): array
    {
        $query = $this->model::query();

        if (is_numeric($param)) {
            $provider = $query->findOrFail($param);
        } else {
            $provider = $query->where('name', $param)
                ->get();
        }

        return $provider->toArray();
    }
}
