
<div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <h5 class="text-uppercase mb-0 mt-0 page-title">Professeur</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <ul class="breadcrumb float-right p-0 mb-0">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Professeur</a></li>
                                <li class="breadcrumb-item"><span>tous les professeurs</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            
                <div class="content-page">
                <form class="md-float-material form-material" action="<?= Yii::$app->request->baseUrl.'/'.md5('personnel_proffeseurs')?>" name="form-liste" id="anneescolaire-form" method="post">

                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                <input type="hidden" name="action" id="action" value="<?= md5('filtrer') ?>" />


                 <div class="card">
                        <div class="card-header">
                          <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <div class="page-title">Liste des professeurs </div>
                                </div>
                                <div class="col-sm-6 text-sm-right">
                                    <div class=" mt-sm-0 mt-2">
                                    <!-- <button class="btn btn-outline-primary mr-2">
                                    <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/excel.png" alt="">
                                    <span class="ml-2">Excel</span>
                                </button> -->
                                    <a href="javascript:;"
                                    onclick=" $('#action').val('<?= md5('printlist') ?>');  $('#anneescolaire-form').submit();"
                                        class="btn btn-outline-danger mr-2">
                                        <img src="/wamy/web/mainAssets/img/pdf.png" alt="" height="18">
                                        <span class="ml-2">PDF</span>
                                    </a>


                                    </div>
                                </div>
                                </div>
                        </div> 
                            <div class="card-body">  
                                <div class="row filter-row">    
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group form-focus">

                                        <input type="text" name="search" id="search" placeholder="Recercher...."
                                            class="form-control " value="<?= (isset($post)) ? $post['search'] : '' ?>">
                                            <label class="focus-label">Rechercher </label>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group form-focus">
                                        <select name="catsearch" class="form-control">
                                            <option value='' ></option>
                                            <option value="1" <?= (isset($post) && $post['catsearch'] ==1 ) ? 'selected' : ''?>>Titulaire</option>
                                            <option value="2" <?= (isset($post) && $post['catsearch'] ==2 ) ? 'selected' : ''?>>Non Titulaire</option>
                                        </select>
                                        <label class="focus-label">Groupe de Professeur </label>

                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                    <button type="submit" class="btn btn-search btn-sm rounded btn-block mb-3"> Rehercher </button>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                    <a href="<?= yii::$app->request->baseurl.'/'.md5('personnel_addteachers')?>" class="btn btn-primary btn-sm float-right btn-rounded"><i class="fas fa-plus"></i> Ajouter un Professeur</a>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="table-responsive">
                                            <table class="table datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="min-width:50px;">[]</th>
                                                        <th style="min-width:70px;">Matricule</th>
                                                        <th style="min-width:50px;">Prénoms et Noms</th>
                                                        <th style="min-width:50px;">Genre</th>
                                                        <th style="min-width:80px;">Téléphone</th>
                                                        <th style="min-width:50px;">Email</th>
                                                        <th style="min-width:50px;">Adresse</th>
                                                        <th style="min-width:50px;">Catégorie</th>
                                                        <th class="text-right" style="width:15%;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    if(sizeof($liste)>0){
                                                        $j=0;
                                                        foreach ($liste as $key => $value) {
                                                            $j++;
                                                            $genre = $value['genre'] == 1 ? 'Masculin' : 'Feminin'; 
                                                            $groupe =$value['groupePers']==1 ? 'Titulaire' : 'Non Titulaire';
                                                        echo'    
                                                            <tr>
                                                            <td class="sorting_1">
                                                                '.$j.'
                                                            </td>
                                                            <td>'.$value['matricule'].'</td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                <a href="student-details.html" class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle" src="'.yii::$app->request->baseUrl.'/web/mainAssets/uploads/'.$value['photo'].'" alt="ELEVES Image">
                                                                </a>
                                                                <a href="student-details.html">'.$value['nom'].' '.$value['prenom'].'</a>
                                                                </h2>
                                                            </td>
                                                            <td >
                                                            '.$genre.'
                                                            </td>
                                                            <td >
                                                            '.$value['tel'].'
                                                            </td>
                                                            <td >
                                                            '.$value['email'].'
                                                            </td>
                                                            <td >
                                                            '.$value['adresse'].'
                                                            </td>
                                                            <td >
                                                            '.$groupe.'
                                                            </td>
                                                            <td class="text-right">
                                                            <a href="'.yii::$app->request->baseUrl.'/'.md5('personnel_updatprof').'/'.$value['codePers'].'" class="btn btn-primary btn-sm mb-1">
                                                                <i class="far fa-edit"></i>
                                                            </a>
                                                            
                                                            <a href="'.yii::$app->request->baseUrl.'/'.md5('personnel_profie').'/'.$value['codePers'].'"  class="btn btn-secondary btn-sm mb-1">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                    </a>
                                                            </td>
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
                </form>
                </div>
           
            </div>



            <script>
              
            </script>





   