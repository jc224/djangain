<?php

  $infoeval= Yii::$app->mainCLass->databycode('dj_evaluation',$codeEval,'code')['0'];
//   die(var_dump($infoeval));
  $max= 0;
  if($infoeval['typeEval'] == 2){
    $max= 10;
  }else{
    $max= 20;
  }


?>






<form class="md-float-material form-material" action="<?= yii::$app->request->baseurl.'/'.md5('evaluation_composition')?>"  enctype="multipart/form-data" name="login-form" id="eval-form" method="post">
    <input type="text"  hidden name="codeEvaluation" value="<?=$codeEval?>">
<div class="content container-fluid">
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
                      onclick=" $('#action').val('<?= md5(strtolower('ajouterunenoter')) ?>');  $('#eval-form').submit();"
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
                                        <th>Note</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(sizeof($donner)>0){
                                            $j=0;
                                            // die(var_dump($donner));

                                            foreach ($donner as $key => $value) {
                                                 $info= Yii::$app->mainCLass->databycode('dj_eleve',$value['matricule'],'matricule')['0'];

                                                        $j++;
                                                      echo '

                                                      <tr>
                                                      </td>
                                                      <td>'.$j.'</td>
                                                      <td>
                                                      <input type="hidden" name="matricule[]" value="'.$value['matricule'].'">

                                                      ' . $info['matricule'] . '</td>
                                                      <td>
                                                        <h2 class="table-avatar">
                                                      
                                                          <a href="student-details.html">' . $info['nom'] . ' ' . $info['prenom'] . '</a>
                                                        </h2>
                                                      </td>
                                                      <td><input type="number" class="form-control form-control-solid" min="0" max="'.$max.'" name="notea1[]" value="'.$value['composition'].'" id="notea1'.$j.'" onchange="calcmoy1('.$j.');" ></td>
                            
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


<input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
    <input type="hidden" name="action" id="action" value=""/>
    <input type="hidden" name="matiereData" id="matiereDta" value=""/>
    <input type="hidden" name="classeData" id="classe" value=""/>
    <input type="hidden" name="periodeData" id="periodedata" value=""/>
    <input type="hidden" name="code" id="code" value=""/>
    <input type="hidden" name="codeEva" id="codeEva" value=""/>
    <div id="delete_employee" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Ajout Evaluation</h4> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body box-shadow" >
                    <div class="row">
                        <div class="col-md-6">
                                <label class=" fs-7">CLASSE</label>
                                <select class="form-control" name="classe"  id="classeSelect" onchange="selectmatiere()">
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
                                <label style=" font-weight: bold;"class=" fs-7">coeficients</label>

                                <input type="text" class="form-control" placehoder="coeficient" name="Coeficient" id="Coeficient" readonly="readonly">
                                <span class="form-bar"></span>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-primary">
                                <label  style=" font-weight: bold;" for="">Période</label>
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
                                <input type="file" class="form-control" placehoder="sujet" name="sujet" id=""   accept=".pdf, .word">
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