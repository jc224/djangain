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

        border-collapse: collapse;



    }



    .table thead th,

    .table thead td {

        padding: 1rem;

        vertical-align: top;

        font-size: 14px;



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

        padding: 0.2rem;

        border: 1px solid black;

        border-collapse: collapse;

    }



    tr

    td {

        padding: 0.8rem;

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





?>

<table style="margin-top:20px; border:0px solid black   ;">

    <tr style="border:0px solid black ">

    <td style="border:0px solid black ">

            <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 80px;">

        </td>

        <td colspan="4" style=" border:0px solid black; padding-left:25%;padding-right:25%;text-align:center ">

            <p style="font-size:20px">REPUBLIQUE DE GUINEE</p>

            <p><span style="color:red;">Travail-</span><span style="color:yellow;">Justice-</span><span

                    style="color:green;">Solidarité</span></p>

            <div style=" border-bottom:1px solid black"><u></u> </div>

       

            <p style="padding-top:10px;"><?=$infoets['ire']?></p>
            <p class=""><?=$infoets['nomEtbs']?></p>


            <p style="font-size:16px;text-align: center; font-weight:bold;padding-top:20px;">EMPLOI DU TEMPS </p>



        </td>

        <td style="border:0px solid black ">

            <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 80px;">



        </td>

    </tr>



</table>


<div class="row">

    <div class="col lefth">

        <?php

        $class = Yii::$app->mainCLass->databycode('dj_classe', $infoemploie['0']['codeClasse'], 'code');

        $annee = Yii::$app->mainCLass->databycode('dj_anneescolaire', $infoemploie['0']['codeAnnee'], 'code');

        $infoclasse = (sizeof($class) > 0) ? $class['0']['libelle'] : '';

        $infoannee = (sizeof($annee) > 0) ? $annee['0']['libelle'] : '';



        ?>

        <p><span>CLASSE :

                <?= $infoclasse ?>

            </span></p>

        <p><span>EMPLOIE DU TEMPS :DU

                <?= $infoemploie['0']['dateDebut'] ?> AU

                <?= $infoemploie['0']['dateFin'] ?>

            </span></p>



    </div>



    <div class="col leftg">

        <p><span>ANNEE SCOLAIRE :

                <?= $infoannee ?>

            </span></p>



    </div>

</div>



<table class="table table-bordered text-center " style="height:80%;margin-top:10px">

    <thead class="text-white" style="background-color:rgb(155, 187, 89)">



        <tr>



            <th style="width: 80px;">HORAIRE </th>

            <th>LUNDI</th>

            <th>MARDI</th>

            <th>MERCREDI</th>

            <th>JEUDI</th>

            <th>VENDREDI</th>

            <th>SAMEDI</th>









        </tr>



    </thead>

    <?php $getmat = Yii::$app->mainCLass;

        // die($getmat);

        ?>

    <tbody>

        <tr >

            <td>8H-9H</td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '1', '8H-9H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '2', '8H-9H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '3', '8H-9H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '4', '8H-9H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '5', '8H-9H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '6', '8H-9H')?></td>





          

        </tr>

        <tr >

            <td>9H-10H</td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '1', '9H-10H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '2', '9H-10H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '3', '9H-10H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '4', '9H-10H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '5', '9H-10H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '6', '9H-10H')?></td>





          

        </tr>



        <tr >

            <td>10H-11H</td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '1', '10H-11H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '2', '10H-11H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '3', '10H-11H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '4', '10H-11H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '5', '10H-11H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '6', '10H-11H')?></td>





          

        </tr>

        <tr >

            <td>11H-12H</td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '1', '11H-12H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '2', '11H-12H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '3', '11H-12H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '4', '11H-12H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '5', '11H-12H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '6', '11H-12H')?></td>





          

        </tr>



        <tr >

            <td>12H-13H</td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '1', '12H-13H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '2', '12H-13H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '3', '12H-13H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '4', '12H-13H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '5', '12H-13H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '6', '12H-13H')?></td>





          

        </tr>

        <tr >

            <td>13H-14H</td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '1', '13H-14H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '2', '13H-14H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '3', '13H-14H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '4', '13H-14H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '5', '13H-14H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '6', '13H-14H')?></td>





          

        </tr>

        <tr >

            <td>14H-15H</td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '1', '14H-15H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '2', '14H-15H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '3', '14H-15H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '4', '14H-15H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '5', '14H-15H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '6', '14H-15H')?></td>





          

        </tr>

        <tr >

            <td>15H-16H</td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '1', '15H-16H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '2', '15H-16H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '3', '15H-16H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '4', '15H-16H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '5', '15H-16H')?></td>

            <td><?=$getmat->selectmatiere($infoemploie['0']['code'], '6', '15H-16H')?></td>





          

        </tr>

    </tbody>

</table>



