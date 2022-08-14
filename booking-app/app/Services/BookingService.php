<?php

namespace App\Services;

use App\Dao\CommonDao;
use App\Models\Booking;
use App\Mail\NotifyMail;
use Illuminate\Http\Request;
use App\Constants\GeneralConst;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use App\Contracts\Services\BookingServiceInterface;

class BookingService implements BookingServiceInterface
{

    private $commonDao;
    function __construct(CommonDao $commonDao)
    {
        $this->commonDao = $commonDao;
    }

    /**
     * retrieve the customers
     * @return JsonResponse
     */
    public function getBookings(): JsonResponse
    {
            $bookingData = $this->commonDao->dbGetModel(new Booking());
        return prepareForPresentation($bookingData, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * register booking
     * @param Request $request
     * @return JsonResponse
     */
    public function addBooking(Request $request): JsonResponse
    {
        $booking = new Booking();
        $booking->date = $request->date;
        $booking->customer_name = $request->customer_name;
        $booking->email = $request->email;
        $booking->car_number = $request->car_number;
        $booking->additional_service = $request->additional_service;
        $booking->duration = $request->duration;
        $booking->notes = $request->notes;
        $booking->parking_fee = $request->parking_fee;
        $isUpdated = $this->commonDao->dbAddOrUpdateModel($booking) ? GeneralConst::SUCCESS_ADD_MSG : GeneralConst::EMPTY;
        try {
            Mail::to('test@gmail.com')->send(new NotifyMail());
        } catch (\Throwable $th) {
            throw new \Exception("Mail Sending Error");  
        }
        return prepareForPresentation($isUpdated, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * retrieve the booking detail by id
     * @param int $id
     * @return JsonResponse
     */
    public function getBookingDetailById(int $id): JsonResponse
    {
        $user = $this->commonDao->dbGetModelDetailById(new Booking(), $id);
        return prepareForPresentation($user, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * update the booking detail by id
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function updateBooking(Request $request, string $id): JsonResponse
    {
        $booking = $this->commonDao->dbFindModelDataById(new Booking(), $id);
        $booking->date = $request->date ? $request->date : $booking->date;
        $booking->customer_name = $request->customer_name ? $request->customer_name : $booking->customer_name;
        $booking->email = $request->email ? $request->email : $booking->email;
        $booking->car_number = $request->car_number ? $request->car_number : $booking->car_number;
        $booking->additional_service = $request->additional_service ? $request->additional_service : $booking->additional_service;
        $booking->duration = $request->duration ? $request->duration : $booking->duration;
        $booking->notes = $request->notes ? $request->notes : $booking->notes;
        $booking->parking_fee = $request->parking_fee ? $request->parking_fee : $booking->parking_fee;
        $isUpdated = $this->commonDao->dbAddOrUpdateModel($booking) ? GeneralConst::SUCCESS_UPDATE_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isUpdated, GeneralConst::DATA_NOT_FOUND_ERR);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function deleteBookingById(string $id): JsonResponse
    {
        $customer = $this->commonDao->dbFindModelDataById(new Booking(), $id);
        $isDeleted = $this->commonDao->dbDeleteModelById($customer) ? GeneralConst::SUCCESS_DELETE_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isDeleted, GeneralConst::DATA_NOT_FOUND_ERR);
    }
}
