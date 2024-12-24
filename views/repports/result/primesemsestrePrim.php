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
        position: relative;
        background-position: center;
        background-size: cover;
        width: 5%;
        height: 75%;


    }

    .lefth {

        width: 80%;


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
        border: 1px solid rgb(155, 187, 89);

    }

    .table thead td {
        border: 1px solid white;

    }

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
        border: 1px solid rgb(155, 187, 89);
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
//die(yii::$app->basePath."/web/mainAssets/logo/logowamy.png");
$periodeAlpha = yii::$app->simplelClass->selectPeriode($periode);

?>
<table style="margin-top:20px; border:0px solid black   ;">
    <tr style="border:0px solid black ">
        <td style="border:0px solid black ">
            <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 80px;">
        </td>
        <td colspan="4" style=" border:0px solid black; padding-left:20%;padding-right:20%;text-align:center ">
            <p style="font-size:20px">REPUBLIQUE DE GUINEE</p>
            <p><span style="color:red;">Travail-</span><span style="color:yellow;">Justice-</span><span
                    style="color:green;">Solidarité</span></p>
            <div style=" border-bottom:1px solid black"><u></u> </div>
            <p style="padding-top:10px;"><?= $infoets['ire'] ?></p>
            <p class=""><?= $infoets['nomEtbs'] ?></p>
        </td>
        <td style="border:0px solid black ">
            <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 80px;">

        </td>
    </tr>

</table>

<h2 style="text-align: center; font-weight:bold;margin-top:-1px;">BULLETIN DE NOTES</h2>

<div class="row">
  
    <div class="col">
        <div class="row">
            <div class="col lefth">
                <p> <span style="font-size: 15px; font-weight: bold;">Niveau: </span> <span>
                        <?= $classe["libClasse"] ?></span><br>
                    <span style="font-size: 15px; font-weight: bold;">Classe: </span>
                    <span><?= $classe["libelle"] ?></span><br>
                    <span style="font-size: 15px; font-weight: bold;">Nom Comlet: </span> <span>
                        <?= $info['nom'] . ' ' . $info['prenom'] ?></span><br>
                    <span style="font-size: 15px; font-weight: bold;">Periode: </span>
                    <span><?= $periodeAlpha   ?></span>
                </p>
            </div>
            <div class="col leftg">
                <img class="avatar-img rounded-circle" style="width:80px;height:80px;padding-top:20px;"
                    src="<?= yii::$app->basePath . '/web/mainAssets/uploads/' . $info['photo'] ?>" alt="ELEVES Image">
            </div>
        </div>
        <table class="table table-bordered text-center " style="height:60%;">
            <thead class="text--white" style="font-size:1.2=rem;">
                <tr style="background-color:rgb(155, 187, 89)">
                    <td colspan='2' class="text-white" style="width:250px;">MATIERES</td>
                    <td class="text--white " style="padding-top:10px;padding-rihgt:5px">Coef</td>
                    <td class="text--white">Moyenne cours</td>
                    <td class="text--white">Moyenne composition</td>
                    <td class="text--white" colspan="2" style="width:300px;">OBSERVATION</td>
                </tr>

            </thead>
            <tbody>

                <?php
                $coefgen = 0;
                $minimun = 0;
                $cours1 = 0;
                $comp1 = 0;
                $moyenneGen = 0;
                $cours2 = 0;
                $comp2 = 0;
                $moyenneGen2 = 0;
                $mgeneral = 0;
                $totalsemestre1 = 0;
                $totalsemestre2 = 0;
                $ranggent = 0;
                $rangmin = $rangmin = 0;
                //moy/20
                $j = 0;
                $moyenneT1 = 0;
                $moyenneT2 = 0;
                $i = 0;
                $k = 0;
                $dataSem1 = null;
                $dataMoy = 0;
                $dataSem2 = null;
                if (sizeof($matiere) > 0) {
                    $i = 0;


                    foreach ($matiere as $key => $value) {
                        echo '  
                            <tr class="text-dark">
                            <td colspan="2">' . $value['libelle'] . '</td>
                            <td>' . $value['coef'] . '</td>';
                        $moy = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], $periode, $anneeActive);
                        $coefgen = $coefgen + $value['coef'];
                        if ($moy == false) {
                            $dataSem1[$i] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                            $i++;
                            echo '
                                 <td>0</td>
                                <td>0</td>
                      
                                  ';
                        } else {

                            $cours = yii::$app->simplelClass->moyenne($moy['note1'], $moy['note2'], $moy['note3'], $periode);
                            $cours1 = $cours1 + $cours;
                            $comp1 = $comp1 +  $moy['composition'];
                            $dataSem1[$i] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy['composition'], 'moy' => round(($cours + $moy['composition']) / 2, 2)];
                            $i++;
                            $moyenne1 = yii::$app->simplelClass->moyenneMoyennegenral($cours, $moy['composition']);

                            $moyenneGen = $moyenneGen + $moyenne1;
                            $totalsemestre1 += $moyenne1;
                            echo ' <td>' . $cours . '</td>
                                    <td>' . $moy['composition'] . '</td>';
                        }
                    }
                }


                $moyenneT1 =  yii::$app->simplelClass->moySemestre($dataSem1, '1');

                $mentionS1 = yii::$app->simplelClass->mentionTrimestre($moyenneT1['moyenneGenerale']);
                switch ($periode) {
                    case '1':
                        $ranggent = $rang['rang1'];
                        $rangmin = $rang['min1'];
                        $rangmax = $rang['max1'];
                        break;
                    case '2':
                        $ranggent = $rang['rang2'];
                        $rangmin = $rang['min2'];
                        $rangmax = $rang['max2'];
                        break;
                    case '3':
                        $ranggent = $rang['rang3'];
                        $rangmin = $rang['min3'];
                        $rangmax = $rang['max3'];
                        break;
                    case '4':
                        $ranggent = $rang['rang1'];
                        $rangmin = $rang['min1'];
                        $rangmax = $rang['max1'];
                        break;
                    case '5':
                        $ranggent = $rang['rang2'];
                        $rangmin = $rang['min2'];
                        $rangmax = $rang['max2'];
                        break;

                    default:
                        # code...
                        break;
                }
                ?>
                <tr class="text-dark">
                    <td class="text-start" colspan="2">
                        Total</td>
                    <td><?= $coefgen ?></td>
                    <td><?= $moyenneT1['Totalcours'] ?></td>
                    <td><?= $moyenneT1['totalCompo'] ?></td>
                </tr>
                <tr class="text-dark">
                    <td class="text-start" colspan="4">
                        Moyenne/10</td>
                    <td><?= $moyenneT1['moyenneGenerale'] ?></td>
                </tr>
                <tr class="text-dark">
                    <td colspan="4">Rang</td>
                    <td><?= $ranggent ?></td>
                </tr>
                <tr class="text-dark">
                    <td colspan="4">Mention</td>
                    <td><?= $mentionS1 ?></td>
                </tr>
                <tr class="text-dark">
                    <td colspan="3" rowspan="2">Moyyenne General</td>
                    <td>Max</td>
                    <td><?= $rangmax ?></td>
                </tr>
                <tr class="text-dark">
                    <td>Min</td>
                    <td><?= $rangmin ?></td>
                </tr>
                <tr class="text-dark">
                    <td style="padding-bottom:1rem;padding-top:1rem" colspan="3" rowspan="1 ">Le proffesseur Principal
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr class="text-dark">
                    <td style="padding-bottom:1rem;padding-top:1rem" colspan="3" rowspan="1 ">Le Directeur des Études
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr class="text-dark">
                    <td style="padding-bottom:1rem;padding-top:1rem" colspan="3" rowspan="1 ">Signature des parents</td>
                    <td colspan="2"></td>
                </tr>
                <tr class="text-dark">
                    <td style="padding-bottom:1.5rem;padding-top:1.5rem" colspan="3" rowspan="1 ">Signature et Cachet du
                        Directeur</td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>

    </div>

</div>