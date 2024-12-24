<!-- debut du header -->
<aside id="fh5co-hero">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url(<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/bluo.jpg);">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center slider-text">
                            <div class="slider-text-inner">
                                <h1>Améliorer le niveau d’intelligence de nos élèves à Travers des Programmes
                                    Pédagogiques Riches.</h1>
                                <h2>et Attrayant Pour en faire D’eux des Réels Génies<a href="http://freehtml5.co/"
                                        target="_blank"></a></h2>
                                <p><a class="btn btn-primary btn-lg" href="#">La Wamy est plus qu'une école!</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url(<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/heade.jpg);">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center slider-text">
                            <div class="slider-text-inner">
                                <h1>Développer La conscience Civique chez nos élèves à travers</h1>
                                <h2>Des programmes D’éducation continue. <a href="http://freehtml5.co/"
                                        target="_blank"></a></h2>
                                <p><a class="btn btn-primary btn-lg btn-learn" href="#">La wamy est plus qu'une
                                        école.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url(<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/etag.jpg);">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center slider-text">
                            <div class="slider-text-inner">
                                <h1>Vise l’excellence sur toutes les étapes et préparer nos élèves à être des futures
                                    cadres techniquement</h1>
                                <h2>et consciencieusement aptes à servir partout dans le monde. <a
                                        href="http://freehtml5.co/" target="_blank"></a></h2>
                                <p><a class="btn btn-primary btn-lg btn-learn" href="#">La wamy est plus qu'une
                                        école.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>
<!-- debut du header -->

<div id="fh5co-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-push-1 animate-box">

                <div class="fh5co-contact-info " style="padding-right: 3px;">
                    <h3>Nos Informations</h3>
                    <ul>
                        <li class="address">Ecole Wamy Internationale<br> Située au côté nord du stade de nongo <br>
                        C/Ratoma – Conakry République de Guinée</li>
                        <li class="phone"><a href="tel://1234567920">Tel: 669958989 – 621121464 – 664262926 </a></li>
                        <li class="email"><a href="mailto::wamyguinee@gmail.com">wamyguinee@gmail.com</a></li>
                    </ul>
                </div>

            </div>
            <div class="col-md-6 animate-box  box-shadow">
                <h3>Entrez en Contact avec Nos experts</h3>
                <form action="<?= Yii::$app->request->baseUrl . '/' . md5('visiteur_contacte') ?>" method="post">
                    <?= Yii::$app->simplelClass->getHiddenFormTokenField(); ?>
                    <?php
                    $token2 = Yii::$app->getSecurity()->generateRandomString();
                    $token2 = str_replace('+', '.', base64_encode($token2));
                    ?> <!-- DEBUT : BASIC HIDDEN IMPUT FOR THE FORM -->
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="token2" value="<?= $token2 ?>" />

                    <div class="row form-group">
                        <div class="col-md-6">
                            <!-- <label for="fname">First Name</label> -->
                            <input type="text" id="fname" name="fname" class="form-control" placeholder="Entrez votre Nom">
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="lname">Last Name</label> -->
                            <input type="text" id="lname" name="lname" class="form-control" placeholder="Entrez votre Prénom">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <!-- <label for="email">Email</label> -->
                            <input type="text" id="email" name="email" class="form-control" placeholder="Entrez votre Email">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <!-- <label for="message">Message</label> -->
                            <textarea name="message" id="message" cols="30" rows="10" class="form-control"
                                placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Envoyer un Message" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>