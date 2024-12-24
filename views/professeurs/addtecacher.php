<div class="content container-fluid">

    <div class="page-header">

        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                <h5 class="text-uppercase mb-0 mt-0 page-title">ajout professeur</h5>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                <ul class="breadcrumb float-right p-0 mb-0">

                    <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Home</a></li>

                    <li class="breadcrumb-item"><a href="index.html">professeur</a></li>

                    <li class="breadcrumb-item"><span> ajout professeur</span></li>

                </ul>

            </div>

        </div>

    </div>

    <div class="page-content">

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="card">

                    <div class="card-body">



                        <div class="table-responsive">


                            <form class="" enctype="multipart/form-data" method="post" novalidate="novalidate"

                                action="<?= Yii::$app->request->baseUrl . '/' . md5("personnel_addteachers") ?>" id="formsubmit"> 

                                <input type="hidden" name="_csrf" vlue="<?= Yii::$app->request->getCsrfToken() ?>" />

                                <input type="hidden" name="action" id="action" value="" />


                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                                        <form class="" enctype="multipart/form-data" method="post" novalidate="novalidate"

                                            action="<?= Yii::$app->request->baseUrl . '/' . md5("personnel_addteachers") ?>">

                                            <input type="hidden" name="_csrf" vlue="<?= Yii::$app->request->getCsrfToken() ?>" />

                                            <input type="hidden" name="action" id="action" value="" />



                                            <div class="form-group">

                                                <label>Nom</label>

                                                <input type="text" name="nom" id="nom" class="form-control">

                                            </div>

                                            <div class="form-group">

                                                <label>Email</label>

                                                <input type="text" name="email" id="email" class="form-control">

                                            </div>



                                            <div class="form-group">

                                                <label>Genre</label>

                                                <select class="form-control" name="genre" id="genre" aria-hidden="true">

                                                    <option value="1">Masculin</option>

                                                    <option value="2">Féminin</option>

                                                </select>

                                            </div>

                                            <div class="form-group">

                                                <label> Date de Naissance</label>

                                                <input class="form-control" id="dnais" name="dnais" type="date">

                                            </div>

                                            <div class="form-group">

                                                <label> Adresse</label>

                                                <input class="form-control " type="text" id="lnai" name="adresse">

                                            </div>

                                            <div class="form-group">

                                                <label> Date début Service</label>

                                                <input class="form-control " id="Datedebutservice" name="Datedebutservice" type="date"

                                                    data-toggle="datetimepicker">

                                            </div>

                                            <div class="form-group students-up-files">



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

                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"

                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"

                                                        title="

                                                                <?= yii::t("app", 'changephoto') ?>">

                                                        <a href="javascript:;" Class="btn " data-toggle="modal"

                                                            data-target="#vuePrincipaleAddInModal">

                                                            <i class="bi bi-pencil-fill fs-7"></i>Ajouter une photo

                                                        </a>

                                                        <!--begin::Inputs-->

                                                        <input type="text" hidden id="photo" value="" name="photo" accept=".png, .jpg, .jpeg" />

                                                        <br>

                                                        <!--end::Inputs-->

                                                    </label>

                                                    <!--end::Label-->

                                                    <!--begin::Cancel-->



                                                </div>

                                                <!--end::Image input-->



                                            </div>



                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">



                                        <div class="form-group">

                                            <label>Prénoms</label>

                                            <input type="text" name="prenom" id="prenom" class="form-control">

                                        </div>

                                        <div class="form-group">

                                            <label>Numéro de téléphone </label>

                                            <input class="form-control" name="tel" id="tel" type="text">

                                        </div>



                                        <div class="form-group">

                                            <label> Matricule</label>

                                            <input type="text" name="mat" id="mat" class="form-control">

                                        </div>



                                        <div class="form-group">

                                            <label>Lieu de Naissance</label>

                                            <input type="text" name="lieuNai" id="lieuNai" class="form-control">

                                        </div>



                                        <div class="form-group">

                                            <label>Catégorie D'enseignants</label>

                                            <select class="form-control" name="groupe" id="groupe" aria-hidden="true">

                                                <option hidden>Séléctionner une Catégorie...</option>

                                                <option value="1">Titulaire</option>

                                                <option value="2">Non Titulaire</option>

                                            </select>

                                        </div>

                                        <div class="form-group">

                                            <label>A propos</label>

                                            <textarea class="form-control" id="desc" name="desc" rows="4"></textarea>

                                        </div>



                                    </div>

                                </div>
                            </form>
                            <div class="row">


                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">


                                    <div class="form-group text-center custom-mt-form-group">

                                        <button class="btn btn-primary mr-2" id="btnsubmit">Valider</button>

                                        <button class="btn btn-secondary" type="reset">Annuler</button>

                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

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

    document.getElementById('image-getter').onclick = function() {

        document.getElementById('image-cropper-result').children[0].src = document.getElementById('image-cropper').crop

            .getCroppedImage().src;

        var image = document.getElementById('image-cropper-result').children[0].src;

        document.getElementById('photo').value = image;

        // var image =  document.getElementById('image-cropper').crop.getImage().src;;

        // console.log(image);

    }

    $(document).ready(function() {

        $('#image').change(function() {

            $("#frames").html('');

            for (var i = 0; i < $(this)[0].files.length; i++) {

                $("#frames").html('<img src="' + window.URL.createObjectURL(this.files[i]) +

                    '" width="100px" height="100px"/>');

            }

        });



        $('#btnsubmit').click(function() {
            $('#btnsubmit').prop("disabled", true);
            let requiredFields = ['#prenom','#Datedebutservice','#lnai','#dnais','#genre','#email','#nom','#tel'];
            if (checkEmptyFields(requiredFields)) {
                $('#btnsubmit').prop("disabled", false);
                return false;
            }
            $('#formsubmit').submit();

        });

    });
</script>