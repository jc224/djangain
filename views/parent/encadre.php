<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title">
                    <?= yii::t('app', Yii::$app->controller->id) ?>
                </h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="fas fa-home"></i> Acceuil </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">
                            <?= yii::t('app', Yii::$app->controller->id) ?>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span>
                            <?= yii::t('app', Yii::$app->controller->action->id) ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form class="md-float-material form-material"
        action="<?= Yii::$app->request->baseUrl . '/' . md5('eleve_enrollement') ?>" name="login-form"
        id="anneescolaire-form" method="post">

        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
        <input type="hidden" name="action" id="action" value="<?= md5('filtrer') ?>" />
        <input type="hidden" name="code" id="code" value="<?= md5('filtrer') ?>" />


        <div class="row staff-grid-row">

            <?php
            if (sizeof($listeparents) > 0) {
                foreach ($listeparents as $key => $value) {

                    $infoeleves = yii::$app->mainCLass->databycode('dj_eleve', $value['codeeleve'], 'code');
                    //  die(var_dump($listeparents));
                    if (sizeof($infoeleves) > 0) {
                        echo '
                        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                         <a href="javascript:;" onclick="  document.getElementById(\'action\').value=\'' . md5(strtolower("profil")) . '\';  document.getElementById(\'code\').value=\'' . $value["codeeleve"] . '\';$(\'#anneescolaire-form\').submit(); ">
                        <div class="profile-widget">
                            <div class="profile-img">
                               <img class="avatar" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $infoeleves['0']['photo'] . '" alt="">
                            </div>
                       
                            <h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="javascript:;" onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("profil")) . '\';  document.getElementById(\'code\').value=\'' . $value["codeeleve"] . '\';$(\'#anneescolaire-form\').submit(); ">' . $infoeleves['0']['nom'] . ' ' . $infoeleves['0']['prenom'] . '</a></h4>
                        </div>
                        </a>
                    </div>
                        ';
                    }
                }
            }

            ?>


        </div>
    </form>
</div>