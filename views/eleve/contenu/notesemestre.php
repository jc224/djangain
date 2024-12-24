<thead class="text-bolder"  style="font-size:12px;">
    <tr>
        <td rowspan='2' class="justify-content-center text-center pt-4" >MATIERES</td>
        <td colspan="6" class="text-center">1er Semestre</td>
        <td colspan="6" class="text-center">2 eme Semestre</td>
        <td rowspan='2' class="justify-content-center text-center pt-4">Moyenne</td>
    </tr>
    <tr>

        <td>Eval 1</td>
        <td>Eval 2</td>
        <td>Eval 3</td>
        <td>moyenne Cours</td>
        <td>compo</td>
        <td>moyenne</td>
        <td>Eval 1</td>
        <td>Eval 2</td>
        <td>Eval 3</td>
        <td>compo Cours</td>
        <td>moyenne</td>
        <td>Moyenne General</td>
    </tr>
</thead>
<tbody  class="text-bolder"  style="font-size:12px;">
<?php
           if(sizeof($matiere)>0){
              //  die(var_dump($matiere))
              $rang = yii::$app->evaluationClass->rang($noteAllElve,$info['codeEleve']);

              $maximun =0;$minimun=0;$cours1=0;$comp1=0;$moyenneGen=0;$cours2=0;$comp2=0;$moyenneGen2=0;$mgeneral=0;
              $totalsemestre1= 0; $totalsemestre2= 0;
              //moy/20
              $moyenne1=0;
              $j=0;  $moyenneT1=0;  $moyenneT2=0;
              $i=0; $k=0;
              $dataSem1=null;$dataMoy=0;
              $dataSem2=null;
              foreach ($matiere as $key => $value) {
                  # code...
                  // $data=null;
             
                  echo'  
                 <tr class="text-dark">
                  <td>'.$value['libelle'].'</td>';
                  $coef = yii::$app->simplelClass->maxmincoef($value['coef'],$infoclasse['typeCompo']);
                 $maximun =$maximun+$coef['0'];
                 $minimun =$minimun+$coef['1']; 
        
                    $moy = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'],$value['codeMatiere'],'4',$anneeActive);
                    // die(var_dump($moy));
                    if($moy==false){
                      $dataSem1[$i] =['cours'=>  0 ,'coef'=>$value['coef']  ,'compo'=>0,'moy' => 0];
                       $i++;
                      echo'
                       <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
            
                        ';
      
                    }else{
                    $cours=0;
                    if($infoclasse['typeCompo'] ==1){
                      $cours =yii::$app->simplelClass->moyenne($moy['note1'],$moy['note2'],$moy['note3'],'1');
                      $cours1 =$cours1+$cours;
                    }else if($infoclasse['typeCompo']==2){
                      
                       $cours =yii::$app->simplelClass->moyenne($moy['note1'],$moy['note2'],$moy['note3'],'4');
                      $cours1 =$cours1+$cours;
                    }
                  
                    $comp1 = $comp1 +  $moy['composition'];
                   // die($cours);
                   echo 
                   ' <td>'.$moy['note1'].'</td>
                    <td>'.$moy['note2'].'</td>
                    <td>'.$moy['note3'].'</td>

                     <td>'.$cours.'</td>
                  <td>'.$moy['composition'].'</td>';
                  $dataSem1[$i] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy['composition'] ,'moy' => round(($cours+2*$moy['composition'])/3,2)];
                  $i++;
                  $moyenne1 = yii::$app->simplelClass->moyenneMoyennegenral(  $cours , $moy['composition']);
                  $moyenneGen =$moyenneGen+$moyenne1;
                  $totalsemestre1+=$moyenne1;
           
                  echo '
                     <td> '.$moyenne1.'</td>'; 
      
                  }
             
                 
      
                  $moyenne2 = 0;
                  $moy2 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'],$value['codeMatiere'],'5',$anneeActive);
          
                  if($moy2==false){
                    $dataSem2[$j] =['cours'=>  0 ,'coef'=>$value['coef'] ,'compo'=>0,'moy' => 0];
                    $j++;
                    echo'
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>';
                  }else{
                    // $dataSem2[$i] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy['composition'] ,'moy' => round(($cours+2*$moy['composition'])/3,2)];
                  
                    $cours=0;
                    if($infoclasse['typeCompo'] ==1){
                      $cours =yii::$app->simplelClass->moyenne($moy2['note1'],$moy2['note2'],$moy2['note3'],'1');
      
                    }else if($infoclasse['typeCompo']==2){
                      
                      $cours =yii::$app->simplelClass->moyenne($moy2['note1'],$moy2['note2'],$moy2['note3'],'4');
                    }
                    // die($cours);
                    $cours2 =$cours2+$cours;
                    $comp2 =$moy2['composition']+$comp2;
                    echo ' 
                     <td>'.$moy2['note1'].'</td>
                    <td>'.$moy2['note2'].'</td>
                    <td>'.$moy2['note3'].'</td>

                    <td>'.$cours.'</td>
                    <td>'.$moy2['composition'].'</td>';
                    $dataSem2[$j] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy2['composition'] ,'moy' => round(($cours+2*$moy2['composition'])/3,2)];
                    $moyenne2 = yii::$app->simplelClass->moyenneMoyennegenral(  $cours , $moy2['composition']);
                    $moyenneGen2+=$moyenne2 ;
                    $totalsemestre2+=$moyenne2;
                    $j++;
                    echo '
                      <td>'.$moyenne2.'</td>';
                       
      
                  }                                                                                                                                                                                                                                                                                                                                                                                        
                 
                    $mgeneralgeneral= ($moyenne1+$moyenne2)/2 ;
               
                  $mgeneral +=$mgeneralgeneral;
                // $mgeneralgeneral=  yii::$app->simplelClass->moySemestre($data);
                $dataMoy +=$mgeneralgeneral;
               echo 
               '   <td>'.$mgeneralgeneral.'</td>
               
                  </tr>';
                }
      
            
              }
              
              // die(var_dump($dataSem2));
                  $moyenneT1=  yii::$app->simplelClass->moySemestre($dataSem1,'2');
                  $moyenneT2=  yii::$app->simplelClass->moySemestre($dataSem2,'2');
      
              ?>

            <?php 
             $moyenneT2=  yii::$app->simplelClass->moySemestre($dataSem2,'2');
            //moyennefinal
             $moyfinal = ($moyenneT1['moyenneGenerale'] + $moyenneT2['moyenneGenerale'] )/2;
              $mentionS1 =yii::$app->simplelClass->mentionSecondaire($moyenneT1['moyenneGenerale']);  
              $mentionS2 =yii::$app->simplelClass->mentionSecondaire( $moyenneT2['moyenneGenerale']);  
              $mentionfinal =yii::$app->simplelClass->mentionSecondaire( $moyfinal);  
             
            
            
            ?>
              <tr class="text-dark">
                <td  colspan="4">Total</td>
             
                <td><?=   $cours1 ?></td>
                <td><?= $comp1?></td>
                <td><?= $totalsemestre1?></td>
                <td  colspan="3"></td>
                <td ><?= $cours2?></td>
                <td><?= $comp2?></td>
                <td><?= $totalsemestre2?></td>
                <td><?= $mgeneral?></td>
            </tr>
            <!-- moyenne sur 20 -->
            <tr class="text-dark">
                <td class="text-start"  colspan="4">
                    Moyenne/20</td>
                <td><?=$moyenneT1['MoyenneCours'] ?></td>
                <td><?=$moyenneT1['moyennecompo'] ?></td>
                <td><?=$moyenneT1['moyenneGenerale'] ?></td>
                <td  colspan="3"></td>
                <td><?=$moyenneT2['MoyenneCours'] ?></td>
                <td><?=$moyenneT2['moyennecompo'] ?></td>
                <td><?=$moyenneT2['moyenneGenerale'] ?></td>
                <td><?= $moyfinal?></td>
            </tr>
            <!-- mention  -->
            <tr class="text-dark">
                <td >Mention</td>
                <td style="background-color:#c6d9f1;" colspan="5"></td>
                <td><?= $mentionS1?></td>
                <td style="background-color:#c6d9f1;" colspan="5"></td>

                <td><?= $mentionS2?></td>
                <td><?=$mentionfinal?></td>
            </tr>
            <!-- Rang  -->
            <tr class="text-dark">
                <td >Rang</td>
                <td style="background-color:#c6d9f1;" colspan="5"></td>
                <td><?=$rang['rang1']?></td>
                <td style="background-color:#c6d9f1;" colspan="5"></td>

                <td><?=$rang['rang2']?></td>
                <td><?=$rang['rangfinal']?></td>
            </tr>
            <!-- Moyenne classe  -->
            <tr class="text-dark">
                <td   rowspan="2 ">Moyyenne General</td>
                <td style="color:white;background-color:#31849b;" class="text-center" colspan="3" >Max</td>
                <td style="background-color:#c6d9f1;" colspan="2"></td>
                <td><?=$rang['max1']?></td>
                <td style="background-color:#c6d9f1;"  colspan="5"></td>

                <td><?=$rang['max2']?></td>
                <td><?=$rang['maxfinal']?></td>
            </tr>
            <tr>
                <td style="color:white;background-color:#31849b;"  colspan="3">Min</td>
                <td style="background-color:#c6d9f1;"    colspan="2"></td>
                <td><?=$rang['min1']?></td>
                <td style="background-color:#c6d9f1;" colspan="5"></td>
                <td><?=$rang['min2']?></td>
                <td><?=$rang['minfinal']?></td>
            </tr>

</tbody>