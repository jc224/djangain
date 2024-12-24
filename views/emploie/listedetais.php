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
                        <div class="page-title">LISTE DES EMPLOIE DE TEMPS PAR CLASSE </div>
                      </div>

                    </div>
                  </div>
                  <div class="card-body">
                    <form class="md-float-material form-material"
                      action="<?= Yii::$app->request->baseUrl . '/' . md5('emploie_emploie') ?>" name="login-form"
                      id="anneescolaire" method="post" target="_blank">
                      <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                      <input type="hidden" name="action" id="action" value="" />
                      <input type="hidden" name="code" id="code" value="" />
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
                                    style="width: 191.016px;">Date Debut</th>
                                  <th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" aria-label="Position: activate to sort column ascending"
                                    aria-sort="descending" style="width: 311.312px;">Date Fin</th>
                                  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" aria-label="Office: activate to sort column ascending"
                                    style="width: 145.188px;">Actions</th>

                              </thead>
                              <tbody>
                                <?php
                                if (isset($emploie) && sizeof($emploie)) {
                                  $j = 0;
                                  foreach ($emploie as $key => $value) {
                                    //  die(var_dump($value));
                                    $autBtn = '<a href="javascript:;" onclick="$(\'#action\').val(\'' . md5('imprimer') . '\');$(\'#code\').val(\'' . $value["code"] . '\');$(\'#anneescolaire\').submit()" Class="btn btn-circle btn-info"    
                                                    " >  <i class="fa fa-eye" aria-hidden="true"></i> ' . yii::t("app", 'Imprimer') . '</a>';




                                    $j++;
                                    echo '
                                                    <tr>
                                                    <td>' . $j . '</td>
                                                    <td>' . $value['dateDebut'] . '</td>
                                                    <td >' . $value['dateFin'] . '</td>
                                                    <td class="text-end"> ' . $autBtn . ' </td>
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
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>





    </div>