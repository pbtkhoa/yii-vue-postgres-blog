<?php

namespace backend\controllers;

use backend\business\AuthBusiness;
use backend\models\LoginForm;
use backend\models\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class AuthController extends Controller
{
    public $layout = false;

    /**
     * @var AuthBusiness
     */
    protected $authBusiness;

    /**
     * AuthController constructor.
     *
     * @param string $id
     * @param $module
     * @param AuthBusiness $authBusiness
     * @param array $config
     */
    public function __construct(string $id, $module, AuthBusiness $authBusiness, array $config = [])
    {
        $this->authBusiness = $authBusiness;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'error'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $loginModel = new LoginForm();
        $registerModel = new RegisterForm();

        $session = Yii::$app->session;
        if ($session->hasFlash('registerModel')) {
            $registerModel = $session->getFlash('registerModel');
        } elseif ($session->hasFlash('loginModel')) {
            $loginModel = $session->getFlash('loginModel');
        }

        return $this->render('index', compact('loginModel', 'registerModel'));
    }

    public function actionLogin()
    {
        $loginModel = new LoginForm();
        $requestData = Yii::$app->request->post();
        if ($loginModel->load($requestData) && $loginModel->login()) {
            return $this->goBack();
        } else {
            $session = Yii::$app->session;
            $session->setFlash('loginModel', $loginModel);

            return $this->redirect(['auth/index#signin']);
        }
    }

    public function actionRegister()
    {
        $registerModel = new RegisterForm();
        $requestData = Yii::$app->request->post();
        if ($registerModel->load($requestData) && $registerModel->validate()) {
            $this->authBusiness->createUser($requestData['RegisterForm']);

            return $this->redirect(['auth/index#signin']);
        } else {
            $session = Yii::$app->session;
            $session->setFlash('registerModel', $registerModel);

            return $this->redirect(['auth/index#signup']);
        }
    }
}
