<div class="content container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <h5 class="text-uppercase mb-0 mt-0 page-title">COMPTABILITE</h5>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <ul class="breadcrumb float-right p-0 mb-0">
          <li class="breadcrumb-item">
            <a href="#">
              <i class="fas fa-home"></i> Acceuil </a>
          </li>
          <li class="breadcrumb-item">
            <a href="#">Comptabilité</a>
          </li>
          <li class="breadcrumb-item">
            <span>Liste des Paiements</span>
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
                        <div class="page-title">Liste des Paiements </div>
                      </div>
                      <div class="col-sm-6 text-sm-right">
                        <a href="#" class="btn btn-primary text-reight" data-toggle="modal"
                          data-target="#exampleModal">Ajouter un Payement</a>
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
                                  style="width: 191.016px;">CLASSES</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                  colspan="1" aria-label="Office: activate to sort column ascending"
                                  style="width: 145.188px;">ACTES</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                  colspan="1" aria-label="Office: activate to sort column ascending"
                                  style="width: 145.188px;">MONTANTS</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                  colspan="1" aria-label="Office: activate to sort column ascending"
                                  style="width: 145.188px;">ACTEUR</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                  colspan="1" aria-label="Office: activate to sort column ascending"
                                  style="width: 145.188px;">ACTIONS</th>

                            </thead>
                            <tbody>
                              <?php
                              if (isset($listepaiement) && sizeof($listepaiement)) {
                                $j = 0;
                                foreach ($listepaiement as $key => $value) {
                                  $usercode = yii::$app->mainCLass->getusers();

                                  $user = yii::$app->accessClass->chargerUserAuthData($usercode);
                                  $btnmodifier = '<button type="button" class="btn btn-primary modifierAnee"   onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("modifierpaiement")) . '\';document.getElementById(\'montant\').value=\'' . $value['montant'] . '\'; document.getElementById(\'code\').value=\'' . $value['code'] . '\'; " data-toggle="modal" data-target="#staticBackdrop">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                modifier
                                                </button>';
                                  $j++;
                                  echo '
                                            <tr>
                                            <td>' . $j . '</td>
                                            <td>' . $value['classe'] . '</td>
                                            <td>' . $value['paiement'] . '</td>
                                            <td>' . $value['montant'] . ' GNF</td>
                                            <td>' . $user['admin_name'] . ' </td>
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
              </div>
            </div>
          </div>


          <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Modifier un paiement</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form class="md-float-material form-material"
                  action="<?= Yii::$app->request->baseUrl . '/' . md5('param_paramscolaire') ?>" name="login-form"
                  id="anneescolaire-form" method="post">
                  <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                  <input type="hidden" name="action" id="action" value="" />
                  <input type="hidden" name="code" id="code" value="" />
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group form-primary">
                          <label class=" fs-7">Montant a payer</label>

                          <input type="text" class="form-control" placehoder="Montant a payer" name="montantM" id="montantupdate">
                          <span class="form-bar"></span>
                        </div>

                      </div>
                    </div>
                  </div>
                </form>
                  <div class="modal-footer">
                    <button type="submit" class="btn   btn-primary" id="addp" onclick="modifiercat()">Enregistrer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                  </div>
              </div>
            </div>
          </div>


          <div id="exampleModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-head bg-primary">
                  <h4 class="modal-title" id="standard-modalLabel">ACTE</h4>
                </div>
                <form class="md-float-material form-material"
                  action="<?= Yii::$app->request->baseUrl . '/' . md5('param_paramscolaire') ?>" name="login-form"
                  id="mpaiement" method="post">
                  <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                  <input type="hidden" name="action"  value="" />
                  <div class="modal-body">
                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group form-primary">
                          <label class=" fs-7">Paiement</label>

                          <select class="form-control" name="paiement" id="seletpaiement" onchange="selectpaiement()">
                            <option hidden value="">Selectionner...</option>
                            <?php
                            if (isset($paiement)) {
                              foreach ($paiement as $key => $value) {
                                echo '  <option  value="' . $value['code'] . '">' . $value['libelle'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <span class="form-bar"></span>

                        </div>

                      </div>

                      <div class="col-md-12">
                        <div class="form-group form-primary">
                          <label class=" fs-7">Montant a payer</label>

                          <input type="text" class="form-control" placehoder="Montant a payer" name="montant" id="montant">
                          <span class="form-bar"></span>
                        </div>

                      </div>

                      <div class="col-md-12">
                        <label class=" fs-7">CLASSE</label>

                        <div class="row" id="classe">



                          <span class="form-bar"></span>

                        </div>

                      </div>
                    </div>
                  </div>
                </form>

                <div class="modal-footer">
                  <button type="submit" class="btn   btn-primary" id="btnajout" onclick="ajoutcatpaiement()">Enregistrer</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                </div>
              </div>
            </div>
          </div>




        </div>
      </div>

      <?php require('script/param.php'); ?>