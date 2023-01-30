<?php

declare(strict_types=1);

namespace App\Repositories\Pet;

use App\Repositories\AbstractRepository;

/**
 * Class PetRepository
 * @package App\Repositories\Pet
 */
class PetRepository extends AbstractRepository
{
    
    /**
     * @param string $param
     * @return array
     */
    public function findBy(string $param): array
    {
        $query = $this->model::query();

        if (is_numeric($param)) {
            $pet = $query->findOrFail($param);
        } else {
            $pet = $query->where('slug', $param)
                ->get();
        }

        return $pet->toArray();
    }

    /**
     * @param string $param
     * @param array $data
     * @return bool
     */
    public function editBy(string $param, array $data): bool
    {
        if (is_numeric($param)) {
            $pet = $this->model::find($param);
        } else {
            $pet = $this->model::where('slug', $param);
        }

        return $pet->update($data) ? true : false;
    }

    /**
     * @param string $param
     * @return bool
     */
    public function deleteBy(string $param): bool
    {
        if (is_numeric($param)) {
            $pet = $this->model::destroy($param);
        } else {
            $pet = $this->model::where('slug', $param)
                ->delete();
        }

        return $pet ? true : false;
    }
}
