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
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row align-items-center">
                      <div class="col-sm-6">
                        <div class="page-title">LISTE DES TAUX HORAIRE </div>
                      </div>
                      <div class="col-sm-6 text-sm-right">
                        <a href="#" class="btn btn-primary text-reight" onclick="$('#etat').css('display','none'); $('#anneescolaire-form')[0].reset()" data-toggle="modal"
                          data-target="#add_leavetype">Ajouter UN TAUX HORAIRE</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-responsive">
                          <table class="datatable table table-stripped dataTable no-footer" id="DataTables_Table_0"
                            role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                              <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                  colspan="1" aria-label="Name: activate to sort column ascending"
                                  style="width: 191.016px;">#</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                  colspan="1" aria-label="Name: activate to sort column ascending"
                                  style="width: 191.016px;">Montant</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                  colspan="1" aria-label="Office: activate to sort column ascending"
                                  style="width: 145.188px;">Actions</th>

                            </thead>
                            <tbody>
                              <?php
                              if (isset($taux) && sizeof($taux)) {
                                $j = 0;
                                foreach ($taux as $key => $value) {
                                  //  die(var_dump($value));
                                  $btnmodifier = '<button type="button" class="btn btn-primary modifierAnee"   onclick="$(\'#etat\').css(\'display\',\'block\');document.getElementById(\'action\').value=\'' . md5(strtolower("modifierfonction")) . '\';document.getElementById(\'montant\').value=\'' . $value['libelle'] . '\'; document.getElementById(\'code\').value=\'' . $value['code'] . '\'; " style="background-color:#041e42;" 
                                                    data-toggle="modal" data-target="#add_leavetype">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                    modifier
                                                    </button>';

                                  $j++;
                                  echo '
                                                    <tr>
                                                    <td>' . $j . '</td>
                                                    <td >' . $value['libelle'] . '</td>
                                                    <td >' . $btnmodifier . '</td>
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
              </div>


              <div id="add_leavetype" class="modal" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-head bg-primary">
                      <h4 class="modal-title" id="standard-modalLabel">TAUX HORAIRE</h4>
                    </div>
                    <form class="md-float-material form-material"
                      action="<?= Yii::$app->request->baseUrl . '/' . md5('param_tauxhoraire') ?>" name="login-form"
                      id="anneescolaire-form" method="post">
                      <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                      <input type="hidden" name="action" id="action" value="" />
                      <input type="hidden" name="code" id="code" value="" />
                      <div class="modal-body">

                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group form-primary">
                              <label class=" fs-7">Montant </label>

                              <input class="form-control" type="text" id="montant" name="montant" value="">
                              <span class="form-bar"></span>
                            </div>

                          </div>
                        </div>





                      </div>
                    </form>

                    <div class="modal-footer">
                      <button type="submit" class="btn   btn-primary"  id="btnajout" onclick="ajouttaux()">Enregistrer</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <?php require('script/param.php');