<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class PresenceController extends Controller
{


    public function actionAjax()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $ets = yii::$app->mainCLass->getets();
        $anneeActive = yii::$app->mainCLass->getAnneeActive();
        $caseValue = $_POST['action_key'];

        switch ($caseValue) {
            case md5('verifiepresence'):
                $liste = yii::$app->eleveClass->listefiltre($_POST['matricule'], $anneeActive);
                if (sizeof($liste) > 0) {
                    $value = $liste['0'];
                    $presenceeleves = yii::$app->eleveClass->verifiepresnece($value['codeEleve']);
                    if ($presenceeleves) {
                        $heure =  $presenceeleves['heure'];
                    } else {
                        $code = Yii::$app->simplelClass->generateUniq();
                        yii::$app->eleveClass->inserpresence($code, $value['codeEleve'], $ets);
                        $heure = date('H:i:s');
                    }
                    return '
                     <div class="d-flex flex-center justify-content-center mt-2 ">
                                    <div class="profile-widget"  style="width:500px;">
                                        <div class="profile-img"  >
                                          <img class="avatar mb-3" src="' . yii::$app->request->baseUrl . '/web/mainAssets/uploads/' . $value['photo'] . '" alt="" style="width:200px;height: 200px;margin-left:-50px" >
                                        </div>
                                        <div>
                                        <h4 class="user-name m-t-10 m-b-0 text-ellipsis">' . $value['nom'] . ' ' . $value['prenom'] . '</h4>
                                        <br><span>Mariicule:' . $value['matricule'] . '</span>
                                        <br><span>Heure d\'entre:' . $heure . '</span>
                                        <br><span class="badge badge-success text-center">Present</span>
                                       </div>
                                
                                     </div>
                                   
                                </div>
                                        
                            ';
                } else {
                    return 'eleves non trouves';
                }
                return $liste;

                break;
                case  md5('statistiqueprensence'):
                    return $_POST;
                    if ($_POST['ac
                    tion'] == md5('statindividus')) {
                        $ans = yii::$app->eleveClass->stateleveAns();
                        $value = null;
                        $cat = null;
                        $i = 0;
                        $nbE = yii::$app->eleveClass->stateleve();
                        $total = $nbE + 1;
                  
                        return [
                          'eleves' => $nbE,
                          'pesrs' => 1,
                          'total' => $total
                        ];
                  
                      }
                    break;
        }
    }


    public function actionPresence()
    {
        $ets = yii::$app->mainCLass->getets();
        return $this->render('/presence/vuepricipal.php', ['ets' => $ets]);
    }

    public function actionStatistique()
    {
        $ets = yii::$app->mainCLass->getets();
        $liste = yii::$app->eleveClass->actionListclass();

        return $this->render('/presence/statistique.php', ['liste' => $liste]);
    }

    public function actionListe(){
         $ets = yii::$app->mainCLass->getets();
        $liste = yii::$app->eleveClass->listeprensececlasse($_GET['classe']);
         return $this->render('/presence/listeeleve.php', ['liste' => $liste]);

    }
}
