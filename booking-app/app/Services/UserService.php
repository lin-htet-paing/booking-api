<?php

namespace App\Services;

use App\Constants\GeneralConst;
use Illuminate\Http\Request;
use App\Contracts\Dao\CommonDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserService implements UserServiceInterface
{

    private $commonDao;

    function __construct(CommonDaoInterface $commonDao)
    {
        $this->commonDao = $commonDao;
    }

    /**
     * retrieve the users 
     * @param Model $model
     * @return JsonResponse
     */
    public function getUsers(): JsonResponse
    {
        $userData = $this->commonDao->dbGetModel(new User());
        return prepareForPresentation($userData, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * add the users 
     * @param Request $request
     * @return JsonResponse
     */
    public function addUser(Request $request): JsonResponse
    {
        $token = $request->user()->createToken($request->token_name);
        dd($token->plainTextToken);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->password = bcrypt($request->password);
        $isUpdated = $this->commonDao->dbAddOrUpdateModel($user) ? GeneralConst::SUCCESS_ADD_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isUpdated, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * retrieve the user detail by id
     * @param int $id
     * @return JsonResponse
     */
    public function getUserDetailById(int $id): JsonResponse
    {
        $user = $this->commonDao->dbGetModelDetailById(new User, $id);
        return prepareForPresentation($user, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * update the user detail by id
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function updateUser(Request $request, string $id): JsonResponse
    {
        $user = $this->commonDao->dbFindModelDataById(new User, $id);
        $user->name = $request->name ? $request->name : $user->name;
        $user->email = $request->email ? $request->email : $user->email;
        $user->type = $request->type ? $request->type : $user->type;
        $user->password = $request->password ? $request->password : $user->password;
        $isUpdated = $this->commonDao->dbAddOrUpdateModel($user) ? GeneralConst::SUCCESS_UPDATE_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isUpdated, GeneralConst::DATA_NOT_FOUND_ERR);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function deleteUserById(string $id): JsonResponse
    {
        $user = $this->commonDao->dbFindModelDataById(new User, $id);
        $isDeleted = $this->commonDao->dbDeleteModelById($user) ? GeneralConst::SUCCESS_DELETE_MSG : GeneralConst::EMPTY;
        return prepareForPresentation($isDeleted, GeneralConst::DATA_NOT_FOUND_ERR);
    }
}
