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
            <span>Liste des élèves</span>
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
                    <table class="table custom-table datatable  dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                                 
                    <thead class="thead-light">
                           <tr role="row">
                             <th>[]</th>
                              <th>Classe</th>
                              <th>Niveau</th>
                              <th>Nombre</th>
                              <th class="text-right">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            if(isset($liste) && sizeof($liste)>0){
                                $j=0;
                                foreach ($liste as $key => $value) {
                                    //  die(var_dump($liste));
                                    $niveaus = Yii::$app->mainCLass->databycode('dj_niveau',$value['codeNiveau'],'code');
                                    $niveau = (sizeof($niveaus) >0) ? $niveaus['0']['libelle'] :'' ;

                                     $stat =yii::$app->eleveClass->actionsTATcLASSE($value['code']);
                                    $j++;
                                    $nb = 0;
                                     $btn =' <a class="btn btn-primary text-white" href="'.yii::$app->request->baseUrl.'/'.md5('eleve_listp').'/'.$value['code'].'">Acceder A la liste</a>';
                                 
                                        if($stat){
                                            $nb  =  $stat['nb'];
                                        }
                                    //  die(var_dump(($stat['nb'])));
                                    
                                   echo'       
                                      <tr role="row" class="odd">
                                   <td class="sorting_1">
                                       '.$j.'
                                   </td>
                                   <td>'.$value['libelle'].'</td>
                                   
                                   <td>'.$niveau.'</td>
                                   <td>'.$nb.'</td>
                                   <td  class="text-right">'.$btn.'</td>
                                   
                                  
                                 </tr>';
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






   