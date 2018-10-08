<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AdminPanelAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $depends = [
        'backend\assets\AppAsset',
        'backend\assets\VendorCssAsset',
        'backend\assets\VendorJsAsset'
    ];
}
