<?php

// die(var_dump($infoEva));
$max = 0;
if ($infoEva['periode'] < 4) {
  $max = 10;
} else {
  $max = 20;
}


?>





<div class="content container-fluid">


  <form class="md-float-material form-material" action="<?= yii::$app->request->baseurl . '/' . md5('evaluation_organiser') ?>" enctype="multipart/form-data" name="login-form" id="eval-form" method="post">
    <input type="text" hidden name="codeEvaluation" value="<?= $infoEva['codeEva'] ?>">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <h5 class="text-uppercase mb-0 mt-0 page-title">Listes des évaluations</h5>
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
    <div class="row">
      <div class="col-sm-4 col-12">
      </div>

    </div>
    <div class="content-page">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-sm-6">
              <div class="page-title">Liste des Evaluations </div>
            </div>
            <div class="col-sm-6 text-sm-right">
              <div class=" mt-sm-0 mt-2">
                <!-- <button class="btn btn-outline-primary mr-2">
                    <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/excel.png" alt="">
                    <span class="ml-2">Excel</span>
                  </button> -->
                <a href="javascript:;"
                  onclick=" $('#action').val('<?= md5(strtolower('modifieraddnote')) ?>');  $('#eval-form').submit();"
                  class="btn btn-outline-primary mr-2">
                  <span class="ml-2">AJOUTER</span>
                </a>


              </div>
            </div>
          </div>
        </div>
        <div class="card-body">

          <div class="row">
            <div class="col-md-12 mb-3">
              <div class="table-responsive">
                <table class="table custom-table datatable">
                  <thead class="thead-light">
                    <tr>

                      <th>[] </th>
                      <th>Matricule</th>
                      <th>Eleves</th>
                      <th>Note1</th>
                      <th>Note2</th>
                      <?php
                      if ($infoEva['periode'] > 3) {
                        echo '
                                                <th>Note3</th>
                                                
                                                ';
                      }
                      ?>
                      <th>Moyenne</th>


                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (sizeof($listeElevee) > 0) {
                      $j = 0;
                      // die(var_dump($donner));

                      foreach ($listeElevee as $key => $value) {
                        $note = Yii::$app->evaluationClass->selectnote($infoEva['codeEva'], $value['matricule']);


                        $moyenne = '';
                        $note1 = 0;
                        $note2 = 0;
                        $note3 = 0;
                        if ($note) {
                          $moyenne = yii::$app->simplelClass->moyenne($note['note1'], $note['note2'], $note['note3'], $infoEva['periode']);
                          $note1 = $note['note1'];
                          $note2 = $note['note2'];
                          $note3 = $note['note3'];
                          // $moyenneGenerale = yii::$app->simplelClass->moyenneMoyennegenral($moyenne, $note['composition']);
                        }

                        $j++;
                        echo '

                                                      <tr>
                                                      </td>
                                                      <td>' . $j . '</td>
                                                      <td>
                                                      <input type="hidden" name="matricule[]" value="' . $value['matricule'] . '">

                                                      ' . $value['matricule'] . '</td>
                                                      <td>
                                                        <h2 class="table-avatar">
                                                      
                                                          <a href="student-details.html">' . $value['nom'] . ' ' . $value['prenom'] . '</a>
                                                        </h2>
                                                      </td>
                                                  
                                                      <td><input type="number" class="form-control form-control-solid" min="0" max="' . $max . '" name="notea1[]" value="' . $note1 . '" id="notea1' . $j . '" onchange="calculnote(' . $j . ');" ></td>
                                                      <td><input type="number" class="form-control form-control-solid" min="0" max="' . $max . '" name="notea2[]" value="' . $note2 . '"  id="notea2' . $j . '" onchange="calculnote(' . $j . ');" ></td>
                                                      ';

                        if ($infoEva['periode'] > 3) {

                          echo '
                                                                <td><input type="number" class="form-control form-control-solid" min="0" max="' . $max . '" name="notea3[]" value="' . $note3 . '" id="notec1' . $j . '" onchange="calculnote(' . $j . ');" ></td>
                                                               
                                                                ';
                        }

                        echo '
                                                       <td><input type="number" class="form-control form-control-solid" min="0" max="' . $max . '" name="moy[]" value="' . $moyenne . '"  id="moy' . $j . '"  ></td>

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




    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
    <input name="fichier" type="file" class="d-none" id="monInputFile" accept=".xlsx" />
    <input type="hidden" name="action" id="action" value="" />
    <input type="hidden" name="matiereData" id="matiereDta" value="" />
    <input type="hidden" name="classeData" id="classe" value="" />
    <input type="hidden" name="periodeData" id="periodedata" value="" />
    <input type="hidden" name="code" id="code" value="" />
    <input type="hidden" name="codeEva" id="codeEva" value="" />

    <form>
</div>
<?php
require('script/script.php');

?>