<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Constants\GeneralConst;
use Illuminate\Http\JsonResponse;
use App\Contracts\Dao\CommonDaoInterface;
use App\Contracts\Services\CarServiceInterface;

class CarService implements CarServiceInterface
{
    private $commonDao;
    function __construct(CommonDaoInterface $commonDao)
    {
        $this->commonDao = $commonDao;
    }

    /**
     * retrieve the carService
     * @return JsonResponse
     */
    public function getCarServices(): JsonResponse
    {
        $bookingData = $this->commonDao->dbGetModel(new Service());
        return prepareForPresentation($bookingData, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * register carService
     * @param Request $request
     * @return JsonResponse
     */
    public function addCarServices(Request $request): JsonResponse
    {
        $carService = new Service();
        $carService->service_type = $request->service_type;
        $isUpdated = $this->commonDao->dbAddOrUpdateModel($carService) ? GeneralConst::SUCCESS_ADD_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isUpdated, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * retrieve the carService detail by id
     * @param int $id
     * @return JsonResponse
     */
    public function getCarServiceDetailById(int $id): JsonResponse
    {
        $user = $this->commonDao->dbGetModelDetailById(new Service(), $id);
        return prepareForPresentation($user, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * update the carService detail by id
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function updateCarService(Request $request, string $id): JsonResponse
    {
        $carService = $this->commonDao->dbFindModelDataById(new Service(), $id);
        $carService->service_type = $request->service_type ? $request->service_type : $carService->service_type;
        $isUpdated = $this->commonDao->dbAddOrUpdateModel($carService) ? GeneralConst::SUCCESS_UPDATE_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isUpdated, GeneralConst::DATA_NOT_FOUND_ERR);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function deleteCarServiceById(string $id): JsonResponse
    {
        $carService = $this->commonDao->dbFindModelDataById(new Service(), $id);
        $isDeleted = $this->commonDao->dbDeleteModelById($carService) ? GeneralConst::SUCCESS_DELETE_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isDeleted, GeneralConst::DATA_NOT_FOUND_ERR);
    }
}
