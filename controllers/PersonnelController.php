<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class PersonnelController extends Controller
{
    //personnelc class
    public function actionPersonnel(){
        $columnName = '*';
        $ets =yii::$app->mainCLass->getets();
        $liste= Yii::$app->personnelClass->listepers($ets );
        $fonction =   Yii::$app->mainCLass->getAlltableData('dj_fonction');

        // die(var_dump($liste));
        if(yii::$app->request->isPost){
            if ($_POST['action'] == md5("filtrer")) {
                $liste= Yii::$app->personnelClass->listepersfiltre($_POST['search'],$_POST['catsearch'], $ets);
                return $this->render('/personnel/listpers.php',['post'=>$_POST,'liste'=>$liste,'fonction'=>$fonction]);
            }
            
            if ($_POST['action'] == md5(("printlist"))) {

                $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);
                $liste= Yii::$app->personnelClass->listepersfiltre($_POST['search'],$_POST['catsearch'],$ets);

                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'orientation'=>'L',
                    'format' => 'A4',
                    'margin_left' => 2,
                    'margin_right' => 2,
                    'margin_top' => 2,
                    'margin_bottom' => 30,
                    'margin_header' => 10,
                    'margin_footer' => 10,


                ]);

                $mpdf->showImageErrors = true;
                $pdf = $this->renderPartial('/personnel/impression/listpdf.php', ['liste' => $liste,'post'=>$_POST,'infoets'=>$infoets]);
                $footer = $this->renderPartial('/evalresul/detailstrimestrepdffooter.php');
                $mpdf->SetHTMLFooter($footer);
                $mpdf->SetHTMLFooter($footer, 'E');
                $mpdf->WriteHTML($pdf);
                $mpdf->Output('print.pdf', 'I');
                return $this->redirect(Yii::$app->request->referrer);



            }

        }

        return $this->render('/personnel/listpers.php',['liste'=>$liste,'fonction'=>$fonction]);
    }


    public function actionAddpersonnel(){
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
        $ets =yii::$app->mainCLass->getets();

        if(yii::$app->request->isPost){

            $fonction =$_POST['fonction'];
            $photo ="";
            $data =$_POST; 
            if (!empty($_POST['photo'])) {
                $filenames = $nonSql->upload_image64(yii::$app->params['linkToUploadIndividusProfil'], $_POST['photo']);
                if ($filenames != null) {
                  $photo = $filenames;
                }
              }

            Yii::$app->personnelClass->addpersonnel($data,$fonction,'1','',$photo, $ets );
            
            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(md5('personnel_personnel'));
        }
        $fonction =   Yii::$app->mainCLass->getAlltableData('dj_fonction');

        return $this->render('/personnel/addpers.php',['fonction'=>$fonction]);
    }


    public function actionProfi(){
        if(yii::$app->request->isGet){
           
            $info=   yii::$app->mainCLass->databycode('dj_personnel',$_GET['code'],'code');
            //  die(var_dump($info));
               if(sizeof($info)>0){

                   return $this->render('/personnel/profil.php',['info'=>$info[0]]);
   
               }
               return $this->redirect(md5('personnel_proffeseurs'));
   
           }



    }
    
    public function actionUpdatpers(){
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        if(yii::$app->request->isPost){
            // die(var_dump($_POST));
         
                $fonction =$_POST['fonction'];
                $code= $_POST['code'];
                $data =$_POST; 
                $photo = $_POST['avatare'];

                if (!empty($_POST['photo'])) {
                    $filenames = $nonSql->upload_image64(yii::$app->params['linkToUploadIndividusProfil'], $_POST['photo']);
                    if ($filenames != null) {
                      $photo = $filenames;
                    }
                  }
      
                Yii::$app->personnelClass->updatepersonnel($code,$data,$fonction,'1','',$photo);
                return $this->redirect(md5('personnel_personnel'));

        }
       if(yii::$app->request->isGet){
           
         $info=   yii::$app->mainCLass->databycode('dj_personnel',$_GET['code'],'code');
        //    die(var_dump($info));
            if(sizeof($info)>0){
                $fonction =   Yii::$app->mainCLass->getAlltableData('dj_fonction');

                return $this->render('/personnel/update.php',['fonction'=>$fonction,'info'=>$info[0]]);

            }
            return $this->redirect(md5('personnel_personnel'));

        }

     
    }



    public function actionProffeseurs(){
        $ets =yii::$app->mainCLass->getets();
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
    
        if(yii::$app->request->isPost){
            if ($_POST['action'] == md5("filtrer")) {
          
                $liste= Yii::$app->personnelClass->listeproffiltre($_POST['search'],$_POST['catsearch'],$ets);
           
                return $this->render('/professeurs/listprofesseurs.php',['post'=>$_POST,'liste'=>$liste]);


            }
            

            if ($_POST['action'] == md5(("printlist"))) {

                $liste= Yii::$app->personnelClass->listeproffiltre($_POST['search'],$_POST['catsearch'],$ets);
                $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);

                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'orientation'=>'L',
                    'margin_left' => 2,
                    'margin_right' => 2,
                    'margin_top' => 2,
                    'margin_bottom' => 30,
                    'margin_header' => 10,
                    'margin_footer' => 10,


                ]);

                $mpdf->showImageErrors = true;


                $pdf = $this->renderPartial('/professeurs/impression/listpdf.php', ['liste' => $liste,'post'=>$_POST,'infoets'=> $infoets]);

                $footer = $this->renderPartial('/evalresul/detailstrimestrepdffooter.php');
                $mpdf->SetHTMLFooter($footer);

                $mpdf->SetHTMLFooter($footer, 'E');
                $mpdf->WriteHTML($pdf);

                $mpdf->Output('wamy.pdf', 'I');
                return $this->redirect(Yii::$app->request->referrer);



            }
        }
        $liste= Yii::$app->personnelClass->listeprof();
        // die(var_dump($liste));
        return $this->render('/professeurs/listprofesseurs.php',['liste'=>$liste]);
    }



    public function actionAddteachers(){
        $ets =yii::$app->mainCLass->getets();
        $main = yii::$app->eloquantClass;
        $nonSql = yii::$app->simplelClass;
        $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
        $fonction =   Yii::$app->mainCLass->getAlltableData('dj_fonction');
        if(yii::$app->request->isPost){
            $groupe =$_POST['groupe'];
            $photo ="";
            $data =$_POST; 
            $photo = '';
            if (!empty($_POST['photo'])) {
              $filenames = $nonSql->upload_image64(yii::$app->params['linkToUploadIndividusProfil'], $_POST['photo']);
              if ($filenames != null) {
                $photo = $filenames;
              }
            }

            $code =Yii::$app->personnelClass->addpersonnel($data,'','2',$groupe,$photo,$ets);


            //ajouter du proffesseur comme utilisateurss
            $codep = $nonSql->generateUniq();


            $tableName = 'dj_admins';
            $columnValue["code"] = $code;
            $columnValue["admin_name"] = $_POST['nom'].' '.$_POST['prenom'];
         
            $columnValue["admin_email"] = $_POST['email'];
            $columnValue["tel"] = $_POST['tel'];
            $columnValue["codeetbs"] = $ets;
            $columnValue["admin_type"] = yii::$app->params['prof'];
            $columnValue["created_at"] = date('Y-m-d');
            $columnValue["statut"] = '0';
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
            $infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);
    
           
            $main->insertData($tableName, $columnValue);
            yii::$app->simplelClass->envoieSms($infoets['nomEtbs'], $url, $tel);

            $notification = yii::$app->simplelClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
            Yii::$app->session->setFlash('flashmsg', $notification);
            return $this->redirect(md5('personnel_proffeseurs'));
        }
      
        return $this->render('/professeurs/addtecacher.php');
    }

    public function actionUpdatprof(){
        if(yii::$app->request->isPost){
            // die(var_dump($_POST));
         
                $groupe =$_POST['groupe'];
                $code= $_POST['code'];
                $data =$_POST; 
                $photo = $_POST['avatare'];

                if (!empty($_POST['photo'])) {
                    $filenames =  yii::$app->simplelClass->upload_image64(yii::$app->params['linkToUploadIndividusProfil'], $_POST['photo']);
                    if ($filenames != null) {
                      $photo = $filenames;
                    }
                  }
      
                Yii::$app->personnelClass->updatepersonnel($code,$data,'','2',$groupe,$photo);
                return $this->redirect(md5('personnel_proffeseurs'));

        }
       if(yii::$app->request->isGet){
           
         $info=   yii::$app->mainCLass->databycode('dj_personnel',$_GET['code'],'code');
        //    die(var_dump($info));
            if(sizeof($info)>0){
                return $this->render('/professeurs/update.php',['info'=>$info[0]]);

            }
            return $this->redirect(md5('personnel_proffeseurs'));

        }

     
    }

    public function actionProfie(){
        if(yii::$app->request->isGet){
           
            $info=   yii::$app->mainCLass->databycode('dj_personnel',$_GET['code'],'code');
           //    die(var_dump($info));
               if(sizeof($info)>0){
                   return $this->render('/professeurs/profil.php',['info'=>$info[0]]);
   
               }
               return $this->redirect(md5('personnel_proffeseurs'));
   
           }



    }

}
