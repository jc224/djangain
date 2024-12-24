<div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                            <h5 class="text-uppercase mb-0 mt-0 page-title">Profil Professeur</h5>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                            <ul class="breadcrumb float-right p-0 mb-0">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item"><a href="all-teachers.html">Professeur</a></li>
                                <li class="breadcrumb-item"><span>profil</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-page">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="aboutprofile-sidebar">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="aboutprofile">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="aboutprofile-pic">
                                                                <img class="card-img-top"  src="<?=yii::$app->request->baseUrl.'/web/mainAssets/uploads/'.$info['photo']?>" alt="Card image">
                                                            </div>
                                                            <div class="aboutprofile-name">
                                                                <h5 class="text-center mt-2"><?= $info['nom'].' '.$info['prenom']?></h5>
                                                                <p class="text-center">Matières Enseignés</p>
                                                            </div>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"><b>Maths</b><a href="#" class="float-right">7e A</a></li>
                                                                <li class="list-group-item"><b>Chimie</b><a href="#" class="float-right">8e A</a></li>
                                                                <li class="list-group-item"><b>Biologie</b><a href="#" class="float-right">11e A</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="aboutme-profile">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="page-title">Autre Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p>Hello je suis <?= $info['nom'].' '.$info['prenom']?>  </p>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><b>Matricule</b><a href="#" class="float-right"><?= $info['matricule']?></a></li>
                                                        <li class="list-group-item"><b>Catégorie Professeur</b><a href="#" class="float-right"><?= $info['groupePers']==1 ? 'Titulaire' : 'Non Titulaire'?></a></li>
                                                        <li class="list-group-item"><b>Genre</b><a href="#" class="float-right"><?= $info['genre']==1 ? 'Masculin' : 'Feminin'?></a></li>
                                                        <li class="list-group-item"><b>Date Début Service</b><a href="#" class="float-right"><?= $info['Datedebutservice']?></a></li>
                                                    </ul>
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="aboutprofile-address mt-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="page-title">Adresse</h4>
                                                </div>
                                                <div class="card-body">
                                                    <address class="text-center">
                                                        <?= $info['adresse']?> <br>
                                                        <?= $info['tel']?> <br>
                                                        <?= $info['email']?>
                                                        </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                                        <div class="profile-content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">

                                                        <div class="card-header">
                                                            <h4 class="page-title">Information</h4>
                                                        </div>

                                                        <div class="card-body">
                                                            <div id="biography" class="biography">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-6"> <strong>Nom Complet</strong>
                                                                        <p class="text-muted"><?= $info['nom'].' '.$info['prenom']?> </p>
                                                                    </div>
                                                                    <div class="col-md-3 col-6"> <strong>Téléphone</strong>
                                                                        <p class="text-muted"><?= $info['tel']?> </p>
                                                                    </div>
                                                                    <div class="col-md-3 col-6"> <strong>Email</strong>
                                                                        <p class="text-muted"><a href="#" class="__cf_email__" data-cfemail="82efebe1eae3e7eef4e0f7f6f6e3f0f1c2e7fae3eff2eee7ace1edef"><?= $info['email']?></a></p>
                                                                    </div>
                                                                    <div class="col-md-3 col-6"> <strong>Adresse</strong>
                                                                        <p class="text-muted"><?= $info['adresse']?></p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                             
                                                              
                                                                <h4>A PROPOS</h4>
                                                                <?= $info['apropos']?>
                                                                <hr>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>