<?php
        $anneeActive =   yii::$app->mainCLass->chargerAnneeActive();

$classe = yii::$app->configClass->infClasse($codeclasse);

$i = 0;
$moyfinal = null;
$typecompo = $classe['typeCompo'];

$noteAllElve = yii::$app->evaluationClass->noteall($anneeActive, $classe, $typecompo);

if (sizeof($noteAllElve) > 0) {

  foreach ($noteAllElve as $key => $value) {
    $eleve[$i] = $value['code'];

    $moyfinal[$i] = $value['moyfinal'];
    $i++;

  }


  array_multisort($moyfinal, SORT_DESC, $eleve, SORT_ASC, $noteAllElve);


}

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
            <h5 class="text-uppercase mb-0 mt-0 page-title">ELEVES</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <ul class="breadcrumb float-right p-0 mb-0">
              <li class="breadcrumb-item">
                <a href="#">
                  <i class="fas fa-home"></i> Acceuil </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#">Elèves</a>
              </li>
              <li class="breadcrumb-item">
                <span>Liste des élèves</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="page-content">
        
<form id="sumit" method="post" action="<?= Yii::$app->request->baseUrl . '/' . md5('evaluation_resultatfinal') ?>">
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
                    <div class="page-title">Liste des élèves </div>
                  </div>
                  <div class="col-sm-6 text-sm-right">
                    <div class=" mt-sm-0 mt-2">

                      <a href="javascript:;"
                        onclick="document.getElementById('classe').value='<?= $classe['code'] ?>';
                                    document.getElementById('action').value='<?= md5(strtolower('resultatglobalfinal')) ?>';document.getElementById('sumit').submit();"
                        class="btn btn-outline-danger mr-2">
                        <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/pdf.png" alt="" height="18">
                        <span class="ml-2">IMPRIMER LE RESULTAT FINAL</span>
                      </a>


                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row filter-row  justify-content-between mb-5">

                  <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">

                      <label class="">Statut</label>
                      <select name="Statut" class="select form-control">
                        <option value="" hidden>Sélèctonner pour filtrer...</option>
                        <option value="1" <?= $stat == 1 ? "Selected" : "" ?>>Admis</option>
                        <option value="2" <?= $stat == 2 ? "Selected" : "" ?>>Non Admis</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-3 ">
                    <button type="submit" id="search" class="btn btn-search rounded btn-block mt-4 ">Rehercher</button>
                  </div>

                </div>
                <div class="row mt-10">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-responsive">
                      <table class="datatable table table-stripped dataTable no-footer" id="DataTables_Table_0"
                        role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead class="thead-light">

                          <tr>
                            <th>Rang </th>
                            <th>Matricule</th>
                            <th>Elèves</th>
                            <?php
                            $notemin = 0;
                            if ($typeCOmpo == 1) {
                              $notemin = 5;
                              echo '
                                <th>Trimeestre 1</th>
                                <th>Trimestre 2</th>
                                <th>Trimeestre 3</th>';

                            } elseif ($typeCOmpo == 2) {
                              $notemin = 10;
                              echo '
                                <th>Semestre 1</th>
                                <th>Semestre 2</th>

                                
                                ';
                            }

                            ?>


                            <th>Moyenne</th>
                            <th>Mention</th>



                            <th class="text-right">Action</th>
                          </tr>

                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php
                            //  die(var_dump($typecompo));
                            if (sizeof($noteAllElve) > 0) {
                              $j = 1;

                              foreach ($noteAllElve as $key => $value) {
                                if ($j == 1) {
                                  $rang = $j . ' er';
                                } else {
                                  $rang = $j . ' eme';
                                }
                                $info = yii::$app->eleveClass->infoeleve($anneeActive, $value['code']);


                                if ($typecompo == '1') {
                                  $mentionfinal = yii::$app->simplelClass->mentionTrimestre($value['moyfinal']);
                                } else if ($typecompo == '2') {
                                  $mentionfinal = yii::$app->simplelClass->mentionSecondaire($value['moyfinal']);

                                }
                                ;
                                $detail = '<a href="javascript:;" class="btn btn-outline-primary mr-2" 
                                    onclick="document.getElementById(\'classe\').value=\'' . $classe['code'] . '\';
                                    document.getElementById(\'classe\').value=\'' . $classe['code'] . '\';
                                    document.getElementById(\'action\').value=\'' . md5(strtolower("resultatfinal")) . '\';
                                    document.getElementById(\'codeE\').value=\'' . $info['codeEleve'] . '\';
                                    document.getElementById(\'search\').click();
                                    ">
                                    <i class="fa fa-eye" aria-hidden="true"></i>Imprimer</a>';

                                if (isset($statut)) {
                                  if ($statut == 1 && $value['moyfinal'] > $notemin) {
                                    echo '
                                        <tr role="row" class="odd">
                                        <td class="sorting_1">
                                            ' . $rang . '
                                        </td>
                                        <td>' . $info['matricule'] . '</td>
                                        <td>
                                          <h2 class="table-avatar">
                                            <a href="#" class="avatar avatar-sm me-2">
                                              <img class="avatar-img rounded-circle" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $info['photo'] . '" alt="ELEVES Image">
                                            </a>
                                            <a href="#">' . $info['nom'] . ' ' . $info['prenom'] . '</a>
                                          </h2>
                                          <td>' . $value['Moye1'] . '</td>
                                          <td>' . $value['Moye2'] . '</td>';
                                    if ($typecompo == '1') {
                                      echo '<td>' . $value['Moye3'] . '</td>';
                                    }
                                    ;
                                    echo '
                                          <td>' . round($value['moyfinal'], 2) . '</td>
                                          <td>' . $mentionfinal . '</td>
                                          <td>' . $detail . '</td>
                                        </td>';


                                    $j++;





                                  } else if ($statut == 2 && $value['moyfinal'] < $notemin) {

                                    echo '
                                        <tr role="row" class="odd">
                                        <td class="sorting_1">
                                            ' . $rang . '
                                        </td>
                                        <td>' . $info['matricule'] . '</td>
                                        <td>
                                          <h2 class="table-avatar">
                                            <a href="#" class="avatar avatar-sm me-2">
                                              <img class="avatar-img rounded-circle" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $info['photo'] . '" alt="ELEVES Image">
                                            </a>
                                            <a href="#">' . $info['nom'] . ' ' . $info['prenom'] . '</a>
                                          </h2>
                                          <td>' . $value['Moye1'] . '</td>
                                          <td>' . $value['Moye2'] . '</td>';
                                    if ($typecompo == '1') {
                                      echo '<td>' . $value['Moye3'] . '</td>';
                                    }
                                    ;
                                    echo '
                                          <td>' . round($value['moyfinal'], 2) . '</td>
                                          <td>' . $mentionfinal . '</td>
                                          <td>' . $detail . '</td>
                                        </td>';


                                    $j++;

                                  }
                                } else {
                                  echo '
                                    <tr role="row" class="odd">
                                    <td class="sorting_1">
                                        ' . $rang . '
                                    </td>
                                    <td>' . $info['matricule'] . '</td>
                                    <td>
                                      <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm me-2">
                                          <img class="avatar-img rounded-circle" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $info['photo'] . '" alt="ELEVES Image">
                                        </a>
                                        <a href="#">' . $info['nom'] . ' ' . $info['prenom'] . '</a>
                                      </h2>
                                      <td>' . $value['Moye1'] . '</td>
                                      <td>' . $value['Moye2'] . '</td>';
                                  if ($typecompo == '1') {
                                    echo '<td>' . $value['Moye3'] . '</td>';
                                  }
                                  ;
                                  echo '
                                      <td>' . round($value['moyfinal'], 2) . '</td>
                                      <td>' . $mentionfinal . '</td>
                                      <td>' . $detail . '</td>
                                    </td>';


                                  $j++;
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
