<?php



$stat = $comp = $perid = "";



$typeEval = null;

if (isset($statut)) {



    $stat = $statut;

}

if (isset($composer)) {



    $comp = $composer;

}

if (isset($periode)) {



    $perid = $periode;

}





?>





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



        <form id="sumit" method="post" action="<?= Yii::$app->request->baseUrl . '/' . md5('evaluation_resultatconcinelle') ?>">

            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

            <input type="hidden" name="action" id="action" value="<?= md5('filtre') ?>" />

            <input type="hidden" name="classe" id="classe" value="<?= $codeclasse ?>" />

            <input type="hidden" name="codeE" id="codeE" value="" />

            <input type="hidden" name="matricule" id="matricule" value="" />

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-header">

                            <div class="row align-items-center">

                                <div class="col-sm-6">

                                    <div class="page-title">Liste des eleves </div>

                                </div>

                                <div class="col-sm-6 text-sm-right">

                                    <div class=" mt-sm-0 mt-2">

                                        <?php

                                        if (sizeof($liste) > 0) {





                                            ?>



                                            <a href="javascript:;"

                                                onclick=" document.getElementById('classe').value='<?= $codeclasse ?>';

                                                document.getElementById('action').value='<?= md5(strtolower('primelistespdf')) ?>';document.getElementById('sumit').submit();"

                                                class="btn btn-outline-danger mr-2">

                                                <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/pdf.png"

                                                    alt="" height="18">

                                                <span class="ml-2">IMPRIMER LE RESULTAT FINAL</span>

                                            </a>



                                            <?php

                                        }



                                        ?>





                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row filter-row  mb-5">

                                <div class="col-sm-6 col-md-3">

                                    <div class="form-group form-focus">

                                        <label class="">Periode</label>

                                        <select name="Periode" class="select form-control">

                                            <?php

                                            if (isset($typeCOmpo)) {

                                                if ($typeCOmpo == 1) {



                                                    ?>

                                                    <option value="1" <?= $perid == 1 ? "Selected" : "" ?>>1er Trimestre

                                                    </option>

                                                    <option value="2" <?= $perid == 2 ? "Selected" : "" ?>>2eme Trimestre

                                                    </option>

                                                    <option value="3" <?= $perid == 3 ? "Selected" : "" ?>>3eme Trimestre

                                                    </option>';

                                                    <?php

                                                } else {

                                                    ?>

                                                    <option value="4" <?= $perid == 4 ? "Selected" : "" ?>>1er Semestre

                                                    </option>

                                                    <option value="5" <?= $perid == 5 ? "Selected" : "" ?>>2eme Semestre

                                                    </option>';

                                                    <?php

                                                }

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-6 col-md-3">

                                    <div class="form-group form-focus">



                                        <label class="">Statut</label>

                                        <select name="Statut" class="select form-control">

                                            <option value="" hidden>Selectonner pour filtrer...</option>

                                            <option value="1" <?= $stat == 1 ? "Selected" : "" ?>>Admis</option>

                                            <option value="2" <?= $stat == 2 ? "Selected" : "" ?>>Non Admis</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-6 col-md-3 d-none">

                                    <div class="form-group form-focus select-focus">

                                        <label class=""> Compsoer</label>

                                        <select name="composer" class="select form-control">

                                            <option value="" hidden>Sélèctonner pour filtrer...</option>

                                            <option value="1" <?= $comp == 1 ? "Selected" : "" ?>>Composer</option>

                                            <option value="2" <?= $comp == 2 ? "Selected" : "" ?>>Non Composer

                                            </option>

                                        </select>



                                    </div>

                                </div>

                                <div class="col-sm-6 col-md-3 ">

                                    <button type="submit" id="search"

                                        class="btn btn-search rounded btn-block mt-4">Rehercher</button>

                                </div>

                            </div>

                            <div class="row mt-10">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                                    <div class="table-responsive">

                                        <table class="table custom-table datatable" id="DataTables_Table_0">

                                            <thead class="thead-light">





                                                <tr>

                                                    <th>[] </th>

                                                    <th>Matricule</th>

                                                    <th>Elèves</th>

                                                    <th>Evaluation 1</th>

                                                    <!-- <th>Moyenne Cours</th> -->

                                                    <th>Evaluation 2</th>

                                                    <!-- <th>Composition</th> -->

                                                    <th>Moyenne</th>

                                                    <th>Mention</th>







                                                    <th class="text-right">Action</th>

                                                </tr>



                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>

                                                    <?php

                                                    //demo

                                                    $anneeActive = yii::$app->mainCLass->getAnneeActive();





                                                    $matiere = yii::$app->evaluationClass->infoclasse($codeclasse);

                                                    $classe = yii::$app->configClass->infClasse($codeclasse);

                                                    $liste = yii::$app->eleveClass->listeclasse($anneeActive, $classe['code']);



                                                    if (sizeof($liste) > 0) {



                                                        if ($classe['typeCompo'] == '1') {

                                                            $min = 5;

                                                            $max = 10;



                                                        } else {

                                                            $min = 10;

                                                            $max = 20;

                                                        }

                                                        foreach ($liste as $key => $info) {

                                                            if (sizeof($matiere) > 0) {



                                                                //DECLARATION DES VARIABLE DE SEM ET AUTRES

                                                                $maximun = 0;

                                                                $minimun = 0;

                                                                $cours1 = 0;

                                                                $comp1 = 0;

                                                                $moyenneGen = 0;

                                                                $cours2 = 0;

                                                                $cours3 = 0;

                                                                $comp2 = 0;

                                                                $comp3 = 0;

                                                                $moyenneGen2 = 0;

                                                                $mgeneral = 0;

                                                                $moyenneGen3 = 0;

                                                                $totalsemestre1 = 0;

                                                                $totalsemestre2 = 0;

                                                                $totaltrim1 = 0;

                                                                $totaltrim2 = 0;

                                                                $totaltrim3 = 0;

                                                                //moy/20

                                                                $j = 0;

                                                                $moyenneT1 = 0;

                                                                $moyenneT2 = 0;

                                                                $moyenne2 = 0;

                                                                $moyenneT3 = null;

                                                                $moyenne3 = 0;

                                                                $moyenne1 = 0;

                                                                $dataSem2 = null;

                                                                $i = 0;

                                                                $k = 0;

                                                                $dataTrim1 = null;

                                                                $dataMoy = 0;

                                                                $dataTrim2 = null;

                                                                $dataTrim3 = null;



                                                                foreach ($matiere as $key => $value):



                                                                    $coef = yii::$app->simplelClass->maxmincoef($value['coef'], $classe['typeCompo']);

                                                                    $maximun = $maximun + $coef['0'];

                                                                    $minimun = $minimun + $coef['1'];

                                                                    $moy1 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], $periode, $anneeActive);
                                                             


                                                                    if ($moy1 == false) {

                                                                        $dataTrim1[$i] = ['Evalluation1' => 0, 'coef' => $value['coef'], 'Evalluation2' => 0, 'moy' => 0];

                                                                        $i++;

                                                                    } else {

                                                                        $cours = 0;

                                                                        $cours = yii::$app->simplelClass->moyenne($moy1['note1'], $moy1['note2'], $moy1['note3'], $periode);

                                                                        $cours1 = $cours1 + $cours;





                                                                        $comp1 = $comp1 + $moy1['composition'];



                                                                        $dataTrim1[$i] = ['Evalluation1' => $moy1['note1'], 'coef' => $value['coef'], 'Evalluation2' => $moy1['note2'], 'moy' => round(($moy1['note1'] +$moy1['note2']) / 2, 2)];

                                                                        $i++;

                                                                        $moyenne1 = yii::$app->simplelClass->moyenneMoyennegenralTrim($moy1['note1'], $moy1['note2']);

                                                                        $moyenneGen = $moyenneGen + $moyenne1;

                                                                        $totaltrim1 += $moyenne1;

                                                                    }





                                                                endforeach;

                                                                $j++;

                                                                $content = '          <tr role="row" class="odd">

                                                                    <td class="sorting_1">

                                                                        ' . $j . '

                                                                    </td>

                                                                    <td>' . $info['matricule'] . '</td>

                                                                    <td>

                                                                      <h2 class="table-avatar">

                                                                        <a href="#" class="avatar avatar-sm me-2">

                                                                          <img class="avatar-img rounded-circle" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $info['photo'] . '" alt="ELEVES Image">

                                                                        </a>

                                                                        <a href="#">' . $info['nom'] . ' ' . $info['prenom'] . '</a>

                                                                      </h2>

                                                                    </td>



                                                                ';
                                                                $result = yii::$app->simplelClass->moySemestreConcinelle($dataTrim1, $classe['typeCompo']);
                                                                // die(var_dump($result));

                                                                $moy = $result['moyenneGenerale'];

                                                                $moyComposer = $result['moyennecompo'];

                                                                $content .= '


                                                                          <td>' . $result['MoyenneCours'] . '</td>


                                                                          <td>' . $result['moyennecompo'] . '</td>

                                                                          <td>' . $result['moyenneGenerale'] . '</td>

                                                                          

                                                                        

                                      

                                                                      

                                                                      ';



                                                                if ($typeCOmpo == 1) {

                                                                    $mention = yii::$app->simplelClass->mentionTrimestre($moy);



                                                                } else {

                                                                    $mention = yii::$app->simplelClass->mentionSecondaire($moy);



                                                                }





                                                                $detail = '<a href="javascript:;" class="btn btn-outline-primary mr-2" 

                                                                  onclick="

                                                             

                                                                  document.getElementById(\'classe\').value=\'' . $codeclasse . '\';

                                                                  document.getElementById(\'action\').value=\'' . md5(strtolower("resultatfinal")) . '\';

                                                                  document.getElementById(\'codeE\').value=\'' . $info['codeEleve'] . '\'; 



                                                                      document.getElementById(\'search\').click();

                                                                  ">

                                                                  <i class="fa fa-print" aria-hidden="true"></i></a>';
 
                                                                $content .= '<td>' . $mention . '</td>  <td>' . $detail . '</td> </tr>';

                                                                // die($comp);

                                                                if ($stat == "" && $comp == "") {



                                                                    echo $content;

                                                                    continue;

                                                                } else if ($stat == 1 && $moy >= $min && $comp == "") {

                                                                    echo $content;

                                                                    continue;

                                                                } else if ($stat == 2 && $moy <= $min && $comp == "") {

                                                                    echo $content;

                                                                    continue;

                                                                } else if ($comp == 1 && $moyComposer != 0 && $stat == "") {



                                                                    echo $content;

                                                                    continue;

                                                                } else if ($comp == 2 && $moyComposer == 0 && $stat == "") {

                                                                    // die('oh');

                                                                    echo $content;

                                                                    continue;

                                                                } else if ($stat == 1 && $moy >= $min && $moy > 0 && $comp == '1') {

                                                                    echo $content;

                                                                    continue;

                                                                } else if ($stat == 2 && $moyComposer <= $min && $moyComposer > 0 && $comp == '1') {

                                                                    echo $content;

                                                                    continue;

                                                                } else if ($stat == 1 && $moy >= $min && $moyComposer == 0 && $comp == '2') {



                                                                    echo $content;

                                                                    continue;

                                                                } else if ($stat == 2 && $moyComposer == 0 && $comp == '2') {



                                                                    echo $content;

                                                                    continue;

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

                </div>

            </div>

        </form>

    </div>

</div>