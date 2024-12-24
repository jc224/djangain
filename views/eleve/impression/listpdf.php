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
        padding: 0.2rem;
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


$annee = yii::$app->mainCLass->databycode('dj_anneescolaire', $anneeActive, 'code');


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
            <p style="padding-top:10px;"><?= $infoets['ire'] ?></p>

            <p class=""><?= $infoets['nomEtbs'] ?></p>
            <p style="font-size:16px;text-align: center; font-weight:bold;padding-top:20px;">LISTE DES ELEVES DE LA <?= strtoupper($classe['libelle']) ?></p>

        </td>
        <td style="border:0px solid black ">
            <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 80px;">

        </td>
    </tr>

</table>



<div class="row">
    <!-- <div class="col left" style="">
    </div> -->
    <div class="col">
        <div class="row">
            <div class="col lefth">
                <p><span>CLASSE : <?= $classe['libelle'] ?></span></p>

            </div>
            <div class="col leftg">
                <p><span>ANNEE SCOLAIRE : <?= $annee['0']['libelle'] ?></span></p>

            </div>
        </div>


        <table class="table table-bordered text-center " style="height:80%;margin-top:10px">
            <thead class="text-white" style="background-color:rgb(155, 187, 89)">

                <tr>
                    <td style="font-size:15px;">[]</td>
                    <td style="font-size:15px;">Matricule</td>
                    <td style="font-size:15px;width:200px">Nom Complet</td>
                    <td style="font-size:15px;">Tuteur</td>
                    <td style="font-size:15x;">Tél</td>
                    <td style="font-size:15x;">Adresse</td>

                </tr>

            </thead>
            <tbody>
                <?php
                // die(var_dump($liste));
                if (sizeof($liste) > 0) {
                    $i = 0;
                    foreach ($liste as $key => $value) {
                        $i++;

                        echo '
                           <tr>
                           <td>' . $i . '</td>
                           <td>' . $value['matricule'] . '</td>
                           <td >' . strtoupper($value['nom']) . ' ' . $value['prenom'] . '</td>
                           <td >' . strtoupper($value['nomTuteur']) . ' ' . $value['prenomTuteur'] . '</td>
                           <td >' . $value['telTuteur'] . '</td>
                           <td >' . $value['adresse'] . '</td>
                           
                       </tr>
                
     
                           ';
                    }
                }
                ?>

            </tbody>
        </table>
        <p style="text-align:right">Le Directeur Général</p>
    </div>

</div>