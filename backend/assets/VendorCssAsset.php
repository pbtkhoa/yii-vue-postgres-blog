<?php

namespace backend\assets;

use yii\web\AssetBundle;

class VendorCssAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendors/font-awesome/css/font-awesome.min.css',
        'vendors/nprogress/nprogress.css',
        'vendors/iCheck/skins/flat/green.css',
        'vendors/google-code-prettify/bin/prettify.min.css',
        'vendors/select2/dist/css/select2.min.css',
        'vendors/switchery/dist/switchery.min.css',
        'vendors/starrr/dist/starrr.css',
        'vendors/bootstrap-daterangepicker/daterangepicker.css',
        'css/custom.min.css',
    ];
}
