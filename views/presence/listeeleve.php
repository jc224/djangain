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

    <form class="md-float-material form-material" action="<?= Yii::$app->request->baseUrl . '/' . md5('eleve_enrollement') ?>" name="login-form" id="anneescolaire-form" method="post">



      <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

      <input type="hidden" name="action" id="action" value="<?= md5('filtrer') ?>" />

      <div class="row">

        <div class="col-12">

          <div class="card">

            <div class="card-header">

              <div class="row align-items-center">

                <div class="col-sm-6">

                  <div class="page-title">Liste des Presents </div>

                </div>

                <div class="col-sm-6 text-sm-right">

                  <div class=" mt-sm-0 mt-2">

                    <!-- <button class="btn btn-outline-primary mr-2">

                    <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/excel.png" alt="">

                    <span class="ml-2">Excel</span>

                  </button> -->






                  </div>

                </div>

              </div>

            </div>

            <div class="card-body">



              <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                  <div class="row">



                    <?php

                    if (isset($liste) && sizeof($liste) > 0) {

                      $j = 0;

                      foreach ($liste as $key => $value) {

                        // die(var_dump($liste));

                        $j++;

                        echo '<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">

                                    <a href="javascript:;" onclick="  document.getElementById(\'action\').value=\'' . md5(strtolower("profil")) . '\';  document.getElementById(\'code\').value=\'' . $value["codeEleve"] . '\';$(\'#anneescolaire-form\').submit(); ">

                                    <div class="profile-widget">

                                        <div class="profile-img">

                                          <img class="avatar" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $value['photo'] . '" alt="">

                                        </div>

                                  

                                        <h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="javascript:;" onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("profil")) . '\';  document.getElementById(\'code\').value=\'' . $value["codeEleve"] . '\';$(\'#anneescolaire-form\').submit(); ">' . $value['nom'] . ' ' . $value['prenom'] . '</a></h4>

                                        <br><span>Mariicule:' . $value['matricule'] . '</span>

                                       

                                    </a>

                                 
                                   

                                    </div>
                                    </div>

                                        

                            





                               

                               

                                 ';
                      }
                    }

                    ?>







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