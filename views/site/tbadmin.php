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

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

      <div class="dash-widget dash-widget5">

        <span class="float-left"><img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/dash/dash-1.png" alt=""

            width="80"></span>

        <div class="dash-widget-info text-right">

          <span>Total  Inscrits</span>

          <h3>

            <?= $nbE ?>

          </h3>

        </div>

      </div>

    </div>



    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

      <div class="dash-widget dash-widget5">

        <span class="float-left"><img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/dash/dash-3.png" alt=""

            width="80"></span>

        <div class="dash-widget-info text-right">

          <span>Total filles</span>

          <h3>

            <?= $wm ?>

          </h3>

        </div>

      </div>

    </div>

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

      <div class="dash-widget dash-widget5">

        <div class="dash-widget-info text-left d-inline-block">

          <span>Total Enseignats</span>

          <h3>

            <?= $ens ?>

          </h3>

        </div>

        <span class="float-right"><img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/dash/dash-2.png"

            width="80" alt=""></span>

      </div>

    </div>

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

      <div class="dash-widget dash-widget5">

        <div class="dash-widget-info text-left d-inline-block">

          <span>Total Personnel</span>

          <h3>

            <?= $pers ?>

          </h3>

        </div>

        <span class="float-right"><img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/dash/dash-2.png"

            width="80" alt=""></span>

      </div>

    </div>

  </div>

  <div class="row">

    <div class="col-lg-6 d-flex">

      <div class="card flex-fill">

        <div class="card-header">

          <div class="row align-items-center">

            <div class="col-auto">

              <div class="page-title">

                Evolution des Elèves Par Année Scolaire

              </div>

            </div>



          </div>

        </div>

        <div class="card-body">

          <div id="chartans"></div>

        </div>

      </div>

    </div>

    <div class="col-lg-6 col-md-12 col-12 d-flex">

      <div class="card flex-fill scroll card-flush pe-5 h-xl-100">

        <div class="card-header">

          <div class="row align-items-center">

            <div class="col-auto">

              <div class="page-title">

                Statistiques par Niveau

              </div>

            </div>



          </div>

        </div>

        <div class="card-body ">

          <div class="vertical-scroll scroll-demo h-100px">

            <table class="table">

              <thead>

                <tr>

                  <th>Niveau</th>

                  <th>Total fille</th>

                  <th>Total</th>

                </tr>

              </thead>

              <tbody>

                <?php

                $liste = Yii::$app->mainCLass->getAlltableData('dj_niveau');

                $anneeActive = yii::$app->mainCLass->chargerAnneeActive();



                if (sizeof($liste) > 0) {

                  foreach ($liste as $key => $value) {

                    $totaleve = yii::$app->eleveClass->statistiqueforNIVEAU($value['code'], $anneeActive);

                    $filles = yii::$app->eleveClass->stateleveWomanforniveau($value['code']);

                    echo '

                    <tr>

                    <td>' . $value['libelle'] . '</td>

                    <td>' . $filles . '</td>

                    <td>' . $totaleve . '</td>

                    </tr>

                  ';





                    // die(var_dump($value));

                  }

                }

                // die();

                ?>

              </tbody>

            </table>

          </div>



        </div>

      </div>

    </div>



  </div>

  <div class="row">

    <div class="col-lg-6 d-flex">

      <div class="card flex-fill">

        <div class="card-header">

          <div class="row align-items-center">

            <div class="col-auto">

              <div class="page-title">

                STATITQUE PAR CLASSE

              </div>

            </div>



          </div>

        </div>

        <div class="card-body " id="cardscrool">

          <div class="vertical-scroll scroll-demo h-100px">

            <table class="table">

              <thead>

                <tr>

                  <th>Classe</th>

                  <th>Total fille</th>

                  <th>Total</th>

                </tr>

              </thead>

              <tbody>

                <?php

                $liste = Yii::$app->configClass->listClasse();

                $anneeActive = yii::$app->mainCLass->chargerAnneeActive();



                if (sizeof($liste) > 0) {

                  foreach ($liste as $key => $value) {

                    $totaleve = yii::$app->eleveClass->statistiqueforclasse($value['code'], $anneeActive);

                    $filles = yii::$app->eleveClass->stateleveWomanforclasse($value['code']);

                    // die(var_dump($totaleve));

                    echo '

                    <tr>

                    <td>' . $value['libelle'] . '</td>

                    <td>' . $filles . '</td>

                    <td>' . $totaleve . '</td>

                    </tr>

                  ';





                    // die(var_dump($value));

                  }

                }



                ?>

              </tbody>

            </table>

          </div>



        </div>

      </div>

    </div>

    <div class="col-lg-6 col-md-12 col-12 d-flex">

      <div class="card flex-fill">

        <div class="card-header">

          <div class="row align-items-center">

            <div class="col-auto">

              <div class="page-title">

                Répartitions par types d'individus

              </div>

            </div>



          </div>

        </div>

        <div class="card-body d-flex align-items-center justify-content-center overflow-hidden">

          <div id="statindividus"> </div>

        </div>

      </div>

    </div>

  </div>



</div>





<?php

require('script/script.php');

?>



<style>

  #cardscrool {

    height: 200px;

    /* Définissez la hauteur de votre carte selon vos besoins */

    overflow: auto;

    /* Ajoutez une barre de défilement automatique si nécessaire */

    border: 1px solid #ccc;

    /* Ajoutez une bordure pour délimiter la carte */

  }

</style>