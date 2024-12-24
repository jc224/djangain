<?php
    // die(var_dump($infoeleve));
?>

<div class="content container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <h5 class="text-uppercase mb-0 mt-0 page-title">ELEVES</h5>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <ul class="breadcrumb float-right p-0 mb-0">
          <li class="breadcrumb-item">
            <a href="#">
              <i class="fas fa-home"></i> Acceuil </a>
          </li>
          <li class="breadcrumb-item">
            <a href="#">Elèves</a>
          </li>
          <li class="breadcrumb-item">
            <span>Modifier un élève</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
<div class="page-content">
    <form class="" enctype="multipart/form-data" method="post" novalidate="novalidate" action="
			
			<?= Yii::$app->request->baseUrl . '/' . md5("eleve_enrollement") ?>">
        <input type="hidden" name="_csrf" value="	<?= Yii::$app->request->getCsrfToken() ?>" />
        <input type="hidden" name="action_key" id="action_key" value="<?="editeleve"?>" />
        <input type="hidden" name="codeEleve" id="codeEleve" value="<?=$infoeleve['codeEleve']?>" />
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="page-title ml-3">Modification élève</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body w-100 p-3">
                                <div class="row">
                                <div class="col-12 col-sm-12">
                                        
                                        <label class="" for="form1Example1" style=" font-style: oblique;">Photo :</label>

                                        <!-- <input type="file" id="form1Example1" class="form-control" name="logo" /> -->


                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline  image-input-empty " data-kt-image-input="true">
                                            <!--begin::Preview existing avatar-->
                                            <div id="image-cropper-result"
                                                class="image-input-wrapper w-125px  h-125px;" style="">
                                                <img style="width:125px; height:125px;" src="<?= yii::$app->request->baseUrl . yii::$app->params['linkToUploadIndividusProfil'].$infoeleve['photo']  ?>">
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
                                                <input type="text" hidden id="" name="avatare" value="<?= $infoeleve['photo']  ?>" />

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
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Prénoms <span class="login-danger">*</span>
                                            </label>
                                            <input type="text" name="Prenom" class="form-control" required=""
                                                value="<?= $infoeleve['prenom'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Nom <span class="login-danger">*</span>
                                            </label>
                                            <input type="text" name="nom" class="form-control"
                                                value="<?= $infoeleve['nom'] ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Genre <span class="login-danger">*</span>
                                            </label>
                                            <select class="form-control" name="genre" aria-hidden="true">
                                                <option hidden value="0">Selection un genre</option>
                                                <option value="1"
                                                    <?= ($infoeleve['genre'] == "1") ? "selected" : " " ?>>Masculin
                                                </option>
                                                <option value="2"
                                                    <?= ($infoeleve['genre'] == "2") ? "selected" : " " ?>>Féminin
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Date De Naissance <span class="login-danger">*</span>
                                            </label>
                                            <input value="<?= $infoeleve['dateNaissance'] ?>"
                                                class="form-control " type="date" name="dateNaissance"
                                               >
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Lieu De Naissance </label>
                                            <input class="form-control" type="text" name="lieuNai" placeholder=""
                                                value="<?= $infoeleve['lieuNaissance'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Matricule</label>
                                            <input value="<?= $infoeleve['matricule'] ?>" class="form-control"
                                                type="text" name="mat" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Adresse</label>
                                            <input value="<?= $infoeleve['adresse'] ?>" class="form-control" type="text"
                                                name="adresse" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Classe <span class="login-danger">*</span>
                                            </label>
                                            <select class="form-control" name="Classe" aria-hidden="true">
                                                <option hidden>Sélèctionner une classe </option> <?php

                                                            if (isset($liste)) {
                                                                foreach ($liste as $key => $value) {
                                                                    if($value['code'] == $infoeleve['codeClasse']){
                                                                        $selected="selected";
                                                                      
                                                                    }else{
                                                                        $selected="";
                                                                    }
                                                                    
                                                                    echo ' 
                                                                    <option value="' . $value['code'] . '"  '.$selected.'>' . $value['libelle'] . ' </option>';
                                                                    }
                                                            }

                                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Documents Fournis <span class="login-danger">*</span>
                                            </label>
                                            <textarea name="document"
                                                class="form-control" id="" cols="30" rows=""><?= $infoeleve['document']?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                        <label>Type de Paiement <span class="login-danger">*</span>
                                        </label>
                                        <select class="form-control form-select" name="typepaiement" aria-hidden="true">
                                            <option hidden value="">Sélèctionner un type</option>
                                            <option value="0"      <?= ($infoeleve['typepaiement'] == "0") ? "selected" : " " ?>>Total</option>
                                            <option value="1"  <?= ($infoeleve['typepaiement'] == "1") ? "selected" : " " ?>>Moitier</option>
                                            <option value="2"  <?= ($infoeleve['typepaiement'] == "2") ? "selected" : " " ?>>Gratuit</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 m">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="page-title ml-3">Filiation</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body w-100 p-3">
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group local-forms">
                                                <label>Prénoms Père </label>
                                                <input value="<?=$infoeleve['prenomMere']?>" type="text" name="nomP"
                                                    class="form-control" required="">
                                            </div>
                                        </div>
                                        <!-- <div class="col-12 col-sm-6 ">
                                            <div class="form-group local-forms">
                                                <label class="">Prenom Pére</label>
                                                </label>
                                                <input type="text" name="PrenomP"  value="" class="form-control" required="">
                                            </div>
                                        </div> -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label class="">Nom Mère</label>
                                                <input value="<?= $infoeleve['nomMere']?>" type="text" name="nomM"
                                                    class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label class="">Prénoms Mère</label>
                                                <input value="<?= $infoeleve['prenomMere']?>" type="text" name="PrenomM"
                                                    class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 m">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="page-title ml-3">Tuteur</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body w-100 p-3">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="">Nom Tuteur </label>
                                                <input value="<?= $infoeleve['nomTuteur']?>" type="text"
                                                    name="nomtuteur" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="">Prénoms Tuteur </label>
                                                <input value="<?= $infoeleve['prenomTuteur']?>" type="text"
                                                    name="prenomtuter" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="">Téléphone Tuteur </label>
                                                <input value="<?= $infoeleve['telTuteur']?>" type="text"
                                                    name="telTuteur" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="card-body w-100 p-3">
                        <div class="row">
                          <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                              <label class="">Groupe Sanguin </label>
                              <select name="gsanguin"  class="form-control form-select" id="">
                              <option value=""></option>
                              <?php $gs =yii::$app->mainCLass-> gsanguuin();
                                foreach ($gs as $key => $value) {
                                
                                  echo '<option value="'.$key.'" '.($key == $infoeleve['groupeSanguin'] ? 'selected' : '').'>'.$value.'</option>';
                                }
                              ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                              <label class="">Alergie </label>
                              <textarea name="alergie" id="" class="form-control" ><?= $infoeleve['alergies']?> </textarea>  
                            
                            </div>
                          </div>
                          <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                              <label class="">Maladie</label>
                                <textarea name="maladie" id="" class="form-control" ><?= $infoeleve['maladies']?> </textarea>                        
                                  </div>
                          </div>
                          <div class="col-12">
                            <div class="student-submit">
                              <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save" aria-hidden="true"></i> Enregistrer </button>
                            </div>
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