<?php

namespace backend\assets;

use yii\web\AssetBundle;

class VendorJsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'vendors/fastclick/lib/fastclick.js',
        'vendors/nprogress/nprogress.js',
        'vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
        'vendors/iCheck/icheck.min.js',
        'vendors/moment/min/moment.min.js',
        'vendors/bootstrap-daterangepicker/daterangepicker.js',
        'vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js',
        'vendors/jquery.hotkeys/jquery.hotkeys.js',
        'vendors/google-code-prettify/src/prettify.js',
        'vendors/jquery.tagsinput/src/jquery.tagsinput.js',
        'vendors/switchery/dist/switchery.min.js',
        'vendors/select2/dist/js/select2.full.min.js',
        'vendors/parsleyjs/dist/parsley.min.js',
        'vendors/autosize/dist/autosize.min.js',
        'vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js',
        'vendors/starrr/dist/starrr.js',
        'js/custom.js',
    ];
}
