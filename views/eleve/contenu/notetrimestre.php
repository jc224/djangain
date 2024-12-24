<thead class="text-bolder" style="font-size:12px;">
    <tr>
        <td rowspan='2' class="justify-content-center text-center pt-4">MATIERES</td>
        <td colspan="5" class="text-center">1er Trimestre</td>
        <td colspan="5" class="text-center">2eme Trimestre</td>
        <td colspan="5" class="text-center">3eme Trimestre</td>
        <td rowspan='2' class="justify-content-center text-center pt-4">Moyenne</td>
    </tr>
    <tr>

        <td>Eval 1</td>
        <td>Eval 2</td>
        <td>moyenne Cours</td>
        <td>compo</td>
        <td>moyenne</td>
        <td>Eval 1</td>
        <td>Eval 2</td>
        <td>moyenne Cours</td>
        <td>compo</td>
        <td>moyenne</td>
        <td>Eval 1</td>
        <td>Eval 2</td>
        <td>moyenne Cours</td>
        <td>compo</td>
        <td>moyenne</td>
    </tr>
</thead>
<tbody>
    <?php
if(sizeof($matiere)>0){
       
    $rang = yii::$app->evaluationClass->rang($noteAllElve,$info['codeEleve']);

       $maximun =0;$minimun=0;$cours1=0;$comp1=0;$moyenneGen=0;$cours2=0;$comp2=0;$moyenneGen2=0;$mgeneral=0;
       $totalsemestre1= 0; $totalsemestre2= 0;$cours3=$moyenneGen3=$totalsemestre3=0;$comp3=0;
       $moyenne1=$moyenne2=$moyenne=0;
       //moy/20
       $j=0;  $moyenneT1=0; $moyenneT3=0;  $moyenneT2=0;
       $i=0; $k=0;
       $dataTrim1=null;$dataMoy=0;
       $dataTrim2=null;
       foreach ($matiere as $key => $value) {
           # code...
           // $data=null;
      
           echo'  
          <tr class="text-dark">
           <td>'.$value['libelle'].'</td>';
           $coef = yii::$app->simplelClass->maxmincoef($value['coef'],$infoclasse['typeCompo']);
          $maximun =$maximun+$coef['0'];
          $minimun =$minimun+$coef['1']; 
        
             $moy = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'],$value['codeMatiere'],'1',$anneeActive);
            // die(var_dump($moy));
             if($moy==false){
               $dataTrim1[$i] =['cours'=>  0 ,'coef'=>$value['coef']  ,'compo'=>0,'moy' => 0];
                $i++;
               echo'
               <td>0</td>
               <td>0</td>
                <td>0</td>
               <td>0</td>
               <td>0</td>
     
                 ';

             }else{
             $cours=0;
           
               $cours =yii::$app->simplelClass->moyenne($moy['note1'],$moy['note2'],$moy['note3'],'1');
               $cours1 =$cours1+$cours;
           
           
             $comp1 = $comp1 +  $moy['composition'];
            // die($cours);
            echo '
             <td>'.$moy['note1'].'</td>
            <td>'.$moy['note2'].'</td>

            <td>'.$cours.'</td>
           <td>'.$moy['composition'].'</td>';
           $dataTrim1[$i] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy['composition'] ,'moy' => round(($cours+$moy['composition'])/2,2)];
           $i++;
           $moyenne1 = yii::$app->simplelClass->moyenneMoyennegenralTrim(  $cours , $moy['composition']);
           $moyenneGen =$moyenneGen+$moyenne1;
           $totalsemestre1+=$moyenne1;
             
           echo '
              <td> '.$moyenne1.'</td>'; 

           }
      
          

           $moyenne2 = 0;
           $moy2 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'],$value['codeMatiere'],'2',$anneeActive);
   
           if($moy2==false){
             $dataTrim2[$j] =['cours'=>  0 ,'coef'=>$value['coef'] ,'compo'=>0,'moy' => 0];
             $j++;
             echo'
              <td>0</td>
             <td>0</td>
             <td>0</td>
             <td>0</td>
             <td>0</td> ';
           }else{
             // $dataTrim2[$i] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy['composition'] ,'moy' => round(($cours+2*$moy['composition'])/3,2)];
           
             $cours=0;
               $cours =yii::$app->simplelClass->moyenne($moy2['note1'],$moy2['note2'],$moy2['note3'],'1');

          
             // die($cours);
             $cours2 =$cours2+$cours;
             $comp2 =$moy2['composition']+$comp2;
             echo ' 
             <td>'.$moy2['note1'].'</td>
             <td>'.$moy2['note2'].'</td>
             <td>'.$cours.'</td>
             <td>'.$moy2['composition'].'</td>';
             $dataTrim2[$j] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy2['composition'] ,'moy' => round(($cours+$moy2['composition'])/2,2)];
             $moyenne2 = yii::$app->simplelClass->moyenneMoyennegenralTrim(  $cours , $moy2['composition']);
             $moyenneGen2+=$moyenne2 ;
             $totalsemestre2+=$moyenne2;
             $j++;
             echo '
               <td>'.$moyenne2.'</td>';
                

           }            
           
             $moyenne3 = 0;
           $moy3 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'],$value['codeMatiere'],'2',$anneeActive);
   
           if($moy3==false){
             $dataTrim3[$j] =['cours'=>  0 ,'coef'=>$value['coef'] ,'compo'=>0,'moy' => 0];
             $j++;
             echo'
              <td>0</td>
             <td>0</td>
             <td>0</td>
             <td>0</td>
             <td>0</td> ';
           }else{
             // $dataTrim2[$i] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy['composition'] ,'moy' => round(($cours+2*$moy['composition'])/3,2)];
           
             $cours=0;
               $cours =yii::$app->simplelClass->moyenne($moy3['note1'],$moy3['note2'],$moy3['note3'],'1');

          
             // die($cours);
             $cours3 =$cours3+$cours;
             $comp3 =$moy3['composition']+$comp3;
             echo ' 
             <td>'.$moy3['note1'].'</td>
             <td>'.$moy3['note2'].'</td>
             <td>'.$cours.'</td>
             <td>'.$moy3['composition'].'</td>';
             $dataTrim3[$j] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy3['composition'] ,'moy' => round(($cours+$moy3['composition'])/2,2)];
             $moyenne2 = yii::$app->simplelClass->moyenneMoyennegenralTrim(  $cours , $moy3['composition']);
             $moyenneGen3+=$moyenne3;
             $totalsemestre3+=$moyenne3;
             $j++;
             echo '
               <td>'.$moyenne3.'</td>';
                

           }            
          
             $mgeneralgeneral= ($moyenne1+$moyenne2+$moyenne3)/2 ;
        
           $mgeneral +=$mgeneralgeneral;
         // $mgeneralgeneral=  yii::$app->simplelClass->moySemestre($data);
         $dataMoy +=$mgeneralgeneral;
        echo 
        '   <td>'.$mgeneralgeneral.'</td>
        
           </tr>';
         }

     
   
       
           $moyenneT1=  yii::$app->simplelClass->moySemestre($dataTrim1,'1');
           $moyenneT2=  yii::$app->simplelClass->moySemestre($dataTrim2,'1');
           $moyenneT3=  yii::$app->simplelClass->moySemestre($dataTrim3,'1');

       ?>

    <!-- data firs  -->
    <!-- total -->
    <?php 
            //  $moyenneT2=  yii::$app->simplelClass->moySemestre($dataTrim2);
            //moyennefinal
             $moyfinal = ($moyenneT1['moyenneGenerale'] + $moyenneT2['moyenneGenerale'] )/2;
              $mentionS1 =yii::$app->simplelClass->mentionTrimestre($moyenneT1['moyenneGenerale']);  
              $mentionS2 =yii::$app->simplelClass->mentionTrimestre( $moyenneT2['moyenneGenerale']);  
              $mentionS3 =yii::$app->simplelClass->mentionTrimestre( $moyenneT3['moyenneGenerale']);  
              $mentionfinal =yii::$app->simplelClass->mentionTrimestre( $moyfinal);  
             
            
            
            ?>
    <tr class="text-dark">
        <td class="text-white text-center text-primary" colspan="3">Total</td>

        <td><?=   $cours1 ?></td>
        <td><?= $comp1?></td>
        <td><?= $totalsemestre1?></td>
        <td colspan="2"></td>
        <td><?= $cours2?></td>
        <td><?= $comp2?></td>
        <td><?= $totalsemestre2?></td>
        <td colspan="2"></td>
        <td><?= $cours3?></td>
        <td><?= $comp3?></td>
        <td><?= $totalsemestre3?></td>
        <td><?= $mgeneral?></td>
    </tr>
    <!-- moyenne sur 20 -->
    <tr class="text-dark">
        <td class="text-center" colspan="3">
            Moyenne/20</td>
        <td><?=$moyenneT1['MoyenneCours'] ?></td>
        <td><?=$moyenneT1['moyennecompo'] ?></td>
        <td><?=$moyenneT1['moyenneGenerale'] ?></td>
        <td colspan="2"></td>
        <td><?=$moyenneT2['MoyenneCours'] ?></td>
        <td><?=$moyenneT2['moyennecompo'] ?></td>
        <td><?=$moyenneT2['moyenneGenerale'] ?></td>
        <td colspan="2"></td>
        <td><?=$moyenneT3['MoyenneCours'] ?></td>
        <td><?=$moyenneT3['moyennecompo'] ?></td>
        <td><?=$moyenneT3['moyenneGenerale'] ?></td>
        <td><?= $moyfinal?></td>
    </tr>
    <!-- mention  -->
    <tr class="text-dark">
        <td colspan="5" class="text-center">Mention</td>

        <td><?= $mentionS1?></td>
        <td colspan="4"></td>

        <td><?= $mentionS2?></td>
        <td colspan="4"></td>

        <td><?= $mentionS3?></td>
        <td><?=$mentionfinal?></td>
    </tr>
    <!-- Rang  -->
    <tr class="text-dark">
        <td colspan="5">Rang</td>
        <td><?=$rang['rang1']?></td>
        <td colspan="4"></td>

        <td><?=$rang['rang2']?></td>
        <td colspan="4"></td>

        <td><?=$rang['rang3']?></td>
        <td><?=$rang['rangfinal']?></td>
    </tr>
    <!-- Moyenne classe  -->
    <tr class="text-dark">
        <td colspan="2" rowspan="2">Moyyenne General</td>
        <td>Max</td>
        <td colspan="2"></td>
        <td><?=round($rang['max1'],2)?></td>
        <td colspan="4"></td>

        <td><?=round($rang['max2'],2)?></td>
        <td colspan="4"></td>
        <td><?=round($rang['max3'],2)?></td>
        <td><?=round($rang['maxfinal'],2)?></td>
    </tr>
    <tr>
        <td>Min</td>
        <td colspan="2"></td>
        <td><?=round($rang['min1'],2)?></td>
        <td colspan="4"></td>
        <td><?=round($rang['min2'],2)?></td>
        <td colspan="4"></td>
        <td><?=round($rang['min3'],2)?></td>
        <td><?=round($rang['minfinal'],2)?></td>
    </tr>
</tbody>

<?php

}

?>