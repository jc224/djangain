<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class ParentsController extends Controller
{


    public function actionAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isPost) {
            switch ($_POST['action_key']) {
                case 'presence':
                    $infoclasse = yii::$app->configClass->geteinfoetsforeleves($_POST['codeeleve']);
                    $codeanne = $infoclasse['codeAnnee'];
                    $codeclasse = $infoclasse['codeClasse'];
                    $codeindividue = $infoclasse['codeEleve'];
                    $codeetbs = $infoclasse['codeetbs'];
                    $hisprence = Yii::$app->eleveClass->presenceFordata($codeindividue, $codeetbs);
                    $data = [];
                    $i = 0;
                    $date = [];
                    $j = 0;
                    if (sizeof($hisprence) > 0) {

                        foreach ($hisprence as $key => $value) {

                            $date[$j] = [
                                'start' => $value['dataajout'],
                                'end' => $value['dataajout'],
                            ];

                            $j++;
                            $data[$i] = [
                                'title' => 'Entrer',
                                'start' => $value['dataajout'] . 'T' . $value['heure'],
                                'end' => $value['dataajout'] . 'T' . $value['heure'],
                            ];

                            $i++;
                        }
                    }
                    return  ['data' => $data, 'date' => $date, 'code' => $codeindividue];

                    break;

                default:
                    # code...
                    break;
            }
        }
    }


    public function actionEncadrer()
    {
        $userCode = yii::$app->mainCLass->getusers();


        $infoparents =   yii::$app->mainCLass->databycode('dj_lien_parent_eleve', $userCode, 'codeparent');
        //  die(var_dump($infoparents));

        // listeparents($telTuteur);
        return $this->render('/parent/encadre.php', ['listeparents' => $infoparents]);
    }



    public function actionEmploie()
    {
        $userCode = yii::$app->mainCLass->getusers();
        $anneeActive = yii::$app->mainCLass->getAnneeActive();


        $infoparents =   yii::$app->mainCLass->databycode('dj_lien_parent_eleve', $userCode, 'codeparent');
        //  die(var_dump($infoparents));
        if (Yii::$app->request->isPost) {
            $infoeleve =  yii::$app->eleveClass->infoeleve($anneeActive, $_POST['code']);


            $emploie = Yii::$app->configClass->selectemploidutempps($infoeleve['codeClasse'], $anneeActive);
            return $this->render('/emploie/listedetais', ['emploie' => $emploie]);
        }
        // listeparents($telTuteur);
        return $this->render('/parent/encadreformemploie.php', ['listeparents' => $infoparents]);
    }

    public function actionPresence()
    {
        $userCode = yii::$app->mainCLass->getusers();
        $infoparents =   yii::$app->mainCLass->databycode('dj_lien_parent_eleve', $userCode, 'codeparent');

        return $this->render('/parent/presence/encadrer.php', ['listeparents' => $infoparents]);
    }
}
