<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use HTTP_Request2;




class VisiteurController extends Controller
{


    public function actionValidationrecu(){
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $compt = yii::$app->comptabiliteClass;
        $matricule = json_decode(base64_decode($_GET['matricule']));
        $infoclasse = yii::$app->configClass->geteinfoetsforeleves($matricule);
        $anneeActive =$infoclasse['codeAnnee'];
        $infopiement = $compt->selectpaiemeteleve($_GET['code'], $_GET['codepaiement'], $anneeActive);
        $infoeleve = yii::$app->eleveClass->infoformatricule($anneeActive, $matricule);
        $classe = yii::$app->mainCLass->unidata('dj_classe', $infoeleve['codeClasse']);
        $paiement = yii::$app->mainCLass->unidata('dj_payement', $infopiement['codePayement']);
        // die(var_dump($_GET));
        $lien = yii::$app->request->baseurl . '/' . md5('visiteur_validationrecu') . '/' . $_GET['codepaiement']. '/' . $_GET['code'] . '/' . $_GET['matricule'];


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
        $infoets = yii::$app->mainCLass->unidata('dj_etbs', $infoclasse['codeetbs']);

        $pdf = $this->renderPartial('/comptabilite/pdf/recu.php', ['acte' => $paiement['libelle'], 'qrimage' => $qrimage, 'infopiement' => $infopiement, 'infoeleve' => $infoeleve, 'classe' => $classe['libelle'],'infoets'=>$infoets]);
        $mpdf->WriteHTML($pdf);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output('recudescolarite' . date('Y-m-d') . '.pdf', 'D');
    }

    public function actionFinaliserprof()
    {
        if (yii::$app->request->isGet) {
            $users =    yii::$app->mainCLass->databycode('dj_admins', $_GET['code'], 'code');
            if (sizeof($users) > 0) {
                $users = $users['0'];
                if ($users['statut'] == '0') {
                    return $this->render('/visiteur/finalliser.php', ['code' => $_GET['code']]);
                    die('commencer la creation d');
                } else {
                    die('ce lien est de ja valider');
                }
            }
        }
    }


    public function actionProfil()
    {
        Yii::$app->layout = 'repport';

        $eleves = yii::$app->eleveClass->infoeleve($_GET['codeA'], $_GET['code']);

        return $this->render('/eleve/profil.php', ['info' => $eleves, 'anneeActive' => $_GET['codeA']]);
    }

    public function actionValidebuletin()
    {

        $anneeActive = $_GET['codeA'];
        $codeE = $_GET['codeE'];
        $info = yii::$app->eleveClass->infoeleve($anneeActive, $_GET['codeE']);

        $classe = yii::$app->configClass->infClasse($info['codeClasse']);
        $matiere = yii::$app->evaluationClass->infoclasse($info['codeClasse']);

        //   die(var_dump($info));





        //determinier le rang d'un eleves
        $noteAllElve = yii::$app->evaluationClass->noteall($anneeActive, $classe, $classe['typeCompo']);
        $rang = yii::$app->evaluationClass->rang($noteAllElve, $_GET['codeE']);
        // die(var_dump($rang));

        $lien = yii::$app->request->baseurl . '/' . md5('visiteur_validebuletin') . '/' . $_GET['codeE'] . '/' . $anneeActive;


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
            $pdf = $this->renderPartial('/repports/result/prime.php', ['qrimage' => $qrimage, 'info' => $info, 'classe' => $classe, 'matiere' => $matiere, 'anneeActive' => $anneeActive, 'rang' => $rang]);
        } else {
            die('en cours');
        }
        $mpdf->WriteHTML($pdf);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output('wamy.pdf', 'I');
    }

    //verification uniticiter libelle
    public function actionUnicitelibelle()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $caseValue = $_POST['action_key'];
        // return $_POST;
        $verifieUniciter = false;
        switch ($caseValue) {
            case md5(strtolower('anneeScolaire')):

                $libAnnee = $_POST['libelle'];

                return Yii::$app->mainCLass->uniLibelle('dj_anneescolaire', $libAnnee, 'libelle');
                break;
            case md5(strtolower('niveau')):

                $libAnnee = $_POST['libelle'];

                return Yii::$app->mainCLass->uniLibelle('dj_niveau', $libAnnee, 'libelle');
                break;
            case md5(strtolower('classe')):

                $classe = $_POST['libelle'];
                $niveau = $_POST['libNiveau'];

                return Yii::$app->configClass->uniclasse($classe, $niveau);
                break;
            case md5(strtolower('matiere')):

                $libelle = $_POST['libelle'];

                return Yii::$app->mainCLass->uniLibelle('dj_matiere', $libelle, 'libelle');
                break;
            case md5(strtolower('paiement')):

                $libelle = $_POST['libelle'];

                return Yii::$app->mainCLass->uniLibelle('dj_payement', $libelle, 'libelle');
                break;
            case md5(strtolower('paiementpers')):

                $libelle = $_POST['libelle'];

                return Yii::$app->mainCLass->uniLibelle('dj_payementpers', $libelle, 'libelle');
                break;
            case md5(strtolower('fonction')):

                $libelle = $_POST['libelle'];

                return Yii::$app->mainCLass->uniLibelle('dj_fonction', $libelle, 'libelle');
                break;
            case md5(strtolower('laguage')):

                    $libelle = $_POST['libelle'];
    
                    return Yii::$app->mainCLass->uniLibelle('dj_language', $libelle, 'libelle');
                    break;
            case md5(strtolower('depense')):

                $libelle = $_POST['libelle'];

                return Yii::$app->mainCLass->uniLibelle('dj_catdepense', $libelle, 'libelle');
                break;
            case md5(strtolower('ajoutcategorieev')):

                $libelle = $_POST['cat'];
                $coulleur = $_POST['coulleur'];

                $unilibelle =  Yii::$app->mainCLass->uniLibelle('dj_cat_evenement', $libelle, 'libelle');
                if ($unilibelle) {
                    return true;
                } else {
                    $code = Yii::$app->simplelClass->generateUniq();

                    Yii::$app->configClass->insetcatevenement($code, $libelle, $coulleur);
                    $eventcat = Yii::$app->mainCLass->getAlltableData('dj_cat_evenement');
                    $content = '';
                    if (sizeof($eventcat) > 0) {
                        foreach ($eventcat as $key => $value) {
                            //    die(var_dump($eventcat));
                            $content .= '
                            <div class="p-1" data-class="bg-' . $value['colore'] . '"><i class="fas fa-circle text-' . $value['colore'] . '"></i> ' . $value['Libelle'] . '</div>
                           ';
                        }
                    }

                    return $content;
                }
                break;
            case md5(strtolower('selectpaiement')):

                $codepaiement = $_POST['codepaiement'];
                // return $_POST;
                $classe = Yii::$app->configClass->selectpayement($_POST['codepaiement']);
                $content = '';

                if (isset($classe)) {
                    foreach ($classe as $key => $value) {
                        $content .= '   <div class="col-md-1 pb-2">
                          <input  class = "form-control form-checkbox " type="checkbox" name="classe[]" value="' . $value['code'] . '"> 
          
          
                           </div>     
                           <div class="col-md-2 pb-2">
                            <span>' . $value['libelle'] . '</span>
                           </div>             
                    
                    ';
                    }
                }
                return $content;
                break;
            case md5(strtolower('charlistepaiemt')):

                $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
                $content = '';
                $listepaiement = Yii::$app->personnelClass->actionListpaiement($anneeActive, $_POST['codeprof']);
                if (sizeof($listepaiement) > 0) {
                    foreach ($listepaiement as $key => $value) {

                        $content .=  '<option value="' . $value['code'] . '">' . $value['libelle'] . '</option>';
                    }
                }
                return $content;

                break;
            case md5(strtolower('chargefonction')):

                $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
                $content = '';
                $montant = Yii::$app->comptabiliteClass->selectpaienebtfonction($_POST['codefonction']);

                return $montant;

                break;
        }

        return $verifieUniciter;
    }


    public function actionIndex()
    {
        return $this->render('/visiteur/index.php');
    }

    public function actionApropos()
    {
        return $this->render('/visiteur/about.php');
    }

    public function actionContacte()
    {

        if (Yii::$app->request->isPost) {
            // die(var_dump($_POST));
            try {
                //envoi de l'email
                $client = new Client([
                    'base_uri' => "https://rge2em.api.infobip.com/",
                    'headers' => [
                        'Authorization' => "App e3ca893a325aa44ceed42db9d6c77431-bc03a5be-da59-41ae-b5dd-75a7c916a57d",
                        'Content-Type' => 'multipart/form-data',
                        'Accept' => 'application/json',
                    ]
                ]);

                $response = $client->request(

                    'POST',
                    'email/2/send',
                    [
                        RequestOptions::MULTIPART => [
                            ['name' => 'from', 'contents' => "jeunes@selfserviceib.com"],
                            ['name' => 'to', 'contents' => 'jeunescodeurs@gmail.com'],
                            ['name' => 'subject', 'contents' => 'Merci de nous contacter' . ' ' . $_POST['message']],
                            // ['name' => 'html', 'contents' => $this->render('/visiteurmessage/d.html')],
                            //

                        ],
                    ]
                );
            } catch (\Throwable $th) {
                //throw $th;
            }

            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('/visiteur/contact.php');
    }

    public function actionFinaliser()
    {
        Yii::$app->layout = 'login_layout';
        if (yii::$app->request->isPost) {
            // die(var_dump($_POST));
            if ($_POST['motPass'] == $_POST['confirme']) {
                $mdp = Yii::$app->accessClass->create_pass($_POST['userName'], $_POST['motPass']);
                $tableName = 'dj_admins';
                //  $columnValue["code"] = $_POST['code'];
                $columnValue["identifiant"] = $_POST['userName'];
                $columnValue["admin_password"] = $mdp;
                $columnValue["statut"] = '1';
                $wheres['code'] = $_POST['code'];
                yii::$app->eloquantClass->updateData($tableName, $columnValue, $wheres);
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                Yii::$app->session->setFlash('flashmsg', $notification);

                Yii::$app->getSession()->destroy();
                return $this->redirect(md5('site_login'));
            }
        }
        if (yii::$app->request->isGet) {

            $users =    yii::$app->mainCLass->databycode('dj_admins', $_GET['code'], 'code');
            // die(var_dump($users));
            if (sizeof($users) > 0) {
                $users = $users['0'];
                if ($users['statut'] == '0') {
                    return $this->render('/visiteur/finalliser.php', ['code' => $_GET['code']]);
                    die('commencer la creation d');
                } else {
                    die('ce lien est de ja valider');
                }
            }
        }
    }

    public function actionInitier()
    {
        Yii::$app->layout = 'login_layout';
        if (Yii::$app->request->isPost) {
            // die('ok');
            $code = Yii::$app->simplelClass->generateUniq();
            Yii::$app->configClass->insertets($code, $_POST['nomets'], $_POST['email'], $_POST['tel'], $commune = "", $addresse = "", $logo = "", $signature = "", $slogan = "");
            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(md5('site_login'));
        }

        return $this->render('/visiteur/initier.php');
    }


    public function actionTest(){
        yii::$app->simplelClass->envoieSms('djangain', "Merci de nous avoir fais confiance acceder a ce lien pour finaliser la creation de votre compte parental", '224623516202');

    }
}
