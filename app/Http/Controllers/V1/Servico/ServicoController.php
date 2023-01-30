<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Servico;

use App\Http\Resources\ServicoResource;
use App\Helpers\OrderByHelper;
use App\Http\Controllers\AbstractController;
use App\Services\Servico\Servico;
use App\Services\Servico\ServicoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ServicoController
 * @package App\Http\Controllers\V1\Servico
 */
class ServicoController extends AbstractController
{
    /**
     * @var array
     */
    protected array $searchFields = [];

    /**
     * ServicoController constructor.
     * @param Servico $service
     */
    public function __construct(ServicoService $servico)
    {
        parent::__construct($servico);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function findAllService(Request $request): JsonResponse
    {
        try {
            $limit = (int) $request->get('limit', 10);
            $orderBy = $request->get('order_by', []);

            if (!empty($orderBy)) {
                $orderBy = OrderByHelper::treatOrderBy($orderBy);
            }

            $searchString = $request->get('q', '');

            if (!empty($searchString)) {
                $result = $this->service->searchBy(
                    $searchString,
                    $this->searchFields,
                    $limit,
                    $orderBy
                );
            } else {
                $result = $this->service->findAllService($limit, $orderBy);
            }

            $response = $this->successResponse($result, Response::HTTP_PARTIAL_CONTENT);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }
        // $teste = ServicoResource::collection($response);

        return response()->json($response, $response['status_code']);
    }

    protected function successResp(object $data, int $statusCode = Response::HTTP_OK): object
    {
        var_dump($data);die;
        $response = new \stdClass();
        $response->status_code = $statusCode;
        $response->data = $data;
        return $response;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function findOneBy(Request $request, int $id): JsonResponse
    {
        try {
            $result = $this->service->findOneBy($id);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /**
     * @param Request $request
     * @param int $cliente
     * @return JsonResponse
     */
    public function findByCliente(Request $request, int $cliente): JsonResponse
    {
        try {
            $result = $this->service->findByCliente($cliente);
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
     * @param int $cliente
     * @return JsonResponse
     */
    public function deleteByCliente(Request $request, int $cliente): JsonResponse
    {
        try {
            $result['deletado'] = $this->service->deleteByCliente($cliente);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }
}
