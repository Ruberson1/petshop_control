<?php

declare(strict_types=1);

namespace App\Services\Servico;

use App\Services\AbstractService;


/**
 * Class ServicoService
 * @package App\Services\Servico
 */
class ServicoService extends AbstractService
{
     /**
     * @param int $limit
     * @param array $orderBy
     * @return array
     */
    public function findAllService(int $limit = 10, array $orderBy = [])
    {
        return $this->repository->findAllService($limit, $orderBy);
    }

    /**
     * @param int $clienteId
     * @return array
     */
    public function findByCliente(int $clienteId): array
    {
        return $this->repository->findByCliente($clienteId);
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
    public function deleteByCliente(int $clienteId): bool
    {
        return $this->repository->deleteByCliente($clienteId);
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
