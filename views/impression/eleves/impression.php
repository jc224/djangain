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
        <form id="sumit" method="post" action="<?= Yii::$app->request->baseUrl . '/' . md5('impression_eleve') ?>">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
            <input type="hidden" name="action" id="action" value="" />
            <input type="hidden" name="codeclasse" id="codeclasse" value="" />

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6">
                                                    <div class="page-title">TOTAL ELEVES PAR NIVEAU </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="table-responsive">
                                                        <table class="table custom-table table-responsive-sm datatable "
                                                            aria-describedby="DataTables_Table_0_info"
                                                            id="DataTables_Table_0">
                                                            <thead class="thead-light">

                                                                <tr role="row">
                                                                    <th>[]</th>
                                                                    <th>Classe</th>
                                                                    <th>Niveau</th>
                                                                    <th>Nombre</th>
                                                                    <th class="text-right">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if (isset($liste) && sizeof($liste) > 0) {
                                                                    $j = 0;
                                                                    foreach ($liste as $key => $value) {
                                                                        //  die(var_dump($value));
                                                                        $stat = yii::$app->eleveClass->actionstatcarte($value['code'], $anneeActive, '0');
                                                                        //  die(var_dump($statnonImprimer));
                                                                        $j++;
                                                                        $nb = 0;
                                                                        $btn = ' <a class="btn btn-primary text-white" href="javascript:;" onclick="
                                        $(\'#codeclasse\').val(\'' . $value['code'] . '\');
                                        $(\'#action\').val(\'prime\');$(\'#sumit\').submit();"><i class="fa fa-print" aria-hidden="true"></i> Imprimer</a>';

                                                                        if ($stat) {
                                                                            $nb = $stat['nb'];
                                                                        }
                                                                        //  die(var_dump(($stat['nb'])));
                                                                
                                                                        echo '       
                                        <tr >
                                    <td >
                                        ' . $j . '
                                    </td>
                                    <td>' . $value['nomCLasse'] . '</td>
                                    
                                    <td>' . $value['niveau'] . '</td>
                                    <td>' . $nb . '</td>
                                    <td  class="text-right">' . $btn . '</td>
                                    
                                    
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
                        </div>
        </form>
    </div>
</div>