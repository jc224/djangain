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
  
    <div class="row">
      <div class="col-sm-12 col-md-12 mt-2 " style="margin-bottom:20px ;">
        <div class="page-title">AJOUTER UN TYPE D'UTILISATEURS </div>

      </div>

    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Ajouter un type D'utilisateurs</h4>
          </div>
          <div class="card-body">
            <form class="needs-validation" novalidate=""
              action="<?= Yii::$app->request->baseUrl . '/' . md5('param_adduser') ?>" name="login-form" id="formsubmit"
              method="post">
              <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
              <input type="hidden" name="action" id="action" value="" />
              <input type="hidden" name="code" id="code" value="" />
              <div class="row mb-12">
                <div class="col-md-12">
                  <label for="">Type d'utilisateurs</label>
                </div>
                <div class="col-md-12 mt-10 mb-15">
                  <input type="text" name="libelle" id="libelle" class="form-control">
                </div>
              </div>

              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-md-12">
                  <p class="pt-10">TABLEAU DE BOARD</p>
                  <input class="form-control form-checkbox " id="sitep" checked hidden type="checkbox"
                    name="menuaction[]" value="tb">

                </div>

                <?php
                $menuString = yii::$app->params['tb'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox site" type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>


              </div>



              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>Eleves</p>
                  <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                    value="@eleves">

                </div>

                <?php
                $menuString = yii::$app->params['eleves'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>


              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>Présence</p>
                  <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                    value="@presence">

                </div>

                <?php
                $menuString = yii::$app->params['presence'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>
              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>Communication</p>
                  <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                    value="@communication">

                </div>

                <?php
                $menuString = yii::$app->params['communication'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>

              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>R.H</p>
                  <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                    value="@personnel">

                </div>
                <?php
                $menuString = yii::$app->params['personnel'];

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>

              <!-- parents -->
              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>Parents</p>
                  <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                    value="@parents">

                </div>
                <?php
                $menuString = yii::$app->params['parents'];

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>


              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>Comptabilite</p>
                  <input class="form-control form-checkbox " hidden type="checkbox" checked name="menuaction[]"
                    value="@comptable">

                </div>
                <?php
                $menuString = yii::$app->params['comptable'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>

              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>EVALUATION</p>
                  <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                    value="@evaluation">

                </div>
                <?php
                $menuString = yii::$app->params['evaluation'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>


              <!-- Emploie du temps -->

              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>Emploie du temps</p>
                  <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                    value="@emploie">

                </div>
                <?php
                $menuString = yii::$app->params['emploie'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>



              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>impression</p>
                  <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                    value="@impression">

                </div>
                <?php
                $menuString = yii::$app->params['impression'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>
              <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                value="@devoirs">

              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <P>Devoire</P>
                </div>
                <?php
                $menuString = yii::$app->params['devoirs'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                  <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>


              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>impression</p>
                  <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                    value="@impression">

                </div>
                <?php
                $menuString = yii::$app->params['impression'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>

              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <p>GESTION</p>
                  <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                    value="@gestion">

                </div>
                <?php
                $menuString = yii::$app->params['gestion'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>



              <input class="form-control form-checkbox " hidden checked type="checkbox" name="menuaction[]"
                value="@param">

              <div class="row " style="margin-top:20px;margin-bottom:20px">
                <div class="col-12">
                  <P>PARAMETRE</P>
                </div>
                <?php
                $menuString = yii::$app->params['param'];
                // die($menuString);

                if (isset($menuString)) {
                  $ajaxAction = Yii::$app->params['ajaxActions'];
                  $menuArray = explode(Yii::$app->params['menu'], $menuString); # ligne principal des menus

                  foreach ($menuArray as $value) {
                    /* Empechons la vue des actions ajax */
                    $subMenuArray = explode(Yii::$app->params['sousMenu'], $value);

                    for ($i = 1; $i < sizeof($subMenuArray); $i++) {
                      if (!(in_array($subMenuArray[$i], $ajaxAction))) {

                        echo '   <div class="col-md-1 pb-2">
                                <input  class = "form-control form-checkbox " type="checkbox" name="menuaction[]" value="' . $subMenuArray[$i] . '"> 
            
            
                                </div>     
                                <div class="col-md-2 pb-2">
                                  <span>' . yii::t("app", $subMenuArray[$i]) . '</span>
                                </div>             
                        
                        ';
                      }
                    }
                  }
                }
                ?>
              </div>

            </form>

          </div>
          <div class="row" style="margin-bottom: 20px;margin-left:40% ;">
            <div class="col-md-12 ">
              <button class="btn   btn-primary " onclick="ajoutertypeusers()" id="btnajout">Enregistrer</button>

            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</div>

<script>
  function ajoutertypeusers() {
  
    $('#btnajout').prop("disabled", true);
    let requiredFields = ['#libelle'];
    if (checkEmptyFields(requiredFields)) {
      $('#btnajout').prop("disabled", false);
      return false;
    }
    $('#formsubmit').submit();
  }
</script>