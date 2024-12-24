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

class EvaluationController extends Controller
{


    public function actionCompositionprof()
    {
        $anneeActive = yii::$app->mainCLass->getAnneeActive();
        $userCode = yii::$app->mainCLass->getusers();
        $classe = yii::$app->personnelClass->selectlisteclasseforprof($anneeActive, $userCode);
        if (yii::$app->request->isPost) {
            switch ($_POST['action']) {

                case md5(strtolower("search")):
                    $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');
                    $liste = Yii::$app->evaluationClass->selectEvalforclasse($anneeActive, $_POST['classetSearch']);
                    // die(var_dump($liste));

                    return $this->render('/composition/vueprincipal.php', ['post' => $_POST, 'classe' => $classe]);

                    break;

                default:
                    # code...
                    break;
            }
        }

        return $this->render('/composition/compositionp.php', ['classe' => $classe]);
    }

    public function actionGevalprof()
    {
        $anneeActive = yii::$app->mainCLass->getAnneeActive();
        $userCode = yii::$app->mainCLass->getusers();
        $classe = yii::$app->personnelClass->selectlisteclasseforprof($anneeActive, $userCode);


        return $this->render('/evaluation/gevaluation.php', ['classe' => $classe]);
    }
    public function actionOrganiser()
    {
        $anneeActive  = yii::$app->mainCLass->getAnneeActive();
        $ets = yii::$app->mainCLass->getets();

        if (yii::$app->request->isPost) {


            switch ($_POST['action']) {


                case md5(strtolower("exportpdf")):
                    $classe = $_POST['classeData'];

                    $periode = $_POST['periodeData'];
                    $isteElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $_POST['code']);
                    $periode = Yii::$app->simplelClass->selectPeriode($_POST['periodeData']);
                    $codePeriode = $_POST['periodeData'];
                    $annee = Yii::$app->mainCLass->unidata('dj_anneescolaire', $anneeActive);
                    $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                    $matiere = $_POST['matiereData'];
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
                    $pdf = $this->renderPartial('/evaluation/fichenote.php', ['codePeriode' => $codePeriode, 'matiere' => $matiere, 'classe' => $classe, 'annee' => $annee['libelle'], 'listeElevee' => $isteElevee, 'periode' => $periode, 'infoets' => $infoets]);
                    $footer = $this->renderPartial('/evalresul/detailstrimestrepdffooter.php');
                    $mpdf->showImageErrors = true;

                    $mpdf->SetHTMLFooter($footer);
                    $mpdf->SetHTMLFooter($footer, 'E');

                    $mpdf->WriteHTML($pdf);
                    $mpdf->SetDisplayMode('fullpage');
                    $mpdf->Output('print.pdf', 'I');


                    break;
                case md5(strtolower("modifieraddnote")):


                    if (sizeof($_POST['matricule']) > 0) {
                        foreach ($_POST['matricule'] as $key => $value) {

                            if (isset($_POST['notea3'][$key])) {

                                $note3 = $_POST['notea3'][$key];
                            } else {
                                $note3 = 0;
                            }
                            $verifier = Yii::$app->evaluationClass->infoEval($value, $_POST['codeEvaluation']);
                            // die(var_dump($verifier));
                            $code = Yii::$app->simplelClass->generateUniq();
                            // die(var_dump($_POST['codeEvaluation']));
                            if ($verifier) {
                                //  die(var_dump($_POST['moy1'][$key]));
                                $query = Yii::$app->evaluationClass->Updatenote($verifier['matricule'], $verifier['composition'], $verifier['codeEva'], $_POST['notea1'][$key], $_POST['notea2'][$key], $note3);
                            } else {
                                Yii::$app->evaluationClass->insertNote($code, $value, $_POST['notea1'][$key], $_POST['notea2'][$key], $note3, $_POST['codeEvaluation']);
                            }
                        }
                    }

                    $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);

                    break;
                case md5(strtolower("search")):
                    $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');
                    $liste = Yii::$app->evaluationClass->selectEvalforclasse($anneeActive, $_POST['classetSearch']);
                    // die(var_dump($liste));
                    return $this->render('/evaluation/evaluation.php', ['post' => $_POST, 'liste' => $liste, 'classe' => $classe]);

                    break;

                case md5(strtolower("modifiereval")):
                    // die(var_dump(($_POST)));
                    $anneeActive  = yii::$app->mainCLass->getAnneeActive();


                    $infoEva = Yii::$app->evaluationClass->selecuniquetEval($_POST['codeEva']);

                    $listeElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $infoEva['codeClasse']);
                    // die(var_dump($listeElevee));

                    return $this->render('/evaluation/ajoutnote.php', ['listeElevee' => $listeElevee, 'infoEva' => $infoEva]);

                    break;
                case md5('update'):
                    //    die(var_dump(($_POST)));
                    $verifier = Yii::$app->evaluationClass->infoEval($_POST['matricule'], $_POST['codeEva']);

                    if (isset($_POST['note3'])) {

                        $note3 = $_POST['note3'];
                    } else {
                        $note3 = 0;
                    }
                    $query = Yii::$app->evaluationClass->Updatenote($_POST['matricule'], $_POST['compo'], $_POST['codeEva'], $_POST['note1'], $_POST['note2'], $note3);
                    return $this->redirect(Yii::$app->request->referrer);

                    break;

                case md5(strtolower("ajouterunenoter")):

                    if (sizeof($_POST['matricule']) > 0) {
                        foreach ($_POST['matricule'] as $key => $value) {

                            if (isset($_POST['moy3'][$key])) {

                                $note3 = $_POST['moy3'][$key];
                            } else {
                                $note3 = 0;
                            }
                            $verifier = Yii::$app->evaluationClass->infoEval($value, $_POST['codeEvaluation']);
                            // die(var_dump($verifier));
                            $code = Yii::$app->simplelClass->generateUniq();
                            // die(var_dump($_POST['codeEvaluation']));
                            if ($verifier) {
                                //  die(var_dump($_POST['moy1'][$key]));
                                $query = Yii::$app->evaluationClass->Updatenote($verifier['matricule'], $verifier['composition'], $verifier['codeEva'], $_POST['moy1'][$key], $_POST['moy2'][$key], $note3);
                            } else {
                                Yii::$app->evaluationClass->insertNote($code, $value, $_POST['moy1'][$key], $_POST['moy2'][$key], $note3, $_POST['codeEvaluation']);
                            }
                        }
                    }
                    return $this->redirect(Yii::$app->request->referrer);

                    break;
                case md5(strtolower("excel")):
                    $periode = $_POST['periodeData'];
                    $isteElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $_POST['code']);
                    $periode = Yii::$app->simplelClass->selectPeriode($_POST['periodeData']);
                    $codePeriode = $_POST['periodeData'];
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $annee = Yii::$app->mainCLass->unidata('dj_anneescolaire', $anneeActive);

                    //LOGO
                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing();
                    $drawing->setName('Spreadsheet-Coding.com Logo');
                    $drawing->setPath(__DIR__ . '/../web/mainAssets/logo/logo.png');
                    // Add the image to the header of the sheet
                    // $sheet->getHeaderFooter()->addImage($drawing, \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter::IMAGE_HEADER_LEFT);
                    $sheet->getHeaderFooter()->setOddFooter('&LWAMY INTERNATIONNAL Document&RPage &P of &N');

                    // Set the print header
                    $sheet->getHeaderFooter()->setOddHeader('&L&G');
                    $sheet->mergeCells('A1:D1');
                    $sheet->setCellValue('A1', 'FICHE RELEVER DE NOTE DE L\'EVALUATION DU ' . $periode . '');
                    // $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                    // $sheet->setCellValue('A2', 'Code Evaluation ' . $_POST['codeEva'] . '');
                    $sheet->mergeCells('A3:D3');
                    $sheet->setCellValue('A3', 'Classe: ' . $_POST['classeData'] . '');
                    $sheet->mergeCells('A4:D4');
                    $sheet->setCellValue('A4', 'Matiere: ' . $_POST['matiereData'] . '');
                    $sheet->mergeCells('A5:D5');
                    $sheet->setCellValue('A5', 'Annee Scolaire: ' . $annee['libelle'] . '');

                    $sheet->setCellValue('A7', 'MATRICULE');
                    $sheet->setCellValue('B7', 'NOM');
                    $sheet->setCellValue('C7', 'PRENOM');
                    $sheet->setCellValue('D7', 'ORALE');
                    $sheet->setCellValue('E7', 'ECRITE');
                    $sheet->setCellValue('F7', 'MOY');
                    $sheet->setCellValue('G7', 'ORALE');
                    $sheet->setCellValue('H7', 'ECRITE');
                    $sheet->setCellValue('I7', 'MOY');
                    if ($codePeriode > 3) {
                        $sheet->setCellValue('J7', 'ORALE');
                        $sheet->setCellValue('K7', 'ECRITE');
                        $sheet->setCellValue('L7', 'MOY');
                    }

                    //style
                    $style = $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);;

                    $style = $sheet->getStyle('A3')->getFont()->setSize(12);
                    $style = $sheet->getStyle('A4')->getFont()->setSize(12);
                    $style = $sheet->getStyle('A5')->getFont()->setSize(12);
                    //HEADER

                    $sheet->setCellValue('D6', 'MOIS');
                    $sheet->setCellValue('G6', 'MOIS');

                    if ($codePeriode > 3) {

                        $sheet->setCellValue('j6', 'MOIS');
                    }


                    $sheet->getStyle('D6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('G6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('J6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                    //HEADER MOMIS
                    $sheet->mergeCells('D6:F6');
                    $sheet->mergeCells('G6:I6');
                    $sheet->mergeCells('J6:L6');


                    $style = $sheet->getStyle('A7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('B7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('C7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('D7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('E7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('F7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('G7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('H7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('I7')->getFont()->setBold(true)->setSize(13);
                    if ($codePeriode > 3) {
                        $style = $sheet->getStyle('J7')->getFont()->setBold(true)->setSize(13);
                        $style = $sheet->getStyle('K7')->getFont()->setBold(true)->setSize(13);
                        $style = $sheet->getStyle('L7')->getFont()->setBold(true)->setSize(13);
                    }


                    $style = $sheet->getStyle('A7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('B7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('C7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('D7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('E7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('F7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('G7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('H7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('I7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    if ($codePeriode > 3) {
                        $style = $sheet->getStyle('J7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                        $style = $sheet->getStyle('K7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                        $style = $sheet->getStyle('L7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    }

                    $style = $sheet->getStyle('A7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('B7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('C7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('D7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('E7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('F7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('G7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('H7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('I7')->getFill()->getStartColor()->setARGB('F1F1F1FF');

                    if ($codePeriode > 3) {
                        $style = $sheet->getStyle('J7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                        $style = $sheet->getStyle('K7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                        $style = $sheet->getStyle('L7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    }

                    $sheet->getColumnDimension('A')->setWidth(15);
                    $sheet->getColumnDimension('B')->setWidth(20);
                    $sheet->getColumnDimension('C')->setWidth(35);


                    //chargement des donner
                    // die(var_dump($isteElevee));
                    if (sizeof($isteElevee) > 0) {
                        $i = 8;
                        foreach ($isteElevee as $key => $value) {
                            $sheet->setCellValue('A' . $i, $value['matricule']);
                            $sheet->setCellValue('B' . $i, $value['nom']);
                            $sheet->setCellValue('C' . $i, $value['prenom']);
                            $sheet->setCellValue('F' . $i, '=(D' . $i . '+ E' . $i . ')/2');
                            $sheet->setCellValue('I' . $i, '=(G' . $i . '+ H' . $i . ')/2');
                            $sheet->setCellValue('F' . $i, '=(D' . $i . '+ E' . $i . ')/2');
                            if ($codePeriode > 3) {
                                $sheet->setCellValue('L' . $i, '=(J' . $i . '+ K' . $i . ')/2');
                            }

                            $i++;
                        }
                        $j = $i + 5;
                        $sheet->setCellValue('A' . $j, 'code Evaluation');
                        $sheet->mergeCells('B' . $j . ':F' . $j);

                        $sheet->setCellValue('B' . $j, $_POST['codeEva']);
                    }

                    $sheet->getProtection()->setSheet(true);
                    $sheet->getStyle('D')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('E')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('G')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('H')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('I')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('j')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('k')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

                    $fileName = 'fichedeNote.xlsx';

                    $writer = new Xlsx($spreadsheet);
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
                    $writer->save('php://output');
                    die(var_dump($isteElevee));
                    break;
                case md5(strtolower("pdf")):
                    $file = $_FILES['fichier'];
                    if (isset($file) && sizeof($file) > 0) {

                        $file_name = $file['name'];
                        $file_size = $file['size'];
                        $file_tmp = $file['tmp_name'];
                        $file_type = $file['type'];
                        $extCounter = explode('.', $file_name);

                        $file_ext = end($extCounter);

                        $expensions = "xlsx";
                        $file_uni_name = 'note.' . $file_ext;
                        $rslt = '';
                        if ($file_ext === $expensions) {
                            $rslt = 'succes';
                        }
                        if ($file_size > '30000') {
                            $rslt = 'error';
                        }

                        if ($rslt == 'succes') {

                            $targetfolder = \Yii::getAlias(yii::$app->basePath . yii::$app->params['document']);


                            if (move_uploaded_file($file_tmp, $targetfolder . $file_uni_name)) {
                                $spreadsheet = IOFactory::load($targetfolder . $file_uni_name);
                                $worksheet = $spreadsheet->getActiveSheet();
                                $data = [];

                                foreach ($worksheet->getRowIterator() as $row) {
                                    $row_data = [];

                                    foreach ($row->getCellIterator() as $cell) {
                                        $row_data[] = $cell->getValue();
                                    }

                                    $data[] = $row_data;
                                }

                                $i = $j = 0;
                                $donner = null; //fixer
                                foreach ($data as $key => $value) {
                                    $i++;
                                    if ($i > 7 && $i < (sizeof($data) - 5)) {

                                        $notea1 = $value[3];
                                        $notea2 = $value[4];
                                        $notea = ($value[3] + $value[4]) / 2;
                                        $noteb1 = $value[6];
                                        $noteb2 = $value[7];
                                        $noteb = ($value[6] + $value[7]) / 2;
                                        $notec1 = $value[9];
                                        $notec2 = $value[10];
                                        $notec = ($value[9] + $value[10]) / 2;

                                        $j++;
                                        $donner[$j] = [
                                            'matricule' => $value['0'],
                                            'notea1' => $notea1,
                                            'notea2' => $notea2,
                                            'notea' => $notea,
                                            'noteb1' => $noteb1,
                                            'noteb2' => $noteb2,
                                            'noteb' => $noteb,
                                            'notec1' => $notec1,
                                            'notec2' => $notec2,
                                            'notec' => $notec,
                                        ];
                                    }
                                }
                                // die(var_dump($donner));
                                $codeEval = $data[$i - 1]['1'];
                                return $this->render('/evaluation/import.php', ['donner' => $donner, 'codeEval' => $codeEval]);
                            }

                            return $this->redirect(Yii::$app->request->referrer);
                        }
                    }

                    break;


                default:
                    # code...
                    break;
            }
            if (!empty($_POST['periode'] && $_POST['matiere'] && $_POST['classe'] && $_POST['date'] && $_POST['Coeficient'])) {
                // die(var_dump($_POST));
                $code = Yii::$app->simplelClass->generateUniq();
                $periode = $_POST['periode'];
                $codeMatiere = $_POST['matiere'];
                $date = $_POST['date'];
                $codeclasse = $_POST['classe'];
                $sujet = '';


                if ($periode < 4) {
                    $typeEval = '1';
                } else {
                    $typeEval = '2';
                }
                // die(var_dump($typeEval));
                $filename = yii::$app->simplelClass->upload_image(yii::$app->params['document'], $_FILES['sujet']);
                if ($filename != null) {
                    $sujet = $filename;
                }
                Yii::$app->evaluationClass->inserteval($code, $periode, $codeMatiere, $date, $codeclasse, $anneeActive, $sujet, $_POST['Coeficient'], $typeEval, $ets);

                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                Yii::$app->session->setFlash('flashmsg', $notification);
                return $this->redirect(Yii::$app->request->referrer);
            } else {
            }
        }
        $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');
        $liste = Yii::$app->evaluationClass->selectEval($anneeActive);
        // die(var_dump($liste));
        return $this->render('/evaluation/evaluation.php', ['liste' => $liste, 'classe' => $classe]);
    }


    public function actionComposition()
    {
        $anneeActive  = yii::$app->mainCLass->getAnneeActive();
        $ets = yii::$app->mainCLass->getets();

        $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');
        $liste = Yii::$app->evaluationClass->selectEval($anneeActive);

        if (yii::$app->request->isPost) {


            switch ($_POST['action']) {

                case md5(strtolower("exportpdf")):
                    $classe = $_POST['classeData'];

                    $periode = $_POST['periodeData'];
                    $isteElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $_POST['code']);
                    $periode = Yii::$app->simplelClass->selectPeriode($_POST['periodeData']);
                    $codePeriode = $_POST['periodeData'];
                    $annee = Yii::$app->mainCLass->unidata('dj_anneescolaire', $anneeActive);
                    $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                    $matiere = $_POST['matiereData'];
                    $mpdf = new \Mpdf\Mpdf([
                        'mode' => 'utf-8',
                        'format' => 'A4',
                        'margin_left' => 2,
                        'margin_right' => 2,
                        'margin_top' => 2,
                        'margin_bottom' => 30,
                        'margin_header' => 10,
                        'margin_footer' => 10,


                    ]);
                    $pdf = $this->renderPartial('/composition/fichenote.php', ['codePeriode' => $codePeriode, 'matiere' => $matiere, 'classe' => $classe, 'annee' => $annee['libelle'], 'listeElevee' => $isteElevee, 'periode' => $periode, 'infoets' => $infoets]);
                    $footer = $this->renderPartial('/evalresul/detailstrimestrepdffooter.php');
                    $mpdf->showImageErrors = true;

                    $mpdf->SetHTMLFooter($footer);
                    $mpdf->SetHTMLFooter($footer, 'E');

                    $mpdf->WriteHTML($pdf);
                    $mpdf->SetDisplayMode('fullpage');
                    $mpdf->Output('djangai.pdf', 'I');


                    break;
                case md5(strtolower("modifieraddnote")):


                    if (sizeof($_POST['matricule']) > 0) {
                        foreach ($_POST['matricule'] as $key => $value) {

                            $verifier = Yii::$app->evaluationClass->infoEval($value, $_POST['codeEvaluation']);
                            // die(var_dump($_POST));
                            $code = Yii::$app->simplelClass->generateUniq();
                            if ($verifier) {
                                //  die(var_dump($_POST['moy1'][$key]));

                                $query = Yii::$app->evaluationClass->Updatenote($verifier['matricule'], $_POST['compo'][$key], $verifier['codeEva'], $verifier['note1'], $verifier['note2'], $verifier['note3']);
                            } else {
                                Yii::$app->evaluationClass->insertNote($code, $value, '0', '0', '0', $_POST['codeEvaluation'], $_POST['compo'][$key]);
                            }
                        }
                    }

                    $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);

                    break;
                case md5(strtolower("modifiereval")):
                    // die(var_dump(($_POST)));
                    $anneeActive  = yii::$app->mainCLass->getAnneeActive();


                    $infoEva = Yii::$app->evaluationClass->selecuniquetEval($_POST['codeEva']);

                    $listeElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $infoEva['codeClasse']);
                    // die(var_dump($listeElevee));

                    return $this->render('/composition/ajoutnote.php', ['listeElevee' => $listeElevee, 'infoEva' => $infoEva]);

                    break;
                case md5(strtolower("search")):
                    $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');
                    $liste = Yii::$app->evaluationClass->selectEvalforclasse($anneeActive, $_POST['classetSearch']);
                    // die(var_dump($liste));

                    return $this->render('/composition/vueprincipal.php', ['post' => $_POST, 'liste' => $liste, 'classe' => $classe]);

                    break;
                case md5(strtolower("excel")):
                    // die(var_dump($_POST));
                    $periode = $_POST['periodeData'];
                    $isteElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $_POST['code']);
                    $periode = Yii::$app->simplelClass->selectPeriode($_POST['periodeData']);
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $annee = Yii::$app->mainCLass->unidata('dj_anneescolaire', $anneeActive);

                    $sheet->getHeaderFooter()->setOddFooter('&LWAMY INTERNATIONNAL Document&RPage &P of &N');

                    // Set the print header
                    $sheet->getHeaderFooter()->setOddHeader('&L&G');
                    $sheet->mergeCells('A1:D1');
                    $sheet->setCellValue('A1', 'FICHE RELEVER DE NOTE COMPOSITION DU ' . $periode . '');
                    // $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->mergeCells('A3:D3');
                    $sheet->setCellValue('A3', 'Classe: ' . $_POST['classeData'] . '');
                    $sheet->mergeCells('A4:D4');
                    $sheet->setCellValue('A4', 'Matiere: ' . $_POST['matiereData'] . '');
                    $sheet->mergeCells('A5:D5');
                    $sheet->setCellValue('A5', 'Annee Scolaire: ' . $annee['libelle'] . '');

                    // info eleves 
                    $sheet->setCellValue('A7', 'MATRICULE');
                    $sheet->setCellValue('B7', 'NOM');
                    $sheet->setCellValue('C7', 'PRENOM');
                    $sheet->setCellValue('D7', 'NOTE');

                    //style
                    $style = $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);;

                    $style = $sheet->getStyle('A3')->getFont()->setSize(12);
                    $style = $sheet->getStyle('A4')->getFont()->setSize(12);
                    $style = $sheet->getStyle('A5')->getFont()->setSize(12);

                    $style = $sheet->getStyle('A7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('B7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('C7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('D7')->getFont()->setBold(true)->setSize(13);


                    $style = $sheet->getStyle('A7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('B7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('C7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('D7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);

                    $style = $sheet->getStyle('A7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('B7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('C7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('D7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $sheet->getColumnDimension('A')->setWidth(15);
                    $sheet->getColumnDimension('B')->setWidth(20);
                    $sheet->getColumnDimension('C')->setWidth(35);
                    $sheet->getColumnDimension('D')->setWidth(10);


                    //chargement des donner
                    //  die(var_dump($isteElevee));
                    if (sizeof($isteElevee) > 0) {
                        $i = 8;
                        foreach ($isteElevee as $key => $value) {
                            $sheet->setCellValue('A' . $i, $value['matricule']);
                            $sheet->setCellValue('B' . $i, $value['nom']);
                            $sheet->setCellValue('C' . $i, $value['prenom']);


                            $i++;
                        }
                        $j = $i + 5;
                        $sheet->setCellValue('A' . $j, 'code Evaluation');
                        $sheet->mergeCells('B' . $j . ':F' . $j);

                        $sheet->setCellValue('B' . $j, $_POST['codeEva']);
                    }


                    $sheet->getProtection()->setSheet(true);
                    $sheet->getStyle('D')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);



                    $fileName = 'fichedeNote.xlsx';

                    $writer = new Xlsx($spreadsheet);
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
                    $writer->save('php://output');
                    die(var_dump($isteElevee));

                    break;
                case md5(strtolower("ajouterunenoter")):
                    if (sizeof($_POST['matricule']) > 0) {
                        foreach ($_POST['matricule'] as $key => $value) {

                            $verifier = Yii::$app->evaluationClass->infoEval($value, $_POST['codeEvaluation']);

                            $code = Yii::$app->simplelClass->generateUniq();
                            // die(var_dump($_POST['codeEvaluation']));
                            if ($verifier) {
                                //  die(var_dump($_POST['moy1'][$key]));
                                $query = Yii::$app->evaluationClass->Updatenote($verifier['matricule'], $_POST['notea1'][$key], $verifier['codeEva'], $verifier['note1'], $verifier['note2'], $verifier['note3']);
                            } else {
                                // die('insertion');
                                Yii::$app->evaluationClass->insertNote($code, $value, 0, 0, 0, $_POST['codeEvaluation'], $_POST['notea1'][$key]);
                            }
                        }
                    }
                    return $this->redirect(Yii::$app->request->referrer);

                    break;
                case md5(strtolower("imporetenote")):
                    // die(var_dump($_FILES['monInputFile']));
                    //verfie si l'evalution esiste
                    $codeEva = $_POST['codeEva'];
                    $classe = $_POST['code'];
                    $file = $_FILES['monInputFile'];
                    if (isset($file) && sizeof($file) > 0) {

                        $file_name = $file['name'];
                        $file_size = $file['size'];
                        $file_tmp = $file['tmp_name'];
                        $file_type = $file['type'];
                        $extCounter = explode('.', $file_name);

                        $file_ext = end($extCounter);

                        $expensions = "xlsx";
                        $file_uni_name = 'note.' . $file_ext;
                        $rslt = '';
                        if ($file_ext === $expensions) {
                            $rslt = 'succes';
                        }
                        if ($file_size > '30000') {
                            $rslt = 'error';
                        }

                        if ($rslt == 'succes') {

                            $targetfolder = \Yii::getAlias(yii::$app->basePath . yii::$app->params['document']);


                            if (move_uploaded_file($file_tmp, $targetfolder . $file_uni_name)) {
                                $spreadsheet = IOFactory::load($targetfolder . $file_uni_name);
                                $worksheet = $spreadsheet->getActiveSheet();
                                $data = [];

                                foreach ($worksheet->getRowIterator() as $row) {
                                    $row_data = [];

                                    foreach ($row->getCellIterator() as $cell) {
                                        $row_data[] = $cell->getValue();
                                    }

                                    $data[] = $row_data;
                                }

                                $i = 0; //fixer
                                $i = $j = 0;
                                $donner = null;
                                foreach ($data as $key => $value) {
                                    $i++;
                                    if ($i > 7 && $i < (sizeof($data) - 5)) {
                                        // $verifier = Yii::$app->evaluationClass->infoEval($value[0], $codeEva);

                                        // if ($verifier) {
                                        //     // die(var_dump($verifier));
                                        //     $query = Yii::$app->evaluationClass->Updatenote($verifier['matricule'], $value[3], $verifier['codeEva'], $verifier['note1'], $verifier['note2'], $verifier['note3']);

                                        // } else {
                                        //     $code = Yii::$app->simplelClass->generateUniq();

                                        //     Yii::$app->evaluationClass->insertNote($code, $value[0], 0, 0, 0, $_POST['codeEva'], $value[3]);
                                        // }


                                        $notea1 = $value[3];

                                        $j++;
                                        $j++;
                                        $donner[$j] = [
                                            'matricule' => $value['0'],
                                            'composition' => $notea1,

                                        ];
                                    }
                                }
                                $codeEval = $data[$i - 1]['1'];
                                // die(var_dump($codeEval));
                                return $this->render('/composition/import.php', ['donner' => $donner, 'codeEval' => $codeEval]);
                            }

                            return $this->redirect(Yii::$app->request->referrer);
                        }
                    }


                    break;


                default:

                    if (!empty($_POST['periode'] && $_POST['matiere'] && $_POST['classe'] && $_POST['date'] && $_POST['Coeficient'])) {
                        $code = Yii::$app->simplelClass->generateUniq();
                        $periode = $_POST['periode'];
                        $codeMatiere = $_POST['matiere'];
                        $date = $_POST['date'];
                        $codeclasse = $_POST['classe'];
                        $sujet = '';

                        // die(var_du_POST));
                        $filename = yii::$app->simplelClass->upload_image(yii::$app->params['document'], $_FILES['sujet']);
                        if ($filename != null) {
                            $sujet = $filename;
                        }
                        Yii::$app->evaluationClass->inserteval($code, $periode, $codeMatiere, $date, $codeclasse, $anneeActive, $sujet, $_POST['Coeficient'], 2);

                        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                        Yii::$app->session->setFlash('flashmsg', $notification);
                        return $this->redirect(Yii::$app->request->referrer);
                    } else {
                    }

                    break;
            }
        }
        return $this->render('/composition/vueprincipal.php', ['liste' => $liste, 'classe' => $classe]);
    }

    public function actionResultat()
    {

        $ets = yii::$app->mainCLass->getets();
        $liste = Yii::$app->configClass->listClasse($ets);
        $anneeActive  = yii::$app->mainCLass->getAnneeActive();


        if (isset($_GET['code'])) {

            $codeclasse = $_GET['code'];
            $typeCompo = Yii::$app->configClass->infClasse($codeclasse);
            $liste = yii::$app->eleveClass->listeclasse($anneeActive, $codeclasse);
            // die(var_dump($typeCompo));
            if ($typeCompo['typeCompo'] == 1) {
                $default = 1;
            } else {
                $default = 4;
            }

            return $this->render('/evalresul/detailstrimestre.php', ['liste' => $liste, 'periode' => $default, 'typeCOmpo' => $typeCompo['typeCompo'], 'codeclasse' => $codeclasse]);
        }

        if (yii::$app->request->isPost) {


            $periode = $_POST['Periode'];
            $codeclasse = $_POST['classe'];
            // die(var_dump($_POST));
            if ($_POST['action'] == md5(strtolower("primelistespdf"))) {
                // die(var_dump($_POST));
                $codeclasse = $_POST['classe'];
                $typeCompo = Yii::$app->configClass->infClasse($codeclasse);
                $liste = yii::$app->eleveClass->listeclasse($anneeActive, $codeclasse);
                $eva = yii::$app->evaluationClass->evalClasse($anneeActive, $codeclasse, $_POST['Periode']);
                $periode = yii::$app->simplelClass->selectPeriode($_POST['Periode']);
                $noteAllElve = yii::$app->evaluationClass->noteallbystatitque($anneeActive, $codeclasse, $_POST['Periode']);
                $annee = yii::$app->mainCLass->databycode('dj_anneescolaire', $anneeActive, 'code');
                $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'margin_left' => 2,
                    'margin_right' => 2,
                    'margin_top' => 2,
                    'margin_bottom' => 30,
                    'margin_header' => 10,
                    'margin_footer' => 10,


                ]);
                $pdf = $this->renderPartial('/evalresul/detailstrimestrepdf.php', ['infoclasse' => $typeCompo, 'periode' => $_POST['Periode'], 'noteAllElve' => $noteAllElve, 'eva' => $eva, 'typeCOmpo' => $typeCompo['typeCompo'], 'codeclasse' => $codeclasse, 'annee' => $annee, 'infoets' => $infoets]);
                $footer = $this->renderPartial('/evalresul/detailstrimestrepdffooter.php');
                $mpdf->showImageErrors = true;

                $mpdf->SetHTMLFooter($footer);
                $mpdf->SetHTMLFooter($footer, 'E');

                $mpdf->WriteHTML($pdf);
                $mpdf->SetDisplayMode('fullpage');
                $mpdf->Output('djangai.pdf', 'I');
            }

            if ($_POST['action'] == md5(strtolower("resultatfinal"))) {


                $info = yii::$app->eleveClass->infoeleve($anneeActive, $_POST['codeE']);
                $classe = yii::$app->configClass->infClasse($_POST['classe']);
                $matiere = yii::$app->evaluationClass->infoclasse($_POST['classe']);


                $periode = yii::$app->simplelClass->selectPeriode($_POST['Periode']);
                //determinier le rang d'un eleves
                $noteAllElve = yii::$app->evaluationClass->noteall($anneeActive, $classe, $classe['typeCompo']);
                $rang = yii::$app->evaluationClass->rang($noteAllElve, $_POST['codeE']);
                $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);
                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'margin_left' => 2,
                    'margin_right' => 2,
                    'margin_top' => 2,
                    'margin_bottom' => 30,
                    'margin_header' => 10,
                    'margin_footer' => 10,


                ]);

                $lien = yii::$app->request->baseurl . '/' . md5('visiteur_validebuletin') . '/' . $_POST['codeE'] . '/' . $anneeActive;


                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                    $url = "https";
                } else {
                    $url = "http";
                }
                $url .= "://";
                $_SERVER['REQUEST_URI'] = $lien;
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];

                //   die($url);
                $qrimage = yii::$app->simplelClass->codeqr($url);

                $filname = 'filename';
                $mpdf->SetDisplayMode('fullpage');
                if ($classe["typeCompo"] == 1) {
                    $pdf = $this->renderPartial('/repports/result/primesemsestrePrim.php', ['info' => $info, 'classe' => $classe, 'matiere' => $matiere, 'anneeActive' => $anneeActive, 'rang' => $rang, 'periode' => $_POST['Periode'], 'qrimage' => $qrimage, 'infoets' => $infoets]);
                } else {
                    $pdf = $this->renderPartial('/repports/result/primesemsestrSem.php', ['info' => $info, 'classe' => $classe, 'matiere' => $matiere, 'anneeActive' => $anneeActive, 'rang' => $rang, 'periode' => $_POST['Periode'], 'qrimage' => $qrimage, 'infoets' => $infoets]);
                }
                $footer = $this->renderPartial('/repports/result/primesemsestreFooter.php', ['qrimage' => $qrimage]);
                $mpdf->SetHTMLFooter($footer);
                $mpdf->WriteHTML($pdf);
                $mpdf->SetDisplayMode('fullpage');
                $mpdf->Output('djangai.pdf', 'I');


                // die();
                // return $this->render('/repports/resultafint.php');
                die('Encours de traitement');
            }
            $statut = $_POST['Statut'];
            $composer = $_POST['composer'];

            $liste = yii::$app->eleveClass->listeclasse($anneeActive, $codeclasse);
            if ($periode < 4) {
                $typeCompo = 1;
            } else {
                $typeCompo = 2;
            }

            // echo($typeCompo);die();
            $eva = yii::$app->evaluationClass->evalClasse($anneeActive, $codeclasse, $periode);
            return $this->render('/evalresul/detailstrimestre.php', [
                'liste' => $liste,
                'eva' => $eva,
                'typeCOmpo' => $typeCompo,
                'codeclasse' => $codeclasse,
                'statut' => $statut,
                'composer' => $composer,
                'periode' => $periode
            ]);

            // die(var_dump($_POST));
        }
        return $this->render('/evalresul/vueprincipal.php', ['liste' => $liste]);
    }

    public function actionResultatfinal()
    {
        $ets = yii::$app->mainCLass->getets();
        $liste = Yii::$app->configClass->listClasse($ets);
        $anneeActive  = yii::$app->mainCLass->getAnneeActive();


        if (isset($_GET['code'])) {

            $codeclasse = $_GET['code'];
            $typeCompo = Yii::$app->configClass->infClasse($codeclasse);
            $liste = yii::$app->eleveClass->listeclasse($anneeActive, $codeclasse);
            if ($typeCompo['typeCompo'] == 1) {
                $default = 1;
            } else {
                $default = 4;
            }

            $eva = yii::$app->evaluationClass->evalClasse($anneeActive, $codeclasse, $default);
            //  

            return $this->render('/resultatfinal/detialclasse.php', ['liste' => $liste, 'eva' => $eva, 'typeCOmpo' => $typeCompo['typeCompo'], 'codeclasse' => $codeclasse]);
        }

        if (yii::$app->request->isPost) {

            $codeclasse = $_POST['classe'];
            if ($_POST['action'] == md5(strtolower("resultatglobalfinal"))) {
                // die(var_dump($_POST));
                $codeclasse = $_POST['classe'];
                $typeCompo = Yii::$app->configClass->infClasse($codeclasse);
                $liste = yii::$app->eleveClass->listeclasse($anneeActive, $codeclasse);
                $noteAllElve = yii::$app->evaluationClass->noteallbyfinalstatistique($anneeActive, $codeclasse, $typeCompo['typeCompo']);
                $annee = yii::$app->mainCLass->databycode('dj_anneescolaire', $anneeActive, 'code');
                $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'margin_left' => 2,
                    'margin_right' => 2,
                    'margin_top' => 2,
                    'margin_bottom' => 30,
                    'margin_header' => 10,
                    'margin_footer' => 10,


                ]);
                $pdf = $this->renderPartial('/composition/detailstrimestrepdf.php', ['infoclasse' => $typeCompo, 'noteAllElve' => $noteAllElve, 'typeCOmpo' => $typeCompo['typeCompo'], 'codeclasse' => $codeclasse, 'annee' => $annee, 'infoets' => $infoets]);
                $footer = $this->renderPartial('/evalresul/detailstrimestrepdffooter.php');
                $mpdf->showImageErrors = true;

                $mpdf->SetHTMLFooter($footer);
                $mpdf->SetHTMLFooter($footer, 'E');

                $mpdf->WriteHTML($pdf);
                $mpdf->SetDisplayMode('fullpage');
                $mpdf->Output('djangai.pdf', 'I');
            }
            if ($_POST['action'] == md5(strtolower("resultatfinal"))) {

                //charger les resultat des eleeves



                $info = yii::$app->eleveClass->infoeleve($anneeActive, $_POST['codeE']);
                $classe = yii::$app->configClass->infClasse($_POST['classe']);
                $matiere = yii::$app->evaluationClass->infoclasse($_POST['classe']);



                //determinier le rang d'un eleves
                $noteAllElve = yii::$app->evaluationClass->noteall($anneeActive, $classe, $classe['typeCompo']);
                $rang = yii::$app->evaluationClass->rang($noteAllElve, $_POST['codeE']);
                $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                $lien = yii::$app->request->baseurl . '/' . md5('visiteur_validebuletin') . '/' . $_POST['codeE'] . '/' . $anneeActive;


                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                    $url = "https";
                } else {
                    $url = "http";
                }
                $url .= "://";
                $_SERVER['REQUEST_URI'] = $lien;
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];

                //   die($url);
                $qrimage = yii::$app->simplelClass->codeqr($url);

                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => [210, 297],
                    'orientation' => 'L',
                    'margin_left' => 2,
                    'margin_right' => 2,
                    'margin_top' => 2,
                    'margin_bottom' => 2,
                    'margin_header' => 2,
                    'margin_footer' => 2


                ]);
                $filname = 'filename';
                $mpdf->SetDisplayMode('fullpage');
                if ($classe["typeCompo"] == 2) {
                    $pdf = $this->renderPartial('/repports/result/prime.php', ['qrimage' => $qrimage, 'info' => $info, 'classe' => $classe, 'matiere' => $matiere, 'anneeActive' => $anneeActive, 'rang' => $rang, 'infoets' => $infoets]);
                } else {
                    $pdf = $this->renderPartial('/repports/result/primeTrim.php', ['qrimage' => $qrimage, 'info' => $info, 'classe' => $classe, 'matiere' => $matiere, 'anneeActive' => $anneeActive, 'rang' => $rang, 'infoets' => $infoets]);
                }
                $mpdf->WriteHTML($pdf);
                $mpdf->SetDisplayMode('fullpage');
                $mpdf->Output('djangai.pdf', 'I');


                // die();
                return $this->render('/repports/resultafint.php');
            }
            //   die(var_dump($_POST));
            $statut = $_POST['Statut'];
            // $composer =$_POST['composer'];
            $codeclasse = $_POST['classe'];
            $typeCompo = Yii::$app->configClass->infClasse($codeclasse);

            $liste = yii::$app->eleveClass->listeclasse($anneeActive, $codeclasse);

            return $this->render('/resultatfinal/detialclasse.php', ['liste' => $liste, 'statut' => $statut, 'typeCOmpo' => $typeCompo["typeCompo"], 'codeclasse' => $codeclasse]);
        }
        // 

        return $this->render('/resultatfinal/vueprincipal.php', ['liste' => $liste]);
    }

    public function actionRapport()
    {
        return $this->render('/rapportEval/vueprincipal.php');
    }

    public function actionExport()
    {
        return $this->render('/composition/vueprincipal.php');
    }


    public function actionAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $anneeActive  = yii::$app->mainCLass->getAnneeActive();

        if (yii::$app->request->isPOst) {

            if ($_POST['action_key'] == md5('1')) {
                $matiere = Yii::$app->evaluationClass->infoclasse($_POST['code']);
                $typeeva = Yii::$app->evaluationClass->typeEva($_POST['code']);
                $libmatiere = '';
                if (sizeof($matiere) > 0) {

                    foreach ($matiere as $key => $value) {
                        $libmatiere .= '<option value="" hidden>selectionner un... </option><option value="' . $value['codeMatiere'] . '">' . $value['libelle'] . '</option>';
                    }
                }

                $eva = '';
                $type = $typeeva['0'];
                if ($type['typeEva'] == 1) {
                    $eva .= '<option value="1">1er Trimestre</option> <option value="2">2eme Trimestre</option> <option value="3">3eme Trimestre</option>';
                } else if ($type['typeEva'] == 2) {
                    $eva .= '<option value="4">Semestre 1</option> <option value="5">Semestre 2</option>';
                }
                return ['libmatiere' => $libmatiere, 'typeeva' => $eva];
            } elseif ($_POST['action_key'] == md5('2')) {
                $coef = Yii::$app->evaluationClass->coef($_POST['code'], $_POST['codeClasse']);
                return $coef[0];
            }
        }
    }

    public function actionListeleve()
    {
        $anneeActive  = yii::$app->mainCLass->getAnneeActive();

        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        if (yii::$app->request->isPOst) {
            if ($_POST['action'] == md5(strtolower("excel"))) {

                $code = $_POST['code'];

                $tab[0] = 'dj_eleve';
                $tab[1] = 'dj_lien_eleve_classe';

                $col[0] = "dj_eleve.code as codeEleve";
                $col[1] = "dj_eleve.nom";
                $col[2] = "dj_eleve.prenom";
                $col[3] = "dj_eleve.genre";
                $col[4] = "dj_eleve.photo";
                $col[5] = "dj_eleve.prenomTuteur";
                $col[6] = "dj_eleve.telTuteur";
                $col[7] = "dj_eleve.nomTuteur";
                $col[8] = "dj_eleve.adresse";
                $col[9] = "dj_eleve.matricule";
                $col[10] = "dj_lien_eleve_classe.code as codeLien";
                $whereValues["dj_eleve.code"] = "dj_lien_eleve_classe.codeEleve";
                $whereValues["dj_eleve.statut"] = 1;
                $whereValues["dj_lien_eleve_classe.codeAnnee"] = "'$anneeActive'";
                $whereValues["dj_lien_eleve_classe.codeClasse"] = "'$code'";


                $liste = $main->selectJoinData($col, $tab, $whereValues);
                // die(var_dump($liste));


                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setCellValue('A1', 'matricule');
                $sheet->setCellValue('B1', 'Nom');
                $sheet->setCellValue('c1', 'note');
                $fileName = 'data.xlsx';
                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
                $writer->save('php://output');
            } elseif ($_POST['action'] == md5(strtolower("pdf"))) {
                # code...
            }
            $liste = yii::$app->eleveClass->actionListclass();
        }
        $liste = yii::$app->eleveClass->actionListclass();
        return $this->render('/ficheNote/Vueprincipal.php', ['liste' => $liste]);
    }

    //chargement detailler des resultat
    public function actionDetails()
    {
        if (yii::$app->request->isGet) {
            $anneeActive  = yii::$app->mainCLass->getAnneeActive();


            $infoEva = Yii::$app->evaluationClass->selecuniquetEval($_GET['detailsnote']);
            $listeElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $infoEva['codeClasse']);

            // $noteEva =Yii::$app->evaluationClass->selectnote($_GET['detailsnote']);
            // die(var_dump($infoEva));
            return $this->render('/evaDetails/evaluation.php', ['listeElevee' => $listeElevee, 'infoEva' => $infoEva]);
        }
    }
    
    
    
    
        public function actionConcinelledetails()
    {
        if (yii::$app->request->isGet) {
            $anneeActive  = yii::$app->mainCLass->getAnneeActive();
            $infoEva = Yii::$app->evaluationClass->selecuniquetEval($_GET['detailsnote']);
            $listeElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $infoEva['codeClasse']);
            // $noteEva =Yii::$app->evaluationClass->selectnote($_GET['detailsnote']);
            // die(var_dump($infoEva));
            return $this->render('/concinelle/evaDetails/evaluation.php', ['listeElevee' => $listeElevee, 'infoEva' => $infoEva]);
        }
    }



    //oreganiser une evaluation concinelle
    public function actionOrganiserconcinelle()
    {
        $anneeActive  = yii::$app->mainCLass->getAnneeActive();
        $ets = yii::$app->mainCLass->getets();

        if (yii::$app->request->isPost) {
            switch ($_POST['action']) {

                case md5(strtolower("supprimer")):
                    Yii::$app->evaluationClass->suprimeeval($_POST['codeEva']);
                    $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);

                    break;
                case md5(strtolower("exportpdf")):
                    // die('ok');
                    $classe = $_POST['classeData'];

                    $periode = $_POST['periodeData'];
                    $isteElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $_POST['code']);
                    $periode = Yii::$app->simplelClass->selectPeriode($_POST['periodeData']);
                    $codePeriode = $_POST['periodeData'];
                    $annee = Yii::$app->mainCLass->unidata('dj_anneescolaire', $anneeActive);
                    $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);
                    $matiere = $_POST['matiereData'];
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
                    $pdf = $this->renderPartial('/concinelle/evaluation/fichenote.php', ['codePeriode' => $codePeriode, 'matiere' => $matiere, 'classe' => $classe, 'annee' => $annee['libelle'], 'listeElevee' => $isteElevee, 'periode' => $periode, 'infoets' => $infoets]);
                    //   $footer = $this->renderPartial('/concinelle/evalresul/detailstrimestrepdffooter.php');
                    $mpdf->showImageErrors = true;


                    $mpdf->WriteHTML($pdf);
                    $mpdf->SetDisplayMode('fullpage');
                    $mpdf->Output('print.pdf', 'I');


                    break;
                case md5(strtolower("modifieraddnote")):


                    if (sizeof($_POST['matricule']) > 0) {
                        foreach ($_POST['matricule'] as $key => $value) {

                            if (isset($_POST['notea3'][$key])) {

                                $note3 = $_POST['notea3'][$key];
                            } else {
                                $note3 = 0;
                            }
                            $verifier = Yii::$app->evaluationClass->infoEval($value, $_POST['codeEvaluation']);
                            // die(var_dump($verifier));
                            $code = Yii::$app->simplelClass->generateUniq();
                            // die(var_dump($_POST['codeEvaluation']));
                            if ($verifier) {
                                //  die(var_dump($_POST['moy1'][$key]));
                                $query = Yii::$app->evaluationClass->Updatenote($verifier['matricule'], $verifier['composition'], $verifier['codeEva'], $_POST['notea1'][$key], $_POST['notea2'][$key], $note3);
                            } else {
                                Yii::$app->evaluationClass->insertNote($code, $value, $_POST['notea1'][$key], $_POST['notea2'][$key], $note3, $_POST['codeEvaluation']);
                            }
                        }
                    }

                    $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);

                    break;
                case md5(strtolower("search")):
                    $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');
                    $liste = Yii::$app->evaluationClass->selectEvalforclasse($anneeActive, $_POST['classetSearch']);
                    // die(var_dump($liste));
                    return $this->render('/evaluation/evaluation.php', ['post' => $_POST, 'liste' => $liste, 'classe' => $classe]);

                    break;

                case md5(strtolower("modifiereval")):
                    // die(var_dump(($_POST)));
                    $anneeActive  = yii::$app->mainCLass->getAnneeActive();


                    $infoEva = Yii::$app->evaluationClass->selecuniquetEval($_POST['codeEva']);

                    $listeElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $infoEva['codeClasse']);
                    // die(var_dump($listeElevee));

                    return $this->render('/concinelle/evaluation/ajoutnote.php', ['listeElevee' => $listeElevee, 'infoEva' => $infoEva]);

                    break;
                case md5('update'):
                    //    die(var_dump(($_POST)));
                    $verifier = Yii::$app->evaluationClass->infoEval($_POST['matricule'], $_POST['codeEva']);

                    if (isset($_POST['note3'])) {

                        $note3 = $_POST['note3'];
                    } else {
                        $note3 = 0;
                    }
                    $query = Yii::$app->evaluationClass->Updatenote($_POST['matricule'], $_POST['compo'], $_POST['codeEva'], $_POST['note1'], $_POST['note2'], $note3);
                    return $this->redirect(Yii::$app->request->referrer);

                    break;

                case md5(strtolower("ajouterunenoter")):

                    if (sizeof($_POST['matricule']) > 0) {
                        foreach ($_POST['matricule'] as $key => $value) {

                            if (isset($_POST['moy3'][$key])) {

                                $note3 = $_POST['moy3'][$key];
                            } else {
                                $note3 = 0;
                            }
                            $verifier = Yii::$app->evaluationClass->infoEval($value, $_POST['codeEvaluation']);
                            // die(var_dump($verifier));
                            $code = Yii::$app->simplelClass->generateUniq();
                            // die(var_dump($_POST['codeEvaluation']));
                            if ($verifier) {
                                //  die(var_dump($_POST['moy1'][$key]));
                                $query = Yii::$app->evaluationClass->Updatenote($verifier['matricule'], $verifier['composition'], $verifier['codeEva'], $_POST['moy1'][$key], $_POST['moy2'][$key], $note3);
                            } else {
                                Yii::$app->evaluationClass->insertNote($code, $value, $_POST['moy1'][$key], $_POST['moy2'][$key], $note3, $_POST['codeEvaluation']);
                            }
                        }
                    }
                    return $this->redirect(Yii::$app->request->referrer);

                    break;
                case md5(strtolower("excel")):
                    $periode = $_POST['periodeData'];
                    $isteElevee = Yii::$app->eleveClass->listeparclasse($anneeActive, $_POST['code']);
                    $periode = Yii::$app->simplelClass->selectPeriode($_POST['periodeData']);
                    $codePeriode = $_POST['periodeData'];
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $annee = Yii::$app->mainCLass->unidata('dj_anneescolaire', $anneeActive);

                    //LOGO
                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing();
                    $drawing->setName('Spreadsheet-Coding.com Logo');
                    $drawing->setPath(__DIR__ . '/../web/mainAssets/logo/logo.png');
                    // Add the image to the header of the sheet
                    // $sheet->getHeaderFooter()->addImage($drawing, \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter::IMAGE_HEADER_LEFT);
                    $sheet->getHeaderFooter()->setOddFooter('&LWAMY INTERNATIONNAL Document&RPage &P of &N');

                    // Set the print header
                    $sheet->getHeaderFooter()->setOddHeader('&L&G');
                    $sheet->mergeCells('A1:D1');
                    $sheet->setCellValue('A1', 'FICHE RELEVER DE NOTE DE L\'EVALUATION DU ' . $periode . '');
                    // $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                    // $sheet->setCellValue('A2', 'Code Evaluation ' . $_POST['codeEva'] . '');
                    $sheet->mergeCells('A3:D3');
                    $sheet->setCellValue('A3', 'Classe: ' . $_POST['classeData'] . '');
                    $sheet->mergeCells('A4:D4');
                    $sheet->setCellValue('A4', 'Matiere: ' . $_POST['matiereData'] . '');
                    $sheet->mergeCells('A5:D5');
                    $sheet->setCellValue('A5', 'Annee Scolaire: ' . $annee['libelle'] . '');

                    $sheet->setCellValue('A7', 'MATRICULE');
                    $sheet->setCellValue('B7', 'NOM');
                    $sheet->setCellValue('C7', 'PRENOM');
                    $sheet->setCellValue('D7', 'ORALE');
                    $sheet->setCellValue('E7', 'ECRITE');
                    $sheet->setCellValue('F7', 'MOY');
                    $sheet->setCellValue('G7', 'ORALE');
                    $sheet->setCellValue('H7', 'ECRITE');
                    $sheet->setCellValue('I7', 'MOY');
                    if ($codePeriode > 3) {
                        $sheet->setCellValue('J7', 'ORALE');
                        $sheet->setCellValue('K7', 'ECRITE');
                        $sheet->setCellValue('L7', 'MOY');
                    }

                    //style
                    $style = $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);;

                    $style = $sheet->getStyle('A3')->getFont()->setSize(12);
                    $style = $sheet->getStyle('A4')->getFont()->setSize(12);
                    $style = $sheet->getStyle('A5')->getFont()->setSize(12);
                    //HEADER

                    $sheet->setCellValue('D6', 'MOIS');
                    $sheet->setCellValue('G6', 'MOIS');

                    if ($codePeriode > 3) {

                        $sheet->setCellValue('j6', 'MOIS');
                    }


                    $sheet->getStyle('D6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('G6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle('J6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                    //HEADER MOMIS
                    $sheet->mergeCells('D6:F6');
                    $sheet->mergeCells('G6:I6');
                    $sheet->mergeCells('J6:L6');


                    $style = $sheet->getStyle('A7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('B7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('C7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('D7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('E7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('F7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('G7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('H7')->getFont()->setBold(true)->setSize(13);
                    $style = $sheet->getStyle('I7')->getFont()->setBold(true)->setSize(13);
                    if ($codePeriode > 3) {
                        $style = $sheet->getStyle('J7')->getFont()->setBold(true)->setSize(13);
                        $style = $sheet->getStyle('K7')->getFont()->setBold(true)->setSize(13);
                        $style = $sheet->getStyle('L7')->getFont()->setBold(true)->setSize(13);
                    }


                    $style = $sheet->getStyle('A7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('B7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('C7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('D7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('E7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('F7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('G7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('H7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $style = $sheet->getStyle('I7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    if ($codePeriode > 3) {
                        $style = $sheet->getStyle('J7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                        $style = $sheet->getStyle('K7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                        $style = $sheet->getStyle('L7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    }

                    $style = $sheet->getStyle('A7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('B7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('C7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('D7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('E7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('F7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('G7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('H7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    $style = $sheet->getStyle('I7')->getFill()->getStartColor()->setARGB('F1F1F1FF');

                    if ($codePeriode > 3) {
                        $style = $sheet->getStyle('J7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                        $style = $sheet->getStyle('K7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                        $style = $sheet->getStyle('L7')->getFill()->getStartColor()->setARGB('F1F1F1FF');
                    }

                    $sheet->getColumnDimension('A')->setWidth(15);
                    $sheet->getColumnDimension('B')->setWidth(20);
                    $sheet->getColumnDimension('C')->setWidth(35);


                    //chargement des donner
                    // die(var_dump($isteElevee));
                    if (sizeof($isteElevee) > 0) {
                        $i = 8;
                        foreach ($isteElevee as $key => $value) {
                            $sheet->setCellValue('A' . $i, $value['matricule']);
                            $sheet->setCellValue('B' . $i, $value['nom']);
                            $sheet->setCellValue('C' . $i, $value['prenom']);
                            $sheet->setCellValue('F' . $i, '=(D' . $i . '+ E' . $i . ')/2');
                            $sheet->setCellValue('I' . $i, '=(G' . $i . '+ H' . $i . ')/2');
                            $sheet->setCellValue('F' . $i, '=(D' . $i . '+ E' . $i . ')/2');
                            if ($codePeriode > 3) {
                                $sheet->setCellValue('L' . $i, '=(J' . $i . '+ K' . $i . ')/2');
                            }

                            $i++;
                        }
                        $j = $i + 5;
                        $sheet->setCellValue('A' . $j, 'code Evaluation');
                        $sheet->mergeCells('B' . $j . ':F' . $j);

                        $sheet->setCellValue('B' . $j, $_POST['codeEva']);
                    }

                    $sheet->getProtection()->setSheet(true);
                    $sheet->getStyle('D')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('E')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('G')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('H')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('I')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('j')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
                    $sheet->getStyle('k')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

                    $fileName = 'fichedeNote.xlsx';

                    $writer = new Xlsx($spreadsheet);
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
                    $writer->save('php://output');
                    die(var_dump($isteElevee));
                    break;
                case md5(strtolower("pdf")):
                    $file = $_FILES['fichier'];
                    if (isset($file) && sizeof($file) > 0) {

                        $file_name = $file['name'];
                        $file_size = $file['size'];
                        $file_tmp = $file['tmp_name'];
                        $file_type = $file['type'];
                        $extCounter = explode('.', $file_name);

                        $file_ext = end($extCounter);

                        $expensions = "xlsx";
                        $file_uni_name = 'note.' . $file_ext;
                        $rslt = '';
                        if ($file_ext === $expensions) {
                            $rslt = 'succes';
                        }
                        if ($file_size > '30000') {
                            $rslt = 'error';
                        }

                        if ($rslt == 'succes') {

                            $targetfolder = \Yii::getAlias(yii::$app->basePath . yii::$app->params['document']);


                            if (move_uploaded_file($file_tmp, $targetfolder . $file_uni_name)) {
                                $spreadsheet = IOFactory::load($targetfolder . $file_uni_name);
                                $worksheet = $spreadsheet->getActiveSheet();
                                $data = [];

                                foreach ($worksheet->getRowIterator() as $row) {
                                    $row_data = [];

                                    foreach ($row->getCellIterator() as $cell) {
                                        $row_data[] = $cell->getValue();
                                    }

                                    $data[] = $row_data;
                                }

                                $i = $j = 0;
                                $donner = null; //fixer
                                foreach ($data as $key => $value) {
                                    $i++;
                                    if ($i > 7 && $i < (sizeof($data) - 5)) {

                                        $notea1 = $value[3];
                                        $notea2 = $value[4];
                                        $notea = ($value[3] + $value[4]) / 2;
                                        $noteb1 = $value[6];
                                        $noteb2 = $value[7];
                                        $noteb = ($value[6] + $value[7]) / 2;
                                        $notec1 = $value[9];
                                        $notec2 = $value[10];
                                        $notec = ($value[9] + $value[10]) / 2;

                                        $j++;
                                        $donner[$j] = [
                                            'matricule' => $value['0'],
                                            'notea1' => $notea1,
                                            'notea2' => $notea2,
                                            'notea' => $notea,
                                            'noteb1' => $noteb1,
                                            'noteb2' => $noteb2,
                                            'noteb' => $noteb,
                                            'notec1' => $notec1,
                                            'notec2' => $notec2,
                                            'notec' => $notec,
                                        ];
                                    }
                                }
                                // die(var_dump($donner));
                                $codeEval = $data[$i - 1]['1'];
                                return $this->render('/evaluation/import.php', ['donner' => $donner, 'codeEval' => $codeEval]);
                            }

                            return $this->redirect(Yii::$app->request->referrer);
                        }
                    }

                    break;


                default:
                    # code...
                    break;
            }
            if (!empty($_POST['periode'] && $_POST['matiere'] && $_POST['classe'] && $_POST['date'] && $_POST['Coeficient'])) {
                // die(var_dump($_POST));
                $code = Yii::$app->simplelClass->generateUniq();
                $periode = $_POST['periode'];
                $codeMatiere = $_POST['matiere'];
                $date = $_POST['date'];
                $codeclasse = $_POST['classe'];
                $sujet = '';


                if ($periode < 4) {
                    $typeEval = '1';
                } else {
                    $typeEval = '2';
                }
                // die(var_dump($typeEval));
                $filename = yii::$app->simplelClass->upload_image(yii::$app->params['document'], $_FILES['sujet']);
                if ($filename != null) {
                    $sujet = $filename;
                }
                Yii::$app->evaluationClass->inserteval($code, $periode, $codeMatiere, $date, $codeclasse, $anneeActive, $sujet, $_POST['Coeficient'], $typeEval, $ets);

                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                Yii::$app->session->setFlash('flashmsg', $notification);
                return $this->redirect(Yii::$app->request->referrer);
            } else {
            }
        }
        $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');
        $liste = Yii::$app->evaluationClass->selectEval($anneeActive);
        return $this->render('/concinelle/evaluation/evaluation.php', ['liste' => $liste, 'classe' => $classe]);
    }



    public function actionResultatconcinelle()
    {

        $ets = yii::$app->mainCLass->getets();
        $liste = Yii::$app->configClass->listClasse($ets);
        $anneeActive  = yii::$app->mainCLass->getAnneeActive();


        if (isset($_GET['code'])) {

            $codeclasse = $_GET['code'];
            $typeCompo = Yii::$app->configClass->infClasse($codeclasse);
            $liste = yii::$app->eleveClass->listeclasse($anneeActive, $codeclasse);
            // die(var_dump($typeCompo));
            if ($typeCompo['typeCompo'] == 1) {
                $default = 1;
            } else {
                $default = 4;
            }

            return $this->render('/concinelle/evalresul/detailstrimestre.php', ['liste' => $liste, 'periode' => $default, 'typeCOmpo' => $typeCompo['typeCompo'], 'codeclasse' => $codeclasse]);
        }

        if (yii::$app->request->isPost) {


            $periode = $_POST['Periode'];
            $codeclasse = $_POST['classe'];
            if ($_POST['action'] == md5(strtolower("primelistespdf"))) {
                // die(var_dump($_POST));
                $codeclasse = $_POST['classe'];
                $typeCompo = Yii::$app->configClass->infClasse($codeclasse);
                $liste = yii::$app->eleveClass->listeclasse($anneeActive, $codeclasse);
                $eva = yii::$app->evaluationClass->evalClasse($anneeActive, $codeclasse, $_POST['Periode']);
                $periode = yii::$app->simplelClass->selectPeriode($_POST['Periode']);
                $noteAllElve = yii::$app->evaluationClass->noteallbystatitqueconcinelle($anneeActive, $codeclasse, $_POST['Periode']);
                $annee = yii::$app->mainCLass->databycode('dj_anneescolaire', $anneeActive, 'code');
                $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'margin_left' => 2,
                    'margin_right' => 2,
                    'margin_top' => 2,
                    'margin_bottom' => 30,
                    'margin_header' => 10,
                    'margin_footer' => 10,


                ]);
                $pdf = $this->renderPartial('/concinelle/evalresul/detailstrimestrepdf.php', ['infoclasse' => $typeCompo, 'periode' => $_POST['Periode'], 'noteAllElve' => $noteAllElve, 'eva' => $eva, 'typeCOmpo' => $typeCompo['typeCompo'], 'codeclasse' => $codeclasse, 'annee' => $annee, 'infoets' => $infoets]);
                $footer = $this->renderPartial('/concinelle/evalresul/detailstrimestrepdffooter.php');
                $mpdf->showImageErrors = true;

                $mpdf->SetHTMLFooter($footer);
                $mpdf->SetHTMLFooter($footer, 'E');

                $mpdf->WriteHTML($pdf);
                $mpdf->SetDisplayMode('fullpage');
                $mpdf->Output('djangai.pdf', 'I');
            }

            if ($_POST['action'] == md5(strtolower("resultatfinal"))) {


                $info = yii::$app->eleveClass->infoeleve($anneeActive, $_POST['codeE']);
                $classe = yii::$app->configClass->infClasse($_POST['classe']);
                $matiere = yii::$app->evaluationClass->infoclasse($_POST['classe']);


                $periode = yii::$app->simplelClass->selectPeriode($_POST['Periode']);
                //determinier le rang d'un eleves
                $noteAllElve = yii::$app->evaluationClass->noteall($anneeActive, $classe, $classe['typeCompo']);
                $rang = yii::$app->evaluationClass->rang($noteAllElve, $_POST['codeE']);
                $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);
                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'margin_left' => 2,
                    'margin_right' => 2,
                    'margin_top' => 2,
                    'margin_bottom' => 30,
                    'margin_header' => 10,
                    'margin_footer' => 10,


                ]);

                $lien = yii::$app->request->baseurl . '/' . md5('visiteur_validebuletin') . '/' . $_POST['codeE'] . '/' . $anneeActive;


                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                    $url = "https";
                } else {
                    $url = "http";
                }
                $url .= "://";
                $_SERVER['REQUEST_URI'] = $lien;
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];

                //   die($url);
                $qrimage = yii::$app->simplelClass->codeqr($url);

                $filname = 'filename';
                $mpdf->SetDisplayMode('fullpage');
                if ($classe["typeCompo"] == 1) {
                    $pdf = $this->renderPartial('/repports/result/primesemsestrePrim.php', ['info' => $info, 'classe' => $classe, 'matiere' => $matiere, 'anneeActive' => $anneeActive, 'rang' => $rang, 'periode' => $_POST['Periode'], 'qrimage' => $qrimage, 'infoets' => $infoets]);
                } else {
                    $pdf = $this->renderPartial('/repports/result/primesemsestrSem.php', ['info' => $info, 'classe' => $classe, 'matiere' => $matiere, 'anneeActive' => $anneeActive, 'rang' => $rang, 'periode' => $_POST['Periode'], 'qrimage' => $qrimage, 'infoets' => $infoets]);
                }
                $footer = $this->renderPartial('/repports/result/primesemsestreFooter.php', ['qrimage' => $qrimage]);
                $mpdf->SetHTMLFooter($footer);
                $mpdf->WriteHTML($pdf);
                $mpdf->SetDisplayMode('fullpage');
                $mpdf->Output('djangai.pdf', 'I');


                // die();
                // return $this->render('/repports/resultafint.php');
                die('Encours de traitement');
            }
            $statut = $_POST['Statut'];
            $composer = $_POST['composer'];

            $liste = yii::$app->eleveClass->listeclasse($anneeActive, $codeclasse);
            if ($periode < 4) {
                $typeCompo = 1;
            } else {
                $typeCompo = 2;
            }

            // echo($typeCompo);die();
            $eva = yii::$app->evaluationClass->evalClasse($anneeActive, $codeclasse, $periode);
            return $this->render('/concinelle/evalresul/detailstrimestre.php', [
                'liste' => $liste,
                'eva' => $eva,
                'typeCOmpo' => $typeCompo,
                'codeclasse' => $codeclasse,
                'statut' => $statut,
                'composer' => $composer,
                'periode' => $periode
            ]);

            // die(var_dump($_POST));
        }
        // die('ok');
        return $this->render('/concinelle/evalresul/vueprincipal.php', ['liste' => $liste]);
    }



    public function actionLangage()
    {
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $ets = yii::$app->mainCLass->getets();
        $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');

        $typeCompo = Yii::$app->simplelClass->typeCompo();
        if (yii::$app->request->isPost) {
            if ($_POST['action'] == "filtrrecherche") {
                 $liste = yii::$app->evaluationClass->filtrelangage($ets,$_POST['classetSearch'],$_POST['langagefiltre']);
                return $this->render('/concinelle/maternelle/language.php', ['liste' => $liste,'classe'=>$classe,'post'=>$_POST]);

            }
           
            if ($_POST['action'] == md5(strtolower("modifierfonction"))) {
                Yii::$app->evaluationClass->updatelanguage($_POST['libelle'], "", $_POST['etat'], $_POST['classe'], $_POST['langage'], $_POST['code']);
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
                Yii::$app->session->setFlash('flashmsg', $notification);
                return $this->redirect(Yii::$app->request->referrer);
            }
           
            $libelle = $_POST['libelle'];
            $classe = $_POST['classe'];
            $langage = $_POST['langage'];
            $code = Yii::$app->simplelClass->generateUniq();

            $tableName = "dj_language";
            $columnValue["code"] = $code;
            $columnValue["libelle"] = $libelle;
            $columnValue["codeetbs"] = $ets;
            $columnValue["codeclasse"] = $classe;
            $columnValue["typelangage"] = $langage;
            $main->insertData($tableName, $columnValue);
            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(Yii::$app->request->referrer);
        }
      
        $liste = Yii::$app->mainCLass->getAlltableData('dj_language');
        return $this->render('/concinelle/maternelle/language.php', ['liste' => $liste,'classe'=>$classe]);
    }



}
