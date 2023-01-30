<?php

declare(strict_types=1);

namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Models\Status\Status;
use App\Repositories\AbstractRepository;

const PENDENCY = 0;

/**
 * Class productRepository
 * @package App\Repositories\Product
 */
class ProductRepository extends AbstractRepository
{
    /**
     * @param int $limit
     * @param array $orderBy
     * @return array
     */
    public function findAllProduct(int $limit = 10, array $orderBy = [])
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
                'status' => product::with('statusproduct')->get()
            ])
            ->toArray();
    }

    /**
     * @param int $providerId
     * @return array
     */
    public function findByProvider(int $providerId): array
    {
        return $this->model::where('provider_id', $providerId)
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
            $product = $query->findOrFail($param);
        } else {
            $product = $query->where('name', $param)
                ->get();
        }

        return $product->toArray();
    }

    /**
     * @param int employeId
     * @return bool
     */
    public function deleteByProvider(int $providerId): bool
    {
        $result = $this->model::where('provider_id', $providerId)
            ->delete();

        return $result ? true : false;
    }
}
