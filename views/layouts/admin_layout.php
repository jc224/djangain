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
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://jsuites.net/v4/jsuites.js"></script>
      <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
      <script src="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.css" type="text/css" />

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode("WAMY"." | SOLUTION") ?></title>
    
    <?php $this->head() ?>
</head>

<body>

  <?php $this->beginBody() ?>
   
    <?= $this->render('user_component/adminheader.php', ['baseUrl' => $baseUrl]) ?>

    <?= $this->render('user_component/content.php', ['content' => $content]) ?>
    <?php require_once(\Yii::$app->basePath.'/extensions/msg/popupMsg.php');?>

  <?php $this->endBody() ?>

</body>


</html>
<?php $this->endPage() ?>