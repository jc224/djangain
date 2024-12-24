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


    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-sm-6">
                    <div class="page-title">LISTE DES CLASSES </div>
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
                          //  die(var_dump($liste));
                          $stat = yii::$app->eleveClass->actionsTATcLASSE($value['code']);
                          $j++;
                          $nb = 0;
                          $btn = ' <a class="btn btn-primary text-white" href="' . yii::$app->request->baseUrl . '/' . md5('eleve_list') . '/' . $value['code'] . '"><i class="fa fa-eye text-white" aria-hidden="true"></i></a>';

                          if ($stat) {
                            $nb  =  $stat['nb'];
                          }
                          //  die(var_dump(($stat['nb'])));

                          echo '  
                              <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                    <div class="profile-widget">
                                    
                                        <h4 class="user-name m-t-10 m-b-0 text-ellipsis">' . $value['nomCLasse'] . '</h4>
                                        <br><span>Niveau :' . $value['niveau'] . '</span>
                                        <br><span>Total :' . $nb . '</span>
                                       
                                     <div class=" mt-3 d-flex flex-center justify-content-center">
                                      <div class="px-3">
                                        ' . $btn . '
                                      </div>
                                   
                                    </div>
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