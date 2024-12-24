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
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode("WAMYs"." | SOLUTION") ?></title>
    
    <?php $this->head() ?>
</head>

<body>

  <?php $this->beginBody() ?>
   

    <?= $this->render('main_component/content.php', ['content' => $content]) ?>

  <?php $this->endBody() ?>

</body>


</html>
<?php $this->endPage() ?>