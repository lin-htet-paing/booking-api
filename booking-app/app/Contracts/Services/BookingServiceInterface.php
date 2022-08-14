<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface BookingServiceInterface
{
    /**
     * retrieve the bookings
     * @return JsonResponse
     */
    public function getBookings(): JsonResponse;

    /**
     * register booking
     * @param Request $request
     * @return JsonResponse
     */
    public function addBooking(Request $request): JsonResponse;

    /**
     * retrieve the bookings detail by id
     * @param int $id
     * @return JsonResponse
     */
    public function getBookingDetailById(int $id): JsonResponse;

    /**
     * update the booking detail by id
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function updateBooking(Request $request, string $id): JsonResponse;

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function deleteBookingById(string $id): JsonResponse;
}
