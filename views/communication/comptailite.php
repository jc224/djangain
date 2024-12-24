<div class="content container-fluid">

    <div class="page-header">

        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                <h5 class="text-uppercase mb-0 mt-0 page-title">Communication</h5>

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

        <form class="md-float-material form-material" action="<?= Yii::$app->request->baseUrl . '/' . md5('communication_comptabiliter') ?>" name="login-form" id="formsubmit" method="post">



            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

            <input type="hidden" name="action" id="action" value="<?= md5('filtrer') ?>" />



            <div class="row">

                <div class="col-12">

                    <div class="card">

                       
                    <div class="card-header">

                        <div class="row align-items-center">

                            <div class="col-md-4">

                                <div class="page-title">Canal de Communication </div>

                            </div>

                            <div class="col-md-3 text-sm-right d-flex justify-content-end">

                                <select name="classe" id="classe" class="form-control form-select" data-control="select2" >

                                    <option value="" hidden>Veuillez selectionner une classe</option>

                             

                                    <?php

                                    if (sizeof($classe) > 0) {

                                        foreach ($classe as $key => $value) {

                                            echo ' <option value="' . $value['code'] . '">' . $value['libelle'] . '</option>';

                                        }

                                    }

                                    ?>

                                </select>

                            </div>
                            <div class="col-md-3 text-sm-right d-flex justify-content-end">

                                <select name="acte" id="acte" class="form-control form-select " >

                                    <option value="" hidden>Veuillez selectionner un acte </option>



                                    <?php

                                    if (sizeof($paiement) > 0) {

                                        foreach ($paiement as $key => $value) {

                                            echo ' <option value="' . $value['code'] . '">' . $value['libelle'] . '</option>';

                                        }

                                    }

                                    ?>

                                </select>

                            </div>
                            <div class="col-md-1 text-sm-right d-flex justify-content-end">
                                    <a href="javascript:;" onclick="selectgroue()" class="btn btn-primary">filtre</a>
                             </div>

                        </div>



                    </div>
                        <div class="card-body">
                                    
                            <div class="row">

                                <div class="col-md-8">

                                    <div class="card">

                                        <div class="card-header">

                                            <h1>Messages</h1>

                                        </div>

                                        <div class="card-body">

                                            <div class="h-350px mt-10 d-none" id="contentpresence">

                                                <div class="text-center px-4 align-items-center">

                                                    <img class="" alt="image"

                                                        src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/5.png" style="width:100px">

                                                </div>

                                                <p class="text-center">Selectionner un groupe d'utilisateur</p>

                                            </div>



                                            <div class="chat-box ">

                                                <div class="chats scroll scroll-y" style="max-height: 350px;">



                                                    <div class="chat chat-left">



                                                        <div class="chat-body" id="contenuemessage">



                                                            <div class="text-center px-4 align-items-center">

                                                                <img class="" alt="image"

                                                                    src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/images/5.png" style="width:100px">

                                                            </div>

                                                            <p class="text-center">Selectionner un groupe d'utilisateur</p>



                                                        </div>

                                                    </div>



                                                </div>

                                            </div>

                                        </div>

                                        <div class="card-footer">

                                            <div class="message-bar">

                                                <div class="message-inner">

                                                    <a class="link attach-icon" href="#" data-toggle="modal"

                                                        data-target="#drag_files"><img src="assets/img/attachment.png" alt=""></a>

                                                    <div class="message-area">

                                                        <div class="input-group">

                                                            <textarea class="form-control" require placeholder="message..." name="message" value=""></textarea>

                                                            <span class="input-group-append">

                                                                <button class="btn btn-info" type="button" onclick="envoie()"><i

                                                                        class="fas fa-paper-plane"></i></button>

                                                            </span>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4 ">

                                    <div class="card">

                                        <div class="card-header">

                                            <h4>Numero des parents à contacter </h4>

                                        </div>

                                        <div class="card-body" id="contenue">


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



    <script>    
        function envoie() {

            $('#formsubmit').submit();



        }



        function selectgroue() {
            // alert('ok');
            classe = $('#classe').val();
            acte = $('#acte').val();
            var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("communication_ajax")) ?>';

            $.post(

                url, {

                    classe: classe,
                    acte:acte,
                    action_key: '<?= md5('filtrepaiement') ?>',

                    _csrf: '<?= Yii::$app->request->getCsrfToken() ?>'

                },

                function(response) {
                    $('#contenue').html(response['content']);
                    $('#contenuemessage').html(response['contenuemessage']);
                    console.log(response);



                }

            );

        }
    </script>