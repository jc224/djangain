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

  <form class="needs-validation" novalidate="" id="form" method="post" enctype="multipart/form-data" action="<?= Yii::$app->request->baseUrl . '/' . md5('gestion_creatusers') ?>">



    <div class="page-content">





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

                          <div class="page-title">LISTE DES UTILIISATEURS</div>

                        </div>

                        <div class="col-sm-6 text-right">

                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">

                            Ajouter Un Utilisateurs

                          </button>

                        </div>

                      </div>

                    </div>

                    <div class="card-body">


                      <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                          <div class="table-responsive">

                            <table class="table custom-table">

                              <thead class="table-light">



                                <caption>Liste des Utilisateurs</caption>

                                <tr>

                                  <th>#</th>



                                  <th>Nom</th>

                                  <th>Email </th>

                                  <th>Type </th>

                                  <th>Date Ajout </th>

                                  <th>Action </th>

                                </tr>



                              </thead>

                              <tbody>

                                <?php

                                if (sizeof($users) > 0) {

                                  $j = 0;

                                  foreach ($users as $key => $value) {

                                    $autBtn = '<a href="javascript:;" Class="btn btn-circle btn-primary"      data-bs-toggle="modal" data-bs-target="#kt_modal_add_user" >' . yii::t("app", 'Modifie') . '</a>';

                                    $j++;

                                    $type = yii::$app->mainCLass->unidata('dj_typeusers', $value['admin_type']);

                                    $groupenme = (isset($type['groupe']) ? $type['groupe'] : "");

                                    $satut = $value['admin_status'] == '0' ? 'Active' : 'Desactiver';

                                    echo '

                                          <tr class="" >

                                          <td scope="row">' . $j . '</td>

                                          <td>' . $value['admin_name'] . '</td>

                                          <td>' . $value['admin_email'] . '</td>

                                          <td>' . $groupenme . '</td>

                                          <td>' . $value['created_at'] . '</td>

                                          <td >' . $autBtn . '</td>

                                  </tr>

                                      ';

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



          </div>





          <!-- Modal -->

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">

            <div class="modal-dialog modal-lg  modal-fullscreen" role="document">



              <div class="modal-content">

                <div class="modal-head bg-primary">

                  <h5 class="modal-title" id="modalTitleId">Création d'un utilisateur</h5>





                </div>

                <div class="modal-body">

                  <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

                  <div class="row">

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

                    <div class="col-md-12">

                      <div class="form-group form-primary">

                        <label class=" fs-7">Nom Complet * </label>



                        <input class="form-control" type="text" id="admin_name" name="admin_name" value="" required="">

                      </div>

                    </div>

                    <div class="col-md-12">

                      <div class="form-group form-primary">

                        <label class=" fs-7">Télephone * </label>



                        <input class="form-control" type="text" id="tel" name="tel" value="" required="">

                      </div>

                    </div>

                    <div class="col-md-12">

                      <div class="form-group form-primary">

                        <label class=" fs-7">Eamil * </label>



                        <input class="form-control" type="text" id="admin_email" name="admin_email" value="" required="">

                      </div>

                    </div>

                    <div class="col-md-12">

                      <div class="form-group form-primary">

                        <label class=" fs-7">Type D'utilisateurs * </label>

                        <select name="admin_type" id="" class="form-select form-control">

                          <option value="" hidden>Selectinner une option</option>

                          <?php

                          $droit =   yii::$app->mainCLass->getAlltableData('dj_typeusers');



                          if (sizeof($droit) > 0) {

                            foreach ($droit as $key => $value) {

                              echo '<option value="' . $value['code'] . '">' . $value['groupe'] . '</option>';

                            }

                          }



                          ?>

                        </select>

                      </div>

                    </div>



                  </div>





                </div>

                <div class="modal-footer">

                  <buttom Type="submit" class="btn  btn-primary" onclick="$('#form').submit()">Enregistre</buttom>

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Reour</button>

                </div>



              </div>



            </div>

          </div>



  </form>



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

          $("#frames").html('<img src="' + window.URL.createObjectURL(this.files[i]) + '" width="100px" height="100px"/>');

        }

      });



      $('#submit').click(function() {

        $('#form').submit();

      });

    });

  </script>



  <!-- Modal end -->

  <script>

    $(document).ready(function() {

      $('#image').change(function() {

        $("#frames").html('');

        for (var i = 0; i < $(this)[0].files.length; i++) {

          $("#frames").append('<img src="' + window.URL.createObjectURL(this.files[i]) + '" width="100px" height="100px"/>');

        }

      });





    });

  </script>