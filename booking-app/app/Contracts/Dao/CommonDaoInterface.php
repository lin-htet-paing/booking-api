<?php

namespace App\Contracts\Dao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface CommonDaoInterface
{

    /**
     * retrieve the data 
     * @param Model $model
     * @return LengthAwarePaginator
     */
    public function dbGetModel(Model $model);

    /**
     * add the data 
     * @param Model $model
     * @return bool
     */
    public function dbAddOrUpdateModel(Model $model);

    /**
     * retrieve the data detail by id
     * @param int $id
     * @return Model
     */
    public function dbGetModelDetailById(Model $model, int $id);

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model  model
     * @return bool
     */
    public function dbDeleteModelById(Model $model);

    /**
     * find the respective model data using id
     *
     * @param  Model $model
     * @param string $id
     * @return Object
     */
    public function dbFindModelDataById(Model $model, string $id);
}
