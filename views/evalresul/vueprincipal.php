
<div class="content container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <h5 class="text-uppercase mb-0 mt-0 page-title">CLASSES</h5>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <ul class="breadcrumb float-right p-0 mb-0">
          <li class="breadcrumb-item">
            <a href="#">
              <i class="fas fa-home"></i> Acceuil </a>
          </li>
          <li class="breadcrumb-item">
            <a href="#">Classes</a>
          </li>
          <li class="breadcrumb-item">
            <span>Liste des Classes</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="page-content">
    <form class="md-float-material form-material" action="<?= Yii::$app->request->baseUrl.'/'.md5('param_classe')?>" name="login-form" id="anneescolaire-form" method="post">
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
    <input type="hidden" name="action" id="action" value=""/>
  <input type="hidden" name="code" id="code" value=""/>   


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
                        <div class="page-title">LISTE DES CLASSES    </div>
                      </div>
                     
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-responsive">
                        <table class="datatable table table-stripped dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 191.016px;">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 191.016px;">Classes</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" aria-sort="descending" style="width: 311.312px;">Niveaux</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 145.188px;">Actions</th>
                            
                                </thead>
                                <tbody>
                                        <?php
                                            if(isset($liste) && sizeof($liste)){
                                                $j=0;
                                                foreach ($liste as $key => $value) {
                                                    //  die(var_dump($value));
                                                    $autBtn = '<a href="'.yii::$app->request->baseUrl.'/'.md5('evaluation_resultat').'/'.$value["code"].'" Class="btn btn-circle btn-primary"    
                                                       " >  <i class="fa fa-eye" aria-hidden="true"></i>'.yii::t("app",'Acceder').'</a>';

                                                    
                                                    
                                                    $j++;
                                                    echo '
                                                    <tr>
                                                    <td>'.$j.'</td>
                                                    <td>'.$value['libelle'].'</td>
                                                    <td >'.$value['libClasse'].'</td>
                                                    <td class="text-end">'.$autBtn.'</td>
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
      </div>





</div>

