<hr>

<form class="md-float-material form-material"

    action="<?= yii::$app->request->baseurl . '/' . md5('evaluation_compositionprof') ?>" enctype="multipart/form-data"

    name="login-form" id="eval-form" method="post">



    <div class="content container-fluid">

        <div class="page-header">

            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                    <h5 class="text-uppercase mb-0 mt-0 page-title">Listes des compositions</h5>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                    <ul class="breadcrumb float-right p-0 mb-0">

                        <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Tableau de bord</a>

                        </li>

                        <li class="breadcrumb-item"><span>Evaluation</span></li>

                    </ul>

                </div>

            </div>

        </div>



        <div class="content-page">

            <div class="row filter-row">







                <!-- <div class="col-sm-2 col-md-3">

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

                </div> -->

                <!-- <div class="col-sm-2 col-md-3">

                    <a href="javascript:;" onclick="rechercher()" class="btn btn-search btn-sm rounded btn-block mb-3">

                        Rehercher

                    </a>

                </div> -->

               



            </div>

            <div class="row">

                <div class="col-md-12 mb-3">

                    <div class="table-responsive">

                        <table class="table custom-table datatable">

                            <thead class="thead-light">

                                <tr>

                                    <th>[]</th>

                                    <th>Classe</th>

                                    <th>Composition</th>

                                    <th>Matière</th>

                                    <th>Coefficient</th>

                                    <th>Date</th>

                                    <th>Fiche de notes</th>

                                    <th class="text-right">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                if (sizeof($classe) > 0) {

                                    $anneeActive = yii::$app->mainCLass->getAnneeActive();

                                    $userCode = yii::$app->mainCLass->getusers();



                                    foreach ($classe as $key => $vaal) {

                                        $matiere = yii::$app->personnelClass->selectlistematiereforprof($anneeActive, $userCode, $vaal['code']);

                                        if (sizeof($matiere) > 0) {

                                            foreach ($matiere as $key => $value2) {

                                                $liste = Yii::$app->evaluationClass->selectEvalformatiere($anneeActive, $vaal['code'], $value2['code']);

                                                // die(var_dump($liste));

                                                if (sizeof($liste) > 0) {

                                                    $j = 0;

                                                    foreach ($liste as $key => $value) {

                                                        //  die(var_dump($value));

                                                        $periode = yii::$app->simplelClass->selectPeriode($value['periode']);

                                                        $j++;

                                                        // die(var_dump($value));

                                                        // die(var_dump($value));

                                                        $btn = '<button class="btn  btn-outline-primary mr-2" id="btnexport" onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("excel")) . '\';document.getElementById(\'code\').value=\'' . $value['codeClasse'] . '\';

                                                            document.getElementById(\'periodedata\').value=\'' . $value['periode'] . '\';   document.getElementById(\'matiereDta\').value=\'' . $value['matiere'] . '\';

                                                            document.getElementById(\'classe\').value=\'' . $value['classe'] . '\'; document.getElementById(\'codeEva\').value=\'' . $value['codeEva'] . '\'; 

                                                            document.getElementById(\'eval-form\').submit;

                                                        

                                                        

                                                            "><img src="' . yii::$app->request->baseUrl . '/web/mainAssets/img/excel.png" alt=""><span class="ml-2">Excel</span></button>';

                                                                            $pdf = '<button class="btn btn-outline-primary mr-2" onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("exportpdf")) . '\';document.getElementById(\'code\').value=\'' . $value['codeClasse'] . '\';

                                                            document.getElementById(\'periodedata\').value=\'' . $value['periode'] . '\';   document.getElementById(\'matiereDta\').value=\'' . $value['matiere'] . '\';

                                                            document.getElementById(\'classe\').value=\'' . $value['classe'] . '\';

                                                            document.getElementById(\'codeEva\').value=\'' . $value['codeEva'] . '\'; 



                                                            document.getElementById(\'eval-form\').submit;

                                                        

                                                            "><img src="' . yii::$app->request->baseUrl . '/web/mainAssets/img/pdf.png" alt="" ><span class="ml-2">pdf</span></button>';



                                                                            $note = '   <button class="btn btn-outline-primary mr-2" onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("modifiereval")) . '\';document.getElementById(\'code\').value=\'' . $value['codeClasse'] . '\'; 

                                                            document.getElementById(\'codeEva\').value=\'' . $value['codeEva'] . '\'; 

                                                            document.getElementById(\'eval-form\').submit;"><span class="ml-2"><i class="fa fa-edit" aria-hidden="true"></i>/<i class="fa fa-plus" aria-hidden="true"></i></span> Notes </button>';



                                                        $detail = '<a href="' . yii::$app->request->baseUrl . '/' . md5('evaluation_details') . '/' . $value['codeEva'] . '" class="btn btn-outline-primary mr-2"><i class="fa fa-eye" aria-hidden="true"></i>Details</a>';



                                                        echo '<tr>

                                                                        <td>' . $j . '</td>

                                                                        <td>' . $value['classe'] . '</td>

                                                                        <td>' . $periode . '</td>

                                                                        <td>' . $value['matiere'] . '</td>

                                                                        <td>' . $value['coef'] . '</td>

                                                                        <td>' . $value['date'] . '</td>

                                                                        <td>' . $btn . ' ' . $pdf . '</td>

                                                                        <td class="text-right">' . $detail . '</td>

                                                                   </tr>';

                                                    }

                                                }

                                            }

                                        }



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





    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

    <!-- <input name="fichier" type="file" id="monInputFile" accept=".xlsx" /> -->

    <input type="hidden" name="action" id="action" value="" />

    <input type="hidden" name="matiereData" id="matiereDta" value="" />

    <input type="hidden" name="classeData" id="classe" value="" />

    <input type="hidden" name="periodeData" id="periodedata" value="" />

    <input type="hidden" name="code" id="code" value="" />

    <input type="hidden" name="codeEva" id="codeEva" value="" />

    <div id="delete_employee" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"

        aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title" id="standard-modalLabel">Ajout Composition</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body box-shadow">

                    <div class="row">

                        <div class="col-md-6">

                            <label class=" fs-7">CLASSE</label>

                            <select class="form-control" name="classe" id="classeSelect" onchange="selectmatiere()">

                                <option hidden value="">Sélèctionner une matière...</option>

                                <?php

                                if (isset($classe)) {

                                    foreach ($classe as $key => $value) {

                                        echo '  <option  value="' . $value['code'] . '">' . $value['libelle'] . '</option>';

                                    }

                                }

                                ?>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group form-primary">

                                <label style=" font-weight: bold;" class=" fs-7">Matières</label>



                                <select class="form-control" name="matiere" id="matiere" onchange="coeefmatiere()">

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



                        <div class="col-md-6">

                            <div class="form-group form-primary">

                                <label style=" font-weight: bold;" class=" fs-7">coeficients</label>



                                <input type="text" class="form-control" placehoder="coeficient" name="Coeficient"

                                    id="Coeficient" readonly="readonly">

                                <span class="form-bar"></span>

                            </div>



                        </div>

                        <div class="col-md-6">

                            <div class="form-group form-primary">

                                <label style=" font-weight: bold;" for="">Période</label>

                                <select class="form-control" name="periode" id="periode">

                                    <option hidden value="">Sélèctionner la période...</option>



                                </select>

                            </div>



                        </div>



                        <div class="col-md-6">

                            <div class="form-group form-primary">

                                <label style="margin-top: 10px ; font-weight: bold;" class=" fs-7">Date</label>



                                <input type="date" class="form-control" placehoder="date" name="date" id="">

                                <span class="form-bar"></span>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group form-primary">

                                <label style=" font-weight: bold;" class=" fs-7">Sujet</label>

                                <input type="file" class="form-control" placehoder="sujet" name="sujet" id=""

                                    accept=".pdf, .word">

                                <span class="form-bar"></span>

                            </div>



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

    <form>



        <?php

        require('script/script.php');



        ?>