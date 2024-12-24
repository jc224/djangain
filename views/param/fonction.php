<div class="content container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <h5 class="text-uppercase mb-0 mt-0 page-title">FONCTIONS</h5>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <ul class="breadcrumb float-right p-0 mb-0">
          <li class="breadcrumb-item">
            <a href="#">
              <i class="fas fa-home"></i> Acceuil </a>
          </li>
          <li class="breadcrumb-item">
            <a href="#">Fonctions</a>
          </li>
          <li class="breadcrumb-item">
            <span>Liste des Fonctions</span>
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
                        <div class="page-title">LISTE DES FONCTIONS </div>
                      </div>
                      <div class="col-sm-6 text-sm-right">
                        <a href="#" class="btn btn-primary text-reight" onclick="$('#etat').css('display','none'); $('#anneescolaire-form')[0].reset()" data-toggle="modal"
                          data-target="#add_leavetype">Ajouter une fonction</a>
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
                                  style="width: 191.016px;">Fonctions</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                  colspan="1" aria-label="Office: activate to sort column ascending"
                                  style="width: 145.188px;">Actions</th>

                            </thead>
                            <tbody>
                              <?php
                              if (isset($fonction) && sizeof($fonction)) {
                                $j = 0;
                                foreach ($fonction as $key => $value) {
                                  //  die(var_dump($value));
                                  $btnmodifier = '<button type="button" class="btn btn-primary modifierAnee"   onclick="$(\'#etat\').css(\'display\',\'block\');document.getElementById(\'action\').value=\'' . md5(strtolower("modifierfonction")) . '\';document.getElementById(\'fonction\').value=\'' . $value['libelle'] . '\'; document.getElementById(\'code\').value=\'' . $value['code'] . '\'; " style="background-color:#041e42;" 
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
                      <h4 class="modal-title" id="standard-modalLabel">Fonction</h4>
                    </div>
                    <form class="md-float-material form-material"
                      action="<?= Yii::$app->request->baseUrl . '/' . md5('param_fonction') ?>" name="login-form"
                      id="anneescolaire-form" method="post">
                      <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                      <input type="hidden" name="action" id="action" value="" />
                      <input type="hidden" name="code" id="code" value="" />
                      <div class="modal-body">

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
                            <div class="form-group form-primary">
                              <label class=" fs-7">Libellé Fonction </label>

                              <input class="form-control" type="text" id="fonction" name="fonction" value="">
                              <span class="form-bar"></span>
                            </div>

                          </div>
                        </div>





                      </div>
                    </form>

                    <div class="modal-footer">
                      <button onclick="ajouterfonction()" class="btn   btn-primary" id="btnajout">Enregistrer</button>
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
