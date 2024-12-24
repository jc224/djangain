<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ImpressionController extends Controller
{
    

   public function actionEleve(){
    $liste = yii::$app->eleveClass->actionListclass();
    $anneeActive  = yii::$app->mainCLass->getAnneeActive();

        if(yii::$app->request->isPost){
            $verso =  Yii::$app->basePath.'/web/mainAssets/images/bg/2.jpg';
            $retro =  Yii::$app->basePath.'/web/mainAssets/images/bg/concinelle.png';
            // $retro ="";
            $liste = yii::$app->eleveClass->listeclassecarte($anneeActive,$_POST['codeclasse']);
            if(sizeof($liste)>0){

                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [54, 85.6]]);
                // $mpdf->showImageErrors = true;

                foreach ($liste as $key => $value) {
                      $photo =  Yii::$app->basePath.'/web/mainAssets/uploads/'.$value['photo'];
                      $classe = yii::$app->configClass->infClasse($_POST['codeclasse']);

                      $qr = yii::$app->simplelClass->codeqreleve($value,$classe);
                        $carte = $this->renderPartial('/impression/eleves/concinelle.php',['qr'=>$qr,'classe'=>$classe,'value'=>$value,'photo'=>$photo,'value'=>$value,'retro'=>$retro,'verso'=>$verso]);
                        $mpdf->WriteHTML($carte); 
                        $mpdf->Output('djangai.pdf','I');

                  

                }
                $mpdf->Output('djangai.pdf','l');

            }
        }
            return $this->render('/impression/eleves/impression.php',['liste'=>$liste,'anneeActive'=>$anneeActive]);
   }

   public function actionCertificat(){
    if(yii::$app->request->isPOst){
       
        Yii::$app->response->format = Response::FORMAT_JSON;   
        $anneeActive  = yii::$app->mainCLass->getAnneeActive();
        $liste = yii::$app->eleveClass->listefiltre($_POST['search'], $anneeActive, "");
        $codeeleves = (isset($liste['0']) ? $liste['0']['codeEleve'] : ''); 
        // return yii::$app->request->baseUrl . '/' . md5('impression_framecertificat') . '/' . $codeeleves;
        $content= '<iframe class="custom-iframe" src="'.yii::$app->request->baseUrl . '/' . md5('impression_framecertificat') . '/' . $codeeleves.'" frameborder="0" allowfullscreen></iframe>';
        return $content;
    }
      return $this->render('/impression/certificifcat/eleves.php');

   }


   public function actionFramecertificat(){
        // die('ok');
        $anneeActive  = yii::$app->mainCLass->getAnneeActive();
        // $liste = yii::$app->eleveClass->listefiltre($_GET['code'], $anneeActive, "")['0'];
        $eleves = yii::$app->eleveClass->infoeleve($anneeActive, $_GET['code']);
        return $this->render('/impression/certificifcat/pdf.php');

   }
      
}
