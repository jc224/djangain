<style>

    body {

        margin: 0;

        padding: 0;



    }



    .qrcode {

        text-align: center;

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

        border: 1px solid red;

        border-collapse: collapse;



    }



    .table thead th,

    .table thead td {

        padding: 0.7rem;

        vertical-align: top;

        border: 1px solid black;

        font-size: 11px;



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

        padding: 0.6rem;

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

      // $periodeAlpha = yii::$app->simplelClass->selectPeriode($periode);

      $anneeActive  = yii::$app->mainCLass->getAnneeActive();





      $annee = yii::$app->mainCLass->databycode('dj_anneescolaire',$anneeActive,'code');



?>

<table style="margin-top:20px; border:0px solid black   ;">

    <tr style="border:0px solid black ">

        <td style=" border:0px solid black ">

        <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 80px;">

        </td>

        <td colspan="4" style=" border:0px solid black; padding-left:12%;padding-right:12%;text-align:center ">

            <p style="font-size:20px">REPUBLIQUE DE GUINEE</p>

            <p><span style="color:red;">Travail-</span><span style="color:yellow;">Justice-</span><span

                    style="color:green;">Solidarité</span></p>

            <div style=" border-bottom:1px solid black"><u></u> </div>

            <p style="padding-top:10px;"><?=$infoets['ire']?></p>


            <p class=""><?=$infoets['nomEtbs']?></p>

            <p style="font-size:16px;text-align: center; font-weight:bold;padding-top:30px;">

                LISTE DES ELEVES

            </p>



        </td>

        <td style=" border:0px solid black ">

        <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 80px;">



        </td>

    </tr>



</table>



<div class="row">

    <div class="col lefth">

        <?php

            if(isset($post)){

                // die(var_dump($_POST));

                if(!empty($_POST['classetSearch'])){

                    $info= Yii::$app->mainCLass->databycode('dj_classe',$post['classetSearch'],'code')['0'];

                    echo '    <p><span>CLASSE : '.$info['libelle'].'</span></p>

                    '; 

                }

                if(!empty($_POST['paiementSearch'])){

                    $info= Yii::$app->mainCLass->databycode('dj_payement',$post['paiementSearch'],'code')['0'];

                    echo '    <p><span>ACTE : '.$info['libelle'].'</span></p>

                    '; 

                }

                if(!empty($_POST['statutSearch'])){

                    $statut = ($_POST['statutSearch'] == 1 ? 'PAYER' : 'NON PAYER');

                   if($_POST['statutSearch'] == 0){

                    $statut = 'Avance';

                   }

                    echo '    <p><span>STATUT DE PAIEMENT : '. $statut .'</span></p>

                    '; 

                }

            }

        ?>



    </div>

    <div class="col leftg">

    <p><span>ANNEE SCOLAIRE : <?= $annee['0']['libelle'] ?></span></p>





    </div>

</div>

<table class="table table-bordered text-center " style="height:80%;border:1px solid red;margin-top:10px">

    <thead class="text-white" style="background-color:rgb(155, 187, 89)">



        <tr>

           <td style="font-size:15px;font-weight: bold;">[]</td>

            <td style="font-size:15px;font-weight: bold;">Matricule</td>

            <td style="font-size:15px;font-weight: bold;">Nom Complet</td>

            <td style="font-size:15px;font-weight: bold;">Genre</td>



        </tr>



    </thead>

    <tbody>

        <?php 

           if (isset($listAtente) && sizeof($listAtente) > 0) {

            $j = 0;

            foreach ($listAtente as $key => $value) {

                // die(var_dump($value));



                $genre = ($value['genre'] == 1 ? 'Masculin' : 'Feminin');

                $j++;

                echo '       

                <tr> 

                <td>' . $j . '</td>

                <td>' . $value['matricule'] . '</td>

                

                <td> ' . $value['nom'] . ' ' . $value['prenom'] . '</td>

                <td>' . $genre . '</td>



                </tr>';

            }

        }

        

        ?>

    </tbody>



</table>

