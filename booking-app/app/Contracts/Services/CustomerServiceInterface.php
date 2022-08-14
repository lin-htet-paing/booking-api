<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface CustomerServiceInterface
{

    /**
     * retrieve the customers
     * @return JsonResponse
     */
    public function getCustomers(): JsonResponse;

    /**
     * register customer
     * @param Request $request
     * @return JsonResponse
     */
    public function addCustomer(Request $request): JsonResponse;

    /**
     * retrieve the customer detail by id
     * @param int $id
     * @return JsonResponse
     */
    public function getCustomerDetailById(int $id): JsonResponse;

    /**
     * update the customer detail by id
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function updateCustomer(Request $request, string $id): JsonResponse;

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function deleteCustomerById(string $id): JsonResponse;
}
