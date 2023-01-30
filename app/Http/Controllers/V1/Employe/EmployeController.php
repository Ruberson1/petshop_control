<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Employe;

use App\Helpers\OrderByHelper;
use App\Http\Controllers\AbstractController;
use App\Services\Employe\Employe;
use App\Services\Employe\EmployeService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class EmployeController
 * @package App\Http\Controllers\V1\Employe
 */
class EmployeController extends AbstractController
{
    /**
     * @var array
     */
    protected array $searchFields = [];

    /**
     * EmployeController constructor.
     * @param Employe $service
     */
    public function __construct(EmployeService $employe)
    {
        parent::__construct($employe);
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

}
