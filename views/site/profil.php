<div class="content container-fluid">

    <div class="page-header mb-10 ">

        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                <h5 class="text-uppercase mb-0 mt-0 page-title">mon profil</h5>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                <ul class="breadcrumb float-right p-0 mb-0">

                    <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Home</a></li>

                    <li class="breadcrumb-item"><a href="#">Pages</a></li>

                    <li class="breadcrumb-item"><span> Profile</span></li>

                </ul>

            </div>

        </div>

    </div>

    <div class="card-box mb-10 m-b-0 shadow" style="height: 200px;">

        <div class="row">

            <div class="col-md-12">

                <div class="profile-view">

                    <div class="profile-img-wrap">

                        <div class="profile-img">

                            <a href="">

                                <img class="avatar"

                                    src="<?= yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $info['admin_image'] ?>"

                                    alt=""></a>

                        </div>

                    </div>

                    <div class="profile-basic">

                        <div class="row">

                            <div class="col-md-5">

                                <div class="profile-info-left">

                                    <h4 class="user-name m-t-0">

                                        Nom :

                                        <?= $info['admin_name'] ?>

                                    </h4>

                                    <h4 class="user-name m-t-0">

                                        Email :

                                        <?= $info['admin_email'] ?>

                                    </h4>

                                    <h4 class="user-name m-t-0">

                                        Tel :

                                        <?= $info['tel'] ?>

                                    </h4>



                                </div>

                            </div>



                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <form class="" enctype="multipart/form-data" method="post" novalidate="" id="editform"

        action="<?= Yii::$app->request->baseUrl . '/' . md5("site_profil") ?>">

        <input type="hidden" name="_csrf" vlue="<?= Yii::$app->request->getCsrfToken() ?>" />

        <input type="hidden" name="action" id="action" value="" />

        <input type="hidden" name="photoremo" id="photoremo" value="<?= $info['admin_image'] ?>" />

        <input type="hidden" name="code" id="code" value="<?= $info['code'] ?>" />

        <input type="hidden" name="identifiant" id="identifiant" value="<?= $info['identifiant'] ?>" />



        <div class="card  mt-5 mb-3 shadow">

            <div class="card-header">INFORMATIONS SUPLEMETAIRES</div>

            <div class="card-body fs-1">
                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">

                    <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab1"

                            data-toggle="tab">INFORMATION PERSONNEL</a>

                    </li>

                    <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2"

                            data-toggle="tab">MODIFIER LE MOTS DE PASSE</a></li>



                </ul>

                <div class="tab-content">

                    <div class="tab-pane active show" id="solid-rounded-justified-tab1">

                        <div class="col-12 col-sm-12">

                            <label class="" for="form1Example1" style=" font-style: oblique;">Photo :</label>



                            <!-- <input type="file" id="form1Example1" class="form-control" name="logo" /> -->





                            <!--begin::Image input-->

                            <div class="image-input image-input-outline  image-input-empty " data-kt-image-input="true">

                                <!--begin::Preview existing avatar-->

                                <div id="image-cropper-result"

                                    class="image-input-wrapper w-125px  h-125px;background-image: url('<?= yii::$app->basePath . yii::$app->params['linkToUploadIndividusProfil'] ?>')">

                                    <img style="width:125px; height:125px;" src="">

                                </div>

                                <!--end::Preview existing avatar-->

                                <!--begin::Label-->

                                <label

                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"

                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="

                                                                <?= yii::t("app", 'changephoto') ?>">

                                    <a href="javascript:;" Class="btn " data-toggle="modal"

                                        data-target="#vuePrincipaleAddInModal">

                                        <i class="bi bi-pencil-fill fs-7"></i>Ajouter une photo

                                    </a>

                                    <!--begin::Inputs-->

                                    <input type="text" hidden id="photo" value="" name="photo"

                                        accept=".png, .jpg, .jpeg" />

                                    <br>

                                    <!--end::Inputs-->

                                </label>

                                <!--end::Label-->

                                <!--begin::Cancel-->



                            </div>

                            <!--end::Image input-->

                        </div>





                        <div class="row mb-3">

                            <div class="col-md-1"> <label for="" class="control-label"></label> Nom :</div>

                            <div class="col-md-10"><input type="text" class="form-control" name="Nom"

                                    value=" <?= $info['admin_name'] ?>" id="Nom"></div>

                        </div>



                        <div class="row mb-3">

                            <div class="col-md-1"> <label for="" class="control-label"></label> Tel :</div>

                            <div class="col-md-10"><input type="text" class="form-control" name="Tel"

                                    value=" <?= $info['tel'] ?>" id="Tel"></div>

                        </div>

                        <div class="row mb-3">

                            <div class="col-md-1"> <label for="" class="control-label"></label> Email :</div>

                            <div class="col-md-10"><input type="text" class="form-control" name="Email" id="Email"

                                    value="<?= $info['admin_email'] ?>"></div>

                        </div>

                        <div class="row mb-3">

                            <div class="col-12">

                                <div class="student-submit align-items-end">

                                    <button type="submit" class="btn btn-primary">

                                        <i class="fa fa-save" aria-hidden="true"></i> Enregistrer </button>

                                </div>

                            </div>

                        </div>

                    </div>





                    <div class="tab-pane" id="solid-rounded-justified-tab2">



                        <div class="row mb-3">

                            <div class="col-md-5"> <label for="" class="control-label"></label>  Ancien Mots De passe :</div>

                            <div class="col-md-7"><input type="password" class="form-control" name="currentpassword"

                                    value="" id="Nom"></div>

                        </div>



                        <div class="row mb-3">

                            <div class="col-md-5"> <label for="" class="control-label"></label> Nouveau Mots de Passe :</div>

                            <div class="col-md-7"><input type="password" class="form-control" name="newpassword"

                                    value="" id="Tel"></div>

                        </div>

                        <div class="row mb-3">

                            <div class="col-md-5"> <label for="" class="control-label"></label> Confirmer le mots de passe :</div>

                            <div class="col-md-7"><input type="password" class="form-control" name="confirmpassword"

                                    value=" " id="Tel"></div>

                        </div>

                        <div class="row mb-3">

                            <div class="col-12">

                                <div class="student-submit align-items-end">

                                    <a  onclick="$('#action').val('editpassword');$('#editform').submit()" class="btn btn-primary">

                                        <i class="fa fa-save" aria-hidden="true"></i> Enregistrer </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

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

    $(document).ready(function () {

        $('#image').change(function () {

            $("#frames").html('');

            for (var i = 0; i < $(this)[0].files.length; i++) {

                $("#frames").html('<img src="' + window.URL.createObjectURL(this.files[i]) + '" width="100px" height="100px"/>');

            }

        });



        $('#submit').click(function () {

            $('#form').submit();

        });

    });

</script>