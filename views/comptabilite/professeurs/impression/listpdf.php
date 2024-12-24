<style>

body {

    margin: 0;

    padding: 0;

    

}

.qrcode{

    text-align:center;

    padding-top: 10px;

    /* padding-left: 200px; */

    /* width: 20%; */

}



#retro {

    margin: 0;

    padding: 0;

    width: 100%;

    height: 100%;

}



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

    font-weight: bolder;

}



p {}



.right {

    padding-top: 5px;





}



.left {

    padding-top: 5px;

    background-image: url('<?= yii::$app->basePath ?>/web/mainAssets/logo/barhor.png');

    position: relative;

    background-position: center;

    background-size: cover;

    width: 5%;

    height: 100%;





}



.lefth {



    width: 70%;





}



.text-white {

    color: white;

}



.table {

    width: 100%;

    max-width: 100%;

    height: 60%;

    border-collapse: collapse;



}



.table thead th,

.table thead td {

    padding: 0.7rem;

    vertical-align: top;

    border: 1px solid black;

    font-size:11px;



}



.table thead td {

    border: 1px solid black;



}



.table thead th {

    vertical-align: bottom;

    border-bottom: 2px solid black;

}



.table tbody+tbody {

    border-top: 2px solid black;

}













th,

td {

    padding: 0.75rem;

    border: 1px solid black;

    border-collapse: collapse;



}



.text-center {

    text-align: center;

}





.text--white {

    color: white;

}



.text-dark {



    color: black;

    font-size: 0px;

}



.element {

    display: inline-block;

    width: 30%;

    margin: 10px;

    border: 1px solid black;

}



.element {



    float: right;

    width: 30%;

    margin: 10px;

    border: 0px solid black;

}

</style>



<?php

                  // $periodeAlpha = yii::$app->simplelClass->selectPeriode($periode);

                  $anneeActive  = yii::$app->mainCLass->getAnneeActive();





                  $annee = yii::$app->mainCLass->databycode('dj_anneescolaire',$anneeActive,'code');





?>

<table style="margin-top:20px; border:0px solid black   ;">

    <tr style="border:0px solid black ">

        <td style="border:0px solid black ">

            <img src="<?= yii::$app->basePath ?>/web/mainAssets/logo/logo.png" alt="" style=" width: 140px;">

        </td>

        <td colspan="4" style=" border:0px solid black; padding-left:12%;padding-right:12%;text-align:center ">

            <p style="font-size:20px">REPUBLIQUE DE GUINEE</p>

            <p><span style="color:red;">Travail-</span><span style="color:yellow;">Justice-</span><span

                    style="color:green;">Solidarité</span></p> 

            <div style=" border-bottom:1px solid black"><u></u> </div>

            <p style="padding-top:10px;">MEPU–A/ IRE/DCE–R</p>



            <p class="">Ecole Wamy Internationale</p>

            <p style="font-size:16px;text-align: center; font-weight:bold;padding-top:20px;">LISTE DES PROFESSEUR </p>



            </div>

        </td>

        <td style="border:0px solid black ">

            <img src="<?= yii::$app->basePath ?>/web/mainAssets/logo/logowamy.png" alt="" style=" width: 140px;">



        </td>

    </tr>



</table>

<img src="<?= yii::$app->basePath ?>/web/mainAssets/logo/barbull.png" alt="">





<div class="row">

    <div class="col left" style="">

    </div>

    <div class="col">

    <?php 

     if(isset($post['catsearch']) && !empty($post['catsearch'])){

        $groupe =$post['catsearch']==1 ? 'TITULAIRE' : 'NON TITULAIRE';



         echo '    <p><span>GATEGORIE PROFESSEUR : '.$groupe.'</span></p>

         ';

     }



    ?>

    <p><span>ANNEE SCOLAIRE : <?= $annee['0']['libelle'] ?></span></p>







            <table class="table table-bordered text-center " style="height:80%;margin-top:10px">

            <thead class="text-white"  style="background-color:rgb(155, 187, 89)">

    

                       <tr style="font-size:13px;">

                                                        <th style="min-width:50px;">[]</th>

                                                        <th style="min-width:70px;font-size:14px;">Matricule</th>

                                                        <th style="min-width:50px;font-size:13px;">Prénoms et Noms</th>

                                                        <th style="min-width:50px;font-size:13px;">Genre</th>

                                                        <th style="min-width:80px;font-size:13px;">Téléphone</th>

                                                        <th style="min-width:50px;font-size:13px;">Email</th>

                                                       

                                                    </tr>

            </thead>      

            <tbody>

                <?php

                // die(var_dump($liste));

                    if(sizeof($liste)>0){

                        $i=0;

                        foreach ($liste as $key => $value) {

                            $i++;

                            

                            $genre = $value['genre'] == 1 ? 'Masculin' : 'Feminin'; 

                            $groupe =$value['groupePers']==1 ? 'Titulaire' : 'Non Titulaire';

                            echo'    

                            <tr>

                            <td class="sorting_1">

                                '.$i.'

                            </td>

                            <td>'.$value['matricule'].'</td>

                            <td>

                           

                                '.$value['nom'].' '.$value['prenom'].'

                              

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

                        

                          

                    </tr>';

                        }

                    }

                ?>

            

            </tbody> 

        </table>

        <p style="text-align:right">Le Directeur Général</p>

    </div>

    

</div>

