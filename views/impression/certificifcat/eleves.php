

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
            
                <div class="content-page">
                <form class="md-float-material form-material" action="<?= Yii::$app->request->baseUrl.'/'.md5('impression_certificat')?>" name="form-liste" id="anneescolaire-form" method="post">

                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="action" id="action" value="<?= md5('filtrer') ?>" />
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
                            


                                    </div>
                                </div>
                                </div>
                        </div> 
                        <div class="card-body">
                        <div class="row filter-row ">    
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group form-focus">

                                        <input type="text" name="search" id="search" placeholder="Recercher...."
                                            class="form-control " value="<?= (isset($post)) ? $post['search'] : '' ?>">
                                            <label class="focus-label">Rechercher </label>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                    <a href="javascript:;" onclick="filtre()" class="btn btn-search btn-sm rounded btn-block mb-3"> Rehercher </a>
                                    </div>
                                  
                                </div>

                             <div class="row">
                                <div class="cool-12">
                                <div id="content"></div>

                                </div>
                            </div>
                        
                      
                        </div>
                    </div>
                    
                </form>
                </div>
           
            </div>
            <?php
                $csrf = Yii::$app->request->getCsrfToken();
                $url = Yii::$app->request->baseUrl . "/" . md5("impression_certificat");
                ?>
            <script>
              
                function filtre() {
                    search = $('#search').val();
                    $.post(
                        '<?= $url ?>',

                        {
                            _csrf: '<?= $csrf ?>',
                            search: search
                        },
                        function (response) {
                            console.log(response);
                            $('#content').html('');
                            $('#content').html(response);

                        });
                }

            </script>





   