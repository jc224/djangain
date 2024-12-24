<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class CommunicationController extends Controller
{


    public function actionAjax()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $ets = yii::$app->mainCLass->getets();
        $anneeActive = yii::$app->mainCLass->getAnneeActive();
        $caseValue = $_POST['action_key'];
        $ets = yii::$app->mainCLass->getets();

        switch ($caseValue) {
            case md5('filtrepaiement'):
                // return $_POST;

                $liste = yii::$app->comptabiliteClass->selectalertpaiement($anneeActive,$_POST['acte'],$ets,$_POST['classe']);
                $contenuemessage = '';
                $content = '';
                $message = yii::$app->eleveClass->sellaalmesage($_POST['acte'], $ets, $anneeActive);
                if (sizeof($message) > 0) {
                    foreach ($message as $key => $value) {
                        $contenuemessage .= '
                      <div class="chat-bubble">
                                                                <div class="chat-content">
                                                                    <p>' . $value['message'] . '</p>
                                                                    <span class="chat-time">' . $value['dateenvoie'] . '</span>
                                                                </div>
                                                            </div>
                      ';
                    }
                } else {
                    $contenuemessage = '  <div class="chat-bubble">
                                                                <div class="chat-content">
                                                                    <p>Message vide</p>
                                                                    <p>Veuillez saisre un  message et envoyer</p>
                                                                    
                                                                </div>
                                                            </div>';
                }

                if (sizeof($liste) > 0) {
                    foreach ($liste as $key => $value) {
                        $content .= '
                            <p>' . $value['telTuteur'] . '</p> <input type="hidden" name="tel[]" value="' . $value['telTuteur'] . '">
                       ';
                    }
                }
                return ['content' => $content, 'contenuemessage' => $contenuemessage];

            break;
            case md5('filtrepersonnel'):
                switch ($_POST['groupe']) {
                    case '1':
                        $liste = yii::$app->eleveClass->slectalltuteur($ets, $anneeActive);
                        $message = yii::$app->eleveClass->sellaalmesage('1', $ets, $anneeActive);
                        break;
                    case '3':
                        $liste = yii::$app->eleveClass->slectalltuteur($ets, $anneeActive);
                        $message = yii::$app->eleveClass->sellaalmesage('3', $ets, $anneeActive);
                        break;
                    case '2':
                        $liste = yii::$app->personnelClass->selaalproffeseur($ets, $anneeActive);
                        $message = yii::$app->eleveClass->sellaalmesage('2', $ets, $anneeActive);

                        break;
                    default:
                        $liste = yii::$app->eleveClass->selectgroupuser($ets, $_POST['groupe']);
                        $message = yii::$app->eleveClass->sellaalmesage($_POST['groupe'], $ets, $anneeActive);

                        break;
                }
                $contenuemessage = '';
                $content = '';
                if (sizeof($message) > 0) {
                    foreach ($message as $key => $value) {
                        $contenuemessage .= '
                      <div class="chat-bubble">
                                                                <div class="chat-content">
                                                                    <p>' . $value['message'] . '</p>
                                                                    <span class="chat-time">' . $value['dateenvoie'] . '</span>
                                                                </div>
                                                            </div>
                      ';
                    }
                } else {
                    $contenuemessage = '  <div class="chat-bubble">
                                                                <div class="chat-content">
                                                                    <p>Message vide</p>
                                                                    <p>Veuillez saisre un  message et envoyer</p>
                                                                    
                                                                </div>
                                                            </div>';
                }
                if (sizeof($liste) > 0) {
                    foreach ($liste as $key => $value) {
                        $content .= '
                            <p>' . $value['tel'] . '</p> <input type="hidden" name="tel[]" value="' . $value['tel'] . '">
                       ';
                    }
                }
                return ['content' => $content, 'contenuemessage' => $contenuemessage];

                break;
        }
    }


    public function actionCanalcommunication()
    {
        $users = Yii::$app->mainCLass->getAlltableData('dj_typeusers');
        $ets = yii::$app->mainCLass->getets();
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();

        if (Yii::$app->request->isPost) {
            // die(var_dump($_POST));
            $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);
            if (isset($_POST['tel'])  && sizeof($_POST['tel'])) {
                foreach ($_POST['tel'] as $key => $value) {
                    $tel = '224' . $value;
                    yii::$app->simplelClass->envoieSms($infoets['nomEtbs'], $_POST['message'], $tel);
                }
                $code = Yii::$app->simplelClass->generateUniq();
                yii::$app->eleveClass->insertcomunication($code, $ets, $anneeActive, $_POST['message'], $_POST['groupe']);
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'Message envoyer avec succes'));
                Yii::$app->session->setFlash('flashmsg', $notification);
            }else{
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['erreur'], yii::t('app', 'Erreur d\'envoie'));
                Yii::$app->session->setFlash('flashmsg', $notification);
            }
           
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('/communication/canal/vuepricipal.php', ['ets' => $ets, 'users' => $users]);
    }

    public function actionBienvenue(){
        // die('ok');
        // return $this->render('/communication/alert.php');
    }

    public function actionComptabilite(){
        
        $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');
        $paiement = Yii::$app->mainCLass->getAlltableData('dj_payement');
        $ets = yii::$app->mainCLass->getets();
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();

        // die(var_dump($paiement));
        if (Yii::$app->request->isPost) {
            // die(var_dump($_POST));
            $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);
            if (isset($_POST['tel'])  && sizeof($_POST['tel'])) {
                foreach ($_POST['tel'] as $key => $value) {
                    $tel = '224' . $value;
                    yii::$app->simplelClass->envoieSms($infoets['nomEtbs'], $_POST['message'], $tel);
                }
                $code = Yii::$app->simplelClass->generateUniq();
                yii::$app->eleveClass->insertcomunication($code, $ets, $anneeActive, $_POST['message'], $_POST['acte']);
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'Message envoyer avec succes'));
                Yii::$app->session->setFlash('flashmsg', $notification);
            }else{
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['erreur'], yii::t('app', 'Erreur d\'envoie'));
                Yii::$app->session->setFlash('flashmsg', $notification);
            }
           
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('/communication/comptailite.php',['classe'=>$classe,'paiement'=>$paiement]);
        
    }

    public function actionIndividuelle(){
        $ets = yii::$app->mainCLass->getets();
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();

        if (Yii::$app->request->isPost) {
            $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);
            $tel = '224' . $_POST['tel'];
            yii::$app->simplelClass->envoieSms($infoets['nomEtbs'], $_POST['message'], $tel);
            $code = Yii::$app->simplelClass->generateUniq();
            yii::$app->eleveClass->insertcomunication($code, $ets, $anneeActive, $_POST['message'], 'individuelle');
            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'Message envoyer avec succes'));
            Yii::$app->session->setFlash('flashmsg', $notification);
        }
        $message = yii::$app->eleveClass->sellaalmesage('individuelle', $ets, $anneeActive);

      return $this->render('/communication/alert.php',['message'=>$message]);  
    }
}
