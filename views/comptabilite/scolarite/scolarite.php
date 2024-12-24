<?php

// die(var_dump($post));





?>



<div class="content container-fluid">

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

    <form novalidate="" enctype="multipart/form-data" method="post" id="scolarite"

        action="<?= Yii::$app->request->baseUrl . '/' . md5("comptable_scolarite") ?>">

        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

        <input type="hidden" name="action" id="action" value="<?= md5('filtrer') ?>" />

        <input type="hidden" name="mode" id="mode" value="" />

        <div class="page-content card">

            <div class="row align-items-center card-header">

                <div class="col-sm-6">

                    <div class="page-title">Liste des eleves </div>

                </div>

                <div class="col-sm-6 text-sm-right">

                    <div class=" mt-sm-0 mt-2">



                        <a href="javascript:;"

                            onclick=" $('#action').val('<?= md5('exporterpdf') ?>');document.getElementById('scolarite').submit();"

                            class="btn btn-outline-danger mr-2">

                            <img src="/wamy/web/mainAssets/img/pdf.png" alt="" height="18">

                            <span class="ml-2">PDF</span>

                        </a>







                    </div>

                </div>

            </div>

            <div class="card-body">

                <div class="row filter-row px-2">

                    <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2 col-12 mt-2">

                        <div class="">



                            <input type="text" name="search" id="search" placeholder="Recercher...."

                                class="form-control floating" value="<?= (isset($post)) ? $post['search'] : '' ?>">

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2 col-12 mt-2">

                        <div class="">

                            <select name="statutSearch" class="placeholder js-states form-control">

                                <option value='2' <?= (isset($post) && $post['statutSearch'] == '2') ? 'selected' : '' ?>>Non

                                    paier</option>

                                <option value='1' <?= (isset($post) && $post['statutSearch'] == '1') ? 'selected' : '' ?>>Paier

                                </option>

                                <option value='3' <?= (isset($post) && $post['statutSearch'] == '3') ? 'selected' : '' ?>>

                                    Avance

                                </option>





                            </select>

                        </div>

                    </div>

                    <div class="col-sm-6 col-md-3 col-lg-2 col-xl-3 col-12 mt-2">

                        <div class="">

                            <select name="paiementSearch" class="form-control">

                                <option value='<?= yii::$app->params['inscription'] ?>' hidden>INSCRIPTION</option>

                                <?php

                                if (sizeof($paiement) > 0) {

                                    foreach ($paiement as $key => $value) {

                                        $selected = (isset($post) && $post['paiementSearch'] == $value['code']) ? 'selected' : '';

                                        echo '

                                  <option  value="' . $value['code'] . '"  ' . $selected . ' >' . $value['libelle'] . '</option>

                                  ';
                                    }
                                }

                                ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-sm-6 col-md-3 col-lg-2 col-xl-3 col-12 mt-2">

                        <div class="">

                            <select name="classetSearch" class="form-control">

                                <option value=''>selectionner une classe</option>

                                <?php

                                if (sizeof($classe) > 0) {

                                    foreach ($classe as $key => $value) {

                                        $selected = (isset($post) && $post['classetSearch'] == $value['code']) ? 'selected' : '';



                                        echo '

                                  <option value="' . $value['code'] . '"  ' . $selected . ' >' . $value['libelle'] . '</option>

                                  ';
                                    }
                                }

                                ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-sm-12 col-md-2  col-lg-2  pt-2">

                        <button type="submit" class="btn btn-secondary btn-sm   mb-3"><i class="fa fa-send"

                                aria-hidden="true"></i> Rehercher </button>

                    </div>





                </div>

                <div class="row">




                    <div class="col-lg-12 mb-3">

                        <div class="table-responsive">

                            <table class="table custom-table datatable">

                                <thead class="thead-light">

                                    <tr>

                                        <th>[] </th>

                                        <th>Elèves</th>

                                        <th>Matricule</th>

                                        <th>Classe</th>

                                        <th>Total A Payer</th>

                                        <th>Payer</th>

                                        <th>Reste A Payer</th>

                                        <th class="text-right" style="width: 300px;">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                    if (isset($listAtente) && sizeof($listAtente) > 0) {

                                        $j = 0;

                                        foreach ($listAtente as $key => $value) {

                                            $montantapaier = '';

                                            $payer = '';

                                            $recu = '';

                                            $reste = '';

                                            $paiementrest = '';

                                            if (isset($post['paiementSearch'])) {

                                                $anneeActive = yii::$app->mainCLass->getAnneeActive();

                                                $infoacte = yii::$app->comptabiliteClass->selectinfopaiement($post['paiementSearch'], $value['codeClsse']);

                                                $paiment = yii::$app->comptabiliteClass->selectpaiemeteleve($value['codeEleve'], $post['paiementSearch'], $anneeActive);

                                                $paiment = yii::$app->comptabiliteClass->selectpaiemeteleve($value['codeEleve'], $post['paiementSearch'], $anneeActive);

                                                if ($infoacte) {

                                                    $montantapaier = $infoacte['montant'] . 'GNF';

                                                    $reste = $montantapaier . 'GNF';

                                                    if ($paiment) {

                                                        $payer = $paiment['montant'];

                                                        $reste = $paiment['restePayer'];

                                                        if ($paiment['restePayer'] > 0) {

                                                            $paiementrest = ' <a href="javascript:;" class="btn btn-sm btn-primary me-2 " onclick="

                                                       $(\'#montantpayer\').val(\'' . $payer . '\') ;

                                                       $(\'#montantrestentpayer\').val(\'' . $reste . '\') ;

                                                       $(\'#uodaterestant\').val(\'' . $reste . '\') ;

                                                       $(\'#totalttc\').val(\'' . $montantapaier . '\') ;

                                                       $(\'#actionupdate\').val(\'' . md5('update') . '\') ;

                                                       document.getElementById(\'codepaiemt\').value=\'' . $paiment['code'] . '\';

                                                       document.getElementById(\'classe\').value=\'' . $value['codeClsse'] . '\';

                                                       document.getElementById(\'code\').value=\'' . $value['codeEleve'] . '\';

                                                       document.getElementById(\'matriculeupdate\').value=\'' . $value['matricule'] . '\'; "

                                                       class="btn btn-sm bg-danger-light" data-toggle="modal" data-target="#update-modal">

                                                       <i class="fa fa-edite" aria-hidden="true"></i>  Continuer Le Paiement

                                                       </a>



                                                      

                                                   </div>';
                                                        } else {

                                                            $paiementrest = ' <a href="javascript:;" class="btn btn-sm btn-primary me-2 ">

                                                        <i class="feather-eye"></i> Completer

                                                        </a>

                                                        ';



                                                            $recu = ' <a href="javascript:;"  onclick="document.getElementById(\'matricule\').value=\'' . $value['matricule'] . '\'; ;                                                       document.getElementById(\'code\').value=\'' . $value['codeEleve'] . '\'; $(\'#codepaiemt\').val(\'' .  $paiment['code']  . '\') ;

                                                       $(\'#action\').val(\'recu\') ;$(\'#scolarite\').submit();" 

                                                       class="btn btn-sm btn-primary me-2 ">

                                                       <i class="feather-eye"></i> reçu

                                                       </a>';
                                                        }
                                                    }
                                                }
                                            }

                                            $genre = ($value['genre'] == 1 ? 'Masculin' : 'Feminin');

                                            $j++;



                                            echo '       

                                          

                                        <tr role="row" class="odd">

                                        <td class="sorting_1">

                                                            ' . $j . '

                                                        </td>

                                        <td>

                                            <h2 class="table-avatar">

                                            <a href="student-details.html" class="avatar avatar-sm me-2">

                                                <img class="avatar-img rounded-circle" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $value['photo'] . '" alt="ELEVES Image">

                                                </a>

                                                <a href="student-details.html">' . $value['nom'] . ' ' . $value['prenom'] . '</a>

                                            </h2>

                                            </td>

                                            <td>' . $value['classe'] . '</td>

                                            <td>' . $genre . '</td>

                                            <td>' . $montantapaier . '</td>

                                            <td>' . $payer . '</td>

                                            <td>' . $reste . '</td>

                                            <td class="text-end">

                                           

                                             

                                                <a href="javascript:;" class="btn btn-sm bg-primary me-2 text-white "  onclick="document.getElementById(\'classe\').value=\'' . $value['codeClsse'] . '\';document.getElementById(\'code\').value=\'' . $value['codeEleve'] . '\';document.getElementById(\'matricule\').value=\'' . $value['matricule'] . '\'; document.getElementById(\'action\').value=\'' . md5('ajout') . '\';selecteleve();" class="btn btn-sm bg-danger-light" data-toggle="modal" data-target="#standard-modal">

                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>  Payement

                                                </a>

                                                

                                                ' . $paiementrest . ' ' . $recu . '

                                          

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

            <div id="standard-modal" class="modal custom-modal fade" role="dialog">

                <form class="" action="<?= Yii::$app->request->baseUrl . '/' . md5('comptable_scolarite') ?>"

                    name="login-form" id="" method="post">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

                    <input type="hidden" name="code" id="code" value="" />

                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">

                            <div class="modal-head bg-primary">

                                <h4 class="modal-title" id="standard-modalLabel">ACTE</h4>

                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <input type="hidden" name="classe" id="classe">

                                    <div class="col-md-12">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">Matricule</label>:



                                            <input class="form-control " type="text" id="matricule" name="maricule"

                                                readonly onchange="selecteleve()" value="">

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">DATE DE PAYEMENT</label>:



                                            <input class="form-control " type="date" id="datepaiement"

                                                name="datepaiement" value="<?= date('Y-m-d') ?>" required="">

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-group form-primary">

                                            <label class="float-label fs-7">Paiement</label>

                                            <select name="paiement" class="form-control form-select"

                                                data-control="select2" id="paiement" onchange="calculTotal()"

                                                required="">

                                                <option value=""></option>

                                                <?php



                                                foreach ($paiement as $key => $value) {



                                                    echo '

                                                    <option value="' . $value['code'] . '">' . $value['libelle'] . '</option>

                                                    ';
                                                }

                                                ?>

                                            </select>

                                            <span class="form-bar"></span>



                                        </div>



                                    </div>



                                    <div class="col-md-12">

                                        <div class="table-responsive">

                                            <table class="table custom-table ">

                                                <thead class="thead-light">

                                                    <tr>



                                                        <th>ACTE</th>

                                                        <th>Montant A PAYER</th>

                                                        <th>PAYER</th>

                                                        <th>Reste</th>

                                                        <th>[ ]</th>



                                                    </tr>

                                                </thead>

                                                <tbody id="tablebody">

                                                </tbody>

                                            </table>



                                        </div>

                                    </div>











                                </div>











                            </div>

                            <div class="modal-footer">

                                <a href="javascript:;" onclick="Enregistre('simple')" class="btn   btn-primary">Enregistrer</a>

                                <button onclick="Enregistre('recupaiement')" class="btn   btn-primary">Enregistrer Et Imprimer le reçu</button>



                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>





            <div id="update-modal" class="modal custom-modal fade" role="dialog">

                <form class="" class="needs-validation" novalidate=""

                    action="<?= Yii::$app->request->baseUrl . '/' . md5('comptable_scolarite') ?>" name="login-form"

                    id="" method="post">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

                    <input type="hidden" name="code" id="code" value="" />

                    <input type="hidden" name="action" id="actionupdate" value="" />

                    <input type="hidden" name="codepaiemt" id="codepaiemt" value="" />

                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h4 class="modal-title" id="standard-modalLabel">ACTE</h4>

                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <input type="hidden" name="classe" id="classe">

                                    <div class="col-md-12">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">Matricule</label>:



                                            <input class="form-control " type="text" id="matriculeupdate"

                                                name="matriculeupdate" readonly onchange="" value="" required="">

                                            <span class=" form-bar"></span>

                                        </div>



                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">DATE DE PAYEMENT</label>:



                                            <input class="form-control " type="date" id="datepaiement"

                                                name="datepaiement" value="<?= date('Y-m-d') ?>" required="">

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">Total A Payer</label>:



                                            <input class="form-control " type="text" id="totalttc" name="totalttc"

                                                readonly onchange="" value="">

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">Montant Deja Payer</label>:



                                            <input class="form-control " type="text" id="montantpayer"

                                                name="montantpayer" readonly onchange="" value="">

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">Montant Restant</label>:



                                            <input class="form-control " type="text" id="montantrestentpayer"

                                                name="montantrestentpayer" onchange="" value="">

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>



                                    <div class="col-md-6">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">Payer</label>:



                                            <input class="form-control " type="text" id="updatepayer" name="updatepayer"

                                                onchange="calculeupdate()" value="">

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">Reste A payer</label>:



                                            <input class="form-control " type="text" id="uodaterestant"

                                                name="uodaterestant" onchange="" value="" readonly>

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>













                                </div>











                            </div>

                            <div class="modal-footer">

                                <button type="submit" class="btn   btn-primary">Enregistrer</button>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>









        </div>

    </form>

</div>



















<script>
    function selectpaiement() {



        code = $('#code').val();

        classe = $('#classe').val();

        var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("comptable_ajax")) ?>';

        $.post(

            url, {

                code: code,

                classe: classe,

                action_key: '<?= md5('listpiement') ?>',

                _csrf: '<?= Yii::$app->request->getCsrfToken() ?>'

            },

            function(response) {

                $('#paiement').html(response);



            }

        );

    }







    function remove(params) {

        // alert(params);

        $('#ligne' + params + '').remove();



    }



    function Enregistre(mode) {



        var paiement = $('#paiement').val();



        if (paiement == "") {

            Swal.fire({

                text: "<?= Yii::t("app", "Veuillez Selectionner le paiement") ?>",

                icon: "error",

                buttonsStyling: false,

                confirmButtonText: "Ok, Continuer",

                customClass: {

                    confirmButton: "btn btn-danger"

                }

            });

        } else {



            $('#mode').val(mode);

            $('#scolarite').submit();

        }

    }





    function calculTotal() {

        var paiement = $('#paiement').val();

        var matricule = document.getElementById('matricule').value;

        var classe = document.getElementById('classe').value;

        $('#somPaier').val('');

        $('#apaiier').val('');

        var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("comptable_scolarite")) ?>';



        $.post(

            url, {

                classe: classe,

                matricule: matricule,

                paiement: paiement,

                action_key: '<?= md5('1') ?>',

                _csrf: '<?= Yii::$app->request->getCsrfToken() ?>'

            },

            function(response) {

                console.log(response);

                // $('#somPaier').val(response['montant']);

                // $('#apaiier').val(response['montant']);

                $('#tablebody').append(response);

            }

        );







    }



    function calcul(id) {

        somPaier = parseInt($('#somPaier' + id + '').val());

        montant = parseInt($('#montant' + id + '').val());

        $('#reste' + id + '').val('');

        // alert(montant);

        if (montant > somPaier) {

            $('#montant' + id + '').val('');

            $('#reste' + id + '').val('');



            $('#montant' + id + '').focus();

            Swal.fire({

                text: "<?= Yii::t("app", "Le montant payer dois etre inferiereiuer au montatat a payer") ?>",

                icon: "error",

                buttonsStyling: false,

                confirmButtonText: "Ok, Continuer",

                customClass: {

                    confirmButton: "btn btn-danger"

                }

            });

        } else {

            $('#reste' + id + '').val(somPaier - montant);



        }





    }





    function calculeupdate() {

        somPaier = parseInt($('#montantrestentpayer').val());

        montant = parseInt($('#updatepayer').val());

        $('#uodaterestant').val('');

        if (montant <= somPaier) {

            $('#uodaterestant').val(somPaier - montant);



        } else {

            $('#updatepayer').val('');

            $('#uodaterestant').val('');



            $('#updatepayer').focus();

            alert('Le montant doit pas etre superieur a la somme a paier');

        }





    }











    function selecteleve() {



        code = $('#matricule').val();

        classe = $('#classe').val();

        var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("comptable_ajax")) ?>';

        $.post(

            url, {

                code: code,

                classe: classe,

                action_key: '<?= md5('listpiement') ?>',

                _csrf: '<?= Yii::$app->request->getCsrfToken() ?>'

            },

            function(response) {

                console.log(response);

                $('#paiement').html(response);



            }

        );

    }





    function recu() {

        alert('salut');

    }
</script>