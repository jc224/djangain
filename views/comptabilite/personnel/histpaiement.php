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

    <div class="col-sm-4 col-5"></div>

    <div class="col-sm-8 col-7 text-right add-btn-col">

      <a href="#" class="btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#add_salary">

        <i class="fas fa-plus"></i> Add Salary </a>

    </div>

  </div>

  <div class="content-page">

    <div class="row filter-row">

    



      <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-12">

        <div class="form-group form-focus">

          <input class="form-control datetimepicker-input datetimepicker floating" type="text" data-toggle="datetimepicker">

          <label class="focus-label">From</label>

        </div>

      </div>

      <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">

        <div class="form-group form-focus">

          <input class="form-control datetimepicker-input datetimepicker floating" type="text" data-toggle="datetimepicker">

          <label class="focus-label">To</label>

        </div>

      </div>

      <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12 ">

        <a href="#" class="btn btn-search rounded btn-block mb-3"> search </a>

      </div>

    </div>

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

                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 91.2656px;">Total Heure</th>

                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Joining Date: activate to sort column ascending" style="width: 86.6875px;">Net - Paier</th>

                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Joining Date: activate to sort column ascending" style="width: 86.6875px;">Montant Paier</th>

                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 121.188px;">Reste</th>

                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 43.8438px;">Codeusers</th>

                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Payslip: activate to sort column ascending" style="width: 91.375px;">Derniermodif</th>

                      <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 45.4375px;">Action</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                        if(sizeof($liste)>0){

                            foreach ($liste as $key => $value) {

                                $user = yii::$app->accessClass->chargerUserAuthData($value['codeusers']);



                                // die(var_dump($value));

                               $paiement = yii::$app->mainCLass->databycode('dj_payementpers',$value['codePaiement'],'code')['0'];

                                echo'<tr>

                                <td class="">

                                <h2>'.$paiement['libelle'].'</a>

                               

                                </h2>

                                <td>'.$value['datepaiement'].'</td>

                                <td>'.$value['totalHeure'].' H</td>

                                <td>'.number_format($value['netPayer'],0,".",".").' GNF</td>

                                <td>'.number_format($value['MontantPayer'],0,".",".").' GNF</td>

                                <td>'.number_format($value['reste'],0,".",".").' GNF</td>

                                <td>'.(isset($user['admin_name']) ? $user['admin_name'] :'' ).'  </td>

                                <td>'.$value['dernierupdate'].' </td>

                              </td>

                              <td class="text-right">

                              <div class="dropdown dropdown-action">

                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                                  <i class="fas fa-ellipsis-v"></i>

                                </a>

                                <div class="dropdown-menu dropdown-menu-right">

                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_salary" title="Edit">

                                    <i class="fas fa-pencil-alt m-r-5"></i> Edit </a>

                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_salary" title="Delete">

                                    <i class="fas fa-trash-alt m-r-5"></i> Delete </a>

                                </div>

                              </div>

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