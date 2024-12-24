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
            <p style="font-size:16px;text-align: center; font-weight:bold;padding-top:20px;">RESULTAT DU
                <?= strtoupper(yii::$app->simplelClass->selectPeriode($periode)) ?>
            </p>

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
        <div class="row">
            <div class="col lefth">
                <p><span>CLASSE :
                        <?= $infoclasse['libelle'] ?>
                    </span></p>

            </div>
            <div class="col leftg">
                <p><span>ANNEE SCOLAIRE :
                        <?= $annee['0']['libelle'] ?>
                    </span></p>

            </div>
        </div>
        <p style="text-align:center;text-decoration:underline">Le Tableau Synoptique</p>

        <table class="table table-bordered text-center ">
            <thead class="text-white" style="background-color:rgb(155, 187, 89)">
                <tr>
                    <td colspan='2'>INSCRIPTS</td>
                    <td colspan='2'>ONT COMPOSE</td>
                    <td colspan='2'>ONT LA MOYENNE</td>
                    <td rowspan='2'>POURCENTAGE</td>
                    <td rowspan='2'>MOYENNE CLASSE</td>
                    <td rowspan='2'>MENTION</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>Filles</td>
                    <td>Total</td>
                    <td>Filles</td>
                    <td>Total</td>
                    <td>Filles</td>
                </tr>

            </thead>
            <tbody>
                <?php
                if (sizeof($noteAllElve['dataeleve']) > 0) {
                    if ($periode == '1') {
                        $mention = yii::$app->simplelClass->mentionTrimestre($noteAllElve['moyennepourcent']);

                    } else {
                        $mention = yii::$app->simplelClass->mentionSecondaire($noteAllElve['moyennepourcent']);

                    }
                    echo ' 
                    <tr >
                        <td >' . $noteAllElve['totalclasse'] . '</td>
                        <td >' . $noteAllElve['totalfille'] . '</td>
                        <td >' . $noteAllElve['totalcompose'] . '</td>
                        <td>' . $noteAllElve['totalcomposefille'] . '</td>
                        <td>' . $noteAllElve['onmoyenne'] . '</td>
                        <td >' . $noteAllElve['moyennefille'] . '</td>
                        <td >' . $noteAllElve['moyennepourcent'] . '%</td>
                        <td >' . $noteAllElve['moyenneclasse'] . '</td>
                        <td>' . $noteAllElve['mention'] . '</td>
                  </tr>';
                }
                ?>



            </tbody>
        </table>

        <p style="text-align:center;text-decoration:underline">Classement des résultats par ordre de mérite</p>
            <table class="table table-bordered text-center " style="height:80%;border:1px solid red;margin-top:10px">
            <thead class="text-white" style="background-color:rgb(155, 187, 89)">

                <tr>
                    <td style="font-size:15px;">Rang</td>
                    <td style="font-size:15px;">Nom Complet</td>
                    <td style="font-size:15px;">Moyenne</td>
                    <td style="font-size:15x;">Observation</td>

                </tr>

        </thead>
        <tbody>
            <?php
            // die(var_dump($noteAllElve['dataeleve']));
            if (sizeof($noteAllElve['dataeleve']) > 0) {
                $i = 0;
                foreach ($noteAllElve['dataeleve'] as $key => $value) {
                    $i++;
                    if ($i == 1) {
                        $rang = '1er';
                    } else {
                        $rang = $i . 'eme';
                    }
                    echo '
                           <tr>
                           <td>' . $rang . '</td>
                           <td >' . $value['Nom Complet'] . '</td>
                           <td >' . $value['Moye1'] . '</td>
                           <td >' . $value['mention'] . '</td>
                           
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