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

                        <h2> FINALISE LA CREATION DE VOTRE COMPTE

                        </h2>

                    
                        <form action="<?= Yii::$app->request->baseUrl . '/' . md5('visiteur_finaliser') ?>" method="post">



                            ` <?= Yii::$app->simplelClass->getHiddenFormTokenField(); ?>

                            <?php

                            $token2 = Yii::$app->getSecurity()->generateRandomString();

                            $token2 = str_replace('+', '.', base64_encode($token2));

                            ?> <!-- DEBUT : BASIC HIDDEN IMPUT FOR THE FORM -->

                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

                            <input type="hidden" name="token2" value="<?= $token2 ?>" />

                            <input type="hidden" name="codeUser" value="sdee" />

                            <input type="hidden" name="code" value="<?= $code ?>" />



                            <div class="form-group">

                                <label>Identifient <span class="login-danger">*</span></label>

                                <input class="form-control" type="text" id="userName" name="userName" value="<?= $userName ?>">

                                <span class="profile-views"><i class="fas fa-user-circle"></i></span>

                            </div>

                            <div class="form-group">

                                <label>Mot de Passe <span class="login-danger">*</span></label>

                                <input class="form-control pass-input" id="motPass" name="motPass" type="password" value="<?= $motPass ?>">

                                <span class="profile-views feather-eye toggle-password"></span>

                            </div>

                            <div class="form-group">

                                <label>Confirmer le Mot de Passe<span class="login-danger">*</span></label>

                                <input class="form-control pass-input" id="confirme" name="confirme" type="password" >

                                <span class="profile-views feather-eye toggle-password"></span>

                            </div>



                            <div class="form-group">

                                <button class="btn btn-primary btn-block" type="submit">Enregistrer</button>

                            </div>

                        </form>







                    </div>

                </div>

            </div>

        </div>

    </div>

</div>