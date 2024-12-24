<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class EtablissementController extends Controller
{
    //personnelc class
    public function actionListe()
    {
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        if (yii::$app->request->isPost) {
            switch ($_POST['action']) {
                case md5(strtolower("activer")):
                    $infoadmin = Yii::$app->mainCLass->databycode('dj_admins', $_POST['code'], 'codeetbs');
                    Yii::$app->configClass->updateetatets($_POST['code'], '1');
                    $infoets = yii::$app->mainCLass->unidata('dj_etbs', $_POST['code']);
                    // die(var_dump(empty($infoadmin)));
                    if (empty($infoadmin)) {
                        $code = Yii::$app->simplelClass->generateUniq();
                        $tableName = 'dj_admins';
                        $columnValue["code"] = $code;
                        $columnValue["admin_name"] = 'admin';
                        $columnValue["admin_email"] = $infoets['email'];
                        $columnValue["tel"] = $infoets['tel'];
                        $columnValue["codeetbs"] = $infoets['code'];
                        $columnValue["admin_type"] = '5c8188f3915e5b8206ce6657f80176043c3184763053bf8a';
                        $columnValue["created_at"] = date('Y-m-d');
                        $lien = yii::$app->request->baseurl . '/' . md5('visiteur_finaliser') . '/' . $code;
                        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                            $url = "https";
                        } else {
                            $url = "http";
                        }
                        $url .= "://";
                        $_SERVER['REQUEST_URI'] = $lien;
                        $url .= $_SERVER['HTTP_HOST'];
                        $url .= $_SERVER['REQUEST_URI'];
                        $tel = '224' . $_POST['tel'];


                        $main->insertData($tableName, $columnValue);
                        die($url);

                        yii::$app->simplelClass->envoieSms('djangain', "cliquez sur le lien suivant pour finaliser la creation de votre compte  $url", $_POST['tel']);
                    }
                    break;

                default:
                    $codeets = Yii::$app->simplelClass->generateUniq();
                    Yii::$app->configClass->insertets($codeets, $_POST['nom'], $_POST['Email'], $_POST['tel'], $_POST['commune'], $_POST['adresse']);
                    $code = Yii::$app->simplelClass->generateUniq();

                    $tableName = 'dj_admins';
                    $columnValue["code"] = $code;
                    $columnValue["admin_name"] = 'admin';
                    $columnValue["admin_email"] = $_POST['Email'];
                    $columnValue["tel"] = $_POST['tel'];
                    $columnValue["codeetbs"] = $codeets;
                    $columnValue["admin_type"] = '5c8188f3915e5b8206ce6657f80176043c3184763053bf8a';
                    $columnValue["created_at"] = date('Y-m-d');
                    $lien = yii::$app->request->baseurl . '/' . md5('visiteur_finaliser') . '/' . $code;
                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                        $url = "https";
                    } else {
                        $url = "http";
                    }
                    $url .= "://";
                    $_SERVER['REQUEST_URI'] = $lien;
                    $url .= $_SERVER['HTTP_HOST'];
                    $url .= $_SERVER['REQUEST_URI'];
                    $tel = '224' . $_POST['tel'];


                    $main->insertData($tableName, $columnValue);
                    die($url);

                    yii::$app->simplelClass->envoieSms('djangain', "cliquez sur le lien suivant pour finaliser la creation de votre compte  $url", $_POST['tel']);

                    return $this->redirect(Yii::$app->request->referrer);
                    $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                    break;
            }
        }
        $ets =    Yii::$app->configClass->etbs();
        return $this->render('/etablissement/liste.php', ['ets' => $ets]);
    }
}
