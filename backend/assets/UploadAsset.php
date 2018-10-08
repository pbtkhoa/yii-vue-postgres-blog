<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class UploadAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/upload.js',
    ];
    public $jsOptions = [
        'position' => View::POS_END
    ];
    public $depends = [
    ];
}
