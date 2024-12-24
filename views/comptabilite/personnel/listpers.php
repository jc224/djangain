<div class="content container-fluid">
    <form class="needs-validation" novalidate="" action="<?= Yii::$app->request->baseUrl . '/' . md5('comptable_personnel') ?>" name="form-liste" id="ajoutforme" method="post">

        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
        <input type="hidden" name="action" id="action" value="<?= md5('filtrer') ?>" />
        <input type="hidden" name="codePrpf" id="codePrpf" value="" />
        <input type="hidden" name="codefonction" id="codefonction" value="" />


        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Enseignant</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Enseignant</a></li>
                        <li class="breadcrumb-item"><span>Tous les Enseignant</span></li>
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
                        <div class="col-sm-6 text-sm-right">
                            <div class=" mt-sm-0 mt-2">
                                <!-- <button class="btn btn-outline-primary mr-2">
                                    <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/excel.png" alt="">
                                    <span class="ml-2">Excel</span>
                                </button> -->
                                <!-- <a href="javascript:;"
                                        onclick=" $('#action').val('<?= md5('printlist') ?>');  $('#anneescolaire-form').submit();"
                                            class="btn btn-outline-danger mr-2">
                                            <img src="/wamy/web/mainAssets/img/pdf.png" alt="" height="18">
                                            <span class="ml-2">PDF</span>
                                        </a> -->


                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus">

                                <input type="text" name="search" id="search" placeholder="Recercher...."
                                    class="form-control " value="<?= (isset($post)) ? $post['search'] : '' ?>">
                                <label class="focus-label">Rechercher </label>

                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus">
                                <select name="catsearch" class="form-control">
                                    <option value=""></option>
                                    <?php
                                    if (sizeof($fonction) > 0) {
                                        foreach ($fonction as $key => $value) {
                                            $selected =   (isset($post) && $post['catsearch']  == $value['code']) ?  'selected' : '';

                                            echo '
                                                   <option value="' . $value['code'] . '"  ' . $selected . '>' . $value['libelle'] . '</option>

                                                  ';
                                        }
                                    }
                                    ?>
                                </select>
                                <label class="focus-label">Fonction </label>

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <button type="submit" class="btn btn-search btn-sm rounded btn-block mb-3" onclick="$('#ajoutforme').submit()"> Rehercher
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="table-responsive">
                                <table class="table custom-table datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="min-width:50px;">[]</th>
                                            <th style="min-width:70px;">Matricule</th>
                                            <th style="min-width:50px;">Personnel</th>
                                            <th style="min-width:50px;">Genre</th>
                                            <th style="min-width:80px;">Téléphone</th>
                                            <th style="min-width:50px;">Email</th>
                                            <th style="min-width:50px;">Adresse</th>
                                            <th style="min-width:50px;">Fonction</th>
                                            <th class="text-right" style="width:15%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (sizeof($liste) > 0) {
                                            $j = 0;
                                            foreach ($liste as $key => $value) {
                                                $j++;
                                                // die(var_dump($value));

                                                $genre = $value['genre'] == 1 ? 'Masculin' : 'Feminin';
                                                echo '    
                                                        <tr>
                                                        <td class="sorting_1">
                                                            ' . $j . '
                                                        </td>
                                                        <td>' . $value['matricule'] . '</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                            <a href="student-details.html" class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-circle" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $value['photo'] . '" alt="ELEVES Image">
                                                            </a>
                                                            <a href="student-details.html">' . $value['nom'] . ' ' . $value['prenom'] . '</a>
                                                            </h2>
                                                        </td>
                                                        <td >
                                                        ' . $genre . '
                                                        </td>
                                                        <td >
                                                        ' . $value['tel'] . '
                                                        </td>
                                                        <td >
                                                        ' . $value['email'] . '
                                                        </td>
                                                        <td >
                                                        ' . $value['adresse'] . '
                                                        </td>
                                                        <td >
                                                        ' . $value['libelle'] . '
                                                        </td>
                                                        <td class="text-right">
                                                        <a href="javascript:;" class="btn btn-primary btn-sm mb-1"  onclick="$(\'#codePrpf\').val(\'' . $value['codePers'] . '\');$(\'#codefonction\').val(\'' . $value['codeFonction'] . '\');$(\'#codePrpf\').val(\'' . $value['codePers'] . '\');paiementprof()" data-toggle="modal" data-target="#exampleModalLabel">
                                                            <i class="fa fa-paypal" aria-hidden="true"></i>Payer
                                                        </a>
                                                        
                                                        <a href="' . yii::$app->request->baseUrl . '/' . md5('comptable_historiquepaiement') . '/' . $value['codePers'] . '"  class="btn btn-secondary btn-sm mb-1">
                                                                <i class="fa fa-eye" aria-hidden="true"></i> Hist Paiement
                                                                </a>
                                                        </td>
                                                </tr>';
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

</div>
<div id="exampleModalLabel" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-head bg-primary">
                <h4 class="modal-title" id="standard-modalLabel text-uppercase">Payer un prof</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">

                        <label>TypePaiement</label>
                        <select class="form-control" name="typpepaiement" id="typepaiement" aria-hidden="true">
                            <option hidden>Séléctionner une fonction..</option>

                        </select>
                    </div>



                    <div class="col-md-6">
                        <div class="form-outline mb-4">
                            <label for="validationDefault02" class="required">Salaire Brut *</label>
                            <input type="number" class="form-control " readonly id="salaire" name="salaire"
                                placeholder="" aria-describedby="inputGroupPrepend3" required="">


                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-outline mb-4">
                            <label for="validationDefault02" class="required">PRIME *</label>
                            <input type="number" class="form-control " id="prime" value="0" name="prime"
                                placeholder="" onchange="calculesalaire()" aria-describedby="inputGroupPrepend3" required="">


                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-outline mb-4">
                            <label for="validationDefault02" class="required">DATE</label>
                            <input type="date" class="form-control " name="dateop" value="<?= date('Y-m-d') ?>"
                                placeholder="" aria-describedby="inputGroupPrepend3" required="">


                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-outline mb-4">
                            <label for="validationDefault02" class="required">SALAIRE NET</label>
                            <input type="number" class="form-control " id="netpaier" name="netpaier"
                                placeholder="" aria-describedby="inputGroupPrepend3" required="">


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

    </form>
</div>

<?php require('script/script.php'); ?>

<script>

</script>