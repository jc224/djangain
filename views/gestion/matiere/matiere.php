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

    <div class="page-content">

        


        <form class="needs-validation" novalidate=""

            action="<?= Yii::$app->request->baseUrl . '/' . md5('gestion_detailsmatiers') ?>" name="login-form"

            id="anneescolaire-form" method="post">

            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

            <input type="hidden" name="action" id="action" value="" />

            <input type="hidden" name="codelienprof" id="codelienprof" value="" />

            <input type="hidden" name="codelien" id="codelien" value="" />



            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-header">

                            <div class="row align-items-center">

                                <div class="col-sm-6">

                                    <div class="page-title mt-4">Liste Des Matières </div>

                                </div>



                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                                    <div class="table-responsive">

                                        <table class="datatable table table-stripped dataTable no-footer"

                                            id="DataTables_Table_0" role="grid"

                                            aria-describedby="DataTables_Table_0_info">

                                            <thead>

                                                <tr role="row">

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"

                                                        rowspan="1" colspan="1"

                                                        aria-label="Name: activate to sort column ascending"

                                                        style="width: 191.016px;">#</th>

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"

                                                        rowspan="1" colspan="1"

                                                        aria-label="Name: activate to sort column ascending"

                                                        style="width: 191.016px;">Matière</th>

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"

                                                        rowspan="1" colspan="1"

                                                        aria-label="Office: activate to sort column ascending"

                                                        style="width: 145.188px;">coeficient</th>

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"

                                                        rowspan="1" colspan="1"

                                                        aria-label="Office: activate to sort column ascending">Charger

                                                        du Cours</th>

                                                    <th class="text-end">Action</th>

                                            </thead>

                                            <tbody>

                                                <?php

                                                if (isset($matiere) && sizeof($matiere)) {

                                                    $j = 0;

                                                    foreach ($matiere as $key => $value) {



                                                    

                                                        $prof = Yii::$app->configClass->selectprofformatiere($value['codelien'], $anneeActive);



                                                        if ($prof) {

                                                          

                                                            $data = yii::$app->mainCLass->databycode('dj_personnel',$prof['codeProf'],'code')['0'];

                                                            // die(var_dump($data));

                                                            $codeproff =$data['code'];

                                                            $professeur = $data['nom'].' '.$data['prenom']; 

                                                            $codelenprof =$prof['code'];

                                                        } else {

                                                            $professeur = 'Non Définie';

                                                            $codelenprof = '';

                                                            $codeproff ='';

                                                        }

                                                        // die(var_dump($codelenprof));

                                              

                                                        $btnmodifier = '<button type="button" class="btn btn-primary modifierAnee"   onclick="$(\'#codeprofe\').val(\''.$codeproff.'\'),$(\'#etat\').css(\'display\',\'block\'),$(\'#codelienprof\').val(\''.$codelenprof.'\'),$(\'#coef\').val(\'' . $value['coef'] . '\');document.getElementById(\'action\').value=\'' . md5(strtolower("modifiermaticlasse")) . '\';document.getElementById(\'matieres\').value=\'' . $value['libelle'] . '\'; document.getElementById(\'codelien\').value=\'' .$value['codelien'].'\'; " data-toggle="modal" data-target="#exampleModal">

                                                        <i class="fa fa-edit" aria-hidden="true"></i>

                                                        modifier

                                                        </button>';

                                                        $j++;

                                                        echo '

                                                    <tr>

                                                    <td>' . $j . '</td>

                                                    <td>' . $value['libelle'] . '</td>

                                                    <td>' . $value['coef'] . '</td>

                                                    <td>' . $professeur . '</td>

                                                    <td class="text-end">' . $btnmodifier . '</td>

                                                

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

                <div id="exampleModal" class="modal fade" tabindex="-1" role="dialog"

                    aria-labelledby="standard-modalLabel" aria-hidden="true">

                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">

                            <div class="modal-head bg-primary">

                                <h4 class="modal-title" id="standard-modalLabel">Affectation</h4>

                            </div>



                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group form-primary" id="etat" style="display:none;">

                                            <label for="validationDefault02" class="required">

                                                <?= yii::t("app", 'etat') ?>

                                            </label>

                                            <select class="form-control form-select" name="etat" id="etatsected">

                                                <?php



                                                $etat = yii::$app->simplelClass->etat();

                                                foreach ($etat as $key => $value) {

                                                    echo '<option value="' . $key . '">' . $value . '</option>';

                                                }

                                                ?>

                                            </select>





                                        </div>

                                    </div>

                                </div>

                                <div class="row">



                                    <div class="col-md-12">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">Matières</label>

                                            <input type="text" min='1' value="1" class="form-control" placehoder=""

                                                name="matieres" id="matieres">



                                            <span class="form-bar"></span>



                                        </div>



                                    </div>



                                    <div class="col-md-12">

                                        <div class="form-group form-primary">

                                            <label class=" fs-7">coefficients</label>



                                            <input type="number" min='1' value="1" class="form-control" placehoder=""

                                                name="coeficients" id="coef">

                                            <span class="form-bar"></span>

                                        </div>



                                    </div>



                                    <div class="col-md-12">

                                        <div class="form-group form-primary"  >

                                            <label for="validationDefault02" class="required">

                                                <?= yii::t("app", 'proffeseurs') ?>

                                            </label>

                                            <select class="form-control form-select select2" name="codeprof" id="codeprofe">

                                            <option value="" hidden=""></option>



                                            <?php



                                                foreach ($listeprof as $key => $value) {

                                                  

                                                    echo '<option value="'.$value['codePers'].'">' . $value['nom'] . ' ' . $value['prenom'] . ' : ' . $value['matricule'] . '</option>';

                                                }

                                                ?>

                                            </select>





                                        </div>

                                </div>

                                  

                                </div>











                            </div>

                            <div class="modal-footer">

                                <a href="javascript:;" onclick="ajoutermatier()"

                                    class="btn   btn-primary">Enregistrer</a>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                            </div>

                        </div>

                    </div>

                </div>

        </form>

    </div>

</div>



<script>
    function ajoutermatier() {
        $('#btnajout').prop("disabled", true);
        let requiredFields = ['#codeprofe'];
     
        $('#anneescolaire-form').submit();

    }
</script>