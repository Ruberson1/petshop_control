<?php

declare(strict_types=1);

namespace App\Services\Pet;

use App\Services\AbstractService;

/**
 * Class PetService
 * @package App\Services\Pet
 */
class PetService extends AbstractService
{
    /**
     * @param string $param
     * @return array
     */
    public function findBy(string $param): array
    {
        return $this->repository->findBy($param);
    }

    /**
     * @param string $param
     * @return bool
     */
    public function deleteBy(string $param): bool
    {
        return $this->repository->deleteBy($param);
    }
}
