<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Constants\GeneralConst;
use Illuminate\Http\JsonResponse;
use App\Contracts\Dao\CommonDaoInterface;
use App\Contracts\Services\CustomerServiceInterface;

class CustomerService implements CustomerServiceInterface {
    
    private $commonDao;

    function __construct(CommonDaoInterface $commonDao)
    {
        $this->commonDao = $commonDao;   
    }

    /**
     * retrieve the customers
     * @return JsonResponse
     */
    public function getCustomers(): JsonResponse
    {
        $customerData = $this->commonDao->dbGetModel(new Customer());
        return prepareForPresentation($customerData, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * register customer
     * @param Request $request
     * @return JsonResponse
     */
    public function addCustomer(Request $request): JsonResponse
    {
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $isUpdated = $this->commonDao->dbAddOrUpdateModel($customer) ? GeneralConst::SUCCESS_ADD_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isUpdated, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * retrieve the customer detail by id
     * @param int $id
     * @return JsonResponse
     */
    public function getCustomerDetailById(int $id): JsonResponse
    {
        $user = $this->commonDao->dbGetModelDetailById(new Customer, $id);
        return prepareForPresentation($user, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * update the customer detail by id
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function updateCustomer(Request $request, string $id): JsonResponse
    {
        $customer = $this->commonDao->dbFindModelDataById(new Customer, $id);
        $customer->customer_name = $request->customer_name ? $request->customer_name : $customer->customer_name;
        $customer->email = $request->email ? $request->email : $customer->email;
        $isUpdated = $this->commonDao->dbAddOrUpdateModel($customer) ? GeneralConst::SUCCESS_UPDATE_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isUpdated, GeneralConst::DATA_NOT_FOUND_ERR);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function deleteCustomerById(string $id): JsonResponse
    {
        $customer = $this->commonDao->dbFindModelDataById(new Customer(), $id);
        $isDeleted = $this->commonDao->dbDeleteModelById($customer) ? GeneralConst::SUCCESS_DELETE_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isDeleted, GeneralConst::DATA_NOT_FOUND_ERR);
    }

}