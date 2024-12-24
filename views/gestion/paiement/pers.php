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

        

        <form class="needs-validation" novalidate=""

            action="<?= Yii::$app->request->baseUrl . '/' . md5('gestion_payementpers') ?>" name="login-form"

            id="anneescolaire-form" method="post">

            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

            <input type="hidden" name="action" id="action" value="" />

            <input type="hidden" name="codep" id="codep" value="" />



            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-header">

                            <div class="row align-items-center">

                                <div class="col-sm-6">

                                    <div class="page-title mt-4">Liste Des Paiement des Personnel </div>

                                </div>

                                <div class="col-sm-6 text-sm-right">

                                    <a href="#" class="btn btn-primary text-reight mt-4" data-toggle="modal"

                                        data-target="#exampleModal">Ajouter un paiement</a>

                                </div>

                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                                    <div class="table-responsive">

                                        <table class="datatable table table-stripped dataTable no-footer"

                                            id="DataTables_Table_0" role="grid"

                                            aria-describedby="DataTables_Table_0_info">

                                            <thead>

                                                <tr role="row">

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"

                                                        rowspan="1" colspan="1"

                                                        aria-label="Name: activate to sort column ascending"

                                                        style="width: 191.016px;">#</th>

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"

                                                        rowspan="1" colspan="1"

                                                        aria-label="Name: activate to sort column ascending"

                                                        style="width: 191.016px;">Classe</th>

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"

                                                        rowspan="1" colspan="1"

                                                        aria-label="Office: activate to sort column ascending"

                                                        style="width: 145.188px;">Total Matières</th>

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"

                                                        rowspan="1" colspan="1"

                                                        aria-label="Office: activate to sort column ascending"

                                                        style="width: 145.188px;">Action</th>

                                            </thead>

                                            <tbody>

                                                <?php

                                                if (isset($liste) && sizeof($liste)) {

                                                    $j = 0;

                                                    foreach ($liste as $key => $value) {



                                                      

                                                        $btnmodifier = '<button type="button" class="btn btn-primary modifierAnee"   onclick="$(\'#fonction\').val(\''.$value['codeFonction'].'\');$(\'#codep\').val(\''.$value['code'].'\');$(\'#montant\').val(\'' . $value['montant'] . '\');document.getElementById(\'action\').value=\'' . md5(strtolower("modifierpaiement")) . '\';document.getElementById(\'matieres\').value=\'' . $value['libelle'] . '\';  " data-toggle="modal" data-target="#exampleModal">

                                                        <i class="fa fa-edit" aria-hidden="true"></i>

                                                        modifier

                                                        </button>';

                                                        $j++;

                                                        echo '

                                                    <tr>

                                                    <td>' . $j . '</td>

                                                    <td>' . $value['libelle'] . '</td>

                                                    <td>' .number_format($value['montant'],0,".") . 'GNF</td>

                                                    <td>' . $btnmodifier . '</td>

                                                

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

                <div id="exampleModal" class="modal fade" tabindex="-1" role="dialog"

                    aria-labelledby="standard-modalLabel" aria-hidden="true">

                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">

                            <div class="modal-head bg-primary">

                                <h4 class="modal-title" id="standard-modalLabel">AJOUTER UN PAIEMENT</h4>

                            </div>



                            <div class="modal-body">

                                <div class="row">



                                    <div class="col-md-12">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">Fonction</label>



                                            <select class="form-control" name="fonction" id="fonction"

                                                onchange="selectmat()" required="">

                                                <option hidden value="">Sélèctionner une fonction...</option>

                                                <?php

                                                if (isset($fonction) && sizeof($fonction)>0) {

                                                    foreach ($fonction as $key => $value) {

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

                                            <label class=" fs-7">Montant</label>



                                            <input type="number" min='0' required="" value="" class="form-control" placehoder="" name="Montant"

                                                id="montant">

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>



                                    <div class="col-md-12">

                                    <div class="row " id="classe">

                                    

                                    </div>

                                    </div>

                                </div>











                            </div>

                            <div class="modal-footer">

                            <button type="submit" class="btn   btn-primary">Enregistrer</button>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                            </div>

                        </div>

                    </div>

                </div>

        </form>

    </div>

</div>



