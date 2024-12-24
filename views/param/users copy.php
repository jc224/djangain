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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-sm-6">
                    <div class="page-title">TOTAL ELEVES PAR NIVEAU </div>
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
                                <th>Statut </th>
                                <th>Date Ajout </th>
                                <th>Action </th>
                            </tr>
                            
                            </thead>
                        <tbody>
                        <?php
                              if(sizeof($users)>0){
                                  $j=0;
                                  foreach ($users as $key => $value) {
                                      $autBtn = '<a href="javascript:;" Class="btn btn-circle btn-primary"   data-bs-toggle="modal" data-bs-target="#kt_modal_add_user"   onclick="document.getElementById(\'action_key\').value=\''.md5(strtolower("modifierFonction")).'\';  document.getElementById(\'action_on_this\').value=\''.$value["code"].'\'; document.getElementById(\'libFonction\').value=\''.$value["admin_name"].'\';">'.yii::t("app",'Modifier').'</a>';
                                      $j++;
                                      $satut = $value['admin_status'] == '1' ? 'Active' : 'Desactiver';
                                      echo '
                                          <tr class="" >
                                          <td scope="row">'.$j.'</td>
                                          <td>'.$value['admin_name'].'</td>
                                          <td>'.$value['admin_email'].'</td>
                                          <td>'.$value['admin_type'].'</td>
                                          <td >'.$satut.'</td>
                                          <td>'.$value['created_at'].'</td>
                                          <td >'.$autBtn.'</td>
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
  </form>
</div>
                                        
                                             
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-fullscreen" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalTitleId">Création d'un utilisateur</h5>
 
          </div>
          <div class="modal-body">
                <form class="needs-validation" novalidate="" id="form" method="post" enctype="multipart/form-data" action="<?= Yii::$app->request->baseUrl.'/'.md5('gestion_creatusers')?>" >
                  <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                    <div class="row">
                      <div class="col-md-6">
                         <div class="form-group ">
                           <label for="validationDefault01" class="">Nom *</label>
                           <input type="text" class="form-control" id="validationDefault01" name="nom" required="">
                         </div>

                       </div>
                       <div class="col-md-6">
                         <div class="form-group ">
                           <label for="validationDefault01" class="">Prénoms *</label>
                           <input type="text" class="form-control" id="validationDefault02"name="prenom" required="">
                         </div>

                       </div>
                       <div class="col-md-6">
                         <div class="form-group ">
                           <label for="validationDefault01" class="">Email *</label>
                           <input type="text" class="form-control" id="validationDefault02" name="email" required="">
                         </div>

                       </div>
                      
                       <div class="col-md-6">
                         <div class="form-group ">
                         <label for="validationDefault04" class="">Types D'utilisateurs </label>
                            <select class="form-select form-control" id="validationDefault04"  name="typeUsers" required="">
                              <option selected disabled value="">Choisie...</option>
                              <option value="" hidden></option>
                              <option value="1">Administrateurs</option>
                              <option value="2">Comptable</option>
                              <option value="3">Censeur</option>
                          
                            </select>
                         </div>
                        </div>
                       
                        <!-- <div class="col-md-6 mt-2">
                          <label for="validationDefaultUsername" class="">Identifient</label>
                          <div class="input-group">
                            <input type="username" class="form-control" id="validationDefaultUsername"  name = "identifient" aria-describedby="inputGroupPrepend2" required>
                          </div>
                        </div>

                        <div class="col-md-6 mt-2">
                          <label for="validationDefaultUsername" class="">Mots de pass</label>
                          <div class="input-group">
                            <input type="password" class="form-control" id="validationDefaultUsername"  name = "mdp" aria-describedby="inputGroupPrepend2" required>
                          </div>
                        </div> -->
                        <div class="col-md-6 mt-4 mb-3">
                        
                              <input type="file" id="image" class="form-control" name="image"  accept="image/*"/><br/>
                                    <div id="frames" style="broder:1px solid black;" ></div>
                        </div>
                  
                  
                </form>
          </div>
          <div class="modal-footer">
          <a href="javascript:;" onclick="ajouterusers()" class="btn   btn-primary">Enregistrer</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Reour</button>
                      </div>
      </div>
  </div>
</div>

                                              
                                    
<!-- Modal end -->
<script>
$(document).ready(function(){
    $('#image').change(function(){
        $("#frames").html('');
        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#frames").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" width="100px" height="100px"/>');
        }
    });

  
});
</script>

<?php require('script/param.php');?>
