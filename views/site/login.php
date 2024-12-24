<?php

$this->title = Yii::t('app', 'connexion');

$userName = !empty($userName) ? $userName : null;

$motPass = !empty($motPass) ? $motPass : null;

$sugarpot = !empty($sugarpot) ? $sugarpot : null;

?>



<div class="main-wrapper login-body">

    <div class="login-wrapper">

        <div class="container">

            <div class="loginbox">

                <div class="login-left">

                    <img class="img-fluid" src="<?= yii::$app->request->baseUrl ?>/web/admin/img/login.png" alt="Logo">

                </div>

                <div class="login-right">

                    <div class="login-right-wrap">

                        <h1>Bienvenue sur Djanguai</h1>

                        <p class="account-subtitle">Vous n'avez toujours pas de compte? <a href="<?= yii::$app->request->baseUrl . '/' . md5('visiteur_initier') ?>">Cree un compte</a></p>

                        AUTHENTIFICATION

                        <!-- <p class="account-subtitle">votre partenaire idéal pour une gestion scolaire  <a href="#">simplifiée et efficace</a></p>

                        AUTHENTIFICATION -->

                        <h2></h2>

                        <form action="<?= Yii::$app->request->baseUrl . '/' . md5('site_login') ?>" id="formsubmit" method="post">

                            <?= Yii::$app->simplelClass->getHiddenFormTokenField(); ?>

                            <?php
                            $token2 = Yii::$app->getSecurity()->generateRandomString();
                            $token2 = str_replace('+', '.', base64_encode($token2));
                            ?> <!-- DEBUT : BASIC HIDDEN IMPUT FOR THE FORM -->
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                            <input type="hidden" name="token2" value="<?= $token2 ?>" />
                            <div class="form-group">
                                <label>Identifient <span class="login-danger">*</span></label>
                                <input class="form-control" type="text" id="userName" name="userName" autocomplete="off" value="<?= $userName ?>">
                                <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                            </div>
                            <div class="form-group">
                                <label>Mot de Passe <span class="login-danger">*</span></label>
                                <input class="form-control pass-input" id="motPass" name="motPass" type="password" value="<?= $motPass ?>">
                                <span class="profile-views feather-eye toggle-password"></span>
                            </div>
                            <input id="sugarpot" hidden name="sugarpot" type="password" value="<?= $sugarpot ?>" placeholder="Mot de passe" autocomplete="off" class="form-control bg-transparent">
                            <div class="forgotpass">
                                <!-- <a href="forgot-password.html">Mot de passe oublié?</a> -->
                            </div>



                        </form>


                        <div class="form-group">

                            <button class="btn btn-primary btn-block"  id="btnconnexion" onclick="connexion()">CONNEXION</button>

                        </div>



                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    function connexion(){
        $('#btnconnexion').prop("disabled", true);
      let requiredFields = ['#userName','#motPass'];

      if (checkEmptyFields(requiredFields)) {
         $('#btnconnexion').prop("disabled", false);
         return false;
      }
      $('#formsubmit').submit();
    }

   
</script>