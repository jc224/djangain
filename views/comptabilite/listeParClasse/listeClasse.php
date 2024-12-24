<div class="card">
    <div class="card-header">
        <h5>Liste des Classe</h5>
        <span><code>Total : </code> </span>
        <div class="card-header-right">
            <a href="<?= yii::$app->request->baseurl.'/'.md5('eleve_enrollement')?>" class="btn btn-primary">Ajouter un
                eleves</a>

            </button>

        </div>
    </div>
    <div class="card-block table-border-style">
        <div class="table-responsive">
            <table class="table">
                <thead>

                    <tr>
                        <th>#</th>
                        <th class="min-w-200px">CLASSE</th>
                        <th class="min-w-200px">Niveau</th>
                        <th class="min-w-2000px">ACTION</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                                                                if(isset($liste) && sizeof($liste)){
                                                                    $j=0;
                                                                    //  die(var_dump($liste));
                                                                    foreach ($liste as $key => $value) {
                                                                        $autBtn = '<a href="javascript:;" Class="btn btn-circle btn-primary"   data-bs-toggle="modal" data-bs-target="#kt_modal_add_user"   onclick="document.getElementById(\'action_key\').value=\''.md5(strtolower("modifierFonction")).'\';  document.getElementById(\'action_on_this\').value=\''.$value["code"].'\';">'.yii::t("app",'aCCEDER A LA LISTE').'</a>';

                                                                       
                                                                        $j++;
                                                                        echo '
                                                                     <tr>
                                                                        <td>'.$j.'</td>                                                                      
                                                                        <td >'.$value['nomCLasse'].'</td>
                                                                        <td>'.$value['niveau'].'</td>
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


<!-- Modal end -->
<?php//  require('script/param.php') ?>