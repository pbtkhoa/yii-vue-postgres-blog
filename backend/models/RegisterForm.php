<?php

namespace backend\models;

use yii\db\ActiveRecord;

class RegisterForm extends ActiveRecord
{
    public $username;
    public $email;
    public $password;

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['username', 'string', 'length' => [6, 24]],
            ['email', 'email'],
            ['username', 'unique'],
            ['email', 'unique'],
            ['password', 'string', 'length' => [6, 24]],
        ];
    }
}