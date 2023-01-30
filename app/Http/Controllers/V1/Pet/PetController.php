<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Pet;

use App\Http\Controllers\AbstractController;
use App\Services\Pet\PetService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


/**
 * Class PetController
 * @package App\Http\Controllers\V1\Pet
 */
class PetController extends AbstractController
{
    /**
     * @var array|string[]
     */
    protected array $searchFields = [
        'nome',
        'slug',
        'sobrenome'
    ];

    /**
     * PetController constructor.
     * @param PetService $service
     */
    public function __construct(PetService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param Request $request
     * @param string $param
     * @return JsonResponse
     */
    public function findBy(Request $request, string $param): JsonResponse
    {
        try {
            $result = $this->service->findBy($param);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /**
     * @param Request $request
     * @param string $param
     * @return JsonResponse
     */
    public function deleteBy(Request $request, string $param): JsonResponse
    {
        try {
            $result['deletado'] = $this->service->deleteBy($param);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

}
