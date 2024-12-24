<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title">Modification Information</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <i class="fas fa-home"></i> Acceuil </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Paramétre Classe</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span>Modification</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-content">



        <form class="needs-validation" novalidate="" enctype="multipart/form-data"
            action="<?= Yii::$app->request->baseUrl . '/' . md5('param_ets') ?>" name="login-form"
            id="anneescolaire-form" method="post">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
            <input type="hidden" name="action" id="action" value="<?= md5('modifiereinfoeleve') ?>" />
            <!-- Email input -->
            <div class="row align-items-start">
                <div class="col">

                    <div class="form-outline mb-4">
                        <label class="" for="form1Example1" style=" font-style: oblique;">Nom Etablissement:</label>
                        <input type="text" id="form1Example1" class="form-control" value="<?= $ets['nomEtbs'] ?>"
                            name="nomets" required="" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="" for="form1Example1" style="font-style: oblique;">Email:</label>
                        <input type="email" id="form1Example1" name="email" class="form-control"
                            value="<?= $ets['email'] ?>" required="" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="" for="form1Example1" style=" font-style: oblique;">Tel:</label>
                        <input type="text" id="form1Example1" class="form-control" value="<?= $ets['tel'] ?>"
                            required="" name="tel" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="" for="form1Example1" style=" font-style: oblique;">Commune:</label>
                        <input type="text" id="form1Example1" class="form-control" value="<?= $ets['commune'] ?>"
                            required="" name="Commune" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="" for="form1Example1" style="font-style: oblique;">Primary theme:</label>
                        <input type="primary" id="form1Example1" name="primary" class="form-control"
                            value="<?= $ets['prim'] ?>" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="" for="form1Example1" style=" font-style: oblique;">Seconadry theme:</label>
                        <input type="text" id="secondary" class="form-control" value="<?= $ets['secon'] ?>"
                            required="" name="secondary" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline mb-4">
                        <label class="" for="form1Example1" style="  font-style: oblique;">Adresse:</label>
                        <input type="text" name="adresse" id="form1Example1" required="" value="<?= $ets['addresse'] ?>"
                            class="form-control" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="" for="form1Example1" style=" font-style: oblique;">logo Wamy:</label>

                        <!-- <input type="file" id="form1Example1" class="form-control" name="logo" /> -->


                        <!--begin::Image input-->
                        <div class="image-input image-input-outline  image-input-empty " data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            <div id="image-cropper-result"
                                class="image-input-wrapper w-125px  h-125px;background-image: url('<?=yii::$app->request->baseUrl.''.yii::$app->params['linkToUploadIndividusProfil'].''.$ets['logo']?>')">
                                <img style="width:125px; height:125px;" src="<?=yii::$app->request->baseUrl.''.yii::$app->params['linkToUploadIndividusProfil'].''.$ets['logo']?>">
                            </div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                title="
                                                                                        <?= yii::t("app", 'changephoto') ?>">
                                <a href="javascript:;" Class="btn " data-toggle="modal"
                                    data-target="#vuePrincipaleAddInModal">
                                    <i class="bi bi-pencil-fill fs-7"></i>Ajouter une photo
                                </a>
                                <!--begin::Inputs-->
                                <input type="text" hidden id="photo" value="" name="logo" accept=".png, .jpg, .jpeg" />
                                <br>
                                <input type="hidden" name="logohidden" value="<?= $ets['logo'] ?>">

                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->

                        </div>
                        <!--end::Image input-->
                    </div>
                    <div class="form-outline mb-4">
                        <label class="" for="form1Example1" style=" font-style: oblique;">Slogan:</label>
                        <textarea name="slogan" id="" cols="30" class="form-control"><?= $ets['slogan'] ?> </textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="form-group text-center custom-mt-form-group">
                    <button class="btn btn-primary mr-2" type="submit">Enregistrer</button>
                    <button class="btn btn-secondary" type="reset">Annuler</button>
                </div>

            </div>
        </form>


    </div>


    <!--begin::Modal - Support Center - Create Ticket-->
    <div class="modal fade" id="vuePrincipaleAddInModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15 mt-15">
                    <div style="display: flex;">
                        <div id="image-cropper" style="border:1px solid #ccc; margin: 5px; width:120px; height:120px;">
                            <?= yii::t("app", "selectImage") ?>
                        </div>
                    </div>
                    <p>
                        <input type="button" value="<?= yii::t("app", "validecrop") ?>" id="image-getter"
                            data-toggle="modal" data-target="#vuePrincipaleAddInModal" class="btn btn-primary">
                    </p>
                    <a href="javascript:;" Class="btn btn-light me-3" id="retour" data-toggle="modal"
                        data-target="#vuePrincipaleAddInModal"></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        cropper(document.getElementById('image-cropper'), {
            area: [500, 400],
            crop: [302, 302],
            allowResize: false,
        })
        document.getElementById('image-getter').onclick = function () {
            document.getElementById('image-cropper-result').children[0].src = document.getElementById('image-cropper').crop
                .getCroppedImage().src;
            var image = document.getElementById('image-cropper-result').children[0].src;
            document.getElementById('photo').value = image;
            // var image =  document.getElementById('image-cropper').crop.getImage().src;;
            // console.log(image);
        }
    </script>