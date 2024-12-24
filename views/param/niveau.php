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
  <div class="content-page">
 
    <div class="row">
      <div class="col-sm-16 col-6 ">
        <div class="page-title">LISTE DES NIVEAUX </div>

      </div>
      <div class="col-sm-16 col-6 float-right add-btn-col">
        <a href="#" class="btn btn-primary btn-rounded float-right" onclick="$('#etat').css('display','none'); $('#anneescolaire-form')[0].reset()" data-toggle="modal" data-target="#add_leavetype">
          <i class="fas fa-plus"></i> Ajouter un Niveau</a>
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
                    <th class="text-center">Libellé</th>
                    <th class="text-center">Types de composition</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (isset($liste) && sizeof($liste)) {
                    $j = 0;
                    foreach ($liste as $key => $value) {

                      $editBtn = '<a href="javascript:;" Class="btn btn-circle btn-primary"   
                                    onclick="$(\'#etat\').css(\'display\',\'block\');  document.getElementById(\'niveauEleve\').value=\'' . $value['libelle'] . '\';
                                    document.getElementById(\'action\').value=\'' . md5(strtolower("modiferAnner")) . '\';
                                    document.getElementById(\'code\').value=\'' . $value['code'] . '\';
                                    document.getElementById(\'typeCompo\').value=\'' . $value['typeCompo'] . '\'; "    style="background-color:#041e42;" 
                                    style="background-color:#041e42;"  data-toggle="modal" data-target="#add_leavetype"> <i class="fa fa-edit" aria-hidden="true"  ></i> ' . yii::t("app", 'Modifier') . '</a>';


                      $delete = '<button type="button" class="btn btn-danger modifierAnee"   onclick="  document.getElementById(\'libAnnee\').value=\'' . $value['libelle'] . '\'; " data-toggle="modal" data-target="#exampleModalLabel">
                                            Supprimer   <i class="fa fa-remove" aria-hidden="true"></i>
                                    </button>';


                      if ($value['typeCompo'] == 1) {
                        $typeCompos = 'Trimestre';
                      } else {
                        $typeCompos = 'Semestre';
                      }


                      $j++;
                      echo '
                                    <tr>
                                        <td>' . $j . '</td>
                                        <td class="text-center">' . $value['libelle'] . '</td>
                                        <td  class="text-center">' . $typeCompos . '</td>
                                        <td class="text-right">' . $editBtn . ' </td>
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
            <h4 class="modal-title" id="standard-modalLabel">Modifier un niveau</h4>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate="" action="<?= Yii::$app->request->baseUrl . '/' . md5('param_niveau') ?>"
              name="login-form" id="anneescolaire-form" method="post">
              <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
              <input type="hidden" name="action" id="action" value="" />
              <input type="hidden" name="code" id="code" value="" />
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group form-primary" id="etat" style="display:none;">
                    <label for="validationDefault02" class="required"><?= yii::t("app", 'etat') ?></label>
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
                  <div class="form-group form-primary">
                    <label class="float-label fs-7">Type De composition *</label>

                    <select name="typeCompo" class="form-select form-control" id="typeCompo" value="" required="">
                      <option value="" hidden>sélectionner..</option>
                      <?php
                      foreach ($typeCompo as $key => $value) {
                        echo '
                                       <option value="' . $value['code'] . '">' . $value['libelle'] . '</option>
                                      ';
                      }
                      ?>
                    </select>

                  </div>
                </div>

              </div>
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group form-primary">
                    <label class="float-label fs-7">Libellé Niveau *</label>

                    <input class="form-control" type="text" id="niveauEleve" name="niveau" value="" required="">
                    <span class="form-bar"></span>
                  </div>

                </div>
              </div>

          </div>
          </form>
          <div class="modal-footer">
            <button onclick="ajouterniveau()" class="btn   btn-primary" id="btnajout">Enregistrer</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
          </div>
        </div>
      </div>

    </div>

  </div>
  <?php require('script/param.php');
