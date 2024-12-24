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

    <form class="needs-validation" novalidate="" enctype="multipart/form-data"

      action="<?= Yii::$app->request->baseUrl . '/' . md5('devoirs_ajouter') ?>" name="login-form"

      id="anneescolaire-form" method="post">

      <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

      <input type="hidden" name="action" id="action" value="" />

      <input type="hidden" name="code" id="code" value="" />

      <div class="row">

        <div class="col-sm-6 col-md-6 mt-2 ">

          <div class="page-title">LISTE DES DEVOIRS </div>



        </div>

        <div class="col-md-3 add-btn-col">

        <select type="text" class="form-control mt-3 " id="selectionclasse"  onchange="selesctionneruneclasse()" name="selectclasse" placeholder=""

                      aria-describedby="inputGroupPrepend3" required="">

                      <option value="" hidden>Selectionner une Classe</option>

                            <?php

                                if(sizeof($classe)>0){

                                        foreach ($classe as $key => $value) {

                                            echo '<option value="'.$value['code'].'">'.$value['libelle'].'</option>';

                                        }

                                }

                            ?>

                      </select>



        </div>

        

        <div class="col-sm-3 col-md-3 add-btn-col">

          <a href="#" class="btn btn-primary btn-rounded float-md-right mt-2"

            onclick="$('#etat').css('display','none'); $('#anneescolaire-form')[0].reset()" data-toggle="modal" data-target="#add_leavetype">

            <i class="fas fa-plus"></i> Ajouter un Devoirs </a>

        </div>

      </div>

      <div class="row">

        <div class="col-md-12">

          <div class="card">

            <div class="card-body">

              <div class="table-responsive">


                <table class="table custom-table table-responsive-sm datatable "

                  aria-describedby="DataTables_Table_0_info" id="DataTables_Table_0">

                  <thead class="thead-light">

                    <tr>

                      <th>#</th>

                      <th>Libelle</th>

                      <th>Classe</th>

                      <th>Matiere</th>

                      <th>date Ajout</th>

                      <th>date Debut</th>

                      <th>date FIn</th>

                      <th>Statut</th>

                      <th class="text-right">Action</th>

                    </tr>

                  </thead>

                    <tbody id="bdy">

                        <?php

                          if(sizeof($listedevoirs)){

                            $j=0;

                            foreach ($listedevoirs as $key => $value) {

                               $j++;

                              $class = Yii::$app->mainCLass->databycode('dj_classe',$value['codeclasse'],'code');

                              $matiere = Yii::$app->mainCLass->databycode('dj_matiere',$value['matiere'],'code');

                               //  die(var_dump($matiere));

                               $statut = ($value['statut'] == 1 ? 'Terminer' : 'En Cours');

                                $btn = ' <a href="javascript:;" onclick="$(\'#action\').val(\''.md5('telecharger').'\'),$(\'#code\').val(\''.$value['code'].'\');$(\'#anneescolaire-form\').submit()" class="btn btn-primary">Telecharger</a>';

                                $infoclasse = (sizeof($class) >0) ? $class['0']['libelle'] :'' ;

                                $matiere = (sizeof($matiere) >0) ? $matiere['0']['libelle'] :'' ;

                              

                                echo '

                                    <tr>

                                    <td>'.$j.'</td>

                                    <td>'.$value['libelle'].'</td>

                                    <td>'.$infoclasse.'</td>

                                    <td>'.$matiere.'</td>

                                    <td>'.$value['date'].'</td>

                                    <td>'.$value['datedebut'].'</td>

                                    <td>'.$value['datefin'].'</td>

                                    <td>'.$statut.'</td>

                                    <td>'.$btn.'</td>

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



      <div id="add_leavetype" class="modal" role="dialog">

        <div class="modal-dialog modal-lg">

          <div class="modal-content">

            <div class="modal-header">

              <h4 class="modal-title" id="standard-modalLabel">Ajouter Un Devoirs</h4>

            </div>

            <div class="modal-body">

              <div class="row">

                <div class="col-md-12">

                  <div class="form-group form-primary" id="etat" style="display:none;">

                    <label for="validationDefault02" class="required">

                      <?= yii::t("app", 'etat') ?>

                    </label>

                   





                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-6">

                  <div class="form-outline mb-4">

                    <label for="validationDefault02" class="required">Classe *</label>

                    <select type="text" class="form-control " id="classeSelect"  onchange="selectmat()" name="classeSelect" placeholder=""

                      aria-describedby="inputGroupPrepend3" required="">

                      <option value=""></option>

                            <?php

                                if(sizeof($classe)>0){

                                        foreach ($classe as $key => $value) {

                                            echo '<option value="'.$value['code'].'">'.$value['libelle'].'</option>';

                                        }

                                }

                            ?>

                      </select>





                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-outline mb-4">

                    <label for="validationDefault02" class="required">Matiere *</label>

                    <select type="text" class="form-control " id="matiere" name="matiere" placeholder=""

                      aria-describedby="inputGroupPrepend3" required="">

                      <option value=""></option>

                      </select> 





                  </div>

                </div>



                <div class="col-md-6">

                  <div class="form-outline mb-4">

                    <label for="validationDefault02" class="required">Sujet *</label>

                    <input type="input" class="form-control " id="sujet" name="sujet" placeholder=""

                      aria-describedby="inputGroupPrepend3" required="">





                  </div>

                </div>   

                <div class="col-md-6">

                  <div class="form-outline mb-4">

                    <label for="validationDefault02" class="required">Debut *</label>

                    <input type="date" class="form-control " id="ddebut" name="ddebut" placeholder=""

                      aria-describedby="inputGroupPrepend3" required="">





                  </div>

                </div>     

                <div class="col-md-6">

                  <div class="form-outline mb-4">

                    <label for="validationDefault02" class="required">Fin *</label>

                    <input type="date" class="form-control " id="dfin" name="dfin" placeholder=""

                      aria-describedby="inputGroupPrepend3" required="">





                  </div>

                </div>   

                <div class="col-md-6">

                  <div class="form-outline mb-4">

                    <label for="validationDefault02" class="required">Fichier Devoirs *</label>

                    <input type="file" class="form-control " id="fiche" name="fiche" placeholder=""

                      aria-describedby="inputGroupPrepend3" required="">





                  </div>

                </div>    

                <div class="col-md-12">

                  <div class="form-outline mb-4">

                    <label for="validationDefault02" class="required">Description *</label>

                    <textarea name="desc" id=""  class="form-control"></textarea>





                  </div>

                </div>      

                </div>

            </div>

            <div class="modal-footer">

              <a href="javascript:;" onclick="ajouter()" class="btn   btn-primary">Enregistrer</a>

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

            </div>

          </div>

        </div>

    </form>

  </div>

</div>







<script>





  function ajouter(){

    $('#anneescolaire-form').submit();



  }





  function selesctionneruneclasse(){

   

    code = $('#selectionclasse').val();

    // alert(code);

    var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("devoirs_ajax")) ?>';

    $.post(

      url,

      { code: code, action_key: '<?= md5('2') ?>', _csrf: '<?= Yii::$app->request->getCsrfToken() ?>' },

      function (response) {

        $('#bdy').html(response);

        //  console.log(response);



      }

    );

  }



   function selectmat(){

 

    code = $('#classeSelect').val();

    var url = '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(md5("devoirs_ajax")) ?>';

    $.post(

      url,

      { code: code, action_key: '<?= md5('1') ?>', _csrf: '<?= Yii::$app->request->getCsrfToken() ?>' },

      function (response) {

        $('#matiere').html(response);

         console.log(response);



      }

    );

  }





</script>