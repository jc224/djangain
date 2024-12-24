<?php

$anneeActive = yii::$app->mainCLass->chargerAnneeActive();
// die($anneeActive);
// $anneeActive  = yii::$app->mainCLass->getAnneeActive();

$nbE = yii::$app->eleveClass->stateleve();
$wm = yii::$app->eleveClass->stateleveWomen();
$pers = yii::$app->personnelClass->countpers('1');
$ens = yii::$app->personnelClass->countpers('2');
?>


<!-- debut de la bannière -->
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
                                <p><a class="btn btn-primary btn-lg" href="#">La WAMY est plus qu'une Ecole !</a></p>
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
                                <p><a class="btn btn-primary btn-lg btn-learn" href="#">La WAMY est plus qu'une Ecole
                                        !</a></p>
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
                                <h1>Viser l’excellence sur toutes les étapes et préparer nos élèves à être des futures
                                    cadres techniquement</h1>
                                <h2>et consciencieusement aptes à servir partout dans le monde. <a
                                        href="http://freehtml5.co/" target="_blank"></a></h2>
                                <p><a class="btn btn-primary btn-lg btn-learn" href="#">La WAMY est plus qu'une Ecole
                                        !</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>
<!-- fin de la bannière -->
<div id="fh5co-course-categories">
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-6 col-md-offset-3  fh5co-heading" style="text-align: center; ">
                <h2>WAMY</h2>
                <p>Le Groupe scolaire WAMY est une école d’enseignement général ayant une stratégie pédagogique moderne.
                    Il est situé dans la commune de Ratoma précisément à Nongo-Tady au côté Nord du stade.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 text-center animate-box">
                <div class="services">
                    <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/etag.jpg" alt=""
                        style="border-radius: 50%; width: 100px; height: 100px; margin-right:10%;margin-bottom: 10px;">
                    <div class="desc">
                        <h3><a href="#"></a>Formation D'excellence en Français et Anglais</h3>
                        <p>« Une langue vous place dans un couloir pour la vie. Deux langues vous ouvrent toutes les
                            portes le long du chemin »</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 text-center animate-box">
                <div class="services">
                    <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/ordi.jpg" alt=""
                        style="border-radius: 50%; width: 100px; height: 100px; margin-right:10%;margin-bottom: 10px;">
                    <div class="desc">
                        <h3><a href="#">Cours de Informatique</a></h3>
                        <p>L'enfant qui a la chance d'apprendre l'informatique est prêt à faire face à un monde
                            technologique dans lequel tout – ou presque – est systématisé. Il s'agit de la raison
                            principale pour laquelle vous devez inscrire votre enfant à des cours d'informatique.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 text-center animate-box">
                <div class="services">
                    <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/experi.jpg" alt=""
                        style="border-radius: 50%; width: 100px; height: 100px; margin-right:10%;margin-bottom: 10px;">
                    <div class="desc">
                        <h3><a href="#">Cours d'expérimentation Pratique </a></h3>
                        <p>L'objectif est d'amener les élèves à discuter le protocole et les hypothèses à partir de
                            l'analyse des résultats expérimentaux, afin de leur faire percevoir la nature de ces deux
                            objets et de leurs relations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 text-center animate-box">
                <div class="services">
                    <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/cours.jpg" alt=""
                        style="border-radius: 50%; width: 100px; height: 100px; margin-right:10%;margin-bottom: 10px;">
                    <div class="desc">
                        <h3><a href="#">Un programme d’insertion de cours particuliers</a></h3>
                        <p>Nos professeurs sont spécifiquement formés à la remédiation. Après un diagnostic approfondi
                            des besoins et des lacunes de l’élève, les professeurs sont à même de travailler les points
                            de cours non acquis, en proposant des exercices spécifiques qui permettront aux élèves de
                            progresser. Des cours de remise à niveau sont d’ailleurs proposés durant les périodes de
                            vacances scolaires.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="fh5co-counter" class="fh5co-counters" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
           
                    <div class="col-md-4 col-sm-6 text-center animate-box">
                        <span class="icon"><i class="icon-study"></i></span>
                        <span class="fh5co-counter js-counter" data-from="0" data-to="<?= $nbE?>" data-speed="5000"
                            data-refresh-interval="50"></span>
                        <span class="fh5co-counter-label">Nombre d'elèves Inscris</span>
                    </div>
                       
                    <div class="col-md-4 col-sm-6 text-center animate-box">
                        <span class="icon"><i class="icon-study"></i></span>
                        <span class="fh5co-counter js-counter" data-from="0" data-to="<?= $wm?>" data-speed="5000"
                            data-refresh-interval="50"></span>
                        <span class="fh5co-counter-label">Total Files</span>
                    </div>
               
                    <div class="col-md-4 col-sm-6 text-center animate-box">
                        <span class="icon"><i class="icon-head"></i></span>
                        <span class="fh5co-counter js-counter" data-from="0" data-to="<?= $pers + $ens?>" data-speed="5000"
                            data-refresh-interval="50"></span>
                        <span class="fh5co-counter-label">Nombre d'Encadradeur</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div id="fh5co-testimonial">
    <div class="overlay"></div>
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                <h2><span>Témoignage</span></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row animate-box">
                    <div class="owl-carousel owl-carousel-fullwidth">
                        <div class="item">
                            <div class="testimony-slide active text-center">
                                <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/huhhu.png"
                                    alt=""
                                    style="border-radius: 50%; width: 100px; height: 100px; margin-left: 45%;margin-bottom: -70px;">
                                <div class="user" style="background-image: url(images/person1.jpg);"></div>
                                <span>D. Mamadou Mouctar Diallo<br><small>Fondateur</small></span>
                                <blockquote>
                                    <p>&ldquo;En plus d'instruire et de qualifier, l'école est un milieu de vie où les
                                        élèves interagissent et vivent plusieurs situations qui sont des occasions
                                        d'apprendre à vivre en société : amitiés, relations égalitaires.&rdquo;</p>
                                </blockquote>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-slide active text-center">
                                <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/eleve.jpeg"
                                    alt=""
                                    style="border-radius: 50%; width: 100px; height: 100px; margin-left: 45%;margin-bottom: -70px;">
                                <div class="user" style="background-image: url(images/person2.jpg);"></div>
                                <span>M. Amadou Bailo Diallo<br><small>Ancien élève</small></span>
                                <blockquote>
                                    <p>&ldquo;Je souhaiterai vous témoigner comme il se doit ma gratitude envers l'école
                                        WAMY.
                                        Etant un ancien élève dont la scolarité fut mouvementée, le soutien reçu à mon
                                        arrivée dans cet établissement par les enseignants, la direction ainsi que la
                                        fondation, m'a toutefois permis d'acquérir la maturité nécessaire afin d'obtenir
                                        mon baccalauréat en sciences expérimentales et de poursuivre des études
                                        supérieures à l'Université de Labé.
                                        Aucun de mes précédents établissements ne m'avait encouragé et encadré avec une
                                        telle pédagogie. Aucun n'aurait spéculé sur ma situation actuelle.
                                        Mon exemple étant loin d'être un cas isolé, je crois donc important de témoigner
                                        mon expérience qui m’a permis de revenir en tant qu’enseignant. Merci à tous
                                        pour ce que vous m’avez permis de faire. Comme on le dit souvent ‘’ la WAMY est
                                        plus qu’une école.&rdquo;</p>
                                </blockquote>
                            </div>
                        </div>
                        <!-- <div class="item">
                            <div class="testimony-slide active text-center">
                                <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/huhhu.png" alt="" style="border-radius: 50%; width: 100px; height: 100px; margin-left: 45%;margin-bottom: -70px;">
                                <div class="user" style="background-image: url(images/person2.jpg);"></div>
                                <span>M. Diallo<br><small>Enseignant</small></span>
                                <blockquote>
                                    <p>&ldquo;&rdquo;</p>
                                </blockquote>
                            </div>
                        </div> -->
                        <div class="item">
                            <div class="testimony-slide active text-center">
                                <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/auth/huhhu.png"
                                    alt=""
                                    style="border-radius: 50%; width: 100px; height: 100px; margin-left: 45%;margin-bottom: -70px;">
                                <div class="user" style="background-image: url(images/person3.jpg);"></div>
                                <span>Mme Diallo Aïssatou<br><small>Parent d'élève</small></span>
                                <blockquote>
                                    <p>&ldquo;Merci de l’enseignement que vous avez donné à mon fils depuis 5 ans, Merci
                                        d’avoir remis mon fils sur les rails. Il semble très heureux dans votre
                                        Etablissement.&rdquo;</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>