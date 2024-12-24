<?php

namespace app\assets;

use yii\web\AssetBundle;


class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [


        'web/mainAssets/plugins/feather/feather.css',

        'web/mainAssets/css/bootstrap.min.css',
        'web/mainAssets/plugins/fontawesome/css/all.min.css',
        'web/mainAssets/plugins/fontawesome/css/fontawesome.min.css',
        'web/mainAssets/css/fullcalendar.min.css',
        'web/mainAssets/css/dataTables.bootstrap4.min.css',
        'web/mainAssets/plugins/morris/morris.css',
        'web/mainAssets/plugins/toastr/toatr.css',
        'web/mainAssets/css/style.css',
        'web/mainAssets/css/select2.min.css',

        'web/mainAssets/plugins/datetimepicker/css/tempusdominus-bootstrap-4.min.css',
        'web/mainAssets/css/select2.min.css',

    ];
    public $js = [

        'web/mainAssets/js/jquery-3.6.0.min.js',
        'web/mainAssets/js/bootstrap.bundle.min.js',
        'web/mainAssets/js/jquery.slimscroll.js',
        'web/mainAssets/js/select2.min.js',
        'web/mainAssets/js/moment.min.js',
        'web/mainAssets/js/jquery.slimscroll.js',
        'web/mainAssets/plugins/theia-sticky-sidebar/ResizeSensor.js',
        'web/mainAssets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js',
        'web/mainAssets/js/select2.min.js',

       'web/mainAssets/plugins/jquery-ui/jquery-ui.min.js',
       'web/mainAssets/plugins/fullcalendar/fullcalendar.min.js',
       'web/mainAssets/plugins/fullcalendar/locale-all.js',
       'web/mainAssets/plugins/fullcalendar/jquery.fullcalendar.js',
       'web/mainAssets/plugins/apexchart/apexcharts.min.js',
       'web/mainAssets/plugins/apexchart/chart-data.js',
   
        'web/mainAssets/js/jquery.dataTables.min.js',
        'web/mainAssets/js/dataTables.bootstrap4.min.js',
        'web/mainAssets/plugins/toastr/toastr.min.js',
        'web/mainAssets/plugins/toastr/toastr.js',
        'web/mainAssets/plugins/morris/morris.min.js',
        'web/mainAssets/plugins/raphael/raphael-min.js',
        'web/mainAssets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js',
        'web/mainAssets/js/apexcharts.js',
        'web/mainAssets/js/chart-data.js',
        'web/mainAssets/js/app.js',
    ];

    public $depends = [

        'yii\web\YiiAsset',
        //   'yii\bootstrap\BootstrapAsset',
    ];

    public $jsOptions = [
        // 'position' => \yii\web\View::POS_HEAD
    ];
}
