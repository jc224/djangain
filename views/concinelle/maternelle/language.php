<div class="content container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <h5 class="text-uppercase mb-0 mt-0 page-title">LANGUAGES</h5>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <ul class="breadcrumb float-right p-0 mb-0">
          <li class="breadcrumb-item">
            <a href="#">
              <i class="fas fa-home"></i> Acceuil </a>
          </li>
          <li class="breadcrumb-item">
            <a href="#">languages</a>
          </li>
          <li class="breadcrumb-item">
            <span>Liste des laguages </span>
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
                        <div class="page-title">LISTE DES laguages </div>
                      </div>
                      <div class="col-sm-6 text-sm-right">
                        <a href="#" class="btn btn-primary text-reight" onclick="$('#etat').css('display','none'); $('#anneescolaire-form')[0].reset()" data-toggle="modal"
                          data-target="#add_leavetype">Ajouter</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">

                    <form class="md-float-material form-material"
                      action="<?= Yii::$app->request->baseUrl . '/' . md5('evaluation_langage') ?>" name="login-form"
                      id="formfiltre" method="post">
                      <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                      <input type="hidden" name="action" value="filtrrecherche" />
                      <input type="hidden" name="code" />
                      <div class="row filter-row">
                        <div class="col-sm-2 col-md-3">

                          <div class="form-group form-focus">

                            <select name="classetSearch" class="form-control">

                              <option value=''>selectionner une classe</option>

                              <?php

                              if (sizeof($classe) > 0) {

                                foreach ($classe as $key => $value) {

                                  $selected = (isset($post) && $post['classetSearch'] == $value['code']) ? 'selected' : '';



                                  echo '

                                  <option value="' . $value['code'] . '"  ' . $selected . ' >' . $value['libelle'] . '</option>

                                  ';
                                }
                              }

                              ?>

                            </select>

                            <label class="focus-label">Classe </label>



                          </div>

                        </div>
                        <div class="col-sm-2 col-md-3">

                          <div class="form-group form-focus">

                            <select class="form-control form-select" name="langagefiltre" id="langagefiltre">
                              <option value="" hidden>selectionner un langage</option>

                              <option value="1" <?=(isset($post) && $post['langagefiltre'] == '1') ? 'selected' : '';?>>Langage Oral</option>
                              <option value="2"  <?=(isset($post) && $post['langagefiltre'] == '2') ? 'selected' : '';?>>Langage Ecrit </option>
                              <option value="3" <?=(isset($post) && $post['langagefiltre'] == '3') ? 'selected' : '';?>>Activités Artistiques  </option>
                              <option value="4"  <?=(isset($post) && $post['langagefiltre'] == '4') ? 'selected' : '';?>>Explorer le monde </option>
                              <option value="5" <?=(isset($post) && $post['langagefiltre'] == '5') ? 'selected' : '';?>>Outils Mathématiques  </option>
                            </select>
                            <label class="focus-label"> <?= yii::t("app", 'langage') ?> </label>



                          </div>

                        </div>

                        <div class="col-sm-2 col-md-3">

                          <a href="javascript:;" onclick="$('#formfiltre').submit()" class="btn btn-search btn-sm rounded btn-block mb-3"> Rehercher

                          </a>

                        </div>


                      </div>
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
                                        style="width: 191.016px;">Libelle</th>
                                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Name: activate to sort column ascending"
                                        style="width: 191.016px;">Language</th>
                                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Name: activate to sort column ascending"
                                        style="width: 191.016px;">Classe</th>
                                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Office: activate to sort column ascending"
                                        style="width: 145.188px;">Actions</th>

                                  </thead>
                                  <tbody>
                                    <?php
                                    if (isset($liste) && sizeof($liste)) {
                                      $j = 0;
                                      foreach ($liste as $key => $value) {
                                        //  die(var_dump($value));
                                        $langage = yii::$app->simplelClass->getlangage($value['typelangage']);
                                        $class = yii::$app->mainCLass->unidata('dj_classe', $value['codeclasse']);
                                        $classelib = (isset($class['libelle']) ? $class['libelle'] : '');

                                        $btnmodifier = '<button type="button" class="btn btn-primary modifierAnee"   onclick="$(\'#etat\').css(\'display\',\'block\');document.getElementById(\'action\').value=\'' . md5(strtolower("modifierfonction")) . '\';document.getElementById(\'libelle\').value=\'' . $value['libelle'] . '\'; document.getElementById(\'code\').value=\'' . $value['code'] . '\'; $(\'#classe\').val(\'' . $value['codeclasse'] . '\'); $(\'#langage\').val(\'' . $value['typelangage'] . '\'); $(\'#editemo\').val(\'1\');" style="background-color:#041e42;" 
                                                        data-toggle="modal" data-target="#add_leavetype">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                        modifier
                                                        </button>';

                                        $j++;
                                        echo '
                                                        <tr>
                                                        <td>' . $j . '</td>
                                                        <td >' . $value['libelle'] . '</td>
                                                        <td >' . $langage . '</td>
                                                        <td >' . $classelib . '</td>
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
                  </form>
                </div>
              </div>


              <div id="add_leavetype" class="modal" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-head bg-primary">
                      <h4 class="modal-title" id="standard-modalLabel">Languages</h4>
                    </div>
                    <form class="md-float-material form-material"
                      action="<?= Yii::$app->request->baseUrl . '/' . md5('evaluation_langage') ?>" name="login-form"
                      id="anneescolaire-form" method="post">
                      <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                      <input type="hidden" name="action" id="action" value="" />
                      <input type="hidden" name="code" id="code" value="" />
                      <input type="hidden" name="modifier" id="editemo" value="" />
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
                              <label for="validationDefault02" class="required">
                                <?= yii::t("app", 'langage') ?>
                              </label>
                              <select class="form-control form-select" name="langage" id="langage">
                                <option value="" hidden>selectionner un langage</option>

                                <option value="1">Langage Oral</option>
                                <option value="2">Langage Ecrit </option>
                                <option value="3">Activités Artistiques</option>
                                <option value="4">Explorer le monde </option>
                                <option value="5">Outils Mathématiques</option>
                              </select>



                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group form-primary">
                              <label for="validationDefault02" class="required">
                                <?= yii::t("app", 'Classe') ?>
                              </label>
                              <select class="form-control form-select" name="classe" id="classe">
                                <option value="">selectionner une classe</option>
                                <?php
                                if (sizeof($classe) > 0) {
                                  foreach ($classe as $key => $value) {
                                    echo '<option value="' . $value['code'] . '">' . $value['libelle'] . '</option>';
                                  }
                                }

                                ?>
                              </select>



                            </div>
                          </div>
                        </div>
                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group form-primary">
                              <label class=" fs-7">Libellé </label>

                              <input class="form-control" type="text" id="libelle" name="libelle" value="">
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
      <?php require('script.php');
