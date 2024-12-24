<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title">Présence</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <i class="fas fa-home"></i> Acceuil </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Présence</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span>Mouvement</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-content">
        <form class="md-float-material form-material" action="<?= Yii::$app->request->baseUrl . '/' . md5('eleve_enrollement') ?>" name="login-form" id="anneescolaire-form" method="post">

            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
            <input type="hidden" name="action" id="action" value="<?= md5('filtrer') ?>" />

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <div class="page-title">Verification de presence </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">

                            <div class="d-flex flex-center justify-content-center">
                                <div class="">

                                    <input type="input" class="form-control " id="matricule" name="matricule" placeholder="Matricule * "
                                        aria-describedby="inputGroupPrepend3" required="">
                                </div>
                                <div class="mx-3 ">
                                    <a href="javascript:;" onclick="recherchepresence()" class="btn btn-primary pt-20">Verifier</a>
                                </div>
                            </div>
                            <div class="h-350px mt-10" id="contentpresence">
                                <div class="text-center px-4 align-items-center">
                                    <img class="" alt="image"
                                        src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/5.png" style="width:300px">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function recherchepresence() {

            matricule = $('#matricule').val();
            var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("presence_ajax")) ?>';
            $.post(
                url, {
                    matricule: matricule,
                    action_key: '<?= md5('verifiepresence') ?>',
                    _csrf: '<?= Yii::$app->request->getCsrfToken() ?>'
                },
                function(response) {
                    $('#contentpresence').html(response);
                    // $('#periode').html(response['typeeva']);
                     console.log(response);

                }
            );
        }
    </script>