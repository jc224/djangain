



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

                        <p class="account-subtitle">Vous aviez déjà un  compte? <a href="<?=yii::$app->request->baseUrl.'/'.md5('site_login')?>">Connecter vous</a></p>

                        Creqtion de compte

                        <!-- <p class="account-subtitle">votre partenaire idéal pour une gestion scolaire  <a href="#">simplifiée et efficace</a></p>

                        AUTHENTIFICATION -->

                        <h2></h2>

                      
                        <form action="<?= Yii::$app->request->baseUrl . '/' . md5('visiteur_initier') ?>" method="post">

                            <?= Yii::$app->simplelClass->getHiddenFormTokenField(); ?>

                            <?php

                            $token2 = Yii::$app->getSecurity()->generateRandomString();

                            $token2 = str_replace('+', '.', base64_encode($token2));

                            ?> <!-- DEBUT : BASIC HIDDEN IMPUT FOR THE FORM -->

                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

                            <input type="hidden" name="token2" value="<?= $token2 ?>" />



                            <div class="form-group">

                                <label>Nom de l'etablissement <span class="login-danger">*</span></label>

                                <input class="form-control" type="text" id="nomets" name="nomets">

                                <span class="profile-views"><i class="fa fa-address-card"></i></span>

                            </div>

                            <div class="form-group">

                                <label>Numero de teleohone <span class="login-danger">*</span></label>

                                <input class="form-control pass-input" id="tel" name="tel" type="text">

                                <span class="profile-views feather-phone toggle-password"></span>

                            </div>

                            <div class="form-group">

                                <label>Email <span class="login-danger">*</span></label>

                                <input class="form-control pass-input" id="email" name="email" type="text">

                                <span class="profile-views feather-mail toggle-password"></span>

                            </div>

                     

                            <div class="forgotpass">

                            

                                <!-- <a href="forgot-password.html">Mot de passe oublié?</a> -->

                            </div>

                            <div class="form-group">

                                <button class="btn btn-primary btn-block" type="submit">CONNEXION</button>

                            </div>

                        </form>



                        



                    </div>

                </div>

            </div>

        </div>

    </div>

</div>