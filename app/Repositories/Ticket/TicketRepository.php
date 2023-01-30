<?php

declare(strict_types=1);

namespace App\Repositories\Ticket;

use App\Repositories\AbstractRepository;

const PENDENCY = 0;

/**
 * Class TicketRepository
 * @package App\Repositories\Ticket
 */
class TicketRepository extends AbstractRepository
{
    /**
     * @param int $limit
     * @param array $orderBy
     * @return array
     */
    public function findAllTickets(int $limit = 10, array $orderBy = [])
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
            $provider = $query->findOrFail($param);
        } else {
            $provider = $query->where('expiration_date', $param)
                ->get();
        }

        return $provider->toArray();
    }

    /**
     * @param int providerId
     * @return bool
     */
    public function deleteByProvider(int $providerId): bool
    {
        $result = $this->model::where('provider_id', $providerId)
            ->delete();

        return $result ? true : false;
    }
}
