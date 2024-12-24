<?php
    namespace app\components;
    use yii;
    use yii\base\component;
    use yii\web\controller;
    use yii\base\invalidconfigexception;

    Class menuactionClass extends Component 
    {

      public $connect = Null;
      
      public function __construct(){
        $this->connect = \Yii::$app->db;
      }


      public function colorActiveMenu($menuAction, $identifier){

        switch ($identifier) {
          #****************************************************************
          # IDENTIFICATION DU TYPE DE MENU : SIMPLE MENU OU AVEC SOUS MENU
          #****************************************************************
          case 1: # CASE DE SIMPLE MENU
          if(isset($menuAction)){
            if(Yii::$app->controller->id.'_'.Yii::$app->controller->action->id == $menuAction){
              return "active";
            }
          }
          break;

          case 2: # CAS DES SUB / MENUS
              for ($i=1; $i < sizeof($menuAction); $i++) {
                #*************************************************************
                # ANALYSE SI LE SUB_MENU CLIQUER EST AUTORISER A L'UTILISATEUR
                #*************************************************************
                if($menuAction[$i] == Yii::$app->controller->id.'_'.Yii::$app->controller->action->id){
                  // return "active subdrop ";
                }
            }
          break;

          default:
            return Null;
          break;
        }
        return Null;
      }


      public function menu(){
        $userCode  = yii::$app->mainCLass->getusers();

        $menuString  = yii::$app->menuactionClass->action($userCode);
      if(isset($menuString)){
        $ajaxAction = Yii::$app->params['ajaxActions'];
        $menuArray = explode(Yii::$app->params['menuSeperator'], $menuString); # ON FORME LA LIGNE PRICI[ALE DES MENUS
        echo '<li class="">
        <a href="'.Yii::$app->request->baseUrl.'/'.md5('site_index').'"><i class="feather-home inconemenu"></i><span>'.Yii::t("app",'site_index').'</span></a>
        </li>';
        foreach ($menuArray as $value) {
          /* Empechons la vue des actions ajax */
          $subMenuArray = explode(Yii::$app->params['subMenuSeperator'], $value);

          if(!(in_array($subMenuArray[0], $ajaxAction))){
            // die(var_dump($subMenuArray[0]));
            $icon  = yii::$app->menuactionClass->getIcon($subMenuArray[0]);
            // var_dump($icon);die('d');
            if(is_array($subMenuArray) AND sizeof($subMenuArray) > 2){
              # DANS CE CAS , CEST UN MENU AVEC SOUS MENU

              echo '
                  <li class="submenu  '.menuactionClass::colorActiveMenu($subMenuArray, 2).'">
                      <a href="#">
                        '.$icon.'
                        <span> '.Yii::t("app",$subMenuArray[0]).'</span>
                        <span class="menu-arrow"></span>
                      </a>
                      <ul class="list-unstyled" style="display: none;">
                      ';
                      for ($i=1; $i < sizeof($subMenuArray); $i++) {
                         if(!(in_array($subMenuArray[$i], $ajaxAction))){
                            if(!empty($subMenuArray[$i])){
                            
                            
                          echo '
                          <li>
                             <a  href="'.Yii::$app->request->baseUrl.'/'.md5($subMenuArray[$i]).'"  class="'.yii::$app->menuactionClass->colorActiveMenu($subMenuArray[$i], 1).'" style="font-size: 13px;">
                                <span>'.Yii::t("app",$subMenuArray[$i]).'</span>
                                </a>
                            </li>
                            
                          ';
                            }

                         }
                      }
                    
                    echo '
                    </ul>
                </li>';
            }else {
              if(isset($value) && !empty($value)){
               

              }
            }
          }
        }
      }
  
      }
      // RENVOIS LES DIFFERENTS ICONS DU MENU
      public function getIcon($actions){
        $icon = Null;
        switch ($actions) {

          case 'site':
            // $icon = yii::$app->request->baseUrl.'/web/mainAssets/img/sidebar/icon-1.png';
          break;
          case 'tb':
            $icon = '<i class="feather-grid inconemenu"></i>';
          break;
          case 'param':
            $icon = '<i class="fas fa-cog inconemenu"></i>';
          break;
          case 'eleves':
            $icon = '<i class="fas fa-graduation-cap inconemenu"></i>';
          break;
          case 'personnel':
            $icon = '<i class="fas fa-chalkboard-teacher inconemenu"></i>';
          break;
          case 'comptable':
            $icon = '<i class="fas fa-comment-dollar inconemenu"></i>';
          break;
          case 'gestion':
            $icon = '<i class="fas fa-building inconemenu"></i>';
          break;
          case 'evaluation':
            $icon = '<i class="fas fa-book-reader inconemenu"></i>';
          case 'evaluationconcinelle':
              $icon = '<i class="fas fa-book-reader inconemenu"></i>';
          break;
          case 'communication':
            $icon = '<i class="fas fa-inbox inconemenu"></i>';
          break;
          case 'presence':
            $icon = '<i class="fas fa-book inconemenu"></i>';
          break;
          case 'emploie':
            $icon = '<i class="fas fa-calendar-day inconemenu"></i>';
          break;
          case 'etablissement':
            $icon = '<i class="fas fa-book inconemenu"></i>';
          break;
          case 'parents':
            $icon = '<i class="fas fa-users inconemenu"></i>';
          break;
     
          case 'devoirs':
            $icon = '<i class="fas fa-clipboard-list inconemenu"></i>';
          break;
          case 'impression':
            $icon = '<i class="fas fa-book inconemenu"></i>';
          break;

        }
        return $icon;
      }

      

      public function action($codepers){
        try {
          $anneeActive  = yii::$app->mainCLass->getAnneeActive();
    
    
         $query = $this->connect->createCommand("SELECT * from dj_typeusers ,dj_admins
                                          WHERE dj_admins.admin_type =dj_typeusers.code
                                          and dj_admins.code=:code")
                                              ->bindValue(':code',$codepers)
                                               ->queryOne();
                                              if($query !=null) return $query['action'];
                                               return '';
                                               
        } catch (\Throwable $th) {
            die($th->getMessage());
    
        }
       }


       public function Mainaction($codetype){
        try {
          $anneeActive  = yii::$app->mainCLass->getAnneeActive();
    
    
         $query = $this->connect->createCommand("SELECT * from dj_typeusers 
                                          WHERE dj_typeusers.code=:code")
                                              ->bindValue(':code',$codetype)
                                               ->queryOne();
                                              if($query !=null) return $query['action'];
                                               return '';
                                               
        } catch (\Throwable $th) {
            die($th->getMessage());
    
        }
       }
    }