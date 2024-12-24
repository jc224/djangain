<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class EleveController extends Controller
{
    public function actionEnrollement()
    {
       
        $ets =yii::$app->mainCLass->getets();
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $anneeActive = yii::$app->mainCLass->getAnneeActive();
        $columnName = $tableName = $tableNames = $whereValue = $whereValueSelect = $inColumn = $inValue = $formatBy = $paginate = null;
        $columnName = '*';
        $liste = yii::$app->mainCLass->getAlltableData('dj_classe');
        if (yii::$app->request->isPost) {
            if (isset($_POST['action_key'])) {
                $eleves = yii::$app->eleveClass->infoeleve($anneeActive, $_POST['codeEleve']);
                $liste = yii::$app->mainCLass->getAlltableData('dj_classe');

                $nomMere = '';
                $tuteur = '';
                $tel = '';
                $photo = '';

                $nom = $_POST['nom'];
                $prenom = $_POST['Prenom'];
                $genre = $_POST['genre'];
                $dateNaissance = $_POST['dateNaissance'];
                $lieuNaissance = $_POST['lieuNai'];
                $matricule = $_POST['mat'];
                $adresse = $_POST['adresse'];
                $niveau = $_POST['Classe'];
                $nomP = $_POST['nom'];
                $prenomMere = $_POST['PrenomM'];
                $nomMere = $_POST['nomM'];
                $prenomtuteur = $_POST['prenomtuter'];
                $nomtuteur = $_POST['nomtuteur'];
                $telTuteur = $_POST['telTuteur'];
                $document = $_POST['document'];
                $photo = $_POST['avatare'];
                // die(var_dump($photo));
                if (!empty($_POST['photo'])) {
                    $filenames = $nonSql->upload_image64(yii::$app->params['linkToUploadIndividusProfil'], $_POST['photo']);
                    if ($filenames != null) {
                        $photo = $filenames;
                    }
                }


                yii::$app->eleveClass->editEleves($_POST['codeEleve'], $nom, $prenom, $genre, $dateNaissance, $lieuNaissance, $niveau, $matricule, $photo, $adresse, $telTuteur, '', $nomP, $nomMere, $prenomMere, $nomtuteur, $prenomtuteur, $document, $_POST['gsanguin'], $_POST['alergie'], $_POST['maladie'], $_POST['typepaiement']);
                // $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['attention'], yii::t('app', 'infosAAffairerVide'));
                // Yii::$app->session->setFlash('flashmsg', $notification);
                $eleves = yii::$app->eleveClass->infoeleve($anneeActive, $_POST['codeEleve']);

                return $this->render('/eleve/update.php', ['infoeleve' => $eleves, 'liste' => $liste]);
            }


            if ($_POST['action'] == md5(strtolower("profil"))) {
                $eleves = yii::$app->eleveClass->infoeleve($anneeActive, $_POST['code']);

                return $this->render('/eleve/profilprincipal.php', ['info' => $eleves]);
            }



            if ($_POST['action'] == md5("filtrer")) {
                $listeclasse = yii::$app->eleveClass->actionListclass();

                $liste = yii::$app->eleveClass->listefiltre($_POST['search'], $anneeActive, $_POST['classetSearch']);
                return $this->render('/eleve/listeParClasse/listeleve.php', ['post' => $_POST, 'listeclasse' => $listeclasse, 'liste' => $liste, 'classe' => $_POST['classetSearch']]);
            }


            if ($_POST['action'] == md5(("printlist"))) {

                $liste = yii::$app->eleveClass->listefiltre($_POST['search'], $anneeActive, $_POST['classetSearch']);
                $classe = yii::$app->configClass->infClasse($_POST['classetSearch']);
                $ets = yii::$app->mainCLass->unidata('dj_etbs', $ets);
                // die(var_dump($ets));
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

                // $mpdf->showImageErrors = true;


                $pdf = $this->renderPartial('/eleve/impression/listpdf.php', ['liste' => $liste, 'classe' => $classe,'infoets'=>$ets]);

                $footer = $this->renderPartial('/evalresul/detailstrimestrepdffooter.php');
                $mpdf->SetHTMLFooter($footer);

                $mpdf->SetHTMLFooter($footer, 'E');
                $mpdf->WriteHTML($pdf);

                $mpdf->Output('djangai.pdf', 'I');
                return $this->redirect(Yii::$app->request->referrer);
            }

            if ($_POST['action'] == md5(strtolower("modifiereleve"))) {
                $eleves = yii::$app->eleveClass->infoeleve($anneeActive, $_POST['code']);
                $liste = yii::$app->mainCLass->getAlltableData('dj_classe');

                return $this->render('/eleve/update.php', ['infoeleve' => $eleves, 'liste' => $liste]);

                // die(var_dump($eleves));
            }

            $nomMere = '';
            $tuteur = '';
            $tel = '';
            $photo = '';

            $nom = $_POST['nom'];
            $prenom = $_POST['Prenom'];
            $genre = $_POST['genre'];
            $dateNaissance = $_POST['dateNaissance'];
            $lieuNaissance = $_POST['lieuNai'];
            $matricule = $_POST['mat'];
            $adresse = $_POST['adresse'];
            $niveau = $_POST['Classe'];
            $nomP = $_POST['nomP'];
            $prenomMere = $_POST['PrenomM'];
            $nomMere = $_POST['nomM'];
            $prenomtuteur = $_POST['prenomtuter'];
            $nomtuteur = $_POST['nomtuteur'];
            $telTuteur = $_POST['telTuteur'];
            $document = $_POST['document'];
            $typepaiement = $_POST['typepaiement'];
            $code = Yii::$app->simplelClass->generateUniq();

            // $photo = $_POST['avatare'];

            if (!empty($_POST['photo'])) {
                $filenames = $nonSql->upload_image64(yii::$app->params['linkToUploadIndividusProfil'], $_POST['photo']);
                if ($filenames != null) {
                    $photo = $filenames;
                }
            }

            //  die(var_dump($_POST));
            yii::$app->eleveClass->addEleves($code, $nom, $prenom, $genre, $dateNaissance, $lieuNaissance, $niveau, $matricule, $photo, $adresse, $telTuteur, $ets, $nomP, $nomMere, $prenomMere, $nomtuteur, $prenomtuteur, $document, $_POST['gsanguin'], $_POST['alergie'], $_POST['maladie'], $typepaiement,$ets);
            $codeLien = Yii::$app->simplelClass->generateUniq();

            yii::$app->eleveClass->insertdatacard($codeLien, '0', $niveau, $code, $anneeActive,$ets);

            $codeLien = Yii::$app->simplelClass->generateUniq();

            $tabs = 'dj_lien_eleve_classe';
            $col["code"] = $codeLien;
            $col["codeClasse"] = $_POST['Classe'];
            $col["codeEleve"] = $code;
            $col["codeAnnee"] = $anneeActive;
            $col["codeetbs"] = $ets;
            $main->insertData($tabs, $col);
            //afficher le message de success
            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(Yii::$app->request->referrer);
        }

        $mat = yii::$app->simplelClass->matricule($ets);
        if ($mat) {

            $matricule = yii::$app->simplelClass->genereMatricule($mat,$ets);
        } else {

            $matricule = yii::$app->simplelClass->genereMatricule(0,$ets);

        }
        if($ets == '1858e3a7453dd1b90e8fafdbca2c34f8f507dc6bfece38f1'){
            // die('ok');
            return $this->render('/eleve/enrollementconcinelle.php', ['liste' => $liste, 'matricule' => $matricule]);

        }else{
            return $this->render('/eleve/enrollement.php', ['liste' => $liste, 'matricule' => $matricule]);

        }

    }

    public function actionListeleve()
    {
        // die('ok');
        $liste = yii::$app->eleveClass->actionListclass();
        return $this->render('/eleve/listeeleve.php', ['liste' => $liste]);
    }




    public function actionList()
    {
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $listeclasse = yii::$app->eleveClass->actionListclass();


        $anneeActive = yii::$app->mainCLass->getAnneeActive();


        $classe = $_GET['classe'];

        $liste = yii::$app->eleveClass->listeclasse($anneeActive, $classe);

        return $this->render('/eleve/listeParClasse/listeleve.php', ['listeclasse' => $listeclasse, 'liste' => $liste, 'classe' => $classe]);
    }

    public function actionFiltre()
    {
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $listeclasse = yii::$app->eleveClass->actionListclass();


        $anneeActive = yii::$app->mainCLass->getAnneeActive();

        if (yii::$app->request->isPost) {
            // die(var_dump($_POST));
            if ($_POST['action'])
                $liste = yii::$app->eleveClass->listefiltre($_POST['search'], $anneeActive, $_POST['classetSearch']);
            return $this->render('/eleve/listeParClasse/listeleve.php', ['post' => $_POST, 'listeclasse' => $listeclasse, 'liste' => $liste, 'classe' => $_POST['classetSearch']]);
        }
    }


    public function actionInscription()
    {

        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $columnName = $tableName = $tableNames = $whereValue = $whereValueSelect = $inColumn = $inValue = $formatBy = $paginate = null;
        $columnName = '*';

        if (yii::$app->request->isPost) {
            $tabs = 'dj_eleve';
            $whereValues["dj_eleve.matricule"] = $_POST['matricule'];
            $elevearray = $main->selectJoinData($columnName, $tabs, $whereValues);
            $eleve = $elevearray[0];

            $code = $nonSql->generateUniq();
            $tabs = 'dj_lien_eleve_classe';
            $col["code"] = $code;
            $col["codeClasse"] = $_POST['classe'];
            $col["codeEleve"] = $eleve['code'];
            $col["statut"] = 1;
            $main->insertData($tabs, $col);
            if ($eleve['statut'] == 1) {

                $tabs = 'dj_eleve';
                $columnValue["statut"] = 2;
                $whereValue["code"] = $eleve['code'];

                $update = $main->updateData($tabs, $columnValue, @$whereValue);
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        $tabs = 'dj_eleve';

        $whereValues["dj_eleve.statut"] = 1;

        $listAtente = $main->selectJoinData($columnName, $tabs, $whereValues);
        $tableNames = "dj_classe";
        $classe = $main->selectdata($columnName, $tableNames);
        return $this->render('/eleve/inscription/inscription.php', ['listAtente' => $listAtente, 'classe' => $classe]);
    }

    public function actionImportdata()
    {

        if (Yii::$app->request->isPost) {
            if (!empty($_FILES['file']['name'])) {
                $extensions = array('.xls', '.xlsx', '.xlsm');
                $extension = strtolower(strrchr($_FILES['file']['name'], '.'));

                $fichier = basename($_FILES['file']['name']);

                if (!in_array($extension, $extensions)) {
                    $this->vue->verif = "Extension non autoris&eacute;e! Seuls (.xls, .xlsx, .xlsm) sont autoris&eacute;es!";
                } else {
                    $fichier = strtr(
                        $fichier,
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
                    );

                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                    // die($fichier);

                    $filename = yii::$app->simplelClass->upload_image(yii::$app->params['linkToUploadIndividusProfil'], $_FILES['file']);


                    if ($filename != null) {
                        $photo = $filename;
                    }

                    $targetfolder = \Yii::getAlias(yii::$app->basePath . yii::$app->params['linkToUploadIndividusProfil']);
                    // die($targetfolder);

                    $fp = fopen($targetfolder . $filename, "r");
                    // die($fp);
                    while (!feof($fp)) {
                        $ligne = fgets($fp, 4096);

                        $liste = explode(";", $ligne);

                        $id = $liste[0];
                        $cp = $liste[1];
                        $ville = $liste[2];
                    }
                    $this->vue->verif = "Fichier importé avec sucès !";
                }
            } else {
                die("errue");
            }
        }






        // if ( $xlsx = SimpleXLSX::parse('books.xlsx')) {
        //     // Produce array keys from the array values of 1st array element
        //     $header_values = $rows = [];
        //     foreach ( $xlsx->rows() as $k => $r ) {
        //         if ( $k === 0 ) {
        //             $header_values = $r;
        //             continue;
        //         }
        //         $rows[] = array_combine( $header_values, $r );
        //     }
        //     print_r( $rows );
        // }

    }
    public function actionListelevep()
    {

        $ets =yii::$app->mainCLass->getets();
        $anneeActive = yii::$app->mainCLass->getAnneeActive();
        $userCode = yii::$app->mainCLass->getusers();
        $code = Yii::$app->simplelClass->generateUniq();
        $classe = yii::$app->personnelClass->selectlisteclasseforprof($anneeActive, $userCode);
        if (Yii::$app->request->isPost) {

            if ($_POST['action'] == md5("filtrer")) {

                $liste = yii::$app->eleveClass->listefiltre($_POST['search'], $anneeActive, $_POST['classetSearch']);
                return $this->render('/eleve/listeParClasse/listelevep.php', ['post' => $_POST, 'listeclasse' => $classe, 'liste' => $liste, 'classe' => $_POST['classetSearch']]);
            }


            if ($_POST['action'] == md5(("printlist"))) {

                $liste = yii::$app->eleveClass->listefiltre($_POST['search'], $anneeActive, $_POST['classetSearch']);
                $classe = yii::$app->configClass->infClasse($_POST['classetSearch']);
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

                $mpdf->showImageErrors = true;


                $pdf = $this->renderPartial('/eleve/impression/listpdf.php', ['liste' => $liste, 'classe' => $classe,'infoets'=>$infoets]);

                $footer = $this->renderPartial('/evalresul/detailstrimestrepdffooter.php');
                $mpdf->SetHTMLFooter($footer);

                $mpdf->SetHTMLFooter($footer, 'E');
                $mpdf->WriteHTML($pdf);

                $mpdf->Output('djangai.pdf', 'I');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->render('/eleve/listeelevep.php', ['liste' => $classe]);
    }

    public function actionListp()
    {

        $anneeActive = yii::$app->mainCLass->getAnneeActive();

        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $userCode = yii::$app->mainCLass->getusers();

        $listeclasse = yii::$app->personnelClass->selectlisteclasseforprof($anneeActive, $userCode);


        $anneeActive = yii::$app->mainCLass->getAnneeActive();


        $classe = $_GET['classe'];

        $liste = yii::$app->eleveClass->listeclasse($anneeActive, $classe);

        return $this->render('/eleve/listeParClasse/listelevep.php', ['listeclasse' => $listeclasse, 'liste' => $liste, 'classe' => $classe]);
    }
}
