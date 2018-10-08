<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\FooterWidget;
use app\widgets\SidebarWidget;
use app\widgets\TopNavWidget;
use backend\assets\AdminPanelAsset;
use yii\helpers\Html;

AdminPanelAsset::register($this);
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
<body class="nav-md">
<?php $this->beginBody(); ?>
<div class="container body">
    <div class="main_container">
        <?php SidebarWidget::begin(); ?>
        <?php SidebarWidget::end(); ?>
        <?php TopNavWidget::begin(); ?>
        <?php TopNavWidget::end(); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <?= $content ?>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php FooterWidget::begin(); ?>
        Admin Panel
        <?php FooterWidget::end(); ?>
        <!-- /footer content -->
    </div>
</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>
