<?php

namespace app\controllers;

use Mpdf\Mpdf;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class RapportController extends Controller
{

    public function actionResultat()
    {
        $this->layout = false;

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => '4',
            'margin_right'=> '4',
            'margin_top' =>'4',
            'margin_bottom'=>'4',
            // 'orientation' => 'L'
        ]);
        $mpdf->showImageErrors = true;
        $mpdf->SetDisplayMode('fullpage');
        $filname = 'filename';
        $pdf = $this->renderPartial('/repports/result/primesemsestre.php');
        $mpdf->WriteHTML($pdf);
        $mpdf->Output('wamy.pdf', 'I');
    }
}
