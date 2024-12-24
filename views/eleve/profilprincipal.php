<?php
$anneeActive = yii::$app->mainCLass->chargerAnneeActive();

$infoclasse = Yii::$app->configClass->infClasse($info['codeClasse']);

$noteAllElve = yii::$app->evaluationClass->noteall($anneeActive, $infoclasse, $infoclasse['typeCompo']);
$matiere = yii::$app->evaluationClass->infoclasse($infoclasse['code']);


?>

<div class="content container-fluid">
    <div class="page-header mb-10 ">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title">Mon Profil</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item"><span> Profil</span></li>
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
                                    src="<?= yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $info['photo'] ?>"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="profile-info-left">
                                    <h3 class="user-name m-t-0"><?= $info['nom'] . ' ' . $info['prenom'] ?></h3>
                                    <h5 class="company-role m-t-0 m-b-0">ELEVES</h5>

                                    <div class="">Matricule : <?= $info['matricule'] ?></div>
                                    <div class="">Classe : <?= $infoclasse["libelle"] ?></div>
                                    <div class="">Niveau : <?= $infoclasse['libClasse'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul class="personal-info">
                                    <li>
                                        <span class="title">Numéro Tuteur :</span>
                                        <span class="text"><a href="#"><?= $info['telTuteur'] ?></a></span>
                                    </li>
                                    <li>
                                        <span class="title">Adresse:</span>
                                        <span class="text"><a href="#"><span><?= $info['adresse'] ?>
                                                </span></a></span>
                                    </li>

                                    <li>
                                        <span class="title">Genre:</span>
                                        <span class="text"><?= ($info['genre'] == 1) ? 'Masculin' : 'Feminin' ?></span>
                                    </li>
                                    <li>
                                        <span class="title">Date de Naissance:</span>
                                        <span class="text"><?= $info['dateNaissance'] ?></span>
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
        <div class="card-header">INFORMATION SUPLEMENTAIRES</div>
        <div class="card-body text-primary">
            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                <li class="nav-item"><a class="nav-link active" href="#solid-rounded-justified-tab1"
                        data-toggle="tab">Historique des Paiements</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2"
                        data-toggle="tab">Historique des Notes</a></li>
                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab4"
                        data-toggle="tab">Devoirs</a></li>
                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab5"
                        data-toggle="tab">Présence</a></li>
                <li class="nav-item"><a class="nav-link " href="#solid-rounded-justified-tab3"
                        data-toggle="tab">Informations Générales</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active     " id="solid-rounded-justified-tab1">
                    <div class="table-responsive">
                        <table class="datatable table table-stripped dataTable no-footer" id="DataTables_Table_0"
                            role="grid" aria-describedby="DataTables_Table_0_info">
                            <tr>
                            <tr role="row">
                                <th>[]</th>
                                <th>Acte</th>
                                <th>Statut</th>
                                <th>Montant Payer</th>
                                <th>Reste à Payer</th>
                                <th>Date De Paiement</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php

                                $hist = yii::$app->eleveClass->actionhistorique($info['codeAnnee'], $info['codeEleve']);


                                if (isset($hist) && sizeof($hist) > 0) {
                                    $j = 0;
                                    foreach ($hist as $key => $value) {
                                        $j++;
                                        $statut = ($value['restePayer'] > 0) ? '<span class="badge badge-danger-border">Nom Complet</span>' : '<span class="badge badge-success-border">Completer</span>';

                                        echo '       
                                    <tr>
                                        <td>' . $j . '</td>
                                        <td>' . $value['libelle'] . '</td>
                                       <td>' . $statut . '</td>
                                       <td>' . $value['montant'] . '</td>
                                         <td>' . $value['restePayer'] . '</td>
                                         <td>' . $value['datePayement'] . '</td>

                                      
                                        </td>
                                    </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="solid-rounded-justified-tab2">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered m-b-0" id="DataTables_Table_0" role="grid"
                                        aria-describedby="DataTables_Table_0_info">
                                        <?php
                                        if ($infoclasse['typeCompo'] == 1) {
                                            require('contenu/notetrimestre.php');
                                        } else {
                                            require('contenu/notesemestre.php');
                                        }

                                        ?>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane show" id="solid-rounded-justified-tab3">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="text-gray">
                                <h3 class="user-name m-t-0"><?= $info['nom'] . ' ' . $info['prenom'] ?></h3>
                                <h5 class="m-t-0 m-b-0">ELEVES</h5>

                                <div class="text-primary">Matricule : <?= $info['matricule'] ?></div>
                                <div class="text-gray">Classe : <?= $infoclasse["libelle"] ?></div>
                                <div class="text-gray">Niveau : <?= $infoclasse['libClasse'] ?></div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <ul class="personal-info">
                                <li>
                                    <span class="title">Numéro Tuteur :</span>
                                    <span class="text"><a href="#"><?= $info['telTuteur'] ?></a></span>
                                </li>
                                <li>
                                    <span class="title">Adresse:</span>
                                    <span class="text"><a href="#"><span><?= $info['adresse'] ?>
                                            </span></a></span>
                                </li>

                                <li>
                                    <span class="title">Genre:</span>
                                    <span class="text"><?= ($info['genre'] == 1) ? 'Masculin' : 'Feminin' ?></span>
                                </li>
                                <li>
                                    <span class="title">Date de Naissance:</span>
                                    <span class="text"><?= $info['dateNaissance'] ?></span>
                                </li>
                                <li>
                                    <span class="title">Document fournis:</span>
                                    <span class="text"><?= $info['document']
                                                        ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h3 style="padding-top:10px;color:black">Informations Sanitaire</h3>
                            <ul class="personal-info">
                                <div>
                                    <span class="title">Groupe Sanguin :</span>
                                    <span class="text"><a
                                            href="#"><?= yii::$app->mainCLass->getgsanguin($info['groupeSanguin']) ?></a></span>
                                </div>


                                <div>
                                    <span class="title">Maladies:</span>
                                    <span class="text"><?= $info['maladies'] ?></span>
                                </div>

                                <div>
                                    <span class="title">Alergies:</span>
                                    <span class="text"><?= $info['alergies'] ?></span>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="solid-rounded-justified-tab4">
                    <form class="needs-validation" novalidate="" enctype="multipart/form-data"
                        action="<?= Yii::$app->request->baseUrl . '/' . md5('devoirs_ajouter') ?>" name="login-form"
                        id="anneescolaire-form" method="post">
                        <input type="hidden" name="action" id="action" value="" />
                        <input type="hidden" name="code" id="code" value="" />
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                        <div class="table-responsive">

                            <table class="datatable table table-stripped dataTable no-footer" id="DataTables_Table_0"
                                role="grid" aria-describedby="DataTables_Table_0_info">
                                <tr>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Libelle</th>
                                    <th>Classe</th>
                                    <th>Matiere</th>
                                    <th>date Ajout</th>
                                    <th>date Debut</th>
                                    <th>date FIn</th>
                                    <th>Statut</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $listedevoirs = yii::$app->personnelClass->actionListdevoirsforclasse($info['codeAnnee'], $infoclasse['code']);

                                    if (sizeof($listedevoirs)) {
                                        $j = 0;
                                        foreach ($listedevoirs as $key => $value) {
                                            $j++;
                                            $class = Yii::$app->mainCLass->databycode('dj_classe', $value['codeclasse'], 'code');
                                            $matiere = Yii::$app->mainCLass->databycode('dj_matiere', $value['matiere'], 'code');
                                            //  die(var_dump($matiere));
                                            $statut = ($value['statut'] == 1 ? 'Terminer' : 'En Cours');
                                            $btn = ' <a href="javascript:;" onclick="$(\'#action\').val(\'' . md5('telecharger') . '\'),$(\'#code\').val(\'' . $value['code'] . '\');$(\'#anneescolaire-form\').submit()" class="btn btn-primary">Telecharger</a>';
                                            $infoclasse = (sizeof($class) > 0) ? $class['0']['libelle'] : '';
                                            $matiere = (sizeof($matiere) > 0) ? $matiere['0']['libelle'] : '';

                                            echo '
                                        <tr>
                                        <td>' . $j . '</td>
                                        <td>' . $value['libelle'] . '</td>
                                        <td>' . $infoclasse . '</td>
                                        <td>' . $matiere . '</td>
                                        <td>' . $value['date'] . '</td>
                                        <td>' . $value['datedebut'] . '</td>
                                        <td>' . $value['datefin'] . '</td>
                                        <td>' . $statut . '</td>
                                        <td class="text-right">' . $btn . '</td>
                                        </tr>
                                     ';
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="solid-rounded-justified-tab5">
                    <div class="table-responsive">
                        <div class="row" >
                                <div class="col-12"   id="contentepresence">

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        presence('<?= $info['matricule'] ?>');
    });


    function presence(codeeleve) {

        $.post(
            '<?= Yii::$app->request->baseUrl . "/" . md5("parents_ajax"); ?>', {
                codeeleve: codeeleve,
                action_key: 'presence',
                _csrf: '<?= Yii::$app->request->getCsrfToken() ?>'
            },
            function(response) {
                console.log(response['data']);
                // $('#contentepresence').html(response);
                calendar(response['data']);
            }
        );
    }

    function calendar(data) {

        var calendarEl = document.getElementById('contentepresence');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },

            initialDate: new Date(),
            editable: true,
            selectable: true,
            // businessHours: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: data,
        });

        calendar.render();
    }
</script>