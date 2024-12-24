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
          <form class="needs-validation" novalidate=""
            action="<?= Yii::$app->request->baseUrl . '/' . md5('param_adduser') ?>" name="login-form"
            id="formTY" method="post">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
            <input type="hidden" name="action" id="action" value="" />
            <input type="hidden" name="code" id="code" value="" />
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <div class="row align-items-center">
                        <div class="col-sm-6">
                          <div class="page-title">LISTE DES TYPE UTILIISATEUR</div>
                        </div>
                        <div class="col-sm-6 text-right">
                          <a href="<?= yii::$app->request->baseUrl . '/' . md5('param_adduser') ?>"
                            class="btn btn-primary">
                            Ajouter Un Type
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                          <div class="table-responsive">
                            <table class="table custom-table">
                              <thead class="table-light">

                                <caption>Liste des Utilisateurs</caption>
                                <tr>
                                  <th class="text-start">#</th>

                                  <th>Type </th>
                                  <th>Action </th>
                                </tr>

                              </thead>
                              <tbody>
                                <?php
                                if (sizeof($users) > 0) {
                                  $j = 0;
                                  foreach ($users as $key => $value) {
                                    $j++;
                                    $autBtn = '<a href="javascript:;" Class="btn btn-circle btn-primary"   data-bs-toggle="modal" data-bs-target="#kt_modal_add_user"   onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("modifiertypeuser")) . '\';  document.getElementById(\'code\').value=\'' . $value["code"] . '\';$(\'#formTY\').submit();">' . yii::t("app", 'Modifier') . '</a>';

                                    // die(var_dump($valuex));

                                    echo '
                                          <tr class="texet-center" >
                                          <td scope="row">' . $j . '</td>
                                          <td>' . $value['groupe'] . '</td>
                                         
                                          <td >' . $autBtn . '</td>
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
          </form>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
          aria-hidden="true">
          <div class="modal-dialog modal-lg  modal-fullscreen" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Création d'un utilisateur</h5>

              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate="" id="form" method="post" enctype="multipart/form-data"
                  action="<?= Yii::$app->request->baseUrl . '/' . md5('gestion_creatusers') ?>">
                  <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group form-primary">
                        <label class=" fs-7">Libellé * </label>

                        <input class="form-control" type="text" id="libelle" name="libelle" value="" required="">
                      </div>
                    </div>
                    <div class="row">


                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <a href="<?= yii::$app->request->baseUrl . '/' . md5('param_adduser ') ?>" onclick="ajouterusers()"
                  class="btn   btn-primary">Enregistrer</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Reour</button>
              </div>
            </div>
          </div>
        </div>



        <!-- Modal end -->
        <script>
          $(document).ready(function() {
            $('#image').change(function() {
              $("#frames").html('');
              for (var i = 0; i < $(this)[0].files.length; i++) {
                $("#frames").append('<img src="' + window.URL.createObjectURL(this.files[i]) + '" width="100px" height="100px"/>');
              }
            });


          });
        </script>

        <?php require('script/param.php'); ?>