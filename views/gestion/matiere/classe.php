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

            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        <div class="row align-items-center">

                            <div class="col-sm-6">

                                <div class="page-title mt-4">Liste Des Classes </div>

                            </div>

                            <div class="col-sm-6 text-sm-right">

                                <a href="#" class="btn btn-primary text-reight mt-4" data-toggle="modal"

                                    data-target="#exampleModal">Ajouter une Matières</a>

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

                                            if (isset($classe) && sizeof($classe)) {

                                                $j = 0;

                                                foreach ($classe as $key => $value) {



                                                    $nb = Yii::$app->configClass->selectclassematiers($value['code']);



                                                    $btnmodifier = '<a  href=' . yii::$app->request->baseUrl . '/' . md5('gestion_detailsmatiers') . '/' . $value['code'] . ' class="btn btn-primary modifierAnee"   onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("modifierpaiement")) . '\'; document.getElementById(\'classe\').value=\'' . $value['code'] . '\'; " >

                                                        <i class="fa fa-eye" aria-hidden="true"></i>

                                                        Deatails

                                                        </a>';

                                                    $j++;

                                                    echo '

                                                    <tr>

                                                    <td>' . $j . '</td>

                                                    <td>' . $value['libelle'] . '</td>

                                                    <td>' . $nb . '</td>

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

                            <h4 class="modal-title" id="standard-modalLabel">Affectation</h4>

                        </div>



                        <div class="modal-body">

                            <form class="needs-validation" novalidate=""

                                action="<?= Yii::$app->request->baseUrl . '/' . md5('gestion_agmatier') ?>" name="login-form"

                                id="anneescolaire-form" method="post">

                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

                                <input type="hidden" name="action" id="action" value="" />
                                <div class="row">



                                    <div class="col-md-12">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">Matières</label>



                                            <select class="form-control" name="matiere" id="seletmatier"

                                                onchange="selectmat()">

                                                <option hidden value="">Sélèctionner une matière...</option>

                                                <?php

                                                if (isset($matiere)) {

                                                    foreach ($matiere as $key => $value) {

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

                                            <label class=" fs-7">coefficients</label>



                                            <input type="number" min='1' value="1" class="form-control" placehoder="" name="coeficients"

                                                id="">

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>



                                    <div class="col-md-12">

                                        <div class="row " id="classe">



                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="modal-footer">

                            <button  onclick="ajoutermatier()" class="btn  btn-primary" id="btnajout">Enregistrer</a>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>



    <?php require('script/script.php');
