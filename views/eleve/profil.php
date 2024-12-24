<?php
            $infoclasse = Yii::$app->configClass->infClasse($info['codeClasse']);
          
            $noteAllElve = yii::$app->evaluationClass->noteall($anneeActive,$infoclasse,$infoclasse['typeCompo']);
            $matiere = yii::$app->evaluationClass->infoclasse($infoclasse['code']);

        
          
           

?>

<div class="content container-fluid">
    <div class="page-header mb-10 ">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title">mon profil</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item"><span> Profile</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-box mb-10 m-b-0 shadow">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-view">
                    <div class="profile-img-wrap">
                        <div class="profile-img">
                            <a href="">
                                <img class="avatar"
                                    src="<?=yii::$app->request->baseUrl.'/web/mainAssets/uploads/'.$info['photo']?>"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="profile-info-left">
                                    <h3 class="user-name m-t-0"><?= $info['nom'].' '.$info['prenom']?></h3>
                                    <h5 class="company-role m-t-0 m-b-0">ELEVES</h5>

                                    <div class="staff-id">Matricule : <?= $info['matricule']?></div>
                                    <div class="staff-id">Classe : <?= $infoclasse["libelle"]?></div>
                                    <div class="staff-id">Niveau : <?= $infoclasse['libClasse']?></div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul class="personal-info">
                                    <li>
                                        <span class="title">Numero Tuteur :</span>
                                        <span class="text"><a href="#"><?= $info['telTuteur']?></a></span>
                                    </li>
                                    <li>
                                        <span class="title">Adresse:</span>
                                        <span class="text"><a href="#"><span><?= $info['adresse']?>
                                                </span></a></span>
                                    </li>

                                    <li>
                                        <span class="title">Genre:</span>
                                        <span class="text"><?= ($info['genre'] ==1 ) ? 'Masculin' : 'Feminin' ?></span>
                                    </li>
                                    <li>
                                        <span class="title">Date de Naissance:</span>
                                        <span class="text"><?= $info['dateNaissance']?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card  mt-5 mb-3 shadow">
        <div class="card-header">INFORMATIONS SUPLEMETAIRES</div>
        <div class="card-body text-primary">
            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab1"
                        data-toggle="tab">Historique de Paiement</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2"
                        data-toggle="tab">Historique des Notes</a></li>
                <li class="nav-item"><a class="nav-link active" href="#solid-rounded-justified-tab3"
                        data-toggle="tab">Informations Générales</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane show" id="solid-rounded-justified-tab1">
                    <table class="datatable table table-stripped dataTable no-footer" id="DataTables_Table_0"
                        role="grid" aria-describedby="DataTables_Table_0_info">
                        <tr>
                        <tr role="row">
                            <th>[]</th>
                            <th>Acte</th>
                            <th>Satut</th>
                            <th>Montants</th>
                            <th>Reste à Payer</th>
                            <th>Date De Paiement</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                         $hist =  yii::$app->eleveClass->actionhistorique($info['codeAnnee'],$info['codeEleve']); 

                             
                                if(isset($hist) && sizeof($hist)>0){
                                    $j=0;
                                    foreach ($hist as $key => $value) {
                                       $j++;
                                       $statut = ($value['restePayer'] >0 ) ? '<span class="badge badge-danger-border">Nom Complet</span>' : '<span class="badge badge-success-border">Completer</span>' ;
                                        
                                    echo'       
                                    <tr>
                                        <td>'.$j.'</td>
                                        <td>'.$value['libelle'].'</td>
                                       <td>'.$statut.'</td>
                                       <td>'.$value['montant'].'</td>
                                         <td>'.$value['restePayer'].'</td>
                                         <td>'.$value['datePayement'].'</td>

                                      
                                        </td>
                                    </tr>';
                                    }
                        
                                }
                                    ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="solid-rounded-justified-tab2">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                         
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered m-b-0"
                                        id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                        <?php  
                                            if($infoclasse['typeCompo']==1){
                                                require('contenu/notetrimestre.php');

                                            }else{
                                                require('contenu/notesemestre.php');

                                            }
                                        
                                        ?>
                                    </table>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
                <div class="tab-pane active" id="solid-rounded-justified-tab3">
                <div class="row">
                            <div class="col-md-5">
                                <div class="profile-info-left">
                                    <h3 class="user-name m-t-0"><?= $info['nom'].' '.$info['prenom']?></h3>
                                    <h5 class="company-role m-t-0 m-b-0">ELEVES</h5>

                                    <div class="staff-id">Matricule : <?= $info['matricule']?></div>
                                    <div class="staff-id">Classe : <?= $infoclasse["libelle"]?></div>
                                    <div class="staff-id">Niveau : <?= $infoclasse['libClasse']?></div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul class="personal-info">
                                    <li>
                                        <span class="title">Numero Tuteur :</span>
                                        <span class="text"><a href="#"><?= $info['telTuteur']?></a></span>
                                    </li>
                                    <li>
                                        <span class="title">Adresse:</span>
                                        <span class="text"><a href="#"><span><?= $info['adresse']?>
                                                </span></a></span>
                                    </li>

                                    <li>
                                        <span class="title">Genre:</span>
                                        <span class="text"><?= ($info['genre'] ==1 ) ? 'Masculin' : 'Feminin' ?></span>
                                    </li>
                                    <li>
                                        <span class="title">Date de Naissance:</span>
                                        <span class="text"><?= $info['dateNaissance']?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12">
                            <ul class="personal-info">
                                    <li>
                                        <span class="title">Numero Tuteur :</span>
                                        <span class="text"><a href="#"><?= $info['telTuteur']?></a></span>
                                    </li>
                                    <li>
                                        <span class="title">Adresse:</span>
                                        <span class="text"><a href="#"><span><?= $info['adresse']?>
                                                </span></a></span>
                                    </li>

                                    <li>
                                        <span class="title">Genre:</span>
                                        <span class="text"><?= ($info['genre'] ==1 ) ? 'Masculin' : 'Feminin' ?></span>
                                    </li>
                                    <li>
                                        <span class="title">Date de Naissance:</span>
                                        <span class="text"><?= $info['dateNaissance']?></span>
                                    </li>
                                </ul>
                                            
                            </div>
                        </div>  
                </div>
            </div>
        </div>
    </div>
</div>