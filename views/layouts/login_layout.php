<?php



use yii\helpers\Html;

use yii\widgets\Breadcrumbs;

use app\assets\AppAsset;





$asset = AppAsset::register($this);

$baseUrl = $asset->baseUrl;

// die('ok');

$this->beginPage()

?>



<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">



<head>

  <meta charset="<?= Yii::$app->charset ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">



  <?= Html::csrfMetaTags() ?>

  <title><?= Html::encode("DJANGUAI " . " | CONNEXION") ?></title>

  <!-- sytle css -->

  <style>
    .divider:after,

    .divider:before {

      content: "";

      flex: 1;

      height: 1px;

      background: #eee;

    }
  </style>

  <?php $this->head() ?>

</head>



<body>

  <?php $this->beginBody() ?>

  <?= $this->render('main_component/content.php', ['content' => $content]) ?>

  <script>
 

    function message(type, message) {
      switch (type) {
        case "error":
          o = "rtl" === $("html").attr("data-textdirection"),
            toastr.error(
              message,
              "Erreur", {
                positionClass: "toast-top-right",
                rtl: o
              }
            );
          break;
        case "info":
          o = "rtl" === $("html").attr("data-textdirection"),
            toastr.info(
              message,
              "Information", {
                positionClass: "toast-top-right",
                rtl: o
              }
            );
          break;
        case "warning":
          o = "rtl" === $("html").attr("data-textdirection"),
            toastr.warning(
              message,
              "Attention", {
                positionClass: "toast-top-right",
                rtl: o
              }
            );
          break;
        case "success":
          o = "rtl" === $("html").attr("data-textdirection"),
            toastr.warning(
              message,
              "Information", {
                positionClass: "toast-top-right",
                rtl: o
              }
            );
          break;

        default:
          break;
      }


    }
  </script>

  
<?php       
// die(var_dump( Yii::$app->session->hasFlash('success')));
if(Yii::$app->session->hasFlash('flashmsg')){
  $dataflash = Yii::$app->session->getFlash('flashmsg');
  $msg =$dataflash['msg'];
  $code = intval($dataflash['code']);

  $color = '';
  switch ($code) {

    //Code pour attention
  case 412:
    $color = 'warning';
    break;

    //Code pour erreur
  case 400:
    $color = 'error';
    break;

    //Code pour succes
  case 200:
    $color = 'success';
    break;

    //Information
  case 100:
    $color = 'info';
    break;

    //
  default:
    return;
    break;
   
}
// die('okkk');
Yii::$app->view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css');
Yii::$app->view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

    $js = <<<JS
toastr.{$color}('{$msg}', '{$color}');
JS;

    Yii::$app->view->registerJs($js);

}

  Yii::$app->session->removeFlash('flashmsg'); ?>
  <?php $this->endBody() ?>

</body>





</html>

<?php $this->endPage() ?>