<?php

declare(strict_types=1);

namespace App\Services\Product;

use App\Services\AbstractService;


/**
 * Class ProductService
 * @package App\Services\Product
 */
class ProductService extends AbstractService
{
     /**
     * @param int $limit
     * @param array $orderBy
     * @return array
     */
    public function findAllProduct(int $limit = 10, array $orderBy = [])
    {
        return $this->repository->findAllService($limit, $orderBy);
    }

    /**
     * @param int $clienteId
     * @return array
     */
    public function findByProvider(int $providerId): array
    {
        return $this->repository->findByProvider($providerId);
    }

    /**
     * @param string $param
     * @return array
     */
    public function findBy(string $param): array
    {
        return $this->repository->findBy($param);
    }

    /**
     * @param int $clienteId
     * @return bool
     */
    public function deleteByProvider(int $providerId): bool
    {
        return $this->repository->deleteBy($providerId);
    }

    // /**
    //  * @param array $data
    //  * @return array
    //  */
    // public function create(array $data): array
    // {
    //     $this->isImage($data['imagem']);
    //     $data['imagem'] = base64_encode(file_get_contents($data['imagem']));

    //     return $this->repository->create($data);
    // }

}
