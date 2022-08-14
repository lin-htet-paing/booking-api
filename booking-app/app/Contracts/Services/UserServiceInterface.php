<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface UserServiceInterface
{

    /**
     * retrieve the users
     * @return JsonResponse
     */
    public function getUsers(): JsonResponse;

    /**
     * register user
     * @param Request $request
     * @return JsonResponse
     */
    public function addUser(Request $request): JsonResponse;

    /**
     * retrieve the user detail by id
     * @param int $id
     * @return JsonResponse
     */
    public function getUserDetailById(int $id): JsonResponse;

    /**
     * update the user detail by id
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function updateUser(Request $request, string $id): JsonResponse;

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function deleteUserById(string $id): JsonResponse;
}
