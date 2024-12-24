<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use yii\filters\VerbFilter;


Yii::$app->layout = 'main';

class ParamController extends Controller
{

  public function actionParametre()
  {
    $code =  yii::$app->mainCLass->getets();
    $ets = yii::$app->mainCLass->databycode('dj_etbs', $code, 'code')['0'];
    return $this->render('/param/parametre.php', ['ets' => $ets]);
  }



  public function actionModifi()
  {
    $code =  yii::$app->mainCLass->getets();
    $ets = yii::$app->mainCLass->databycode('dj_etbs', $code, 'code')['0'];
    // $liste =   Yii::$app->mainCLass->getAlltableData('dj_anneescolaire');
    return $this->render('/param/modiparam.php', ['ets' => $ets]);
  }


  public function actionAnneescolaire()
  {
    $ets = yii::$app->mainCLass->getets();
    if (Yii::$app->request->isPost) {
      if ($_POST['action'] == md5(strtolower("cocherCetteAnneeScolaireParDefault"))) {

        Yii::$app->configClass->initanneescolaire($ets);

        Yii::$app->configClass->Defaut($_POST['code']);
        
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'modifier'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        Yii::$app->getSession()->destroy();
        return $this->redirect(md5('site_login'));
        return $this->redirect(Yii::$app->request->referrer);
      }

      if ($_POST['action'] == md5(strtolower("modifier"))) {
        //  die(var_dump($_POST));
        Yii::$app->configClass->updateannee($_POST['code'], $_POST['anneeScolaire'], $_POST['etat']);
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'modifier'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      }
      $libelle = $_POST['anneeScolaire'];
      $code = Yii::$app->simplelClass->generateUniq();

      Yii::$app->configClass->insertAnee($code, $libelle,$ets);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }
    $liste = Yii::$app->mainCLass->getAlltableData('dj_anneescolaire');
    return $this->render('/param/anneescolaire.php', ['liste' => $liste]);
  }

  public function actionNiveau()
  {
    $ets =yii::$app->mainCLass->getets();
    if (Yii::$app->request->isPost) {
      // die(var_dump($_POST));
      if ($_POST['action'] == md5(strtolower("modiferAnner"))) {
        Yii::$app->configClass->updateNiveau($_POST['code'], $_POST['niveau'], $_POST['typeCompo'], $_POST['etat']);
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'modifier'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      }
      $libelle = $_POST['niveau'];
      $typeCompos = $_POST['typeCompo'];
      $code = Yii::$app->simplelClass->generateUniq();

      Yii::$app->configClass->insertNiveau($code, $libelle, $typeCompos,$ets);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }
    $typeCompo = Yii::$app->simplelClass->typeCompo();
    $liste = Yii::$app->mainCLass->getAlltableData('dj_niveau');
    
    return $this->render('/param/niveau.php', ['typeCompo' => $typeCompo, 'liste' => $liste]);
  }


  public function actionClasse()
  {
    $ets =yii::$app->mainCLass->getets();


    if (Yii::$app->request->isPost) {
      // die(var_dump($_POST));
      if ($_POST['action'] == md5(strtolower("modifierClasse"))) {
        Yii::$app->configClass->updateClasse($_POST['code'], $_POST['libClasse'], $_POST['niveau'], $_POST['etat']);
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'modifier'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      }
      $niveau = $_POST['niveau'];
      $libelle = $_POST['libClasse'];
      $code = Yii::$app->simplelClass->generateUniq();

      Yii::$app->configClass->insertClasse($code, $libelle, $niveau,$ets);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }
    $niveau = Yii::$app->mainCLass->getAlltableData('dj_niveau');
    $liste = Yii::$app->configClass->listClasse($ets);
    return $this->render('/param/classe.php', ['niveau' => $niveau, 'liste' => $liste]);
  }


  public function actionCreatusers()
  {
    $main = yii::$app->eloquantClass;
    $nonSql = yii::$app->simplelClass;
    $ets =yii::$app->mainCLass->getets();

    if (yii::$app->request->isPOst) {
      // die(var_dump($_POST));

      $code = $nonSql->generateUniq();
      $mdp = Yii::$app->accessClass->create_pass($_POST['identifient'], $_POST['mdp']);

      $photo = '';
      $filename = $nonSql->upload_image(yii::$app->params['linkToUploadIndividusProfil'], $_FILES['image']);
      if ($filename != null) {
        $photo = $filename;
      }

      $tableName = 'dj_admins';
      $columnValue["code"] = $code;
      $columnValue["admin_name"] = $_POST['nom'] . ' ' . $_POST['prenom'];;
      $columnValue["admin_email"] = $_POST['email'];
      $columnValue["admin_image"] = $photo;
      $columnValue["admin_password"] = $mdp;
      $columnValue["admin_type"] = $_POST['typeUsers'];
      $columnValue["created_at"] = date('Y-m-d');
      $columnValue["identifiant"] = $_POST['identifient'];

      $main->insertData($tableName, $columnValue);
      return $this->redirect(Yii::$app->request->referrer);
    }

    $users = Yii::$app->mainCLass->getAlltableData('dj_typeusers');
    return $this->render('/param/users.php', ['users' => $users]);
  }
  public function actionFonction()
  {
    $main = yii::$app->eloquantClass;
    $nonSql = yii::$app->simplelClass;
    $ets =yii::$app->mainCLass->getets();

    if (Yii::$app->request->isPost) {

      if ($_POST['action'] == md5(strtolower("modifierfonction"))) {
        // die( var_dump( $_POST));
        Yii::$app->configClass->updatefonction($_POST['code'], $_POST['fonction'], $_POST['etat']);
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      }
      $fonction = $_POST['fonction'];
      $code = Yii::$app->simplelClass->generateUniq();

      $tableName = "dj_fonction";
      $columnValue["code"] = $code;
      $columnValue["libelle"] = $fonction;
      $columnValue["codeetbs"] = $ets;
      $main->insertData($tableName, $columnValue);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }
    $fonction = Yii::$app->mainCLass->getAlltableData('dj_fonction');
    return $this->render('/param/fonction.php', ['fonction' => $fonction]);
  }

  public function actionTypeusersadmin()
  {
    $main = yii::$app->eloquantClass;
    $nonSql = yii::$app->simplelClass;
    $users =Yii::$app->configClass->gettypeusersadmin();
    return $this->render('/param/users.php', ['users' => $users]);
  }
  public function actionAdduser()
  {
    $ets =yii::$app->mainCLass->getets();

    if (yii::$app->request->isPost) {
      if ($_POST['action'] == md5('updatety')) {
        $menuaction = '';
        if (sizeof($_POST['menuaction']) > 0) {
          foreach ($_POST['menuaction'] as $key => $value) {
            $menuaction .= $value . ',';
          }
        }
        Yii::$app->configClass->updateype($_POST['code'], $menuaction,$_POST['libelle']);
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(md5('param_creatusers'));
        // return $this->render('/param/editgroupe.php',['code'=>$_POST['code']]);

      }
      if ($_POST['action'] == md5(strtolower("modifiertypeuser"))) {

        $libelle = yii::$app->mainCLass->databycode('dj_typeusers', $_POST['code'], 'code')['0'];
        // die(var_dump($libelle));
        return $this->render('/param/editgroupe.php', ['code' => $_POST['code'], 'libelle' => $libelle]);
      }
      $menuaction = '';
      if (sizeof($_POST['menuaction']) > 0) {
        foreach ($_POST['menuaction'] as $key => $value) {
          $menuaction .= $value . ',';
        }
      }
      $code = Yii::$app->simplelClass->generateUniq();
      Yii::$app->configClass->insertype($code, $_POST['libelle'], $menuaction,$ets);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }
    return $this->render('/param/addusers.php');
  }

  public function actionMatiere()
  {
    $ets =yii::$app->mainCLass->getets();
    if (Yii::$app->request->isPost) {
      if ($_POST['action'] == md5(strtolower("modifierNveau"))) {
        Yii::$app->configClass->updateMatiere($_POST['code'], $_POST['matiere'], $_POST['etat']);
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'modifier'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      }
      $libelle = $_POST['matiere'];
      $code = Yii::$app->simplelClass->generateUniq();

      Yii::$app->configClass->insertMatiere($code, $libelle,$ets);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }
    $liste = Yii::$app->mainCLass->getAlltableData('dj_matiere');
    return $this->render('/param/matiere.php', ['liste' => $liste]);
  }

  public function actionParamscolaire()
  {
    $main = yii::$app->eloquantClass;
    $nonSql = yii::$app->simplelClass;
    $ets =yii::$app->mainCLass->getets();

    $columnName = $tableName = $tableNames = $whereValue = $whereValueSelect = $inColumn = $inValue = $formatBy = $paginate = null;
    $columnNames = '*';
    $usercode = yii::$app->mainCLass->getusers();
    if (yii::$app->request->isPOst) {

      $caseValue = $_POST['action'];
      // return $_POST;
      switch ($caseValue) {
        case md5(strtolower('modifierpaiement')):

          Yii::$app->configClass->updateParam($_POST['code'], $_POST['montantM'], $usercode);
          $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'modifier'));
          Yii::$app->session->setFlash('flashmsg', $notification);
          return $this->redirect(Yii::$app->request->referrer);

          break;
      }
      $tableName = $columnValue = null;

      $tableName = "dj_lien_paiement_classe";
      if (sizeof($_POST['classe']) > 0) {
        foreach ($_POST['classe'] as $key => $value) {
          $code = $nonSql->generateUniq();

          $columnValue["code"] = $code;
          $columnValue["codeClasse"] = $value;
          $columnValue["codePaiement"] = $_POST['paiement'];
          $columnValue["montant"] = $_POST['montant'];
          $columnValue["codeusers"] = $usercode;
          $columnValue["codeetbs"] = $ets;
          $main->insertData($tableName, $columnValue);
        }


        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      }
    }

    $tabs[1] = 'dj_classe';
    $tabs[2] = 'dj_payement';
    $tabs[3] = 'dj_lien_paiement_classe';


    $col[1] = "dj_classe.libelle as classe";
    $col[2] = "dj_payement.libelle as paiement ";
    $col[3] = "dj_lien_paiement_classe.montant as montant";
    $col[4] = "dj_lien_paiement_classe.code as code";
    $whereValues["dj_lien_paiement_classe.codeClasse"] = "dj_classe.code";
    $whereValues["dj_lien_paiement_classe.codePaiement"] = "dj_payement.code";
    $whereValues["dj_lien_paiement_classe.codeetbs"] = "'$ets'";

    $listepaiement = $main->selectJoinData($col, $tabs, $whereValues);
    //  die(var_dump($listepaiement));


    $tableNames = "dj_classe";
    $classe = yii::$app->configClass->classNotscolarite();

    $paiement = Yii::$app->mainCLass->getAlltableData('dj_payement');

    return $this->render('/param/paramScolarite.php', ['listepaiement' => $listepaiement, 'classe' => $classe, 'paiement' => $paiement]);
  }

  public function actionTauxhoraire()
  {
    $ets =yii::$app->mainCLass->getets();

    $main = yii::$app->eloquantClass;
    $nonSql = yii::$app->simplelClass;
    $anneeActive = yii::$app->mainCLass->chargerAnneeActive($ets);
    if (Yii::$app->request->isPost) {

      if ($_POST['action'] == md5(strtolower("modifierfonction"))) {
        // die( var_dump( $_POST));
        Yii::$app->configClass->updateTaux($_POST['code'], $_POST['montant']);
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      }
      $montant = $_POST['montant'];
      $code = Yii::$app->simplelClass->generateUniq();

      $tableName = "dj_taux_horaire";
      $columnValue["code"] = $code;
      $columnValue["codeAnnee"] = $anneeActive;
      $columnValue["libelle"] = $montant;
      $columnValue["codeetbs"] = $ets;
      $main->insertData($tableName, $columnValue);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }
    $taux = Yii::$app->configClass->selecttaux($anneeActive);
    return $this->render('/param/tauxhoraire.php', ['taux' => $taux]);
  }





  public function actionPaiement()
  {
    $ets =yii::$app->mainCLass->getets();

    if (Yii::$app->request->isPost) {
      if ($_POST['action'] == md5(strtolower("modifierpaiement"))) {
        Yii::$app->configClass->updatPaiement($_POST['code'], $_POST['Paiement'], $_POST['etat']);
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      }
      $libelle = $_POST['Paiement'];
      $code = Yii::$app->simplelClass->generateUniq();

      Yii::$app->configClass->insertPaiement($code, $libelle,$ets);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }
    $liste = Yii::$app->mainCLass->getAlltableData('dj_payement');
    return $this->render('/param/paiement.php', ['liste' => $liste]);
  }


  public function actionPayementpers()
  {
    $ets =yii::$app->mainCLass->getets();

    if (Yii::$app->request->isPost) {

      if ($_POST['action'] == md5(strtolower("modifierpaiement"))) {
        Yii::$app->configClass->updatPaiementPers($_POST['code'], $_POST['Paiement'], $_POST['etat']);
        $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      }
      $libelle = $_POST['Paiement'];
      $code = Yii::$app->simplelClass->generateUniq();

      Yii::$app->configClass->insertPaiementpers($code, $libelle,$ets);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }
    $liste = Yii::$app->mainCLass->getAlltableData('dj_payementpers');
    return $this->render('/param/paiementoers.php', ['liste' => $liste]);
  }


  public function actionEts()
  {
    $main = yii::$app->eloquantClass;
    $nonSql = yii::$app->simplelClass;
    if (yii::$app->request->isPost) {
      $code = yii::$app->mainCLass->getets();
      $logo = $_POST['logohidden'];
      if (!empty($_POST['logo'])) {
        $filenames = $nonSql->upload_image64(yii::$app->params['linkToUploadIndividusProfil'], $_POST['logo']);
        if ($filenames != null) {
          $logo = $filenames;
        }
      }
      // die(var_dump($logo));
      yii::$app->configClass->updateEts($code, $_POST['nomets'], $_POST['email'], $_POST['tel'], $_POST['Commune'], $_POST['adresse'], $logo, '', $_POST['slogan'], $_POST['primary'], $_POST['secondary']);

      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }
    $code = yii::$app->mainCLass->getets();

    $ets = yii::$app->configClass->databycode('dj_etbs', $code, 'code')['0'];

    return $this->render('/param/etablissement.php', ['ets' => $ets]);
  }
}
