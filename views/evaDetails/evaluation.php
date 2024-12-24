

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
          <form class="md-float-material form-material" action="<?= yii::$app->request->baseurl . '/' . md5('evaluation_organiser') ?>"
  enctype="multipart/form-data" name="login-form" id="eval-form" method="post">

  
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

                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                          <div class="table-responsive">
                            <table class="table custom-table">
                              <thead class="table-light">

                                <caption>Liste des Elèves</caption>
                                <tr>


                                  <th>[] </th>
                                  <th>Matricule</th>
                                  <th>Elèves</th>
                                  <th>NOTE 1</th>
                                  <th>NOTE 2</th>
                                  <?php
                                  if ($infoEva['periode'] > 3) {
                                    echo '<th>NOTE 3</th>';
                                  }
                                  ?>

                                  <th>MOYENNE COURS</th>
                                  <th>Composition</th>
                                  <th>MOYENNE</th>

                                </tr>

                              </thead>
                              <tbody>
                                <?php
                                if (sizeof($listeElevee) > 0) {
                                  $j = 0;

                                  foreach ($listeElevee as $key => $value) {
                                    $note = Yii::$app->evaluationClass->selectnote($infoEva['codeEva'], $value['matricule']);
                                 
                                    if ($note) {
                                      $moyenne = '';
                                      $note1 = 0;
                                      $note2 = 0;
                                      $note3 = 0;
                                      if ($note) {
                                        $moyenne = yii::$app->simplelClass->moyenne($note['note1'], $note['note2'], $note['note3'], $infoEva['periode']);
                                        $note1 = $note['note1'];
                                        $note2 = $note['note2'];
                                        $note3 = $note['note3'];
                                        $moyenneGenerale = yii::$app->simplelClass->moyenneMoyennegenral($moyenne, $note['composition']);
                                      }


                                      if ($infoEva['periode'] > 3) {
                                        $content = '   
                                             <td>' . $note1 . '</td>
                                            <td>' . $note2 . '</td>
                                            <td>' . $note3 . '</td>';
                                      } else {
                                        $content = '   
                                            <td>' . $note1 . '</td>
                                          <td>' . $note2 . '</td>';
                                      }
                                      $mention = yii::$app->simplelClass->mention($moyenne);
                                    //   <a  href="javascript:;"   onclick="$(\'#not1\').val(\'' . $note1 . '\');$(\'#matricule\').val(\'' . $value['matricule'] . '\');$(\'#codeEva\').val(\'' . $infoEva['codeEva'] . '\');$(\'#codeEva\').val(\'' . $infoEva['codeEva'] . '\');$(\'#not2\').val(\'' . $note2 . '\');$(\'#note3\').val(\'' . $note3 . '\');$(\'#moy\').val(\'' . $moyenne . '\');$(\'#compo\').val(\'' .  $note['composition'] . '\')"   data-toggle="modal" data-target="#exampleModal" class="btn btn-dark btn-sm mb-1">
                                    //   <i class="far fa-edit"></i>
                                    // </a>
                                      $j++;
                                      echo '       
                                           <tr role="row" class="odd">
                                        <td class="sorting_1">
                                            ' . $j . '
                                        </td>
                                        <td>' . $value['matricule'] . '</td>
                                        <td>
                                          <h2 class="table-avatar">
                                            <a href="student-details.html" class="avatar avatar-sm me-2">
                                              <img class="avatar-img rounded-circle" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $value['photo'] . '" alt="ELEVES Image">
                                            </a>
                                            <a href="student-details.html">' . $value['nom'] . ' ' . $value['prenom'] . '</a>
                                          </h2>
                                        </td>
                                         ' . $content . '
                                        <td>' . $moyenne . '</td>
                                        <td>' . $note['composition'] . '</td>
                                        <td>' . $moyenneGenerale . '</td>
                                    
                                        </tr>';
                                    }
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
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">

  <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
  <input type="hidden" name="action" id="action" value="<?=md5('update')?>" />
  <input type="hidden" name="matricule" id="matricule" value="" />
  <input type="hidden" name="codeEva" id="codeEva" value="<?=$infoEva['codeEva']?>" />
  <div class="modal-dialog modal-md modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">Création d'un utilisateur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      
      <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group ">
                <label for="validationDefault01" class="">Note1 </label>
                <input type="text" class="form-control" min="0" id="not1" onchange="calcmoy2();" name="note1">
              </div>

            </div>
            <div class="col-md-12">
              <div class="form-group ">
                <label for="validationDefault01" class="">note2 </label>
                <input type="text" class="form-control" min="0" id="not2" onchange="calcmoy2();" name="note2">
              </div>

            </div>
           <?php
            if ($infoEva['periode'] > 3) {

              ?>
            <div class="col-md-12">
              <div class="form-group ">
                <label for="validationDefault01" class="">note3 </label>
                <input type="text" class="form-control" min="0" id="note3" onchange="calcmoy2();" name="note3">
              </div>
              </div>
              <?php } ?>
    
            <div class="col-md-12">
              <div class="form-group ">
                <label for="validationDefault01" class="">Moyenne</label>
                <input type="text" class="form-control" min="0" id="moy" name="moy" readonly required>
              </div>

            </div>

            <div class="col-md-12">
              <div class="form-group ">
                <label for="validationDefault01" class="">Composition</label>
                <input type="text" class="form-control" min="0" id="compo" name="compo"   >
              </div>

            </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
        <button type="submit" id="submit" class="btn btn-primary">Enregistrer</button>
      </div>
    </div>
  </div>

</div> -->
 

<!-- Modal end -->
<script>

  function calcmoy2() {

    note1 = parseInt($('#not1').val());
    notea2 = parseInt($('#not2').val());
    notea3 = parseInt($('#note3').val());
    if(notea3){
      notea = note1+notea3 + notea2;
      $('#moy').val(notea / 3);

    }else{
      notea = note1 + notea2;
      $('#moy').val(notea / 2);

    }
   


  }
  $(document).ready(function () {





    $('#image').change(function () {
      $("#frames").html('');
      for (var i = 0; i < $(this)[0].files.length; i++) {
        $("#frames").append('<img src="' + window.URL.createObjectURL(this.files[i]) + '" width="100px" height="100px"/>');
      }
    });

    $('#submit').click(function () {
      $('#form').submit();
    });
  });
</script>