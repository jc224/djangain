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

      <input type="hidden" name="code" id="code" value="<?= $classe ?>" />
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
                    <!-- <button class="btn btn-outline-primary mr-2">
                    <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/excel.png" alt="">
                    <span class="ml-2">Excel</span>
                  </button> -->
                    <a href="javascript:;"
                      onclick=" $('#action').val('<?= md5('printlist') ?>');  $('#anneescolaire-form').submit();"
                      class="btn btn-outline-danger mr-2">
                      <img src="/wamy/web/mainAssets/img/pdf.png" alt="" height="18">
                      <span class="ml-2">PDF</span>
                    </a>


                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row filter-row">
                <div class="col-sm-6 col-md-3 pt-2 pb-2">
                  <div class="">

                    <input type="text" name="search" id="search" placeholder="Recercher...."
                      class="form-control floating" value="<?= (isset($post)) ? $post['search'] : '' ?>">
                  </div>
                </div>

                <div class="col-sm-6 col-md-3 pt-2 pb-2">
                  <div class="">
                    <select name="classetSearch" class="form-control">
                      <option value=''>selectionner une classe</option>
                      <?php
                      if (sizeof($listeclasse) > 0) {
                        foreach ($listeclasse as $key => $value) {
                          $selected = ($classe == $value['code']) ? 'selected' : '';

                          echo '
                                  <option value="' . $value['code'] . '"  ' . $selected . ' >' . $value['nomCLasse'] . '</option>
                                  ';
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <button type="submit" class="btn btn-search btn-sm  btn-block mb-3" > Rehercher </button>
                </div>
              </div>
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
                                     <div class=" mt-3 d-flex flex-center justify-content-center">
                                      <div class="px-3">
                                       <a href="javascript:;" Class="btn btn-primary btn-sm mb-1"   onclick="  document.getElementById(\'action\').value=\'' . md5(strtolower("modifiereleve")) . '\';  document.getElementById(\'code\').value=\'' . $value["codeEleve"] . '\';$(\'#anneescolaire-form\').submit(); ">                               
                                         <i class="far fa-edit"></i></a>
                                      </div>
                                      <div >
                                         <a href="javascript:;" Class="btn btn-secondary btn-sm mb-1"   onclick="  document.getElementById(\'action\').value=\'' . md5(strtolower("profil")) . '\';  document.getElementById(\'code\').value=\'' . $value["codeEleve"] . '\';$(\'#anneescolaire-form\').submit(); ">                               
                                       <i class="far fa-eye"></i></a>
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