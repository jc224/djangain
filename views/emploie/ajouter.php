<form class="md-float-material form-material" action="<?= yii::$app->request->baseurl . '/' . md5('emploie_ajouter') ?>"

    enctype="multipart/form-data" name="login-form" id="eval-form" method="post">

    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

    <input type="hidden" name="action" id="action" value="" />

    <input type="hidden" name="code" id="code" value="" />

    <input type="text" hidden name="codeEvaluation" value="">

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

    <div class="row">

        <div class="col-sm-4 col-12">

        </div>



    </div>

    <div class="content-page">

        <div class="card">

            <div class="card-header">

                <div class="row align-items-center">

                    <div class="col-sm-12 " style="padding-bottom: 20px;">

                        <div class="page-title">Liste des Evaluations </div>

                    </div>



                    <div class="col-sm-1">

                        <div class=" mt-sm-0 mt-2">

                            <label for="">Classe </label>

                        </div>

                    </div>



                    <div class="col-sm-3 text-sm-right">

                        <div class=" mt-sm-0 mt-2">



                            <select name="classe" class="form-control form-select" id="classse"

                                onchange="selectclasse()">

                                <option value="" hidden>Selectionner Une Classe.....</option>

                                <?php

                                if (sizeof($classe) > 0) {

                                    foreach ($classe as $key => $value) {

                                        echo '<option value=' . $value['code'] . '>' . $value['libelle'] . '</option>';

                                    }

                                }

                                ?>

                            </select>





                        </div>

                    </div>

                    <div class="col-sm-1 text-sm-right">

                        <div class=" mt-sm-0 mt-2">

                            <label for="">Date Debut </label>

                        </div>

                    </div>

                    <div class="col-sm-2 text-sm-right">

                        <div class=" mt-sm-0 mt-2">

                            <input type="date" name="debut" class="form-control" id="">

                        </div>

                    </div>

                    <div class="col-sm-1 text-sm-right">

                        <div class=" mt-sm-0 mt-2">

                            <label for="">Date Fin </label>

                        </div>

                    </div>

                    <div class="col-sm-2 text-sm-right">

                        <div class=" mt-sm-0 mt-2">

                            <input type="date" name="fin" class="form-control" id="">

                        </div>

                    </div>

                    <div class="col-sm-2 text-sm-right">

                        <div class=" mt-sm-0 mt-2">

                            <!-- <button class="btn btn-outline-primary mr-2">

                                        <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/excel.png" alt="">

                                        <span class="ml-2">Excel</span>

                                    </button> -->

                            <a href="javascript:;" onclick="  $('#eval-form').submit();"

                                class="btn btn-outline-primary mr-2">

                                <span class="ml-2">AJOUTER</span>

                            </a>





                        </div>

                    </div>



                </div>

            </div>

            <div class="card-body">



                <div class="row">

                    <div class="col-md-12 mb-3">

                        <div class="table-responsive">

                            <table class="table custom-table">

                                <thead class="thead-light">

                                    <tr>



                                        <th style="width: 80px;">HORAIRE </th>

                                        <th>LUNDI</th>

                                        <th>MARDI</th>

                                        <th>MERCREDI</th>

                                        <th>JEUDI</th>

                                        <th>VENDREDI</th>

                                        <th>SAMEDI</th>









                                    </tr>

                                </thead>

                                <tbody>





                                    <tr>



                                        <td>8H-9H</td>

                                        <input type="text" hidden name="heure[]" value="8H-9H">

                                        <td><select name="matiere1[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours1[]" value="1">

                                        </td>

                                        <td><select name="matiere1[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours1[]" value="2">

                                        </td>

                                        <td><select name="matiere1[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours1[]" value="3">

                                        </td>

                                        <td><select name="matiere1[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours1[]" value="4">

                                        </td>

                                        <td><select name="matiere1[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours1[]" value="5">

                                        </td>

                                        <td><select name="matiere1[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours1[]" value="6">

                                        </td>







                                    </tr>



                                    <tr>



                                        <td>9H-10H</td>

                                        <input type="text" hidden name="heure[]" value="9H-10H">

                                        <td><select name="matiere2[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours2[]" value="1">

                                        </td>

                                        <td><select name="matiere2[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours2[]" value="2">

                                        </td>

                                        <td><select name="matiere2[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours2[]" value="3">

                                        </td>

                                        <td><select name="matiere2[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours2[]" value="4">

                                        </td>

                                        <td><select name="matiere2[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours2[]" value="5">

                                        </td>

                                        <td><select name="matiere2[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours2[]" value="6">

                                        </td>







                                    </tr>

                                    <tr>



                                        <td>10H-11H</td>

                                        <input type="text" hidden name="heure[]" value="10H-11H">



                                        <td><select name="matiere3[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours3[]" value="1">

                                        </td>

                                        <td><select name="matiere3[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours3[]" value="2">

                                        </td>

                                        <td><select name="matiere3[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours3[]" value="3">

                                        </td>

                                        <td><select name="matiere3[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours3[]" value="4">

                                        </td>

                                        <td><select name="matiere3[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours3[]" value="5">

                                        </td>

                                        <td><select name="matiere3[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours3[]" value="6">

                                        </td>







                                    </tr>

                                    <tr>



                                        <td>11H-12H</td>

                                        <input type="text" hidden name="heure[]" value="11H-12H">



                                        <td><select name="matiere4[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours4[]" value="1">

                                        </td>

                                        <td><select name="matiere4[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours4[]" value="2">

                                        </td>

                                        <td><select name="matiere4[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours4[]" value="3">

                                        </td>

                                        <td><select name="matiere4[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours4[]" value="4">

                                        </td>

                                        <td><select name="matiere4[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours4[]" value="5">

                                        </td>

                                        <td><select name="matiere4[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours4[]" value="6">

                                        </td>







                                    </tr>

                                    <tr>



                                        <td>12H-13H</td>

                                        <input type="text" hidden name="heure[]" value="12H-13H">



                                        <td><select name="matiere5[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours5[]" value="1">

                                        </td>

                                        <td><select name="matiere5[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours5[]" value="2">

                                        </td>

                                        <td><select name="matiere5[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours5[]" value="3">

                                        </td>

                                        <td><select name="matiere5[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours5[]" value="4">

                                        </td>

                                        <td><select name="matiere5[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours5[]" value="5">

                                        </td>

                                        <td><select name="matiere5[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours5[]" value="6">

                                        </td>







                                    </tr>

                                    <tr>



                                        <td>13H-14H</td>

                                        <input type="text" hidden name="heure[]" value="13H-14H">



                                        <td><select name="matiere6[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours6[]" value="1">

                                        </td>

                                        <td><select name="matiere6[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours6[]" value="2">

                                        </td>

                                        <td><select name="matiere6[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours6[]" value="3">

                                        </td>

                                        <td><select name="matiere6[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours6[]" value="4">

                                        </td>

                                        <td><select name="matiere6[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours6[]" value="5">

                                        </td>

                                        <td><select name="matiere6[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours6[]" value="6">

                                        </td>







                                    </tr>

                                    <tr>



                                        <td>14H-15H</td>

                                        <input type="text" hidden name="heure[]" value="14H-15H">



                                        <td><select name="matiere7[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours7[]" value="1">

                                        </td>

                                        <td><select name="matiere7[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours7[]" value="2">

                                        </td>

                                        <td><select name="matiere7[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours7[]" value="3">

                                        </td>

                                        <td><select name="matiere7[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours7[]" value="4">

                                        </td>

                                        <td><select name="matiere7[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours7[]" value="5">

                                        </td>

                                        <td><select name="matiere7[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours7[]" value="6">

                                        </td>







                                    </tr>

                                    <tr>



                                        <td>15H-16H</td>

                                        <input type="text" hidden name="heure[]" value="15H-16H">



                                        <td><select name="matiere8[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours8[]" value="1">

                                        </td>

                                        <td><select name="matiere8[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours8[]" value="2">

                                        </td>

                                        <td><select name="matiere8[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours8[]" value="3">

                                        </td>

                                        <td><select name="matiere8[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours8[]" value="4">

                                        </td>

                                        <td><select name="matiere8[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours8[]" value="5">

                                        </td>

                                        <td><select name="matiere8[]" class="form-control form-select matiere"></select>

                                            <input type="text" hidden name="jours8[]" value="6">

                                        </td>







                                    </tr>



                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    </div>



</form>





<script>

    function selectclasse() {



        code = $('#classse').val();

        var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("emploie_ajax")) ?>';

        $.post(

            url,

            { code: code, action_key: '<?= md5('1') ?>', _csrf: '<?= Yii::$app->request->getCsrfToken() ?>' },

            function (response) {

                $('.matiere').html(response);

                console.log(response);



            }

        );

    }

</script>