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
            <a href="#">Eleves</a>
          </li>
          <li class="breadcrumb-item">
            <span>Liste des eleves</span>
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
                    
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-responsive">
                            <table class="table custom-table">
                            <thead class="thead-light">
                                <tr>
                                <th>[] </th>
                                <th>Classe</th>
                                <th>Niveau</th>
                                <th>Nombre</th>
                                <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form class="md-float-material form-material" action="<?= Yii::$app->request->baseUrl . '/' . md5('evaluation_listeleve') ?>" name="login-form" id="anneescolaire-form" method="post">
                                        <?php
                                            if(isset($liste) && sizeof($liste)>0){
                                                $j=0;
                                                foreach ($liste as $key => $value) {
                                                    //  die(var_dump($liste));
                                                    $stat =yii::$app->eleveClass->actionsTATcLASSE($value['code']);
                                                    $j++;
                                                    $nb = 0; 
                                                    $btn ='<button class="btn  btn-outline-primary mr-2" id="btnexport" onclick="document.getElementById(\'action\').value=\''.md5(strtolower("excel")).'\';document.getElementById(\'code\').value=\''.$value['code'].'\';
                                                    "><img src="'.yii::$app->request->baseUrl.'/web/mainAssets/img/excel.png" alt=""><span class="ml-2">Excel</span></button>';
                                                    $pdf ='<button class="btn btn-outline-primary mr-2"><img src="'.yii::$app->request->baseUrl.'/web/mainAssets/img/pdf.png" alt=""><span class="ml-2">Excel</span></button>';

                                                    //  <a class="btn btn-primary text-white" href="'.yii::$app->request->baseUrl.'/'.md5('eleve_list').'/'.$value['code'].'">Fiche de note excel<a>';
                                                
                                                     //  $btn =' <a class="btn btn-primary text-white" href="'.yii::$app->request->baseUrl.'/'.md5('eleve_list').'/'.$value['code'].'">Fiche de note excel<a>';
                                                        if($stat){
                                                            $nb  =  $stat['nb'];
                                                        }
                                                    //  die(var_dump(($stat['nb'])));
                                                        
                                                    echo'       
                                                        <tr role="row" class="odd">
                                                    <td class="sorting_1">
                                                        '.$j.'
                                                    </td>
                                                    <td>'.$value['nomCLasse'].'</td>
                                                    
                                                    <td>'.$value['niveau'].'</td>
                                                    <td>'.$nb.'</td>
                                                    <td  class="text-right">'.$btn.'  '.$pdf.'</td>
                                                    
                                                    
                                                    </tr>';
                                                }
                                    
                                            }
                                        ?>  
                                          <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                            <input type="hidden" name="action" id="action" value="" />
                                            <input type="hidden" name="code" id="code" value="" />
                                </form>  
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
</div>

<?php require('script/script.php')?>




   