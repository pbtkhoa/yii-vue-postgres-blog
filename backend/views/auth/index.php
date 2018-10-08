<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AuthAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

AuthAsset::register($this);
$formTemplate = [
    'template' => '
    {input}
    {error}'
];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login">
<?php $this->beginBody(); ?>
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?php
                $loginForm = ActiveForm::begin([
                    'action' => ['auth/login']
                ]);
                ?>
                <h1>Login Form</h1>
                <?= $loginForm->field($loginModel, 'username', $formTemplate)->input('text', ['placeholder' => "Username"]) ?>
                <?= $loginForm->field($loginModel, 'password', $formTemplate)->input('password', ['placeholder' => "Password"]) ?>
                <div>
                    <button class="btn btn-default" type="submit">Log in</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">New to site?
                        <a href="#signin" class="to_register"> Create Account </a>
                    </p>
                </div>
                <?php ActiveForm::end(); ?>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <?php
                $registerForm = ActiveForm::begin([
                    'action' => ['auth/register']
                ]);
                ?>
                <h1>Create Account</h1>
                <?= $registerForm->field($registerModel, 'username', $formTemplate)->input('text', ['placeholder' => "Enter Your Username"]) ?>
                <?= $registerForm->field($registerModel, 'email', $formTemplate)->input('text', ['placeholder' => "Enter Your Email"]) ?>
                <?= $registerForm->field($registerModel, 'password', $formTemplate)->input('password', ['placeholder' => "Enter Your Password"]) ?>
                <div>
                    <button class="btn btn-default" type="submit">Submit</button>
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                    <p class="change_link">Already a member ?
                        <a href="#signin" class="to_register"> Log in </a>
                    </p>
                </div>
                <?php ActiveForm::end(); ?>
            </section>
        </div>
    </div>
</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>
