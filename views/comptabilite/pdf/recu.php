<style>
    .header {
        text-align: center;
        font-size: 20px;
        margin-bottom: 20px;
    }

    .content {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .footer {
        text-align: right;
        font-size: 14px;
        margin-top: 20px;
    }

    .logo {
        text-align: center;
        margin-bottom: 20px;
    }

    .signature {
        margin-top: 50px;
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

        width: 60%;


    }

    .start {

        width: 20%;


    }

    p {
        font-size: 12px;
        padding-top: -12px;

    }

    .paiement {
        font-size: 14px;
    }
</style>


<div class="header">


    <div class="row">
        <div class="col start">
            <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 80px;">

        </div>
        <div class="col lefth">
            <h4><?= $infoets['nomEtbs'] ?></h4>
            <p>Sis: à <?= $infoets['addresse'] ?> </p>
            <p>Tel: <?= $infoets['tel'] ?> Email: <?= $infoets['email'] ?></p>
            <p>Acte Payer : <?= $acte ?></p>

        </div>
        <div class="col leftg" style="margin-top: 10px;">
            <p style="padding-top:10px"><span>DATE : <?= $infopiement['datePayement'] ?></span></p>
            <img src="<?= $qrimage ?>" alt="ELEVES Image" width="90px">

        </div>
    </div>

</div>

<div>
    <h3 style="text-align:center;padding-top: -30px;">RECU DE PAIEMENT SCOLAIRE </h3>
</div>
<div class="content">
    <div class="row">
        <div class="col" style="width: 40%;">
            Reçu de :<?= $infoeleve['nom'] . ' ' . $infoeleve['prenom'] ?>
        </div>
        <div class="col" style="width: 25%;">
            Matricule : <?= $infoeleve['matricule'] ?>
        </div>
        <div class="col" style="width: 25%;text-align: right;">
            Classe : <?= $classe ?>
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col" style="width: 40%;">
            <p class="paiement">Montant à payer <br>
                <?= number_format(abs($infopiement['montant'] - $infopiement['restePayer']), 0, '.', '.') ?>F</p>
        </div>
        <div class="col" style="width: 25%;text-align: cent">
            <p class="paiement"> Montant payer <br> <?= number_format($infopiement['montant'], 0, '.', '.') ?> GNF </p>
        </div>
        <div class="col" style="width: 25%;text-align: right;">
            <p class="paiement"> Reste a payer <br> <?= number_format($infopiement['restePayer'], 0, '.', '.') ?> GNF </p>
        </div>
    </div>

</div>
<div class="footer">


    <div class="row">
        <p style="text-align:right;padding-right:25px;margin-bottom:30px">Le Comptable </p>

        <br>
    </div>
</div>

<hr>
<div class="header">


    <div class="row">
        <div class="col start">
            <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 80px;">

        </div>
        <div class="col lefth">
            <h4><?= $infoets['nomEtbs'] ?></h4>
            <p>Sis: à <?= $infoets['addresse'] ?> </p>
            <p>Tel: <?= $infoets['tel'] ?> Email: <?= $infoets['email'] ?></p>
            <p>Acte Payer : <?= $acte ?></p>

        </div>
        <div class="col leftg" style="margin-top: 10px;">
            <p style="padding-top:10px"><span>DATE : <?= $infopiement['datePayement'] ?></span></p>
            <img src="<?= $qrimage ?>" alt="ELEVES Image" width="90px">

        </div>
    </div>

</div>
<div>
    <h3 style="text-align:center;padding-top: -30px;">RECU DE PAIEMENT SCOLAIRE </h3>
</div>
<div class="content">
    <div class="row">
        <div class="col" style="width: 40%;">
            Reçu de :<?= $infoeleve['nom'] . ' ' . $infoeleve['prenom'] ?>
        </div>
        <div class="col" style="width: 25%;">
            Matricule : <?= $infoeleve['matricule'] ?>
        </div>
        <div class="col" style="width: 25%;text-align: right;">
            Classe : <?= $classe ?>
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col" style="width: 40%;">
            <p class="paiement">Montant à payer <br>
                <?= number_format(abs($infopiement['montant'] - $infopiement['restePayer']), 0, '.', '.') ?>F</p>
        </div>
        <div class="col" style="width: 25%;text-align: cent">
            <p class="paiement"> Montant payer <br> <?= number_format($infopiement['montant'], 0, '.', '.') ?> GNF </p>
        </div>
        <div class="col" style="width: 25%;text-align: right;">
            <p class="paiement"> Reste a payer <br> <?= number_format($infopiement['restePayer'], 0, '.', '.') ?> GNF </p>
        </div>
    </div>

</div>
<div class="footer">


    <div class="row">
        <p style="text-align:right;padding-right:25px;margin-bottom:30px">Le Comptable </p>

        <br>
    </div>
</div>
