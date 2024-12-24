<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ComptableController extends Controller
{



    public function actionHispaiemnteleves()
    {
        $hhistoriquepaiement = yii::$app->personnelClass->selsectpaiement();
        $search="";
        $acte="";
        if(Yii::$app->request->isPost){
            $search =$_POST['search'];
            $acte =$_POST['catsearch'];
        }
        $hhistoriquepaiement = yii::$app->personnelClass->selsectpaiement($search,$acte);
        $montantotal = yii::$app->personnelClass->montantscolarite($search,$acte);
        $payement = yii::$app->mainCLass->getAlltableData('dj_payement');
        return $this->render('/comptabilite/historiquepaiement/scolarite.php', ['hhistoriquepaiement' => $hhistoriquepaiement, 'payement' => $payement,'search'=>$search,'acte'=>$acte,'montantotal'=>$montantotal]);
    }

    public function actionScolarite()
    {
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $compt = yii::$app->comptabiliteClass;
        $anneeActive = yii::$app->mainCLass->getAnneeActive();
        $userCode = yii::$app->mainCLass->getusers();
        $ets = yii::$app->mainCLass->getets();
        // die(var_dump($_POST));
        $columnName = $tableName = $tableNames = $whereValue = $whereValueSelect = $inColumn = $inValue = $formatBy = $paginate = null;
        $columnName = '*';

        $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');
        $paiement = Yii::$app->mainCLass->getAlltableData('dj_payement');

        $table = null;
        $table[0] = 'dj_eleve';
        $table[1] = 'dj_lien_eleve_classe';
        $table[2] = 'dj_classe';

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
        $col[11] = "dj_classe.libelle as classe";
        $col[12] = "dj_classe.code as codeClsse";
        $whereValues["dj_eleve.code"] = "dj_lien_eleve_classe.codeEleve";
        $whereValues["dj_eleve.statut"] = 0;
        $whereValues["dj_lien_eleve_classe.codeAnnee"] = "'$anneeActive'";
        $whereValues["dj_lien_eleve_classe.codeClasse"] = "dj_classe.code ";
        $whereValues["dj_lien_eleve_classe.codeetbs"] = "'$ets'";


        $listAtente = $main->selectJoinData($col, $table, $whereValues);

        if (yii::$app->request->isPost) {


            if (isset($_POST['action'])) {

                if ($_POST['action'] == 'recu') {
                    $infopiement = $compt->selectpaiemeteleve($_POST['code'], $_POST['paiementSearch'], $anneeActive);
                    $infoeleve = yii::$app->eleveClass->infoformatricule($anneeActive, $_POST['maricule']);
                    $classe = yii::$app->mainCLass->unidata('dj_classe', $infoeleve['codeClasse']);
                    $paiement = yii::$app->mainCLass->unidata('dj_payement', $infopiement['codePayement']);
                    $lien = yii::$app->request->baseurl . '/' . md5('visiteur_validationrecu') . '/' . $_POST['paiementSearch'] . '/' . $_POST['code'] . '/' . base64_encode(json_encode($_POST['maricule']));


                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                        $url = "https";
                    } else {
                        $url = "http";
                    }
                    $url .= "://";
                    $_SERVER['REQUEST_URI'] = $lien;
                    $url .= $_SERVER['HTTP_HOST'];
                    $url .= $_SERVER['REQUEST_URI'];

                    
                    $qrimage = yii::$app->simplelClass->codeqr($url);
                    //   die(var_dump($paiement));
                    $mpdf = new \Mpdf\Mpdf([
                        'mode' => 'utf-8',
                        'format' => 'A4',
                        'orientation' => 'P',
                        'margin_left' => 2,
                        'margin_right' => 2,
                        'margin_top' => 2,
                        'margin_bottom' => 30,
                        'margin_header' => 10,
                        'margin_footer' => 10,


                    ]);
                    $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                    $pdf = $this->renderPartial('/comptabilite/pdf/recu.php', ['acte' => $paiement['libelle'], 'qrimage' => $qrimage, 'infopiement' => $infopiement, 'infoeleve' => $infoeleve, 'classe' => $classe['libelle'],'infoets'=>$infoets]);
                    $mpdf->WriteHTML($pdf);
                    $mpdf->SetDisplayMode('fullpage');
                    $mpdf->Output('scolaritew' . date('Y-m-d') . '.pdf', 'I');
                }


                if ($_POST['action'] == md5('update')) {

                    if ($_POST['uodaterestant'] == '0') {
                        $statut = '1';
                    } else {
                        $statut = '0';
                    }
                    // die(var_dump($statut));

                    $montant = $_POST['updatepayer'] + $_POST['montantpayer'];
                    $compt->updatetpaiement($_POST['codepaiemt'], $montant, $userCode, $_POST['uodaterestant'], $statut);
                    $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                }
                if ($_POST['action'] == md5('filtrer')) {

                    $filtre = $compt->searchcomptabilite($_POST['search'], $_POST['classetSearch'], $_POST['statutSearch'], $_POST['paiementSearch'], $ets);
                    // die(var_dump($filtre));
                    return $this->render('/comptabilite/scolarite/scolarite.php', ['listAtente' => $filtre, 'classe' => $classe, 'paiement' => $paiement, 'post' => $_POST]);
                }

                if ($_POST['action'] == md5('exporterpdf')) {

                    $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                    $filtre = $compt->searchcomptabilite($_POST['search'], $_POST['classetSearch'], $_POST['statutSearch'], $_POST['paiementSearch'], $ets);
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
                    $pdf = $this->renderPartial('/comptabilite/pdf/liste.php', ['listAtente' => $filtre, 'post' => $_POST, 'infoets' => $infoets]);
                    $footer = $this->renderPartial('/evalresul/detailstrimestrepdffooter.php');
                    $mpdf->showImageErrors = true;

                    $mpdf->SetHTMLFooter($footer);
                    $mpdf->SetHTMLFooter($footer, 'E');

                    $mpdf->WriteHTML($pdf);
                    $mpdf->SetDisplayMode('fullpage');
                    $mpdf->Output('scolaritew' . date('Y-m-d') . '.pdf', 'I');
                }


                if (isset($_POST['somPaier'])) {
                    if (sizeof($_POST['somPaier']) > 0) {
                        //   die(var_dump($paiement));
                        $mpdf = new \Mpdf\Mpdf([
                            'mode' => 'utf-8',
                            'orientation' => 'L',
                            'format' => 'A4',
                            'margin_left' => 2,
                            'margin_right' => 2,
                            'margin_top' => 2,
                            'margin_bottom' => 30,
                            'margin_header' => 10,
                            'margin_footer' => 10,


                        ]);
                        foreach ($_POST['somPaier'] as $key => $value) {

                            if ($value >= $_POST['montant'][$key]) {
                                if ($_POST['reste'][$key] == '0') {
                                    $statut = '1';
                                } else {
                                    $statut = '0';
                                }
                                $code = $nonSql->generateUniq();
                                $col = null;
                                $tabs = 'dj_lien_payement_eleve';
                                $col["code"] = $code;
                                $col["codePayement"] = $_POST['codepaiement'][$key];
                                $col["codeAnnee"] = $anneeActive;
                                $col["codeEleve"] = $_POST['code'];
                                $col["montant"] = $_POST['montant'][$key];
                                $col["restePayer"] = $_POST['reste'][$key];
                                $col["datePayement"] = $_POST['datepaiement'];
                                $col["acteur"] = $userCode;
                                $col["codeetbs"] = $ets;
                                $col["statut"] = $statut;
                                $main->insertData($tabs, $col);

                                $table = $whereValues = null;
                                $columnName = '*';
                                $table = 'dj_eleve';
                                $codeE = $_POST['code'];
                                $whereValues["dj_eleve.code"] = "'$codeE'";


                                $eleve = $main->selectJoinData($columnName, $table, $whereValues);
                                // die(var_dump($eleve));
                                if ($eleve[0]['statut'] == 0) {

                                    $tabs = 'dj_eleve';
                                    $columnValue["statut"] = 1;
                                    $whereValue["code"] = $eleve[0]['code'];

                                    $update = $main->updateData($tabs, $columnValue, @$whereValue);

                                    $tabs = 'dj_lien_eleve_classe';
                                    $coluns["status"] = 1;
                                    $codeEleve = $eleve[0]['code'];
                                    $where1["codeEleve"] = $codeEleve;
                                    $where1["codeAnnee"] = $codeEleve;
                                    $update = $main->updateData($tabs, $coluns, @$where1);

                                    $parent = yii::$app->eleveClass->verifuniparents($eleve['0']['telTuteur'], $ets);
                                    $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                                    // die(var_dump($parent));
                                    if ($parent) {
                                        // die(var_dump($parent));
                                        $codel = $nonSql->generateUniq();
                                        yii::$app->eleveClass->insertlientparents($codel, $parent['code'], $eleve['0']['code'], $ets);
                                        $tel = '224' . $eleve[0]['telTuteur'];

                                        yii::$app->simplelClass->envoieSms($infoets['nomEtbs'], $eleve['0']['nom']." ".$eleve['0']['prenom'] ." à été inscris avec success  Merci de nous avoir fais confiance", $tel);

                                    } else {
                                        $codeParent = $nonSql->generateUniq();

                                        yii::$app->eleveClass->insertparents($codeParent, $eleve['0']['nomTuteur'], $eleve['0']['prenomTuteur'], $eleve['0']['telTuteur'], $ets);
                                        $codel = $nonSql->generateUniq();
                                        yii::$app->eleveClass->insertlientparents($codel, $codeParent, $eleve['0']['code'], $ets);

                                        $tableName = 'dj_admins';
                                        $columnValue["code"] = $codeParent;
                                        $columnValue["admin_name"] = $eleve['0']['nomTuteur'] . ' ' . $eleve['0']['prenomTuteur'];

                                        $columnValue["tel"] = $eleve['0']['telTuteur'];
                                        $columnValue["codeetbs"] = $ets;
                                        $columnValue["admin_type"] = yii::$app->params['parent'];
                                        $columnValue["created_at"] = date('Y-m-d');
                                        $columnValue["statut"] = '0';
                                        $lien = yii::$app->request->baseurl . '/' . md5('visiteur_finaliser') . '/' . $codeParent;


                                        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                                            $url = "https";
                                        } else {
                                            $url = "http";
                                        }
                                        $url .= "://";
                                        $_SERVER['REQUEST_URI'] = $lien;
                                        $url .= $_SERVER['HTTP_HOST'];
                                        $url .= $_SERVER['REQUEST_URI'];
                                        $tel = '224' . $eleve[0]['telTuteur'];

                                        $main->insertData($tableName, $columnValue);
                                        // 
                                        // die($url);
                                        // yii::$app->simplelClass->envoieSms($infoets['nomEtbs'],  $eleve['0']['nom']." ".$eleve['0']['prenom'] ."à été inscris avec success Merci de nous avoir fais confiance acceder a ce lien pour finaliser la creation de votre compte parental $url", $tel);
                                        // die($url);
                                    }
                                }
                                if ($_POST['mode'] == 'recupaiement') {


                                    //impression des carte
                                    $infopiement = $compt->selectpaiemeteleve($_POST['code'], $_POST['codepaiement'][$key], $anneeActive);
                                    $infoeleve = yii::$app->eleveClass->infoformatricule($anneeActive, $_POST['maricule']);
                                    $classe = yii::$app->mainCLass->unidata('dj_classe', $infoeleve['codeClasse']);
                                    $paiement = yii::$app->mainCLass->unidata('dj_payement', $infopiement['codePayement']);
                                    $lien = yii::$app->request->baseurl . '/' . md5('visiteur_validationrecu') . '/' . $_POST['codepaiement'][$key] . '/' . $_POST['code'] . '/' . $_POST['maricule'];


                                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                                        $url = "https";
                                    } else {
                                        $url = "http";
                                    }
                                    $url .= "://";
                                    $_SERVER['REQUEST_URI'] = $lien;
                                    $url .= $_SERVER['HTTP_HOST'];
                                    $url .= $_SERVER['REQUEST_URI'];
                                    $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                                    $qrimage = yii::$app->simplelClass->codeqr($url);

                                    $pdf = $this->renderPartial('/comptabilite/pdf/recu.php', ['acte' => $paiement['libelle'], 'qrimage' => $qrimage, 'infopiement' => $infopiement, 'infoeleve' => $infoeleve, 'classe' => $classe['libelle'],'infoets'=>$infoets]);

                                    $mpdf->WriteHTML($pdf);
                                }
                            }
                            // die(var_dump($value));
                        }
                        if ($_POST['mode'] == 'recupaiement') {

                            $mpdf->Output('recupaiement' . date('Y-m-d') . '.pdf', 'I');
                        }
                    }
                }
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'Payement effectuer avec succes'));
                Yii::$app->session->setFlash('flashmsg', $notification);
                return $this->redirect(Yii::$app->request->referrer);
            }


            if (isset($_POST['action_key'])) {
                Yii::$app->response->format = Response::FORMAT_JSON;


                if ($_POST['action_key'] == md5('1')) {


                    // return $_POST;
                    $eleves = yii::$app->eleveClass->infoformatricule($anneeActive, $_POST['matricule']);

                    // return $eleves;
                    $columnName = '*';
                    $paiement = $_POST['paiement'];
                    $classe = $eleves['codeClasse'];
                    $tabs = 'dj_lien_paiement_classe';

                    $whereValueSelect["dj_lien_paiement_classe.codePaiement"] = "'$paiement'";
                    $whereValueSelect["dj_lien_paiement_classe.codeClasse"] = "'$classe'";

                    $paiement = $main->selectJoinData($columnName, $tabs, $whereValueSelect);
                    $libelle = yii::$app->mainCLass->databycode('dj_payement', $paiement['0']['codePaiement'], 'code');
                    $content = '';
                    if (sizeof($paiement) > 0) {
                        $content .= '<tr id="ligne' . $libelle['0']['id'] . '">
                                <td>' . $libelle['0']['libelle'] . '
                                <input class="form-control " type="text" 
                                    name="codepaiement[]" value="' . $paiement['0']['codePaiement'] . '" hidden> </td>
                                </td>

                                <td>' . $paiement['0']['montant'] . '
                                <input class="form-control " type="number" id="somPaier' . $libelle['0']['id'] . '" 
                                    name="somPaier[]" value="' . $paiement['0']['montant'] . '" hidden> </td>
                                <td> <input class="form-control " type="number" id="montant' . $libelle['0']['id'] . '" onchange="calcul(' . $libelle['0']['id'] . ')"
                                    name="montant[]" value=""></td>
                                <td><input class="form-control " type="number" id="reste' . $libelle['0']['id'] . '" name="reste[]" value="' . $paiement['0']['montant'] . '"
                                readonly="readonly"></td>
                                <td>  <a href="javascript:;" onclick="remove(' . $libelle['0']['id'] . ')" class="btn btn-sm bg-success-light me-2 ">
                                <i class="fa fa-remove"></i>Supprimer
                                </a></td>
                            </tr>';
                    }



                    return $content;
                }
            }






            $columnName = '*';
            $tabs = 'dj_eleve';
            $whereValues["dj_eleve.matricule"] = $_POST['matricule'];
            $elevearray = $main->selectJoinData($columnName, $tabs, $whereValues);
            $eleve = $elevearray[0];
            //    die(var_dump($eleve));

            if (sizeof($eleve) > 0) {

                $code = $nonSql->generateUniq();
                $tabs = 'dj_lien_payement_eleve';
                $col["code"] = $code;
                $col["codePayement"] = $_POST['paiement'];
                $col["codeEleve"] = $eleve['code'];
                $col["codeetbs"] = $ets;
                $col["montant"] = $_POST['montant'];
                $col["datePayement"] = $_POST['datepaiement'];
                $main->insertData($tabs, $col);
                if ($eleve['statut'] == 0) {

                    $tabs = 'dj_eleve';
                    $columnValue["statut"] = 1;
                    $whereValue["code"] = $eleve['code'];

                    $update = $main->updateData($tabs, $columnValue, @$whereValue);
                }
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'operationsucces'));
                Yii::$app->session->setFlash('flashmsg', $notification);
                return $this->redirect(Yii::$app->request->referrer);
            } else {

                return $this->redirect(Yii::$app->request->referrer);
            }

            // die(var_dump($eleve));
        }
        //  die(var_dump($listAtente));
        return $this->render('/comptabilite/scolarite/scolarite.php', ['listAtente' => $listAtente, 'classe' => $classe, 'paiement' => $paiement]);
    }
    public function actionAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $anneeActive = yii::$app->mainCLass->getAnneeActive();
        $ets = yii::$app->mainCLass->getets();
        if (yii::$app->request->isPost) {

            switch ($_POST['action_key']) {
                case md5('listpiement'):
                    $eleves = yii::$app->eleveClass->infoformatricule($anneeActive, $_POST['code']);
                    $content = '';
                    if ($eleves) {
                        switch ($ets) {
                            case '1858e3a7453dd1b90e8fafdbca2c34f8f507dc6bfece38f1':
                                $paiement = yii::$app->eleveClass->listepaiementelevecocineele($eleves['codeClasse'], $eleves['codeEleve'],$eleves['typepaiement']);

                                break;
                            
                            default:
                            $paiement = yii::$app->eleveClass->listepaiementeleve($eleves['codeClasse'], $eleves['codeEleve']);
                            break;
                        }

                        // return $paiement;   
                        if (sizeof($paiement) > 0) {
                            $content = '<option value="" hidden>selectionner un paiement</option>';
                            foreach ($paiement as $key => $value) {
                                $content .= '
                                <option value="' . $value['code'] . '">' . $value['libelle'] . '</option>
                                ';
                            }
                        }
                    }

                    return $content;
                    break;

                default:
                    # code...
                    break;
            }
        }
    }



    public function actionPaiementprof()
    {
        $ets = yii::$app->mainCLass->getets();

        $compt = yii::$app->comptabiliteClass;
        // $userCode  = yii::$app->mainCLass->getusers();
        $userCode = yii::$app->mainCLass->getusers();
        // die(var_dump($userCode));   
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();

        $columnName = $tableName = $tableNames = $whereValue = $whereValueSelect = $inColumn = $inValue = $formatBy = $paginate = null;
        $columnName = '*';
        if (yii::$app->request->isPost) {
            // die(var_dump($_POST));
            switch ($_POST['action']) {
                case md5('paiementprof'):

                    $liste = Yii::$app->personnelClass->listeproffiltre($_POST['search'], $_POST['catsearch'], $ets);

                    return $this->render('/comptabilite/professeurs/listprofesseurs.php', ['post' => $_POST, 'liste' => $liste]);


                    break;
                case md5('addpaiementprof'):
                    $code = Yii::$app->simplelClass->generateUniq();

                    $date = (!empty($_POST['dateop'])) ? $_POST['dateop'] : date('Y-m-d');
                    $compt->insertpaiement($code, $_POST['codePrpf'], $_POST['typpepaiement'], $_POST['heureenseigner'], $anneeActive, '1', $date, $userCode, $_POST['netpaier'], $ets);
                    $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                    break;

                default:
                    # code...
                    break;
            }
        }
        $liste = Yii::$app->personnelClass->listeprof();
        return $this->render('/comptabilite/professeurs/listprofesseurs.php', ['liste' => $liste]);
    }

    public function actionHistoriquepaiement()
    {
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();

        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $compt = yii::$app->comptabiliteClass;
        if (yii::$app->request->isPost) {
        }
        if (yii::$app->request->isGet) {
            $liste = $compt->selectpaiement($_GET['code'], $anneeActive);
            //   die(var_dump($liste));

            return $this->render('/comptabilite/professeurs/histpaiement.php', ['liste' => $liste]);
        }
    }


    public function actionPersonnel()
    {
        $compt = yii::$app->comptabiliteClass;
        $userCode = yii::$app->mainCLass->getusers();
        $fonction = Yii::$app->mainCLass->getAlltableData('dj_fonction');
        $ets = yii::$app->mainCLass->getets();

        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();

        $columnName = $tableName = $tableNames = $whereValue = $whereValueSelect = $inColumn = $inValue = $formatBy = $paginate = null;
        $columnName = '*';
        if (yii::$app->request->isPost) {
            switch ($_POST['action']) {
                case md5('filtrer'):
                    $liste = Yii::$app->personnelClass->listepersfiltre($_POST['search'], $_POST['catsearch'], $ets);

                    return $this->render('/comptabilite/personnel/listpers.php', ['post' => $_POST, 'liste' => $liste, 'fonction' => $fonction]);


                    break;
                case md5('paiementpers'):
                    //   die(var_dump($_POST));
                    $code = Yii::$app->simplelClass->generateUniq();
                    $date = (!empty($_POST['dateop'])) ? $_POST['dateop'] : date('Y-m-d');

                    $compt->insertpaiement($code, $_POST['codePrpf'], $_POST['typpepaiement'], '', $anneeActive, '1', $date, $userCode, $_POST['netpaier'], $ets);
                    $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                    break;

                default:
                    # code...
                    break;
            }
            die(var_dump($_POST));
        }
        $liste = Yii::$app->personnelClass->listepers($ets);
        // die(var_dump($liste));
        $fonction = Yii::$app->mainCLass->getAlltableData('dj_fonction');

        return $this->render('/comptabilite/personnel/listpers.php', ['liste' => $liste, 'fonction' => $fonction]);
    }

    public function actionHistroique()
    {
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();

        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $compt = yii::$app->comptabiliteClass;
        $groupe ="";
        $search ="";
        $acte ="";
        if(Yii::$app->request->isPost){
            $groupe = $_POST['groupepersonnel'];
            $search = $_POST['search'];
            $acte =$_POST['catsearch'];
        }
        $payement = yii::$app->mainCLass->getAlltableData('dj_payementpers');
        $liste = $compt->selectfiltrepaiementpers($anneeActive, $search, $acte, $groupe);
        $montantotal = $compt->montanttotaldeensepers($anneeActive, $search, $acte, $groupe);

        return $this->render('/comptabilite/histpaiement.php', ['liste' => $liste,'payement'=>$payement,'search'=>$search,'acte'=>$acte,'groupe'=>$groupe,'montantotal'=>$montantotal]);
    }

    public function actionDepense()
    {
        $userCode = yii::$app->mainCLass->getusers();

        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
        $ets = yii::$app->mainCLass->getets();

        if (Yii::$app->request->isPost) {
            //  die(var_dump($_POST));
            if ($_POST['action'] == md5(strtolower("modifierClasse"))) {
                Yii::$app->configClass->updateClasse($_POST['code'], $_POST['libClasse'], $_POST['niveau'], $_POST['etat']);
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'modifier'));
                Yii::$app->session->setFlash('flashmsg', $notification);
                return $this->redirect(Yii::$app->request->referrer);
            }

            $code = Yii::$app->simplelClass->generateUniq();
            $detbut = explode('-', $_POST['date']);
            $annee = $detbut[2];
            $month = $detbut[1];
            $day = $detbut[0];

            $date = $annee . '-' . $month . '-' . $day;
            Yii::$app->comptabiliteClass->inserDepense($code, $_POST['motifs'], $userCode, $_POST['montant'], $date, $_POST['libelle'], $_POST['desc'], $anneeActive, $ets);
            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(Yii::$app->request->referrer);
        }
        $cat = Yii::$app->mainCLass->getAlltableData('dj_catdepense');
        $depense = Yii::$app->configClass->listdepennsee();
        //   die(var_dump($depense));
        return $this->render('/comptabilite/depense/depense.php', ['cat' => $cat, 'liste' => $depense]);
    }

    public function actionCatdepense()
    {
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $ets = yii::$app->mainCLass->getets();
        if (Yii::$app->request->isPost) {

            if ($_POST['action'] == md5(strtolower("modifierdepense"))) {
                // die( var_dump( $_POST));
                Yii::$app->configClass->updatedepense($_POST['code'], $_POST['libelle'], $_POST['etat']);
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
                Yii::$app->session->setFlash('flashmsg', $notification);
                return $this->redirect(Yii::$app->request->referrer);
            }
            $libelle = $_POST['libelle'];
            $code = Yii::$app->simplelClass->generateUniq();

            $tableName = "dj_catdepense";
            $columnValue["code"] = $code;
            $columnValue["libelle"] = $libelle;
            $columnValue["codeetbs"] = $ets;
            $main->insertData($tableName, $columnValue);
            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(Yii::$app->request->referrer);
        }
        $depense = Yii::$app->mainCLass->getAlltableData('dj_catdepense');
        return $this->render('/comptabilite/depense/catdepense.php', ['depense' => $depense]);
    }


    public function actionTest()
    { // Créez une image vide de taille 400x300 pixels
        $image_width = 400;
        $image_height = 300;
        $image = imagecreatetruecolor($image_width, $image_height);

        // Couleurs
        $background_color = imagecolorallocate($image, 255, 255, 255); // Blanc (Rouge, Vert, Bleu)
        $line_color = imagecolorallocate($image, 0, 0, 255); // Bleu (Rouge, Vert, Bleu)

        // Remplissez l'arrière-plan en blanc
        imagefill($image, 0, 0, $background_color);

        // Données pour le graphique (à personnaliser)
        $data = [10, 20, 15, 30, 25, 40];

        // Dimensions du graphique
        $width = $image_width;
        $height = $image_height;

        // Trouvez les valeurs maximales et minimales dans les données
        $max_value = max($data);
        $min_value = min($data);

        // Échelles pour les axes
        $x_scale = ($width - 40) / (count($data) - 1);
        $y_scale = ($height - 40) / ($max_value - $min_value);

        // Dessinez l'axe des ordonnées (axe vertical)
        imageline($image, 20, 20, 20, $height - 20, $line_color);

        // Dessinez l'axe des abscisses (axe horizontal)
        imageline($image, 20, $height - 20, $width - 20, $height - 20, $line_color);

        // Dessinez la courbe
        for ($i = 0; $i < count($data) - 1; $i++) {
            $x1 = 20 + ($i * $x_scale);
            $y1 = $height - 20 - ($data[$i] - $min_value) * $y_scale;
            $x2 = 20 + (($i + 1) * $x_scale);
            $y2 = $height - 20 - ($data[$i + 1] - $min_value) * $y_scale;
            imageline($image, $x1, $y1, $x2, $y2, $line_color);
        }

        // Créez un fichier image PNG pour sauvegarder le graphique
        $image_filename = 'graphique.png';

        // Enregistrez l'image dans un fichier
        imagepng($image, $image_filename);

        // Libérez la mémoire en détruisant l'image
        imagedestroy($image);

        echo "Le graphique en courbe a été créé et enregistré sous le nom de $image_filename";
    }
}
