<?php
$code = yii::$app->mainCLass->getets();
$infoets = yii::$app->mainCLass->unidata('dj_etbs', $code);

?>


<div class="row">
    <table style="margin-top:10px; border:0px solid black   ;">
        <tr style=" border:0px solid black ">
            <td style=" border:0px solid black ">
                <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 60px;">
            </td>
            <td colspan="4" style=" border:0px solid black;text-align:center ">

                <p> <?= $infoets['nomEtbs'] ?> – <?= $infoets['addresse'] ?> -
                    Tel : <?= $infoets['tel'] ?> – e-mail :<?= $infoets['email'] ?>
                </p>
            </td>
            <td style=" border:0px solid black ">
                <img src="<?= yii::$app->basePath ?>/web/mainAssets/uploads/<?= $infoets['logo'] ?>" alt="" style=" width: 60px;">

            </td>
        </tr>

    </table>
</div>