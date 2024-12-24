<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class EmploieController extends Controller
{

    public function actionEmploie()
    {
        $ets = yii::$app->mainCLass->getets();
        $liste = Yii::$app->configClass->listClasse($ets);
        if (Yii::$app->request->isPost) {
            if ($_POST['action'] == md5('imprimer')) {

                $infoemploie = Yii::$app->configClass->selectemploifrcode($_POST['code']);
                $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'orientation' => 'L',
                    'margin_left' => 2,
                    'margin_right' => 2,
                    'margin_top' => 2,
                    'margin_bottom' => 30,
                    'margin_header' => 10,
                    'margin_footer' => 10,


                ]);
                $pdf = $this->renderPartial('/emploie/pdf/emploie.php', ['infoemploie' => $infoemploie,'infoets'=>$infoets]);
                // $footer = $this->renderPartial('/evalresul/detailstrimestrepdffooter.php');
                // $mpdf->showImageErrors = true;

                // $mpdf->SetHTMLFooter($footer);
                // $mpdf->SetHTMLFooter($footer, 'E');

                $mpdf->WriteHTML($pdf);
                $mpdf->SetDisplayMode('fullpage');
                $mpdf->Output('emploie_' . date('Y-m-d') . '.pdf', 'I');
            }
            // die(var_dump($_POST));
        }
        // die(var_dump($liste));
        return $this->render('/emploie/liste.php', ['liste' => $liste]);
    }


    public function actionListe()
    {
        $anneeActive = yii::$app->mainCLass->getAnneeActive();

        if (Yii::$app->request->isGet) {
            if (isset($_GET['code'])) {

                $emploie = Yii::$app->configClass->selectemploidutempps($_GET['code'], $anneeActive);
                return $this->render('/emploie/listedetais', ['emploie' => $emploie]);
            }
        }
    }
    public function actionAjouter()
    {
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
        $ets = yii::$app->mainCLass->getets();
        $liste = Yii::$app->configClass->listClasse($ets);
        if (Yii::$app->request->isPost) {
            $code = Yii::$app->simplelClass->generateUniq();

            foreach ($_POST['heure'] as $key => $value) {
                // die(var_dump($_POST));
                if ($value == '8H-9H') {
                    foreach ($_POST['matiere1'] as $key => $mat) {
                        if (!empty($mat)) {
                            Yii::$app->configClass->insertemploie($code, $mat, $_POST['classe'], $anneeActive, $value, $_POST['debut'], $_POST['fin'], $_POST['jours1'][$key]);
                            // die(var_dump($_POST['jours'][$key]));
                        }
                    }
                }
                if ($value == '9H-10H') {
                    foreach ($_POST['matiere2'] as $key => $mat) {
                        if (!empty($mat)) {
                            Yii::$app->configClass->insertemploie($code, $mat, $_POST['classe'], $anneeActive, $value, $_POST['debut'], $_POST['fin'], $_POST['jours2'][$key]);
                            // die(var_dump($_POST['jours'][$key]));
                        }
                    }
                }

                if ($value == '10H-11H') {
                    foreach ($_POST['matiere3'] as $key => $mat) {
                        if (!empty($mat)) {
                            Yii::$app->configClass->insertemploie($code, $mat, $_POST['classe'], $anneeActive, $value, $_POST['debut'], $_POST['fin'], $_POST['jours3'][$key]);
                            // die(var_dump($_POST['jours'][$key]));
                        }
                    }
                }
                if ($value == '11H-12H') { {
                        foreach ($_POST['matiere4'] as $key => $mat) {
                            if (!empty($mat)) {
                                Yii::$app->configClass->insertemploie($code, $mat, $_POST['classe'], $anneeActive, $value, $_POST['debut'], $_POST['fin'], $_POST['jours4'][$key]);
                                // die(var_dump($_POST['jours'][$key]));
                            }
                        }
                    }
                }

                if ($value == '12H-13H') { {
                        foreach ($_POST['matiere5'] as $key => $mat) {
                            if (!empty($mat)) {
                                Yii::$app->configClass->insertemploie($code, $mat, $_POST['classe'], $anneeActive, $value, $_POST['debut'], $_POST['fin'], $_POST['jours5'][$key]);
                                // die(var_dump($_POST['jours'][$key]));
                            }
                        }
                    }
                }
                if ($value == '13H-14H') { {
                        foreach ($_POST['matiere6'] as $key => $mat) {
                            if (!empty($mat)) {
                                Yii::$app->configClass->insertemploie($code, $mat, $_POST['classe'], $anneeActive, $value, $_POST['debut'], $_POST['fin'], $_POST['jours6'][$key]);
                                // die(var_dump($_POST['jours'][$key]));
                            }
                        }
                    }
                }
                if ($value == '14H-15H') { {
                        foreach ($_POST['matiere7'] as $key => $mat) {
                            if (!empty($mat)) {
                                Yii::$app->configClass->insertemploie($code, $mat, $_POST['classe'], $anneeActive, $value, $_POST['debut'], $_POST['fin'], $_POST['jours7'][$key]);
                                // die(var_dump($_POST['jours'][$key]));
                            }
                        }
                    }
                }

                if ($value == '15H-16H') { {
                        foreach ($_POST['matiere8'] as $key => $mat) {
                            if (!empty($mat)) {
                                Yii::$app->configClass->insertemploie($code, $mat, $_POST['classe'], $anneeActive, $value, $_POST['debut'], $_POST['fin'], $_POST['jours8'][$key]);
                                // die(var_dump($_POST['jours'][$key]));
                            }
                        }
                    }
                }
            }
            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('/emploie/ajouter.php', ['classe' => $liste]);
    }


    public function actionAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $anneeActive = yii::$app->mainCLass->getAnneeActive();
        $userCode = yii::$app->mainCLass->getusers();
        if (yii::$app->request->isPOst) {

            if ($_POST['action_key'] == md5('1')) {
                $matiere = yii::$app->evaluationClass->infoclasse($_POST['code']);

                $libmatiere = '';
                if (sizeof($matiere) > 0) {
                    $libmatiere .= '<option value="" hidden></option>';
                    foreach ($matiere as $key => $value) {
                        $libmatiere .= '<option  value="' . $value['codeMatiere'] . '">' . $value['libelle'] . '</option>';
                    }
                }
                return $libmatiere;
            }
        }
    }
}
