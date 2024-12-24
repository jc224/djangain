<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class DevoirsController extends Controller
{
  private $pg = Null;

  public function actionAjouter()
  {
    $anneeActive = yii::$app->mainCLass->getAnneeActive();
    $userCode = yii::$app->mainCLass->getusers();
    $code = Yii::$app->simplelClass->generateUniq();


    if (yii::$app->request->isPost) {
      //  die(var_dump($_POST)); 

      if ($_POST['action'] == md5('telecharger')) {
        $dev = yii::$app->personnelClass->infoeval($_POST['code']);
        // die(var_dump($dev));
        $fichier = '';
        if($dev){
          $fichier =$dev['fichier'];
        }
        // die($file);
        try {
          $file = yii::$app->basePath.'/web/mainAssets/uploads/doc/'.$fichier;

          header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        readfile($file);

        } catch (\Throwable $th) {
          //throw $th;
        }
       
        exit;
     
        return $this->redirect(Yii::$app->request->referrer);

      }
      $sujet = '';
      if (!empty($_FILES['fiche'])) {
        $filenames = Yii::$app->simplelClass->upload_image(yii::$app->params['document'], $_FILES['fiche']);
        if ($filenames != null) {
          $sujet = $filenames;
        }
      }
      $code = Yii::$app->simplelClass->generateUniq();

      yii::$app->personnelClass->inserdevoris($anneeActive, $sujet, $userCode, $code, $_POST['sujet'], $_POST['ddebut'], $_POST['dfin'], $_POST['desc'], $_POST['classeSelect'], $_POST['matiere']);
      $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
      Yii::$app->session->setFlash('flashmsg', $notification);
      return $this->redirect(Yii::$app->request->referrer);
    }

    $listedevoirs = yii::$app->personnelClass->actionListdevoirs($anneeActive, $userCode);
    $classe = yii::$app->personnelClass->selectlisteclasseforprof($anneeActive, $userCode);
    //  die(var_dump($classe));
    return $this->render('/devoirs/liste.php', ['classe' => $classe, 'listedevoirs' => $listedevoirs]);

  }

  public function actionListe()
  {

    $anneeActive = yii::$app->mainCLass->getAnneeActive();
    $userCode = yii::$app->mainCLass->getusers();
    $code = Yii::$app->simplelClass->generateUniq();
    $classe = yii::$app->personnelClass->selectlisteclasseforprof($anneeActive, $userCode);
    return $this->render('/devoirs/listedevoirs.php', ['classe' => $classe]);
    die(var_dump($classe));

  }


  public function actionAjax()
  {
    Yii::$app->response->format = Response::FORMAT_JSON;
    $anneeActive = yii::$app->mainCLass->getAnneeActive();
    $userCode = yii::$app->mainCLass->getusers();
    if (yii::$app->request->isPOst) {

      if ($_POST['action_key'] == md5('1')) {
        $matiere = yii::$app->personnelClass->selectlistematiereforprof($anneeActive, $userCode, $_POST['code']);

        $libmatiere = '';
        if (sizeof($matiere) > 0) {

          foreach ($matiere as $key => $value) {
            $libmatiere .= '<option value="" hidden>selectionner un... </option><option value="' . $value['code'] . '">' . $value['libelle'] . '</option>';
          }
        }
        return $libmatiere;


      }
      if ($_POST['action_key'] == md5('2')) {
        $devoir = yii::$app->personnelClass->infoevalforcode($_POST['code'],$anneeActive);
        // return $devoir;
        $libmatiere = '';
        if (sizeof($devoir) > 0) {
          $j=0;
          foreach ($devoir as $key => $value) {
            $j++;
            $class = Yii::$app->mainCLass->databycode('dj_classe',$value['codeclasse'],'code');
            $matiere = Yii::$app->mainCLass->databycode('dj_matiere',$value['matiere'],'code');
             //  die(var_dump($matiere));
             $statut = ($value['statut'] == 1 ? 'Terminer' : 'En Cours');
              $btn = ' <a href="javascript:;" onclick="$(\'#action\').val(\''.md5('telecharger').'\'),$(\'#code\').val(\''.$value['code'].'\');$(\'#anneescolaire-form\').submit()" class="btn btn-primary">Telecharger</a>';
              $infoclasse = (sizeof($class) >0) ? $class['0']['libelle'] :'' ;
              $matiere = (sizeof($matiere) >0) ? $matiere['0']['libelle'] :'' ;
            
                $libmatiere .= ' <tr>
                <td>'.$j.'</td>
                <td>'.$value['libelle'].'</td>
                <td>'.$infoclasse.'</td>
                <td>'.$matiere.'</td>
                <td>'.$value['date'].'</td>
                <td>'.$value['datedebut'].'</td>
                <td>'.$value['datefin'].'</td>
                <td>'.$statut.'</td>
                <td>'.$btn.'</td>
                </tr>';
          }
        }
        return $libmatiere;

      }
    }
  }
}