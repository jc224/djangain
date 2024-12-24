<?php



use yii\helpers\Html;

use yii\widgets\Breadcrumbs;

use app\assets\MainAsset;



$asset = MainAsset::register($this);

$baseUrl = $asset->baseUrl;



$this->beginPage()

?>



<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">



<head>

  <meta charset="<?= Yii::$app->charset ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">

  <script

    src="https://code.jquery.com/jquery-3.7.0.min.js"

    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="

    crossorigin="anonymous"></script>

  <link rel="icon" href="<?= yii::$app->request->baseUrl ?>mainAssets/images/favicon.ico" type="image/x-icon">

  <!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->

  <!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->

  <script src="https://jsuites.net/v4/jsuites.js"></script>

  <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />

  <script src="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.css" type="text/css" />



  <script src="<?= \Yii::$app->request->baseUrl . '/extensions/fullcalendar/dist/index.global.js' ?>"></script>



  <?= Html::csrfMetaTags() ?>

  <title><?= Html::encode("DJANGUAI" . " | SOLUTION") ?></title>



  <?php $this->head() ?>

</head>



<body>



  <?php $this->beginBody() ?>



  <?= $this->render('user_component/header.php', ['baseUrl' => $baseUrl]) ?>



  <?= $this->render('user_component/content.php', ['content' => $content]) ?>

  <?php require_once('.../../extensions/validator/formvaidator.php') ?>

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