<div class="content container-fluid">

    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
            <h3 class="page-title mb-0" style="font-weight: bolder;"> BIENVENUE DANS VOTRE ESPACE DJANGUAI </h3>

            </div>
            <div class="col-md-6">
                <ul class="breadcrumb mb-0 p-0 float-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Acceuil</a>
                    </li>
                    <li class="breadcrumb-item"><span>Tableau de bord</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Emploi du temps du mois en cours</h5>
                </div>
                <div class="card-body">
                    <div id="donut-chart">


                    <table class="table custom-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>[]</th>
                                            <th>Classe </th>
                                            <th>Matiere</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                              $anneeActive = yii::$app->mainCLass->getAnneeActive();
                                              $userCode = yii::$app->mainCLass->getusers();
                                              $code = Yii::$app->simplelClass->generateUniq();
                                              $classe = yii::$app->personnelClass->selectlisteclasseforprof($anneeActive, $userCode);
                                              if (sizeof($classe) > 0) {
                                                $anneeActive = yii::$app->mainCLass->getAnneeActive();
                                                $userCode = yii::$app->mainCLass->getusers();
            
                                                foreach ($classe as $key => $vaal) {
                                                    $matiere = yii::$app->personnelClass->selectlistematiereforprof($anneeActive, $userCode, $vaal['code']);
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    if (sizeof($matiere) > 0) {
                                                        $j=0;
                                                        foreach ($matiere as $key => $value2) {
                                                            $selecemploie = yii::$app->personnelClass->selectemploidutemps($anneeActive, $value2['code'], $vaal['code']);
                                                             $j++;
                                                            //  die(var_dump($selecemploie));
                                                            echo '<tr>
                                                            <td>' . $j . '</td>
                                                            <td>' . $vaal['libelle'] . '</td>
                                                            <td>' . $value2['libelle'] . '</td>
                                      
                                                       </tr>';
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
        <div class="col-lg-4 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="page-title">  Liste des Matieres Par Classe </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table custom-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>[]</th>
                                            <th>Classe </th>
                                            <th>Matiere</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                              $anneeActive = yii::$app->mainCLass->getAnneeActive();
                                              $userCode = yii::$app->mainCLass->getusers();
                                              $code = Yii::$app->simplelClass->generateUniq();
                                              $classe = yii::$app->personnelClass->selectlisteclasseforprof($anneeActive, $userCode);
                                              if (sizeof($classe) > 0) {
                                                $anneeActive = yii::$app->mainCLass->getAnneeActive();
                                                $userCode = yii::$app->mainCLass->getusers();
            
                                                foreach ($classe as $key => $vaal) {
                                                    $matiere = yii::$app->personnelClass->selectlistematiereforprof($anneeActive, $userCode, $vaal['code']);
                                                    if (sizeof($matiere) > 0) {
                                                        $j=0;
                                                        foreach ($matiere as $key => $value2) {
                                                             $j++;
                                                            echo '<tr>
                                                            <td>' . $j . '</td>
                                                            <td>' . $vaal['libelle'] . '</td>
                                                            <td>' . $value2['libelle'] . '</td>
                                      
                                                       </tr>';
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


</div>


<?php
require('script/script.php');
?>