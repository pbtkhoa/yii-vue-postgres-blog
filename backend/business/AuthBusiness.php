<?php

namespace backend\business;

use common\repository\UserRepository;

class AuthBusiness extends Business
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * PostBusiness constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }
}