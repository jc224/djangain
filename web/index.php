<?php



// comment out the following two lines when deployed to production

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');



require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

require(__DIR__ . '/../extensions/sass/vendor/autoload.php');

require(__DIR__ . '/../extensions/excel/vendor/autoload.php');

require(__DIR__ . '/../extensions/mpdf/vendor/autoload.php');

require(__DIR__ . '/../extensions/infobip/vendor/autoload.php');

require(__DIR__ . '/../extensions/http_request2/vendor/autoload.php');
require(__DIR__ . '/../extensions/smsorange/vendor/autoload.php');





$config = require __DIR__ . '/../config/web.php';



(new yii\web\Application($config))->run();





// $session = Yii::$app->session;



// if(($session->isActive)!=true){

//   $session->open();

// }