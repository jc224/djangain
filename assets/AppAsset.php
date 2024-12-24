<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/admin/plugins/bootstrap/css/bootstrap.min.css',
        'web/admin/plugins/feather/feather.css',
        'web/admin/plugins/icons/flags/flags.css',
        'web/admin/plugins/fontawesome/css/fontawesome.min.css',
        'web/admin/plugins/fontawesome/css/all.min.css',
        'web/admin/plugins/toastr/toatr.css',
        'web/admin/css/style.css',
    ];
    public $js = [
        'web/admin/js/jquery-3.6.0.min.js',
        'web/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'web/admin/js/feather.min.js',
        'web/admin/plugins/toastr/toastr.min.js',
        'web/admin/plugins/toastr/toastr.js',
        'web/admin/js/script.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
