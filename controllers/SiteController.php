<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
  private $pg = Null;
  public function actionIndex()
  {
    $ets =yii::$app->mainCLass->getets();
    $userCode = yii::$app->mainCLass->getusers();
    $user = yii::$app->accessClass->chargerUserAuthData($userCode);
    $admintype = yii::$app->configClass->selecttypeuser($user['admin_type']);
    $result =yii::$app->configClass->selectRaccourcis($userCode);
    $event = Yii::$app->configClass->calendardata($user['admin_type'],$ets);
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
    
    return $this->render('index',['event'=> json_encode($data),'action'=>$result,'admintype'=>$admintype]);
  }


  public function actionProfil()
  {
    $userCode = yii::$app->mainCLass->getusers();
    $user = yii::$app->accessClass->chargerUserAuthData($userCode);
    // die(var_dump(  $user ));
    if (Yii::$app->request->isPost) {
      // die(var_dump($_POST));

      if ($_POST['action'] == 'editpassword') {
        // die(var_dump($_POST));


        $identifiant = $user['identifiant'];
        $motPass = $user['admin_password'];
        $password = $_POST['currentpassword'];
        $motPass_constitue = $identifiant . Yii::$app->params['key_connector'] . $password;
        $veraciteMot_passe = Yii::$app->cryptoClass->validate_password($motPass_constitue, $motPass);
        //  die(var_dump($veraciteMot_passe));
        if ($veraciteMot_passe == true) {

          $motPassCrypte = Yii::$app->accessClass->create_pass($identifiant, $_POST['newpassword']);

          $UpdateUser = Yii::$app->configClass->updatepassword($userCode, $motPassCrypte);
          Yii::$app->getSession()->destroy();
          return $this->redirect(md5('site_login'));
        } else {
          
          $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['erreur'], yii::t('app', 'mdpIncorrect'));
          Yii::$app->session->setFlash('flashmsg', $notification);
          return $this->redirect(Yii::$app->request->referrer);
          // die('ddd');
        }
      }
      $photo = $_POST['photoremo'];
      if (!empty($_POST['photo'])) {
        $filenames = yii::$app->simplelClass->upload_image64(yii::$app->params['linkToUploadIndividusProfil'], $_POST['photo']);
        if ($filenames != null) {
          $photo = $filenames;
        }
      }

      yii::$app->configClass->updateadmin($_POST['code'], $_POST['Nom'], $_POST['Email'], $photo, $_POST['Tel']);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);

    }
    return $this->render('/site/profil.php', ['info' => $user]);
  }
  public function actionTest()
  {
    return $this->render('/eleve/update.php');
  }


  public function actionLogin()
  {

    $notification = Null;

    Yii::$app->layout = 'login_layout';

    if (Yii::$app->request->isPost) {
      switch (AuthController::authentifcation()) { // CKECK THE USER AUTHENTIFICATION
        case 'success': // IF RESPONSE IS SUCCESS
          return $this->redirect(md5('site_index')); // REDIRECT IT TO THE ACTION INDEX
          break;

        //Champs imperatifs sont vides 
        case '11':
          $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['attention'], yii::t('app', 'pasData_trouvee'));
          break;

        case '12':
          $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['attention'], yii::t('app', 'actionNon_valide'));
          break;

        case '22':
          $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['erreur'], yii::t('app', 'utilisateurNon_valid'));
          break;

        case '33':
          $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['attention'], yii::t('app', 'compteBloque'));
          break;
      }

      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->render('login', [
        'userName' => $_POST['userName'],
        'motPass' => $_POST['motPass'],
        'sugarpot' => $_POST['sugarpot'],
      ]);
    }

    return $this->render('login.php');
  }


  public function actionComptable()
  {
    $anneeActive = yii::$app->mainCLass->getAnneeActive();
    // die($anneeActive);
    // $anneeActive  = yii::$app->mainCLass->getAnneeActive();

    $nbE = yii::$app->eleveClass->stateleve();
    $wm = yii::$app->eleveClass->stateleveWomen();
    $ans = yii::$app->eleveClass->stateleveAns();
    $pers = yii::$app->personnelClass->countpers('1');
    $ens = yii::$app->personnelClass->countpers('2');
    //  die(var_dump($ans));
    $this->pg = '/site/comptable';
    return $this->render($this->pg, ['nbE' => $nbE, 'wm' => $wm, 'ans' => $ans, 'ens' => $ens, 'pers' => $pers]);
  }



  public function actionDeconnecter()
  {
  
    Yii::$app->getSession()->destroy();

    return $this->redirect(md5('site_login'));
  }

  public function actionError()
  {

    Yii::$app->layout = 'login_layout';
    return $this->render('/site/error.php');
  }


  public function actionStatistique()
  {
    Yii::$app->response->format = Response::FORMAT_JSON;


    if ($_POST['action'] == md5('statans')) {
      $ans = yii::$app->eleveClass->stateleveAns();
      $value = null;
      $cat = null;
      $i = 0;

      if (sizeof($ans) > 0) {
        foreach ($ans as $key => $values) {

          $value[$i] = $values['Nbeleve'];
          $cat[$i] = $values['libelle'];
          $i++;
        }
      }
      return [
        'value' => $value,
        'libelle' => $cat
      ];

    }


    if ($_POST['action'] == md5('statindividus')) {
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

  }


  public function actionProf(){
    return $this->render('tbprof.php');
  }


  public function actionRacourcis(){
    
    $usercode = yii::$app->mainCLass->getusers();
  
    if(yii::$app->request->isPost){
      $result =yii::$app->configClass-> selectRaccourcis($usercode);
      $action =$_POST['code'];
      if($_POST['action'] == md5('ajoueter')){
        
        if(sizeof($result) < 7){

        
            $code=  Yii::$app->simplelClass->generateUniq();
            yii::$app->configClass->addRacourcis($code,$action,$usercode,sizeof($result));
            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(Yii::$app->request->referrer);
      
        }
      }elseif ($_POST['action'] == md5('sup')) {
        yii::$app->configClass->deleteRaccourcis($usercode,$action);
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      //  die(var_dump($_POST));
      }
    
    
      // addRacourcis($code,$action,$codeUser,$order)
    }
    // die(var_dump($result)); 
    $result =yii::$app->configClass->selectRaccourcis($usercode);

    return $this->render('/site/racourcis.php',['action'=>$result]);


  }
}