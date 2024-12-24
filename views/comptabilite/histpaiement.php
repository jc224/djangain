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



    <div class="content-page">
      <form class="needs-validation" novalidate="" action="<?= Yii::$app->request->baseUrl . '/' . md5('comptable_histroique') ?>" name="form-liste" id="ajoutforme" method="post">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
        <input type="hidden" name="action" id="action" value="<?= md5('filtrer') ?>" />
        <div class="row filter-row">

          <div class="col-sm-6 col-md-3">

            <div class="form-group form-focus">



              <input type="text" name="search" id="search" placeholder="Recercher...."

                class="form-control " value="<?=$search ?>">

              <label class="focus-label">Rechercher </label>



            </div>

          </div>
          <div class="col-sm-6 col-md-3">

            <div class="form-group form-focus">

              <select name="catsearch" class="form-control">

                <option value="">Tous</option>

                <?php

                if (sizeof($payement) > 0) {

                  foreach ($payement as $key => $value) {

                    $selected =   ($acte  == $value['code']) ?  'selected' : '';
                    echo '

                           <option value="' . $value['code'] . '" '.$selected.'  >' . $value['libelle'] . '</option>



                          ';
                  }
                }

                ?>

              </select>

              <label class="focus-label">Paiement </label>



            </div>

          </div>
          <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
              <select name="groupepersonnel" class="form-control">

                <option value="">Tous</option>
                <option value="2" <?=$groupe == "2" ? 'selected' : '' ?>>Enseignant</option>
                <option value="1"  <?=$groupe == "1" ? 'selected' : '' ?>>Personnel</option>

              </select>

              <label class="focus-label">Enseignat/personnel </label>


            </div>

          </div>
          <div class="col-sm-6 col-md-3">

            <button type="submit" class="btn btn-search btn-sm rounded btn-block mb-3" onclick="$('#ajoutforme').submit()"> Rehercher

            </button>

          </div>
        </div>
      </form>

      <div class="row">
        <div class="col-md-12 mb-3">
          <h3>Montant total :: <span class="badge badge-success"><?= number_format($montantotal, 0, '.', '.') ?> GNF</span></h3>
        </div>
        <div class="col-md-12 mb-3">

          <div class="table-responsive mt-2">

            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

              <div class="row">

                <div class="col-sm-12">

                  <table class="table custom-table datatable  dataTable " id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">

                    <thead class="thead-light">

                      <tr role="row">

                        <th>[]</th>

                        <th class="sorting" style="width: 50px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-label="Salary: activate to sort column ascending" style="width: 43.8438px;">Personnel</th>



                        <th style="width: 200.5px;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Employee: activate to sort column ascending">Libelle Paiement</th>

                        <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Employee ID: activate to sort column descending" aria-sort="ascending" style="width: 86.7031px;">Date Paiement</th>

                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Joining Date: activate to sort column ascending" style="width: 86.6875px;">Net - Paier</th>

                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 43.8438px;">Codeusers</th>

                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Payslip: activate to sort column ascending" style="width: 91.375px;">Derniermodif</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php

                      if (sizeof($liste) > 0) {

                        $j = 0;

                        foreach ($liste as $key => $value) {

                          $user = yii::$app->accessClass->chargerUserAuthData($value['codeusers']);

                          $personnel = yii::$app->mainCLass->databycode('dj_personnel', $value['codePers'], 'code')['0'];

                          $j++;

                          $admin = '';



                          if ($user !== null) {

                            $admin = $user['admin_name'];
                          }

                          // die(var_dump($personnel));

                          $paiement = yii::$app->mainCLass->databycode('dj_payementpers', $value['codePaiement'], 'code')['0'];

                          echo '<tr>

                                <td>' . $j . '</td>

                                    <td>

                                  <h2 class="table-avatar">

                                  <a href="student-details.html" class="avatar avatar-sm me-2">

                                      <img class="avatar-img rounded-circle" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $personnel['photo'] . '" alt="ELEVES Image">

                                  </a>

                                  <a href="student-details.html">' . $personnel['nom'] . ' ' . $personnel['prenom'] . '</a>

                                  </h2>

                                </td>

                                <td> <h2>' . $paiement['libelle'] . '

                               

                                </h2></td>

                                <td>' . $value['datepaiement'] . '</td>

                                <td>' . number_format($value['netPayer'], 0, ".", ".") . ' GNF</td>

                               

                                <td>' . $admin . '  </td>

                                <td>' . $value['dernierupdate'] . ' </td>

                              </td>

                              

                                

                                </tr>';
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