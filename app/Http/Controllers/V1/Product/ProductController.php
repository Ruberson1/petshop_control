<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Product;

use App\Http\Resources\ProductResource;
use App\Helpers\OrderByHelper;
use App\Http\Controllers\AbstractController;
use App\Services\Product\Product;
use App\Services\Product\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ProductController
 * @package App\Http\Controllers\V1\Product
 */
class ProductController extends AbstractController
{
    /**
     * @var array
     */
    protected array $searchFields = [];

    /**
     * ProductController constructor.
     * @param Product $service
     */
    public function __construct(ProductService $product)
    {
        parent::__construct($product);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function findAllProduct(Request $request): JsonResponse
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
                $result = $this->service->findAllProduct($limit, $orderBy);
            }

            $response = $this->successResponse($result, Response::HTTP_PARTIAL_CONTENT);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }
        // $teste = ProductResource::collection($response);

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
     * @param int $provider
     * @return JsonResponse
     */
    public function findByCliente(Request $request, int $provider): JsonResponse
    {
        try {
            $result = $this->service->findByProvider($provider);
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
     * @param int $provider
     * @return JsonResponse
     */
    public function deleteByProvider(Request $request, int $provider): JsonResponse
    {
        try {
            $result['deletado'] = $this->service->deleteByProvider($provider);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }
}
