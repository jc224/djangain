

<div class="content container-fluid">



  <div class="page-header">

    <div class="row">

      <div class="col-md-6">

        <h3 class="page-title mb-0" style="font-weight: bolder;"> BIENVENUE DANS VOTRE ESPACE DJANGUAI  </h3>

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

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">

      <div class="card"  style="height: 250px;">

        <div class="card-header">

        <h5 class="card-title text-danger">DEPENSES</h5>

        <?php

                  $codeAnnee = yii::$app->mainCLass->getAnneeActive();



                  $depensepers = yii::$app->comptabiliteClass->countdepenspers($codeAnnee);

                   $depense = yii::$app->comptabiliteClass->depense($codeAnnee);

                   $depensetotal =$depensepers +$depense;

              //  die(var_dump($depensepers));



               ?>

        </div>

        <div class="card-body">

          <table class="table">

            <thead>

            <tr>

              <td > <h4>Cummule des  Depenses</h4></td>

              <td colspan="3" class="text-end text-danger"><h3><?= number_format($depensetotal,0,'.','.').' GNF' ?></h3></td>

            </tr>

            <tr>

              <td> <h4>Denpense</h4></td>

              <td colspan="3" class="text-end "><h5><?= number_format($depense,0,'.','.').' GNF' ?></h5></td>

            </tr>

            <tr>

              <td> <h4>Paiement Personnel</h4></td>

              <td colspan="3" class="text-end"><h5><?= number_format($depensepers,0,'.','.').' GNF' ?></h5></td>

            </tr>

            </thead>

          

          </table>

        </div>

      </div>

    </div>

    

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">

      <div class="card"  style="height: 250px;">

        <div class="card-header">

        <h5 class="card-title text-success">RECETTES</h5>



        </div>

        <div class="card-body">

          <?php

                  $codeAnnee = yii::$app->mainCLass->getAnneeActive();



               $recette = yii::$app->comptabiliteClass->countreccete($codeAnnee);

              //  die(var_dump($compta));

               ?>

          <table class="table">

            <thead>

            <tr>

              <td > <h4 class="">Paiement Scolarite</h4></td>

              <td colspan="3" class="text-end text-success"><h3><?= number_format($recette,0,'.','.').' GNF' ?></h3></td>

            </tr>

          



            </thead>

          

          </table>

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

      <div class="card flex-fill">

        <div class="card-header">

          <div class="row align-items-center">

            <div class="col-auto">

              <div class="page-title">

              calendrier

              </div>

            </div>

            <div class="col text-right">

              <div class=" mt-sm-0 mt-2">

                <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>

                <div class="dropdown-menu dropdown-menu-right">

                  <a class="dropdown-item" href="#">Action</a>

                  <div role="separator" class="dropdown-divider"></div>

                  <a class="dropdown-item" href="#">Another action</a>

                  <div role="separator" class="dropdown-divider"></div>

                  <a class="dropdown-item" href="#">Something else here</a>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="card-body">

        <input type="hidden" id="csrf" value="<?=Yii::$app->request->getCsrfToken()?>">

                        <input type="hidden" id="lien" value="<?=Yii::$app->request->baseUrl . "/" . md5("gestion_ajax")?>">

                        <input type="hidden" id="type" value="0">

          <div id="calendar" class=" overflow-hidden"></div>

        </div>

      </div>

    </div>



  </div>

  <div class="row">

    <div class="col-lg-12 d-flex" >

      <div class="card flex-fill " >

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

                  <th rowspan="2">Total fille </th>

                

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

   

  </div>





 

  <div class="notification-box">

    <div class="msg-sidebar notifications msg-noti">

      <div class="topnav-dropdown-header">

        <span>Messages</span>

      </div>

      <div class="drop-scroll msg-list-scroll">

        <ul class="list-box">

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">A</span>

                </div>

                <div class="list-body">

                  <span class="message-author">Amadou Bailo </span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Bonjour je viens de vous envoyer un mail,

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item new-message">

                <div class="list-left">

                  <span class="avatar">E</span>

                </div>

                <div class="list-body">

                  <span class="message-author">Elhadj Ahmad</span>

                  <span class="message-time">1 Aug</span>

                  <div class="clearfix"></div>

                  <span class="message-content"> Bonjour je n'arrive pas à ouvrir

                  à ouvrir</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">B</span>

                </div>

                <div class="list-body">

                  <span class="message-author"> Bangaly </span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Merci pour l'information

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">T</span>

                </div>

                <div class="list-body">

                  <span class="message-author">Touré</span>

                  <span class="message-ime">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">C'est reçu

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">C</span>

                </div>

                <div class="list-body">

                  <span class="message-author"> Catherine Manseau </span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Lorem ipsum dolor sit amet, consectetur

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">D</span>

                </div>

                <div class="list-body">

                  <span class="message-author"> Domenic Houston </span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Lorem ipsum dolor sit amet, consectetur

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">B</span>

                </div>

                <div class="list-body">

                  <span class="message-author"> Buster Wigton </span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Lorem ipsum dolor sit amet, consectetur

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">R</span>

                </div>

                <div class="list-body">

                  <span class="message-author"> Rolland Webber </span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Lorem ipsum dolor sit amet, consectetur

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">C</span>

                </div>

                <div class="list-body">

                  <span class="message-author"> Claire Mapes </span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Lorem ipsum dolor sit amet, consectetur

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">M</span>

                </div>

                <div class="list-body">

                  <span class="message-author">Melita Faucher</span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Lorem ipsum dolor sit amet, consectetur

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">J</span>

                </div>

                <div class="list-body">

                  <span class="message-author">Jeffery Lalor</span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Lorem ipsum dolor sit amet, consectetur

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">L</span>

                </div>

                <div class="list-body">

                  <span class="message-author">Loren Gatlin</span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Lorem ipsum dolor sit amet, consectetur

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

          <li>

            <a href="chat.html">

              <div class="list-item">

                <div class="list-left">

                  <span class="avatar">T</span>

                </div>

                <div class="list-body">

                  <span class="message-author">Tarah Shropshire</span>

                  <span class="message-time">12:28 AM</span>

                  <div class="clearfix"></div>

                  <span class="message-content">Lorem ipsum dolor sit amet, consectetur

                    adipiscing</span>

                </div>

              </div>

            </a>

          </li>

        </ul>

      </div>

      <div class="topnav-dropdown-footer">

        <a href="chat.html">See all messages</a>

      </div>

    </div>

  </div>

</div>





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



<?php

  require('script/script.php');

?>



