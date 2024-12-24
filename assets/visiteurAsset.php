<?php
namespace app\assets;
use yii\web\AssetBundle;


class  visiteurAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
   'web/onepage/css/animate.css',
   'web/onepage/css/icomoon.css',
   'web/onepage/css/bootstrap.css',
    
   'web/onepage/css/magnific-popup.css',
    
   'web/onepage/css/owl.carousel.min.css',
   'web/onepage/css/owl.theme.default.min.css',
    
        
   'web/onepage/css/flexslider.css',
    
   'web/onepage/css/pricing.css',
   'web/onepage/css/style.css',
  'web/onepage/js/modernizr-2.6.2.min.js',
   
    ];
    public $js = [
        
       'web/onepage/js/jquery.min.js',
       'web/onepage/js/jquery.easing.1.3.js',
       'web/onepage/js/bootstrap.min.js',
       'web/onepage/js/jquery.waypoints.min.js',
       'web/onepage/js/jquery.stellar.min.js',
       'web/onepage/js/owl.carousel.min.js',
       'web/onepage/js/jquery.flexslider-min.js',
       'web/onepage/js/jquery.countTo.js',
       'web/onepage/js/jquery.magnific-popup.min.js',
       'web/onepage/js/magnific-popup-options.js',
       'web/onepage/js/simplyCountdown.js',
       'web/onepage/js/main.js',
      

    ];

    public $depends = [

    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
