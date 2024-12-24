<div class="content container-fluid">
    <form class="needs-validation" novalidate="" enctype="multipart/form-data"
        action="<?= Yii::$app->request->baseUrl . '/' . md5('etablissement_liste') ?>" name="login-form"
        id="formajout" method="post">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
        <input type="hidden" name="action" id="action" value="" />
        <input type="hidden" name="code" id="code" value="" />
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

        <div class="content-page">


            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">Liste des Personnel </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="">
                                <a href="javascript:;" data-toggle="modal" data-target="#add_leavetype" class="btn btn-primary "><i class="fas fa-plus"></i> Ajouter un Etablissement</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="table-responsive">
                                <table class="table custom-table datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="min-width:50px;">[]</th>
                                            <th style="min-width:70px;">Etablissement </th>
                                            <th style="min-width:50px;">Email</th>
                                            <th style="min-width:50px;">Tel</th>
                                            <th style="min-width:80px;">Commune</th>
                                            <th style="min-width:50px;">Adresse</th>
                                            <th style="min-width:50px;">Statut</th>
                                            <th style="min-width:50px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (sizeof($ets)) {
                                            $j = 0;
                                            foreach ($ets as $key => $value) {
                                                $j++;
                                                if ($value['etat']  == 0) {
                                                    $autBtn = '<a href="javascript:;" Class="btn btn-circle btn-primary"  onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("activer")) . '\';  document.getElementById(\'code\').value=\'' . $value["code"] . '\';$(\'#formajout\').submit();">' . yii::t("app", 'activer') . '</a>';
                                                } else {
                                                    $autBtn = '<a href="javascript:;" Class="btn btn-circle btn-danger"  onclick="document.getElementById(\'action\').value=\'' . md5(strtolower("desactiver")) . '\';  document.getElementById(\'code\').value=\'' . $value["code"] . '\';$(\'#formajout\').submit();">' . yii::t("app", 'desactiver') . '</a>';
                                                }
                                                echo '
                                                    <tr>
                                                    <td>' . $j . '</td>
                                                    <td>' . $value['nomEtbs'] . '</td>
                                                    <td>' . $value['email'] . '</td>
                                                    <td>' . $value['tel'] . '</td>
                                                    <td>' . $value['commune'] . '</td>
                                                    <td>' . $value['addresse'] . '</td>
                                                    <td>' . $value['statut'] . '</td>
                                                    <td>' . $autBtn . '</td>
                                                    </tr>
                                                ';
                                            }
                                        }
                                        ?>






                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="add_leavetype" class="modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title text-white" id="standard-modalLabel">Ajouter Un Etablissement</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-outline mb-4">
                                    <label for="validationDefault02" class="required">Nom Etablissement</label>
                                    <input type="input" class="form-control " id="nom" name="nom" placeholder=""
                                        aria-describedby="inputGroupPrepend3" required="">


                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-outline mb-4">
                                    <label for="validationDefault02" class="required">Email *</label>
                                    <input type="input" class="form-control " id="Email" name="Email" placeholder=""
                                        aria-describedby="inputGroupPrepend3" required="">


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-outline mb-4">
                                    <label for="validationDefault02" class="required">Tel *</label>
                                    <input type="text" class="form-control " id="tel" name="tel" placeholder=""
                                        aria-describedby="inputGroupPrepend3" required="">


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-outline mb-4">
                                    <label for="validationDefault02" class="required">Commune</label>
                                    <input type="text" class="form-control " id="commune" name="commune" placeholder=""
                                        aria-describedby="inputGroupPrepend3" required="">


                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-outline mb-4">
                                    <label for="validationDefault02" class="required">Adresse</label>
                                    <input type="text" class="form-control " id="adresse" name="adresse" placeholder=""
                                        aria-describedby="inputGroupPrepend3" required="">


                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" onclick="ajouter()" class="btn   btn-primary">Enregistrer</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>



<script>
    function ajouter() {
        $('#formajout').submit();
    }
</script>