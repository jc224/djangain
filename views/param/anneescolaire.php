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

    <div class="row">
      <div class="col-sm-6 col-md-6 mt-2 ">
        <div class="page-title">LISTE DES ANNEES SCOLAIRE </div>

      </div>
      <div class="col-sm-6 col-md-6 add-btn-col">
        <a href="#" class="btn btn-primary btn-rounded float-md-right mt-2 "
          onclick="$('#etat').css('display','none'); $('#anneescolaire-form')[0].reset()" data-toggle="modal" data-target="#add_leavetype">
          <i class="fas fa-plus"></i> Ajouter une année Scolaire </a>
      </div>
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
                    <th>#</th>
                    <th>Libelle</th>
                    <th>status</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (isset($liste) && sizeof($liste)) {
                    $j = 0;
                    foreach ($liste as $key => $value) {
                      $btnmodifier = '<button type="button" class="btn modifierAnee text-white"   onclick="$(\'#etat\').css(\'display\',\'block\');document.getElementById(\'libAnnee\').value=\'' . $value['libelle'] . '\'; document.getElementById(\'code\').value=\'' . $value['code'] . '\';  document.getElementById(\'code\').value=\'' . $value['code'] . '\';  document.getElementById(\'action\').value=\'' . md5(strtolower("modifier")) . '\'; " style="background-color:#041e42;"  data-toggle="modal" data-target="#add_leavetype" >
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        modifier
                                    </button>';
                      $delete = '<button type="button" class="btn btn-danger modifierAnee"   onclick="  document.getElementById(\'libAnnee\').value=\'' . $value['libelle'] . '\'; " data-toggle="modal" data-target="#exampleModalLabel">
                                            Supprimer   <i class="fa fa-remove" aria-hidden="true"></i>
                                    </button>';

                      if ($value['statut'] == 0) {
                        $default = '<a href="javascript:;" Class="btn btn-success btn-sm btn-rounded "   onclick="  document.getElementById(\'action\').value=\'' . md5(strtolower("cocherCetteAnneeScolaireParDefault")) . '\';  document.getElementById(\'code\').value=\'' . $value["code"] . '\';$(\'#anneescolaire-form\').submit(); ">' . Yii::t("app", "Choisie Par deFualt") . '</a>';
                      } else {
                        $default = '<a href="javascript:;" Class="btn btn-white btn-sm btn-rounded  disabled">' . Yii::t("app", "Par default") . '</a>';
                      }


                      $j++;
                      echo '
                                    <tr>
                                        <td>' . $j . '</td>
                                        <td>' . $value['libelle'] . '</td>
                                        <td>' . $default . '</td>
                                        <td>' . $btnmodifier . ' </td>
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
      </div>
    </div>

    <div id="add_leavetype" class="modal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-head bg-primary">
            <h4 class="modal-title" id="standard-modalLabel">Modifier L'année Scolaire</h4>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate=""
              action="<?= Yii::$app->request->baseUrl . '/' . md5('param_anneescolaire') ?>" name="login-form"
              id="anneescolaire-form" method="post">
              <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
              <input type="hidden" name="action" id="action" value="" />
              <input type="hidden" name="code" id="code" value="" />
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group form-primary" id="etat" style="display:none;">
                    <label for="validationDefault02" class="required">
                      <?= yii::t("app", 'etat') ?>
                    </label>
                    <select class="form-control form-select" name="etat" id="etatsected">
                      <?php

                      $etat = yii::$app->simplelClass->etat();
                      foreach ($etat as $key => $value) {
                        echo '<option value="' . $key . '">' . $value . '</option>';
                      }
                      ?>
                    </select>


                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-outline mb-4">
                    <label for="validationDefault02" class="required">Année Scolaire *</label>
                    <input type="text" class="form-control " id="libAnnee" name="anneeScolaire" placeholder=""
                      aria-describedby="inputGroupPrepend3" required="">


                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button  class="btn  btn-primary" id="btnajout" onclick="ajouter()">Enregistrer</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          </div>
        </div>
      </div>

    </div>
  </div>


  <?php require('script/param.php');
