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

    <div class="page-content">

        <form class="needs-validation" novalidate=""

            action="<?= Yii::$app->request->baseUrl . '/' . md5('site_racourcis') ?>" name="login-form"

            id="form" method="post">

            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

            <input type="hidden" name="action" id="action" value="" />

            <input type="hidden" name="code" id="code" value="" />

            <div class="row">

                <div class="col-sm-6 col-md-6 mt-2 ">

                    <div class="page-title">LISTE DES RACCOURCIS </div>



                </div>

                <!-- <div class="col-sm-6 col-md-6 add-btn-col">

                    <a href="#" class="btn btn-primary btn-rounded float-md-right mt-2"

                        onclick="$('#etat').css('display','none'); $('#anneescolaire-form')[0].reset()"

                        data-toggle="modal" data-target="#add_leavetype">

                        <i class="fas fa-plus"></i> Ajouter une année Scolaire </a>

                </div> -->

            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="table-responsive">



                                <table class="table custom-table table-responsive-sm datatable "

                                    aria-describedby="DataTables_Table_0_info" id="DataTables_Table_0">

                                    <thead class="thead-light">

                                        <tr>

                                            <th class="min-w-50px">[]</th>

                                            <th class="min-w-200px">Controller</th>

                                            <th class="min-w-150px">Action</th>

                                            <th class="min-w-125px">Statut</th>

                                        </tr>

                                    </thead>



                                    <tbody class="text-gray-600 fw-semibold">

                                        <?php

                                        $userCode = yii::$app->mainCLass->getusers();

                                        $user = yii::$app->accessClass->chargerUserAuthData($userCode);

                                        $subMenu = $menuString = Null;

                                        $menuString  = yii::$app->menuactionClass->action($userCode);



                                        if (isset($menuString)) {

                                            $ajaxAction = Yii::$app->params['ajaxActions'];

                                            $menuArray = explode(Yii::$app->params['menuSeperator'], $menuString);

                                            $j = 0;

                                            foreach ($menuArray as $value) {

                                                $subMenuArray = explode(Yii::$app->params['subMenuSeperator'], $value);

                                                if (!(in_array($subMenuArray[0], $ajaxAction))) {

                                                    if (is_array($subMenuArray) and sizeof($subMenuArray) > 1) {



                                                        for ($i = 1; $i < sizeof($subMenuArray); $i++) {

                                                            if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                                                                // (var_dump($action));   die(var_dump($subMenuArray[$i]));

                                                                $verif = false;

                                                                if (sizeof($action) > 0) {



                                                                    foreach ($action as $key => $value) {

                                                                        if (in_array($subMenuArray[$i], $value)) {

                                                                            $autBtn = '<a href="javascript:;" Class="btn btn-circle btn-danger ajouter"   onclick="document.getElementById(\'code\').value=\'' . $subMenuArray[$i] . '\';document.getElementById(\'action\').value=\'' . md5('sup') . '\';document.getElementById(\'form\').submit(); ">' . yii::t("app", 'btnsup') . '</a>';

                                                                            $verif = true;

                                                                        }

                                                                    }

                                                                }

                                                                if ($verif == false) {

                                                                    $autBtn = '<a href="javascript:;" Class="btn btn-circle btn-primary ajouter"   onclick="document.getElementById(\'code\').value=\'' . $subMenuArray[$i] . '\';document.getElementById(\'action\').value=\'' . md5('ajoueter') . '\';document.getElementById(\'form\').submit(); ">' . yii::t("app", 'btnActiver') . '</a>';



                                                                }

                                                                $j++;

                                                                if(!empty($subMenuArray[$i])){

                                                                echo '<tr>

                                                                                <td>' . $j . '</td>

                                                                                <td>' . Yii::t("app", $subMenuArray[0]) . '</td>

                                                                                <td>' . Yii::t("app", $subMenuArray[$i]) . '</td>

                                                                                <td>' . $autBtn . '</td>

                                                                            </tr>';

                                                                }



                                                            }

                                                        }

                                                    }

                                                }

                                            }





                                        }



                                        ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>





        </form>

    </div>

</div>





