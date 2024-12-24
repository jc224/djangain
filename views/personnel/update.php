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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <form class="" enctype="multipart/form-data" method="post" novalidate="novalidate"
                                    action="<?= Yii::$app->request->baseUrl.'/'.md5("personnel_updatpers")?>">
                                    <input type="hidden" name="_csrf" vlue="<?= Yii::$app->request->getCsrfToken() ?>" />
                                      <input type="hidden" name="code" id="code" value="<?= $info['code']?>"/>

                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" name="nom" id="nom" value="<?= $info['nom']?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" value="<?= $info['email']?>" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Genre</label>
                                        <select class="form-control" name="genre" id="genre" aria-hidden="true">
                                            <option value="1" <?= $info['genre']==1 ?  'selected' :'' ?>>Masculin</option>
                                            <option value="2" <?= $info['genre']==2 ?  'selected' :'' ?>>Feminin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label> Date de Naissance</label>
                                        <input class="form-control"   id="dnais" name="dnais" type="date"   value="<?= $info['dateNais']?>"                                             >
                                    </div>
                                    <div class="form-group">
                                        <label> Adresse</label>
                                        <input class="form-control " type="text" id="lnai" value="<?= $info['adresse']?>" name="adresse">
                                    </div>
                                    <div class="form-group">
                                        <label> Date debut Service</label>
                                        <input class="form-control " id="Datedebutservice" value="<?= $info['Datedebutservice']?>" name="Datedebutservice" type="date"    >
                                    </div>
                                    <div class="form-group students-up-files">
                                        <label>Ajouter Une Photo</label>
                                       
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline  image-input-empty " data-kt-image-input="true">
                                            <!--begin::Preview existing avatar-->
                                            <div id="image-cropper-result"
                                                class="image-input-wrapper w-125px  h-125px;" style="">
                                                <img style="width:125px; height:125px;" src="<?= yii::$app->request->baseUrl . yii::$app->params['linkToUploadIndividusProfil'].$info['photo']  ?>">
                                            </div>
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="
                                                                                                        <?= yii::t("app", 'changephoto') ?>">
                                                <a href="javascript:;" Class="btn " data-toggle="modal"
                                                    data-target="#vuePrincipaleAddInModal">
                                                    <i class="bi bi-pencil-fill fs-7"></i>Modifier la photo 
                                                </a>
                                                <input type="text" hidden id="" name="avatare" value="<?= $info['photo']  ?>" />

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
                                    <label>Prénom</label>
                                    <input type="text" name="prenom" id="prenom" value="<?= $info['prenom']?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Numero de telephone </label>
                                    <input class="form-control" name="tel" id="tel" value="<?= $info['tel']?>"  type="text">
                                </div>

                                <div class="form-group">
                                    <label> Matricule</label>
                                    <input type="text" name="mat" id="mat"  value="<?= $info['matricule']?>"  class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Lieu de Naissance</label>
                                    <input type="text"  name="lieuNai" id="lieuNai" value="<?= $info['lieuNais']?>"  class="form-control">
                                </div>
                            
                                <div class="form-group">
                                    <label>Fonctions</label>
                                    <select class="form-control" name="fonction" id="fontion" aria-hidden="true">
                                        <option hidden>Selectionner une fonction..</option>
                                        <?php
                                            if(sizeof($fonction)>0){

                                                foreach ($fonction as $key => $value) {
                                                    $selected =  $info['fonction']== $value['code'] ?  'selected' :'' ;
                                                  echo '
                                                  <option value="'.$value['code'].'" '.$selected.'>'.$value['libelle'].'  </option>

                                                  ';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>A propos</label>
                                    <textarea class="form-control"  value="<?= $info['apropos']?>"   id="desc" name="desc" rows="4"><?= $info['apropos']?></textarea>
                                </div>

                            </div>
                        </div>



                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <form>
                                <div class="form-group text-center custom-mt-form-group">
                                    <button class="btn btn-primary mr-2" type="submit">Valider</button>
                                    <button class="btn btn-secondary" type="reset">Annuler</button>
                                </div>
                            </form>
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
        document.getElementById('image-getter').onclick = function () {
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

    $('#submit').click(function() {
        $('#form').submit();
    });
});
</script>

<script>
$(document).ready(function() {
    $('#image').change(function() {
        $("#frames").html('');
        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#frames").html('<img src="' + window.URL.createObjectURL(this.files[i]) +
                '" width="100px" height="100px"/>');
        }
    });

    $('#submit').click(function() {
        $('#form').submit();
    });
});
</script>