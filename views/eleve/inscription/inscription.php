<div class="card">
                                            <div class="card-header">
                                                <h5>Liste des Classes</h5>
                                                <span><code>Total : </code> </span>
                                                <div class="card-header-right">
                                               
                                                </div>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                          
                                                            <tr>
                                                                <th>#</th>
                                                                <th>PHOTO</th>
                                                                <th>MATRICULE</th>
                                                                <th>NOM</th>
                                                                <th>PRENOMS</th>
                                                                <th>GENRE</th>
                                                                <th>DATE NAISS</th>
                                                                <th>LIEU NAISS</th>
                                                                <th>PERE</th>
                                                                <th>MERE</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                           <?php 
                                                                if(isset($listAtente) && sizeof($listAtente)){
                                                                    $j=0;
                                                                    // die(var_dump($liste));
                                                                    foreach ($listAtente as $key => $value) {
                                                                        $autBtn = '<a href="javascript:;" Class="btn btn-circle btn-primary"  data-toggle="modal" data-target="#exampleModal"   onclick="  document.getElementById(\'matricule\').value=\''.$value["matricule"].'\';">'.yii::t("app",'paier un acte').'</a>';

                                                                        $genre = $value['genre'] ? 'Masculin' : 'Feminin';
                                                                      
                                                                        $j++;
                                                                        echo '
                                                                     <tr>
                                                                        <td>'.$j.'</td>
                                                                        <td>
                                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                        <a href="">
                                                                            <div class="symbol-label">
                                                                            <img src="'.yii::$app->request->baseurl.'/'.'mainAssets/uploadss/'.$value['photo'].'" alt="image"   style="weight:300px;"/>
                                                                            </div>
                                                                        </a>
                                                                       </div>
                                                                        </td>                                                                        
                                                                        <td>'.$value['matricule'].'</td>
                                                                        <td>'.$value['nom'].'</td>
                                                                        <td>'.$value['prenom'].'</td>
                                                                        <td>'.$genre.'</td>
                                                                        <td>'.$value['dateNaissance'].'</td>
                                                                        <td>'.$value['lieuNaissance'].'</td>
                                                                        <td>'.$value['nomP'].'</td>
                                                                        <td>'.$value['prenomMere'].'</td>
                                                                        <td>'. $autBtn.'</td>
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
                                                                                                           <!-- Modal start -->
                                        <div class="modal fade modal-icon" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Inscrire Un Elève</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="md-float-material form-material" action="<?= Yii::$app->request->baseUrl.'/'.md5('eleve_inscription')?>" name="login-form" id="login-form" method="post">
                                                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>

                                                        <div class="modal-body">
                                                            
                                                              
                                                                <div class="row">
                                                                    
                                                                    <div class="col-md-12">
                                                                        <div class="form-group form-primary">
                                                                            <select name="classe" class="form-control" id="">
                                                                                <option value=""></option>
                                                                                <?php
                                                                                  if(sizeof($classe)>0)
                                                                                    foreach ($classe as $key => $value) {
                                                                                        
                                                                                        echo '
                                                                                        <option value="'.$value['code'].'">'.$value['libelle'].'</option>
                                                                                        ';
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                            <span class="form-bar"></span>
                                                                        <label class="float-label fs-7">Classe</label>
                                                                        </div>
                                                                
                                                                    </div>
                                                                </div>
                                                            <div class="row">
                                                            
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-primary">
                                                                        <input class="form-control disable" type="text"  id="matricule"  name="matricule" value="">
                                                                        <span class="form-bar"></span>
                                                                       <label class="float-label fs-7">Matricule</label>
                                                                    </div>
                                                            
                                                                </div>
                                                            </div>

                                                        </div> 
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn  btnAnneeScolaire btn-primary">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                 
<!-- Modal end -->
                   <?php//  require('script/param.php') ?>