<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface CarServiceInterface {
    /**
     * retrieve the carService
     * @return JsonResponse
     */
    public function getCarServices(): JsonResponse;

    /**
     * register carService
     * @param Request $request
     * @return JsonResponse
     */
    public function addCarServices(Request $request): JsonResponse;

    /**
     * retrieve the carService detail by id
     * @param int $id
     * @return JsonResponse
     */
    public function getCarServiceDetailById(int $id): JsonResponse;

    /**
     * update the carService detail by id
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function updateCarService(Request $request, string $id): JsonResponse;

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function deleteCarServiceById(string $id): JsonResponse;
}