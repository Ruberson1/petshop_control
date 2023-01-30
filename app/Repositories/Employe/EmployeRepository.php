<?php

declare(strict_types=1);

namespace App\Repositories\Employe;

use App\Repositories\AbstractRepository;

/**
 * Class EmployeRepository
 * @package App\Repositories\Employe
 */
class EmployeRepository extends AbstractRepository
{
    
    /**
     * @param string $param
     * @return array
     */
    public function findBy(string $param): array
    {
        $query = $this->model::query();

        if (is_numeric($param)) {
            $employe = $query->findOrFail($param);
        } else {
            $employe = $query->where('name', $param)
                ->get();
        }

        return $employe->toArray();
    }

    /**
     * @param string $param
     * @param array $data
     * @return bool
     */
    public function editBy(string $param, array $data): bool
    {
        if (is_numeric($param)) {
            $employe = $this->model::find($param);
        } else {
            $employe = $this->model::where('name', $param);
        }

        return $employe->update($data) ? true : false;
    }
}
