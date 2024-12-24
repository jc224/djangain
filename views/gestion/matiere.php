<form class="md-float-material form-material" action="<?= Yii::$app->request->baseUrl.'/'.md5('gestion_agmatier')?>" name="login-form" id="anneescolaire-form" method="post">

    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>

    <input type="hidden" name="action" id="action" value=""/>





    <div class="content container-fluid">

        <div class="page-header">

            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                    <h5 class="text-uppercase mb-0 mt-0 page-title">Matières</h5>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                    <ul class="breadcrumb float-right p-0 mb-0">

                        <li class="breadcrumb-item">

                            <a href="#">

                                <i class="fas fa-home"></i> Acceuil </a>

                        </li>

                        <li class="breadcrumb-item">

                            <span>Liste des Matières</span>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <hr>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-12">

                            <div class="card">

                                <div class="card-header">

                                    <div class="row align-items-center">

                                        <div class="col-sm-6">

                                            <div class="page-title">Liste Des Matières </div>

                                        </div>

                                        <div class="col-sm-6 text-sm-right">

                                            <a href="#" class="btn btn-primary text-reight" data-toggle="modal" data-target="#exampleModal">Ajouter une Matières</a>

                                        </div>

                                    </div>

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                                            <div class="table-responsive">

                                                <table class="datatable table table-stripped dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">

                                                    <thead>

                                                        <tr role="row">

                                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 191.016px;">#</th>

                                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 191.016px;">Matière</th>

                                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 145.188px;">coeficient</th>

                                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 145.188px;">Classe</th>

                                                    </thead>

                                                    <tbody>

                                                        <?php

                                                        if (isset($liste) && sizeof($liste)) {

                                                            $j = 0;

                                                            foreach ($liste as $key => $value) {



                                                                $btnmodifier = '<button type="button" class="btn btn-primary modifierAnee"   onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("modifierpaiement")) . '\';document.getElementById(\'classe\').value=\'' . $value['code'] . '\'; document.getElementById(\'code\').value=\'' . $value['code'] . '\'; " data-toggle="modal" data-target="#exampleModal">

                                                        <i class="fa fa-edit" aria-hidden="true"></i>

                                                        modifier

                                                        </button>';

                                                                $j++;

                                                                echo '

                                                    <tr>

                                                    <td>' . $j . '</td>

                                                    <td>' . $value['matiere'] . '</td>

                                                    <td>' . $value['coef'] . '</td>

                                                    <td>' . $value['classe'] .'</td>

                                                

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











            </div>

        </div>

    <div id="exampleModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title" id="standard-modalLabel">Affectation</h4>

                </div>



                <div class="modal-body">

                    <div class="row">



                        <div class="col-md-12">

                            <div class="form-group form-primary">

                                <label class=" fs-7">Matières</label>



                                <select class="form-control" name="matiere" id="">

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



                                <input type="text" class="form-control" placehoder="" name="coeficients" id="">

                                <span class="form-bar"></span>

                            </div>



                        </div>

                      

                   

                           <div class="row m-auto">

                                <?php

                                if (isset($classe)) {

                                    foreach ($classe  as $key => $value) {

                                        echo '   <div class="col-md-4">

                                        <div class="form-group form-primary">

                                            <input  class = "" type="checkbox" name="classe[]" value="' . $value['code'] . '"><span class="fs-6">     ' . $value['libelle'] . '</span><br>  

                                            <span class="form-bar"></span>



                                            </div>

                

                                        </div>               

                                            

                                            ';

                                    }

                                }

                                ?>

                            </div>

                    </div>











                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn   btn-primary">Enregistrer</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>

            </div>

        </div>

    </div>



</form>