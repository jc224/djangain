<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;


class GestionController extends Controller
{



    public function actionEmploie(){
        
    }
    public function actionCreatusers()
    {
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $ets = yii::$app->mainCLass->getets();

        if (yii::$app->request->isPOst) {
        //    die(var_dump($_POST));

            $code = $nonSql->generateUniq();
            // $mdp = Yii::$app->accessClass->create_pass($_POST['identifient'], $_POST['mdp']);
            $photo = '';
            $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

            // die(var_dump($_POST));
            if(!empty( $_POST['photo'])){
            $filename = $nonSql->upload_image64(yii::$app->params['linkToUploadIndividusProfil'], $_POST['photo']);
            if ($filename != null) {
                $photo = $filename;
            }
            }
            $tableName = 'dj_admins';
            $columnValue["code"] = $code;
            $columnValue["admin_name"] = $_POST['admin_name'];
            ;
            $columnValue["admin_email"] = $_POST['admin_email'];
            $columnValue["tel"] = $_POST['tel'];
            $columnValue["admin_image"] = $photo;
            $columnValue["codeetbs"] = $ets;
            $columnValue["admin_type"] = $_POST['admin_type'];
            $columnValue["created_at"] = date('Y-m-d');
            // $columnValue["identifiant"] = $_POST['identifient'];
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
            yii::$app->simplelClass->envoieSms('Djangain', "cliquez sur le lien suivant pour finaliser la creation de votre compte  $url", $tel);
            die($url);

            return $this->redirect(Yii::$app->request->referrer);
        }
        $users = Yii::$app->mainCLass->getAlltableData('dj_admins');
        //  die(var_dump($users));
        return $this->render('/gestion/users.php', ['users' => $users]);
    }


    public function actionAgmatier()
    {

        $classe = Yii::$app->mainCLass->getAlltableData('dj_classe');
        $matiere = Yii::$app->mainCLass->getAlltableData('dj_matiere');
        $nonSql = yii::$app->simplelClass;

        if (yii::$app->request->isPost) {
            if (sizeof($_POST['classe'])) {
                foreach ($_POST['classe'] as $key => $value) {
                    $code = $nonSql->generateUniq();
                    Yii::$app->configClass->ajoutmatiereclasse($code, $value, $_POST['matiere'], $_POST['coeficients']);
                }

                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                Yii::$app->session->setFlash('flashmsg', $notification);
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        // $liste = Yii::$app->configClass->listeclasseMatiere();
        // die(var_dump($liste));
        // return $this->render('/gestion/matiere.php',['classe'=>$classe,'matiere'=>$matiere]);
        return $this->render('/gestion/matiere/classe.php', ['classe' => $classe, 'matiere' => $matiere]);

    }

    public function actionDetailsmatiers()
    {
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();

        $nonSql = yii::$app->simplelClass;
        if (yii::$app->request->isPost) {
            // die(var_dump($_POST));
            // die(var_dump($_POST['codelienprof']));

            if (!empty($_POST['codelienprof'])) {
                Yii::$app->configClass->updatensmat($_POST['codelienprof'], $anneeActive, $_POST['etat'], $_POST['codeprof']);

            } else if (!empty($_POST['codeprof'])) {
                // die(var_dump($_POST['codelien']));
                $code = Yii::$app->simplelClass->generateUniq();

                Yii::$app->configClass->inset($code, $anneeActive, $_POST['codelien'], $_POST['codeprof']);

            }


            Yii::$app->configClass->updatmatclasse($_POST['codelien'], $_POST['coeficients'], $_POST['etat']);

            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'modifier'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(Yii::$app->request->referrer);


        }
        if (isset($_GET['code']) && !empty($_GET['code'])) {
            $anneeActive = yii::$app->mainCLass->chargerAnneeActive();

            $listeprof = Yii::$app->personnelClass->listeprof();

            $liste = Yii::$app->evaluationClass->infoclasse($_GET['code']);
            return $this->render('/gestion/matiere/matiere.php', ['listeprof' => $listeprof, 'anneeActive' => $anneeActive, 'classe' => $_GET['code'], 'matiere' => $liste]);

        }
        //


    }

    public function actionAjax()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        $caseValue = $_POST['action_key'];
        switch ($caseValue) {
            case 'evenementdaa' :
                $event = Yii::$app->configClass->calendardata($_POST['type']);
         
            $data =null;
               if(sizeof($event)>0){
         
                 foreach ($event as $key => $value) {
                     $ets = yii::$app->mainCLass->databycode('dj_cat_evenement', $value['codeCategorie'], 'code')['0'];
                     
                //    $data[$key] =['title'=>$value['titre'] ,
                //    'start' =>$value['datedebut'].'T'.$value['heuredebut'],
                //    'end' =>$value['datefin'].'T'.$value['heurefin'],
                // //    'className'=>'b'.$ets['colore'],
         
                //  ];
                $data[$key] =[  
                    'title'=> $value['titre'] ,
                    'start'=>$value['datedebut'].'T'.$value['heuredebut'],
                    'end:'=>$value['datefin'].'T'.$value['heurefin'],
                    'color'=>$ets['colore'],
                    'description'=>$value['objet'],
         
                 ];
                //  return $data;
                 }
               }
               
             return $data;
            break;
            case md5(strtolower('selectmatiere')):

                $classe = Yii::$app->configClass->selectmatiere($_POST['codematiere']);
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
                // return Yii::$app->mainCLass->uniLibelle('dj_anneescolaire', $libAnnee, 'libelle');
                break;

        }
    }


    public function actionEvenement()
    {
      $eventcat = Yii::$app->mainCLass->getAlltableData('dj_cat_evenement');
      $event = Yii::$app->configClass->calendardataall();
      $typeuser = Yii::$app->mainCLass->getAlltableData('dj_typeusers');
      //   die(var_dump($event));
      $ets = yii::$app->mainCLass->getets();


      if(yii::$app->request->isPost){
        $code = Yii::$app->simplelClass->generateUniq();
        $detbut = explode('-',$_POST['datedebut']);
        $annee=$detbut[2];$month=$detbut[1];$day=$detbut[0];

        $datedebut =$_POST['datedebut'];

        $detbut = explode('-',$_POST['datefin']);
        $annee=$detbut[2];$month=$detbut[1];$day=$detbut[0];

        $dateFin = $_POST['datefin'];

        // die(var_dump($dateFin));
        if(sizeof($_POST['typepers'])>0){
            foreach ($_POST['typepers'] as $key => $value) {
                Yii::$app->configClass->inserevenemet($code, $_POST['category-color'] ,$_POST['titre'],$_POST['desc'],$datedebut,$dateFin,$_POST['Heuredebut'],$_POST['HeureFIn'],$value);
            }
        }else{
            Yii::$app->configClass->inserevenemet($code, $_POST['category-color'] ,$_POST['titre'],$_POST['desc'],$_POST['datedebut'],$_POST['datefin'],$_POST['Heuredebut'],$_POST['HeureFIn'],'0');

        }
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);

      }
      $data =null;
      if(sizeof($event)>0){

        foreach ($event as $key => $value) {
            $ets = yii::$app->mainCLass->databycode('dj_cat_evenement', $value['codeCategorie'], 'code')['0'];
            // die(var_dump($ets));
          $data[$key] =['title'=>$value['titre'] ,
          'start' =>$value['datedebut'].'T'.$value['heuredebut'],
          'end' =>$value['datefin'].'T'.$value['heurefin'],
          'color'=>$ets['colore'],

        ];
       
        }
      }
      
      return $this->render('/param/evenement.php',['event'=> json_encode($data),'eventcat'=>$eventcat,'typeuser'=>$typeuser]);
    }
  



    public function actionPayementpers()
    {

        $fonction = Yii::$app->mainCLass->getAlltableData('dj_fonction');
        $nonSql = yii::$app->simplelClass;
        // die('ok');
        $ets = yii::$app->mainCLass->getets();

        if (yii::$app->request->isPost) {
            // die(var_dump($_POST));
            if ($_POST['action'] == md5(strtolower("modifierpaiement"))) {
                // die( var_dump( $_POST));
                Yii::$app->configClass->updatepaiementpers($_POST['codep'],  $_POST['fonction'], $_POST['Montant']);
                $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
                Yii::$app->session->setFlash('flashmsg', $notification);
                return $this->redirect(Yii::$app->request->referrer);
        
              }
            $code = Yii::$app->simplelClass->generateUniq();

            Yii::$app->configClass->ajoutpaiementpers($code,  $_POST['fonction'], $_POST['Montant'],$ets);
            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(Yii::$app->request->referrer);

        }
        $liste = Yii::$app->configClass->listpayementpers();
        // die(var_dump($liste));
        // return $this->render('/gestion/matiere.php',['classe'=>$classe,'matiere'=>$matiere]);
        return $this->render('/gestion/paiement/pers.php', ['fonction' => $fonction, 'liste' => $liste]);

    }

}