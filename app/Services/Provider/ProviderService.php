<?php

declare(strict_types=1);

namespace App\Services\Provider;

use App\Services\AbstractService;


/**
 * Class ProviderService
 * @package App\Services\Provider
 */
class ProviderService extends AbstractService
{

    /**
     * @param string $param
     * @return array
     */
    public function findBy(string $param): array
    {
        return $this->repository->findBy($param);
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
