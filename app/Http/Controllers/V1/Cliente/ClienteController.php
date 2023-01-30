<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Cliente;

use App\Http\Controllers\AbstractController;
use App\Services\Cliente\ClienteService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


/**
 * Class ClienteController
 * @package App\Http\Controllers\V1\Cliente
 */
class ClienteController extends AbstractController
{
    /**
     * @var array|string[]
     */
    protected array $searchFields = [
        'nome',
    ];

    /**
     * ClienteController constructor.
     * @param ClienteService $service
     */
    public function __construct(ClienteService $service)
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
