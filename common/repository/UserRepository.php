<?php

namespace common\repository;

use common\models\User;

class UserRepository extends Repository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * CategoryRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     *
     * @return bool
     */
    public function create($data)
    {
        /** @var $model User */
        $model = new $this->model;
        $model->username = $data['username'];
        $model->email = $data['email'];
        $model->setPassword($data['password']);
        $model->generateAuthKey();
        $model->nickname = $data['username'];

        return $model->save();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAll()
    {
        return $this->model->find()->all();
    }
}