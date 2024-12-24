<style>

body {

    margin: 0;

    padding: 0;

}



#retro {

    margin: 0;

    padding: 0;

    width: 100%;

    height: 100%;

}



/* Clear floats after the columns */

.row:after {

    content: "";

    display: table;

    clear: both;

}



.col {

    float: left;

    width: fit-content;

    margin-top: auto;

    margin-bottom: auto;

    text-align: center;

    font-weight: bolder;

}



.left,

.right {

    padding-top: 5px;

    width: 15%;



}



.leftbas {

    padding-top: 5px;

    width: 20%;



}



.rightbas {

    padding-top: 5px;

    padding-left: 80px;

    width: 20%;

}



.rightbaslogo {

    padding-top: -10px;

    /* padding-left:1px ; */

    width: 30%;

}



.leftfin,

.rightfin {

    padding-top: 10px;

    width: 49%;



}



.fin {

    padding-top: 5px;

    padding-right: 10px;

    width: 40%;

}



.middle {

    padding-top: 5px;

    width: 20%;

}

.qrcode{

    padding-top: 5px;

    padding-left: 80px;

    width: 20%;

}

.midlebas {

    padding-top: 8px;

    width: 60%;



}



.bas {

    margin-left: 150px;



}



.text-white {

    color: white;

}



.table {

    width: 100%;

    max-width: 100%;



}



.table thead th,

.table thead td {

    padding: 0.75rem;

    vertical-align: top;

    border-top: 1px solid black;

}



.table tbody tr,

.table tbody td {

    padding: 0.3rem;

    vertical-align: top;

    border-top: 1px solid black;

}



.foot tr,

.foot td {

    padding: 0.75rem;

    vertical-align: top;

    border-top: 1px solid black;

}



.table thead,

.table thead th {

    vertical-align: bottom;

    border-bottom: 2px solid black;

}



.table tbody+tbody {

    border-top: 2px solid black;

}



table,

th,

td {

    border: 1px solid black;

    border-collapse: collapse;

}



.text-center {

    text-align: center;

}



.text-right {

    text-align: right;

}



.text-white {

    color: white;

}



.text-dark {

    color: black;

    font-size: 0px;

}



.minmax {

    background-color: #403152;

    text-align: center;

}

</style>

<!-- main header -->



<div class="row" style="padding-top:10px;margin-bottom: 5px;">

    <div class="col left"> NIVEAU : <?=  $classe["libClasse"] ?> </div>

    <div class="col middle"> <span>CLASSE: <?=  $classe["libelle"] ?></span> </div>

    <div class="col fin"><span style=""> Nom: <?=  $info['nom'].' '.$info['prenom'] ?></span></div>

    <div class="col" style="width:20%;  padding-top: 5px ;">Année Scolaire: 2023-2024</div>



</div>

<div id="retro">

    <table class="table table-bordered text-center">

        <thead class="text-white" style="font-size:1.2=rem;">

            <tr style="background-color:#31849b">

                <td rowspan='2' class="text-white" style="width:250px;">MATIERES</td>

                <td colspan="2"></td>

                <td colspan="3" class="text-white">1er Semestre</td>

                <td colspan="3" class="text-white">2eme Semestre</td>

                <td class="text-white">Moyenne</td>

                <td rowspan='2' colspan='2' class="text-white" style="width:300px;">OBSERVATION</td>

            </tr>

            <tr style="background-color:#31849b">

                <td class="text-white minmax">MAX</td>

                <td class="text-white minmax">MIN</td>

                <td class="text-white">cours</td>

                <td class="text-white">compo</td>

                <td class="text-white">moyenne</td>

                <td class="text-white">cours</td>

                <td class="text-white">compo</td>

                <td class="text-white">moyenne</td>

                <td class="text-white">moyenne</td>

            </tr>

        </thead>

        

        <tbody>

            <?php

              

                

        if(sizeof($matiere)>0){

        //  die(var_dump($matiere))



        $maximun =0;$minimun=0;$cours1=0;$comp1=0;$moyenneGen=0;$cours2=0;$comp2=0;$moyenneGen2=0;$mgeneral=0;

        $totalsemestre1= 0; $totalsemestre2= 0;

        //moy/20

        $j=0;  $moyenneT1=0;  $moyenneT2=0; $moyenne1 = 0;

        $i=0; $k=0;

        $dataSem1=null;$dataMoy=0;

        $dataSem2=null;

        foreach ($matiere as $key => $value) {

            # code...

            // $data=null;

          

            echo'  

           <tr class="text-dark">

            <td>'.$value['libelle'].'</td>';

            $coef = yii::$app->simplelClass->maxmincoef($value['coef'],$classe['typeCompo']);

           $maximun =$maximun+$coef['0'];

           $minimun =$minimun+$coef['1']; 

          echo '  <td class="text-white minmax">'.$coef['0'].'</td>

              <td class="text-white minmax">'.$coef['1'].'</td>';



              $moy = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'],$value['codeMatiere'],'4',$anneeActive);

             

              if($moy==false){

                $dataSem1[$i] =['cours'=>  0 ,'coef'=>$value['coef']  ,'compo'=>0,'moy' => 0];

                 $i++;

                echo'

                 <td>0</td>

                <td>0</td>

                <td>0</td>

      

                  ';



              }else{

              $cours=0;

              if($classe['typeCompo'] ==1){

                $cours =yii::$app->simplelClass->moyenne($moy['note1'],$moy['note2'],$moy['note3'],'1');

                $cours1 =$cours1+$cours;

              }else if($classe['typeCompo']==2){

                

                 $cours =yii::$app->simplelClass->moyenne($moy['note1'],$moy['note2'],$moy['note3'],'4');

                $cours1 =$cours1+$cours;

              }

            

              $comp1 = $comp1 +  $moy['composition'];

             // die($cours);

             echo ' <td>'.$cours.'</td>

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

              <td>0</td> ';

            }else{

              // $dataSem2[$i] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy['composition'] ,'moy' => round(($cours+2*$moy['composition'])/3,2)];

            

              $cours=0;

              if($classe['typeCompo'] ==1){

                $cours =yii::$app->simplelClass->moyenne($moy2['note1'],$moy2['note2'],$moy2['note3'],'1');



              }else if($classe['typeCompo']==2){

                

                $cours =yii::$app->simplelClass->moyenne($moy2['note1'],$moy2['note2'],$moy2['note3'],'4');

              }

              // die($cours);

              $cours2 =$cours2+$cours;

              $comp2 =$moy2['composition']+$comp2;

              echo ' <td>'.$cours.'</td>

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

            ';



            if($key % 2 ==0 && $key != 0){



                echo ' <td colspan="2" style="border:0px; border-top: 1px dotted black;"></td>

            ';

            }

            echo'

            </tr>';

          }



      

        }

        

        // die(var_dump($dataSem2));

            $moyenneT1=  yii::$app->simplelClass->moySemestre($dataSem1,'2');

            $moyenneT2=  yii::$app->simplelClass->moySemestre($dataSem2,'2');



        ?>



        

            <!-- data firs  -->

            <!-- total -->

            <?php 

             $moyenneT2=  yii::$app->simplelClass->moySemestre($dataSem2,'2');

            //moyennefinal

             $moyfinal = ($moyenneT1['moyenneGenerale'] + $moyenneT2['moyenneGenerale'] )/2;

              $mentionS1 =yii::$app->simplelClass->mentionSecondaire($moyenneT1['moyenneGenerale']);  

              $mentionS2 =yii::$app->simplelClass->mentionSecondaire( $moyenneT2['moyenneGenerale']);  

              $mentionfinal =yii::$app->simplelClass->mentionSecondaire( $moyfinal);  

             

            

            

            ?>







            <tr class="text-dark">

                <td class="text-white" style="color:white;background-color:#31849b;">Total</td>

                <td class="text-white minmax" style="color:white"><?= $maximun?></td>

                <td class="text-white minmax" style="color:white"><?= $minimun?></td>

                <td><?=   $cours1 ?></td>

                <td><?= $comp1?></td>

                <td><?= $totalsemestre1?></td>

                <td><?= $cours2?></td>

                <td><?= $comp2?></td>

                <td><?= $totalsemestre2?></td>

                <td><?= $mgeneral?></td>

                <td colspan="2" style="border:0px; border-top: 1px dotted black;"></td>

            </tr>

            <!-- moyenne sur 20 -->

            <tr class="text-dark">

                <td class="text-start" style="color:white;background-color:#31849b;text-align-right" colspan="3">

                    Moyenne/20</td>

                <td><?=$moyenneT1['MoyenneCours'] ?></td>

                <td><?=$moyenneT1['moyennecompo'] ?></td>

                <td><?=$moyenneT1['moyenneGenerale'] ?></td>

                <td><?=$moyenneT2['MoyenneCours'] ?></td>

                <td><?=$moyenneT2['moyennecompo'] ?></td>

                <td><?=$moyenneT2['moyenneGenerale'] ?></td>

                <td><?= $moyfinal?></td>

                

            </tr>

            <!-- mention  -->

            <tr class="text-dark">

                <td style="color:white ;background-color:#31849b" colspan="3">Mention</td>

                <td style="background-color:#c6d9f1;" colspan="2"></td>

                <td><?= $mentionS1?></td>

                <td style="background-color:#c6d9f1;" colspan="2"></td>



                <td><?= $mentionS2?></td>

                <td><?=$mentionfinal?></td>

                <td colspan="2" style="border:0px; border-top: 1px dotted black;"></td>



            </tr>

            <!-- Rang  -->

            <tr class="text-dark">

                <td style="color:white;background-color:#31849b;" colspan="3">Rang</td>

                <td style="background-color:#c6d9f1;" colspan="2"></td>

                <td><?=$rang['rang1']?></td>

                <td style="background-color:#c6d9f1;" colspan="2"></td>



                <td><?=$rang['rang2']?></td>

                <td><?=$rang['rangfinal']?></td>

                

            </tr>

            <!-- Moyenne classe  -->



            <?php $img = Yii::$app->simplelClass->graphesecond(round($moyenneT1['moyenneGenerale'],2),round($moyenneT2['moyenneGenerale'],2),round($moyfinal,2));?>

            <tr class="text-dark">

                <td style="color:white;background-color:#31849b;" colspan="2" rowspan="2 ">Moyyenne General</td>

                <td style="color:white;background-color:#31849b;">Max</td>

                <td style="background-color:#c6d9f1;" colspan="2"></td>

                <td><?=$rang['max1']?></td>

                <td style="background-color:#c6d9f1;" colspan="2"></td>



                <td><?=$rang['max2']?></td>

                <td><?=$rang['maxfinal']?></td>



                <td style="border:0px; border-top: 1px dotted black;" colspan="2" 

                    rowspan="5">    <img src="<?=$img ?>" alt="Graphique" style=""></td>

            

            </tr>

            <tr>

                <td style="color:white;background-color:#31849b;">Min</td>

                <td style="background-color:#c6d9f1;" colspan="2"></td>

                <td><?=$rang['min1']?></td>

                <td style="background-color:#c6d9f1;" colspan="2"></td>

                <td><?=$rang['min2']?></td>

                <td><?=$rang['minfinal']?></td>

         

            </tr>

            <!-- proffesseur  -->

            <tr class="text-dark">

                <td style="color:white;background-color:#31849b;padding-top:0.25rem;padding-bottom:0.25rem" colspan="3"

                    rowspan="1">Le proffesseur Principal</td>

                <td colspan="3"></td>

                <td colspan="4"></td>

            </tr>



            <!-- direteur -->

            <tr class="text-dark">

                <td style="color:white;background-color:#31849b;padding-top:0.5rem;padding-bottom:0.5rem" colspan="3"

                    rowspan="1">Le Directeur des études</td>

                <td colspan="3"></td>

                <td colspan="4"></td>

                

            </tr>

            

            <tr class="text-dark">

                <td style="color:white;background-color:#31849b;padding-top:2rem;padding-bottom:4.5rem" colspan="3"

                    rowspan="3">Signature et cachet du Directeur Général</td>

                <td colspan="3" rowspan="3"></td>

                <td colspan="4" rowspan="3"></td>

            </tr>

            <tr class="text-dark">



                <td colspan="2" style="padding-left:0px;">Moyenne Annuel: <?= round($moyfinal,2)?> Mention: <?=$mentionfinal?></td>

            </tr>

            <tr class="text-dark">

            

                <td>Admis <input type="checkbox" name="input" id="" checked="<?= ($moyfinal >= 10 ) ?  'checked="checked"': ''?>" ></td>

                <td>Redouble <input type="checkbox" name="input" id=""  <?= ($moyfinal<10) ?  'checked="checked"' : ''?> ></td>

            </tr>



        </tbody>

    </table>

    <?php $img = Yii::$app->simplelClass->graphesecond(round($moyenneT1['moyenneGenerale'],2),round($moyenneT2['moyenneGenerale'],2),round($moyfinal,2));



?>





</div>      



<div class="row">

    <div class="col leftfin" style="border-right:3px solid green">

        <div class="log" style="padding-top:150px">

            <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo']?>" alt="">

        </div>



        <div class="row" style="margin-top:180px;margin-bottom:60px">

            <div class="col leftbas"></div>

                    <div class="col qrcode"><img src="<?= $qrimage ?>" alt=""

                    style="width:130px"></div>

            <div class="col rightbas"></div>

        </div>

    </div>

    <div class="col rightfin">

        <div class="titre">

            <div class="row bas ">

                <div class="col midlebas "><span class=".text-right">REPUBLIQUE DE GUINEE</span><br>

                    <span class="text-right"> <?= $infoets['ire'] ?></span><br>

                    <span class=".text-right"><?= $infoets['nomEtbs'] ?></span>

                </div>




            </div>

        </div>

        <div class="log" style="padding-top:40px">

            <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="">

        </div>

        <div>

            <h4>BULLETIN DE NOTES</h4>

            </div>

            <div class="row">

                <div class="col">

                <a href="#" class="avatar avatar-sm me-2">

                    <img class="avatar-img rounded-circle"  style="width:80px;height:80px" src="<?=yii::$app->basePath.'/web/mainAssets/uploads/'.$info['photo']?>" alt="ELEVES Image">

                </a>

                </div>

                <div class="col">

                <h5>Nom de l’élève : <?=  $info['nom'].' '.$info['prenom'] ?></h5>

            <h5>Classe :  <?=  $classe["libelle"] ?></h5>

            <H4>ANNEE SCOLAIRE : 2023 – 2024</H4>



                </div>

            </div>

        

        <div class="row" style="margin-top:1px;margin-bottom:10px;color:green">

            <h3>Nous offrons à nos élèves un univers de possibilité</h3>

        </div>

    </div>

</div>























