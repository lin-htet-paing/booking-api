<?php

namespace App\Dao;

use App\Constants\GeneralConst;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\CommonDaoInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CommonDao implements CommonDaoInterface
{
    public function dbGetModel(Model $model): LengthAwarePaginator
    {
        return $model::paginate(GeneralConst::defaultPaginateNo);
    }

    /**
     * register user
     * @param Model $model
     * @return bool
     */
    public function dbAddOrUpdateModel(Model $model): bool
    {
        DB::beginTransaction();
        try {
            $model->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * retrieve the user detail by id
     * @param int $id
     * @return Object|null
     */
    public function dbGetModelDetailById(Model $model, int $id): Object|Null
    {
        return $model::all()->find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model $model
     * @return bool
     */
    public function dbDeleteModelById(Model $model)
    {
        return $model->delete();
    }

    /**
     * find the respective model data using id
     *
     * @param  Model $model
     * @param string $id
     * @return Object
     */
    public function dbFindModelDataById(Model $model, string $id): Object
    {
        return $model::find($id);
    }
}
