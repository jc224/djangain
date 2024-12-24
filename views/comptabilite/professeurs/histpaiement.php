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
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="page-title">Historique de Payement </div>
          </div>

        </div>
      </div>
      <div class="card-body">
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="table-responsive mt-2">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

              <div class="row">
                <div class="col-sm-12">
                  <table class="table custom-table datatable scroll-lg-nne dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead class="thead-light">
                      <tr role="row">
                        <th style="width: 248.5px;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Employee: activate to sort column ascending">Libelle Paiement</th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Employee ID: activate to sort column descending" aria-sort="ascending" style="width: 86.7031px;">Date Paiement</th>
                        <!-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 91.2656px;">Total Heure</th> -->
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Joining Date: activate to sort column ascending" style="width: 86.6875px;">Net - Paier</th>

                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 43.8438px;">Codeusers</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Payslip: activate to sort column ascending" style="width: 91.375px;">Derniermodif</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (sizeof($liste) > 0) {
                        foreach ($liste as $key => $value) {
                          $user = yii::$app->accessClass->chargerUserAuthData($value['codeusers']);

                          // die(var_dump($value));
                          $paiement = yii::$app->mainCLass->databycode('dj_payementpers', $value['codePaiement'], 'code')['0'];
                          echo '<tr>
                                <td class="">
                                <h2>' . $paiement['libelle'] . '</a>
                               
                                </h2>
                                <td>' . $value['datepaiement'] . '</td>
                                <td>' . number_format($value['netPayer'], 0, ".", ".") . ' GNF</td>
                                 <td>' . (isset($user['admin_name']) ? $user['admin_name'] : '') . '  </td>
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
  </div>
</div>