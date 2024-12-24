
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = Yii::t('app', 'connexion');
$userName = !empty($userName) ? $userName : null;
$motPass = !empty($motPass) ? $motPass : null;
$sugarpot = !empty($sugarpot) ? $sugarpot : null;
?>



<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/huhhu.png" class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 ">
                <div class="card border-0 shadow-lg">
                        

              <div class="card-header">
                <div class="text-center" style="font-size: 30px; font-weight: bold;">
                    FINALISE LA CREATION DE VOTRE COMPTE
                </div>
                </div>
                <div class="card-body">
                <form action="<?= Yii::$app->request->baseUrl.'/'.md5('visiteur_finaliser')?>"   method="post">

        `                    <?= Yii::$app->simplelClass->getHiddenFormTokenField(); ?>
                            <?php
                            $token2 = Yii::$app->getSecurity()->generateRandomString();
                            $token2 = str_replace('+','.',base64_encode($token2));
                            ?>        <!-- DEBUT : BASIC HIDDEN IMPUT FOR THE FORM --> 
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                            <input type="hidden" name="token2" value="<?= $token2 ?>"/>
                            <input type="hidden" name="codeUser" value="sdee"/>
                            <input type="hidden" name="code" value="<?=$code?>"/>

                            <!-- Email input -->

                            <div class="form-outline mb-4">
                            <label class="control-label" for="form1Example13">IDENTIFIENT</label>

                                <input type="text" id="userName" name="userName" value="<?= $userName ?>"class="form-control form-control" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                 <label class="form-label" for="form1Example23">Mot de Passe</label>

                                <input type="password"  name="motPass" type="password" value="<?= $motPass ?>"  class="form-control form-control-lg" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                 <label class="form-label" for="form1Example23">Confirmer le Mot de Passe</label>

                                <input type="password"  name="confirme" type="password" value="<?= $motPass ?>"  class="form-control form-control-lg" />
                            </div>


                            <!-- Submit button -->
                            <div class="divider d-flex align-items-center my-4">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                <input value="Enregistrer" type="submit" class=" btn btn-primary btn-lg btn-block" style="background-color:rgb(51, 153, 5);font-size: 20px;font-weight: bold; " role="button">
                                <i class="fab fa-twitter me-2"></i>

                                </div>
                                <div class="col-md-6 mt-2">
                                <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998;font-size: 20px;font-weight: bold; " href="#!" role="button">
                                <i class="fab fa-twitter me-2"></i>AUTHENTIFICATION
                            </a>
                                </div>
                            </div>
                       
                          


                    </form>
                </div>
        </div>


               
              
            </div>
        </div>
    </div>
</section>