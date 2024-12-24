<div class="card">
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
    <div class="card-block table-border-style">
        <div class="table-responsive">
            <table class="table">
                <thead>

                    <tr>
                        <th>#</th>
                        <th>CLASSE</th>
                        <th>Niveau</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (isset($liste) && sizeof($liste)) {
                        $j = 0;
                        // die(var_dump($liste));
                        foreach ($liste as $key => $value) {
                            $autBtn = '<a href="javascript:;" Class="btn btn-circle btn-primary"   data-bs-toggle="modal" data-bs-target="#kt_modal_add_user"   onclick="document.getElementById(\'action_key\').value=\'' . md5(strtolower("modifierFonction")) . '\';  document.getElementById(\'action_on_this\').value=\'' . $value["code"] . '\';">' . yii::t("app", 'Modifier') . '</a>';


                            $j++;
                            echo '
                                                                     <tr>
                                                                        <td>' . $j . '</td                                                                        
                                                                        <td>' . $value['nomCLasse'] . '</td>
                                                                        <td>' . $value['niveau'] . '</td>
                                                                     
                                                                     </tr>
                                                                     
                                                                     ';
                        }

                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal end -->
<? php //  require('script/param.php') ?>