<?php

namespace app\components;

use Yii;
use yii\helpers\Html;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;

class configClass extends Component
{
  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }


  //insertion d'une fonction
  public function insertAnee($code, $libelle, $codeets)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_anneescolaire(code, libelle,codeetbs) 
                                               VALUES (:code, :libelle,:codeetbs)")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':codeetbs' => $codeets])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function Defaut($codeAnneeSelectionnee = Null)
  {
    $query = $this->connect->createCommand('UPDATE dj_anneescolaire 
      set statut=:statut
      WHERE code=:codeAnnee
      ')
      ->bindValues([':statut' => 1, ':codeAnnee' => $codeAnneeSelectionnee])
      ->execute();
  }


  public function updateannee($code, $libelle, $etat)
  {
    //  die($etat);
    try {
      $query = $this->connect->createCommand("UPDATE dj_anneescolaire SET libelle=:libelle ,etat=:etat WHERE code=:code  ")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function updatepassword($code, $motPass)
  {
    $query = null;

    try {
      $query = $this->connect->createCommand('UPDATE dj_admins SET admin_password=:motPass WHERE code=:code ')
        ->bindValues([':code' => $code, ':motPass' => $motPass])
        ->execute();
      return;
    } catch (\PDOException $ex) {
    }
  }

  public function updateadmin($code, $libelle, $email, $photo, $tel)
  {
    //  die($etat);
    try {
      $query = $this->connect->createCommand("UPDATE dj_admins SET admin_name=:libelle ,admin_email=:email,admin_image=:photo,tel=:tel WHERE code=:code  ")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':email' => $email, ':photo' => $photo, ':tel' => $tel])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  //Unset toutes les années
  public function initanneescolaire($codeetbs)
  {


    try {
      $query = $this->connect->createCommand('UPDATE dj_anneescolaire
        set statut=:statut where codeetbs=:codeetbs
    ')
        ->bindValues([':statut' => 0, ':codeetbs' => $codeetbs])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  //insertion d'une fonction

  public function insertPaiementpers($code, $libelle, $codeetbs)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_payementpers(code, libelle,codeetbs) 
                                               VALUES (:code, :libelle,:codeetbs)")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':codeetbs' => $codeetbs])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function insertPaiement($code, $libelle, $codeetbs)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_payement(code, libelle,	codeetbs) 
                                               VALUES (:code, :libelle,:codeetbs)")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':codeetbs' => $codeetbs])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  //insertion d'une fonction
  public function insertNiveau($code, $libelle, $typeCompo, $codeets)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_niveau(code, libelle,typeCompo,codeetbs) 
                                               VALUES (:code, :libelle,:typeCompo,:codeetbs)")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':typeCompo' => $typeCompo, ':codeetbs' => $codeets])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function insertMatiere($code, $libelle, $codeetbs)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_matiere(code, libelle,codeetbs) 
                                               VALUES (:code, :libelle,:codeetbs)")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':codeetbs' => $codeetbs])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  //insertion d'une fonction
  public function insertClasse($code, $libelle, $niveau, $codeetbs)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_classe(code, libelle,codeNiveau,	codeetbs) 
                                               VALUES (:code, :libelle,:codeNiveau,:codeetbs)")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':codeNiveau' => $niveau, ':codeetbs' => $codeetbs])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  //insertion d'une fonction
  public function inserPaiement($code, $libelle, $niveau)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_classe(code, libelle,codeNiveau) 
                                                 VALUES (:code, :libelle,:codeNiveau)")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':codeNiveau' => $niveau])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }




  // public function listdepennsee()
  // {
  //   // $codeEntite = yii::$app->nonSqlClass->getActiveEnt();
  //   $query = null;
  //   try {
  //     $query = $this->connect->createCommand("SELECT dj_depense.*,dj_cat_evenement.libelle as cat ,dj_cat_evenement.code as codecat FROM dj_cat_evenement ,dj_depense WHERE dj_cat_evenement.code = dj_depense.codeCat and dj_depense.etat ='1' ")
  //       ->queryAll();
  //     if ($query != null)
  //       return $query;
  //     return;
  //   } catch (\PDOException $ex) {

  //   }
  // }

  public function listdepennsee()
  {
    $ets = yii::$app->mainCLass->getets();
    $query = null;
    try {
      $query = $this->connect->createCommand("SELECT dj_depense.*,dj_catdepense.libelle as cat ,dj_catdepense.code as codecat FROM dj_catdepense ,dj_depense WHERE dj_catdepense.code = dj_depense.codeCat and dj_depense.etat ='1' and dj_depense.codeetbs=:codeetbs ")
        ->bindValue(':codeetbs', $ets)
        ->queryAll();
      if ($query != null)
        return $query;
      return;
    } catch (\PDOException $ex) {
    }
  }


  public function listClasse($codeetbs = "")
  {
    $codeetbs = yii::$app->mainCLass->getets();

    // $codeEntite = yii::$app->nonSqlClass->getActiveEnt();
    $query = null;
    try {
      $query = $this->connect->createCommand("SELECT dj_classe.libelle,dj_classe.code,dj_niveau.libelle as libClasse,dj_niveau.typeCompo,dj_niveau.code as codeClsse FROM dj_classe ,dj_niveau 
      WHERE dj_classe.codeNiveau = dj_niveau.code and dj_classe.etat ='1' and dj_classe.codeetbs=:codeetbs")
        ->bindValue(':codeetbs', $codeetbs)

        ->queryAll();
      if ($query != null)
        return $query;
      return;
    } catch (\PDOException $ex) {
    }
  }

  //uncie classe
  public function uniclasse($libelle, $codeNiveau)
  {
    // $codeEntite = yii::$app->nonSqlClass->getActiveEnt();
    $query = null;
    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_classe  WHERE dj_classe.libelle=:libelle 
       and dj_classe.codeNiveau =:niveau ")
        ->bindValues([':libelle' => $libelle, ':niveau' => $codeNiveau])

        ->queryAll();
      if ($query != null)
        return true;
      return false;
    } catch (\PDOException $ex) {
      return  $ex;
    }
  }


  public function updateNiveau($code, $libelle, $typeCompo, $etat)
  {

    try {
      $query = $this->connect->createCommand("UPDATE dj_niveau SET libelle=:libelle,typeCompo=:typeCompo,etat=:etat  WHERE code=:code")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':typeCompo' => $typeCompo, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function updateClasse($code, $libelle, $codeNiveau, $etat)
  {

    try {
      $query = $this->connect->createCommand("UPDATE dj_classe SET libelle=:libelle,codeNiveau=:codeNiveau,etat=:etat WHERE code=:code")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':codeNiveau' => $codeNiveau, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function updateMatiere($code, $libelle, $etat)
  {

    try {
      $query = $this->connect->createCommand("UPDATE dj_matiere SET libelle=:libelle,etat=:etat WHERE code=:code")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function updatPaiement($code, $libelle, $etat)
  {

    try {
      $query = $this->connect->createCommand("UPDATE dj_payement SET libelle=:libelle,etat=:etat WHERE code=:code")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function updatPaiementPers($code, $libelle, $etat)
  {

    try {
      $query = $this->connect->createCommand("UPDATE dj_payementpers SET libelle=:libelle,etat=:etat WHERE code=:code")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function updatefonction($code, $libelle, $etat)
  {
    try {
      $query = $this->connect->createCommand("UPDATE dj_fonction SET libelle=:libelle,etat=:etat WHERE code=:code")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function updatemouvement($code, $libelle, $etat)
  {
    try {
      $query = $this->connect->createCommand("UPDATE dj_language SET libelle=:libelle,etat=:etat WHERE code=:code")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function updatedepense($code, $libelle, $etat)
  {
    try {
      $query = $this->connect->createCommand("UPDATE dj_catdepense SET libelle=:libelle,etat=:etat WHERE code=:code")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function updateTaux($code, $libelle, $etat = '1')
  {
    try {
      $query = $this->connect->createCommand("UPDATE dj_taux_horaire SET libelle=:libelle,etat=:etat WHERE code=:code")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function updateParam($code, $montant, $usercode)
  {
    try {
      $query = $this->connect->createCommand("UPDATE dj_lien_paiement_classe SET montant=:montant,codeusers=:codeusers WHERE code=:code")
        ->bindValues([':code' => $code, ':montant' => $montant, ':codeusers' => $usercode])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function updateEts($code, $nomEtbs, $email, $tel, $commune, $addresse, $logo, $signature, $slogan, $primary, $secondary)
  {
    try {
      $query = $this->connect->createCommand("UPDATE dj_etbs SET nomEtbs=:nomEtbs,email=:email,tel=:tel,commune=:commune,
                    addresse=:addresse,logo=:logo,signature=:signature,slogan=:slogan,prim=:prim,secon=:secon WHERE code=:code")
        ->bindValues([
          ':code' => $code,
          ':nomEtbs' => $nomEtbs,
          ':email' => $email,
          ':tel' => $tel,
          ':commune' => $commune,
          ':addresse' => $addresse,
          ':logo' => $logo,
          ':signature' => $signature,
          ':slogan' => $slogan,
          ':secon' => $secondary,
          ':prim' => $primary,
        ])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function classNotscolarite()
  {
    try {
      $query = $this->connect->createCommand("SELECT dj_classe.libelle,dj_classe.code FROM  dj_classe 
           ")
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function listpayementpers()
  {
    $ets = yii::$app->mainCLass->getets();

    try {
      $query = $this->connect->createCommand("SELECT libelle,codeFonction,montant,dj_param_pay_pers.code 
      FROM dj_param_pay_pers,dj_fonction 
      WHERE dj_param_pay_pers.codeFonction = dj_fonction.code 
      and dj_fonction.etat='1' and dj_param_pay_pers.etat='1' 
      and dj_param_pay_pers.codeetbs=:codeetbs")
        ->bindValue(':codeetbs', $ets)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function etbs()
  {
    try {
      $query = $this->connect->createCommand("SELECT * FROM  dj_etbs")

        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function updateetatets($code, $etat)
  {
    try {
      $query = $this->connect->createCommand("UPDATE dj_etbs SET etat=:etat where code=:code")
        ->bindValues([':code' => $code, 'etat' => $etat])
        ->execute();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function ajoutmatiereclasse($code, $codeClasse, $codeMatiere, $coef)
  {

    try {
      $query = $this->connect->createCommand("INSERT INTO dj_matiere_classe( code, codeClasse, codeMatiere, coef) 
        VALUES (:code, :codeClasse, :codeMatiere, :coef)")
        ->bindValues([':code' => $code, ':codeClasse' => $codeClasse, ':codeMatiere' => $codeMatiere, ':coef' => $coef])
        ->execute();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function ajoutpaiementpers($code, $codeFonction, $montant, $codeetbs)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_param_pay_pers( code, codeFonction, montant,codeetbs) 
        VALUES (:code, :codeFonction, :montant,:codeetbs)")
        ->bindValues([':code' => $code, ':codeFonction' => $codeFonction, ':montant' => $montant, ':codeetbs' => $codeetbs])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function updatepaiementpers($code, $codeFonction, $montant)
  {
    try {
      $query = $this->connect->createCommand("UPDATE  dj_param_pay_pers SET   codeFonction =:codeFonction, montant=:montant WHERE code=:code")
        ->bindValues([':code' => $code, ':codeFonction' => $codeFonction, ':montant' => $montant])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function listeclasseMatiere()
  {
    try {
      $query = $this->connect->createCommand("SELECT dj_matiere_classe.code,dj_classe.libelle as classe ,dj_matiere.libelle as matiere ,dj_matiere_classe.coef,dj_matiere_classe.codeClasse as codeClasse,
      dj_matiere_classe.codeMatiere as codeMatiere
      FROM dj_matiere_classe ,dj_classe,dj_matiere
      WHERE dj_matiere_classe.codeClasse =dj_classe.code
      and dj_matiere_classe.codeMatiere = dj_matiere.code")
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function selecttaux($codeAnnee)
  {
    try {
      $query = $this->connect->createCommand("SELECT *      FROM dj_taux_horaire
      WHERE codeAnnee =:codeAnnee")
        ->bindValue(':codeAnnee', $codeAnnee)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function infClasse($code)
  {
    try {
      $query = $this->connect->createCommand("SELECT dj_classe.libelle,dj_classe.code,dj_niveau.libelle as libClasse,dj_niveau.typeCompo,dj_niveau.code as codeClsse FROM dj_classe ,dj_niveau 
              WHERE dj_classe.codeNiveau = dj_niveau.code 
              AND dj_classe.code =:code")
        ->bindValue(':code', $code)
        ->queryOne();
      if ($query != null)
        return $query;
      return;
    } catch (\PDOException $ex) {
    }
  }


  public function selectmatiere($code)
  {
    $ets = yii::$app->mainCLass->getets();


    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_classe  
                WHERE code not in ( select  dj_matiere_classe.codeClasse from  dj_matiere_classe where dj_matiere_classe.codeMatiere=:code)
                AND dj_classe.etat ='1'
                and dj_classe.codeetbs=:codeetbs ")
        ->bindValues([':code' => $code, ':codeetbs' => $ets])
        ->queryAll();

      return $query;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }


  public function selectpayement($code)
  {
    $ets = yii::$app->mainCLass->getets();

    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_classe  
              WHERE code not in ( select  dj_lien_paiement_classe.codeClasse from  dj_lien_paiement_classe where dj_lien_paiement_classe.codePaiement  =:code)
              AND dj_classe.etat ='1'
              and dj_classe.codeetbs =:codeetbs")
        ->bindValues([':code' => $code, ':codeetbs' => $ets])
        ->queryAll();

      return $query;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }


  public function selectclassematiers($code)
  {
    try {
      $query = $this->connect->createCommand("SELECT COUNT(codeMatiere) as nbmatiere FROM dj_matiere_classe WHERE codeClasse =:code")
        ->bindValue(':code', $code)
        ->queryOne();
      if ($query) return $query['nbmatiere'];
      return;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }

  public function selectprofformatiere($codelien, $codeAnnee)
  {
    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_lien_professeur_classe 
      WHERE dj_lien_professeur_classe.code_classmat  =:code
      and etat='1'
      AND codeAnnee=:codeAnnee")
        ->bindValueS([':code' => $codelien, ':codeAnnee' => $codeAnnee])
        ->queryOne();
      return $query;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }

  public function calendardataall()
  {
    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_evenement
      WHERE  etat='1'")
        ->queryAll();
      return $query;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }


  public function calendardata($typepersonnel,$codeetbs='')
  {
    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_evenement 
      WHERE typepersonnel  =:typepersonnel
      and codeetbs=:codeetbs
     ")
        ->bindValues([':typepersonnel'=> $typepersonnel,':codeetbs'=>$codeetbs])
        ->queryAll();
      return $query;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }


  public function updatmatclasse($code, $coef, $etat)
  {

    try {
      $query = $this->connect->createCommand("UPDATE dj_matiere_classe SET coef=:coef,etat=:etat WHERE code=:code")
        ->bindValues([':code' => $code, ':coef' => $coef, ':etat' => $etat])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function updatensmat($code, $codeAnnee, $etat, $codeProf)
  {

    try {
      $query = $this->connect->createCommand("UPDATE dj_lien_professeur_classe SET codeProf=:codeProf,etat=:etat 
              WHERE code=:code
              AND codeAnnee =:codeAnnee")
        ->bindValues([':code' => $code, ':codeAnnee' => $codeAnnee, ':etat' => $etat, ':codeProf' => $codeProf])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function inset($code, $codeAnnee, $code_classmat, $codeProf)
  {
    $ets = yii::$app->mainCLass->getets();

    try {
      $query = $this->connect->createCommand("INSERT INTO dj_lien_professeur_classe(code, codeProf, code_classmat, codeAnnee,codeetbs) 
        values(:code, :codeProf, :code_classmat, :codeAnnee,:codeetbs)")
        ->bindValues([':code' => $code, ':code_classmat' => $code_classmat, ':codeAnnee' => $codeAnnee, ':codeProf' => $codeProf, ':codeetbs' => $ets])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function insertype($code, $groupe, $action, $codeetbs)
  {

    try {
      $query = $this->connect->createCommand("INSERT INTO dj_typeusers(code, groupe, action,codeetbs)
        values(:code, :groupe, :action,:codeetbs)")
        ->bindValues([':code' => $code, ':groupe' => $groupe, ':action' => $action, ':codeetbs' => $codeetbs])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function selectemploidutempps($codeClasse, $codeAnnee)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_empoidutemps WHERE codeClasse=:codeClasse and codeAnnee=:codeAnnee  GROUP by code;")
        ->bindValues([':codeClasse' => $codeClasse, ':codeAnnee' => $codeAnnee])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function selecttypeuser($typeusers)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_typeusers WHERE code=:code")
        ->bindValue(':code', $typeusers)
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function selectemploifrcode($code)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_empoidutemps WHERE code=:code")
        ->bindValue(':code', $code)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  //Unset toutes les années
  public function deleteRaccourcis($codeUser, $action)
  {
    try {
      $query = $this->connect->createCommand('DELETE  FROM dj_racourcis where action =:action and codeuser=:codeuser
              ')
        ->bindValues([':codeuser' => $codeUser, ':action' => $action])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }




  public function addRacourcis($code, $action, $codeUser, $order)
  {


    try {
      $query = $this->connect->createCommand("INSERT into dj_racourcis (code,action,codeUser)
                                                VALUES (:code, :action, :codeUser)")
        ->bindValues([':code' => $code, ':action' => $action, ':codeUser' => $codeUser])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function selectRaccourcis($codeUser)
  {
    $query = $this->connect->createCommand('SELECT * FROM dj_racourcis 
      where codeUser=:codeUser
      ')
      ->bindValue(':codeUser', $codeUser)
      ->queryAll();
    return $query;
  }



  public function afficheemploie($code, $jours, $heure)
  {

    try {
      $query = $this->connect->createCommand("SELECT codeMatiere FROM dj_empoidutemps WHERE code=:code and jours=:jours and heure=:heure")
        ->bindValues([':code' => $code, ':jours' => $jours, ':heure' => $heure])
        ->queryOne();
      if ($query) return $query['codeMatiere'];
      return '';
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  //insertion dans la table emploi du temps

  public function insertemploie($code, $codeMatiere, $codeClasse, $codeAnnee, $heure, $dateDebut, $dateFin, $jours)
  {

    try {
      $query = $this->connect->createCommand("INSERT INTO dj_empoidutemps( code, jours, codeMatiere, codeClasse, codeAnnee, heure, dateDebut, dateFin)
        values(:code, :jours, :codeMatiere, :codeClasse, :codeAnnee, :heure, :dateDebut, :dateFin)")
        ->bindValues([':code' => $code, ':jours' => $jours, ':codeMatiere' => $codeMatiere, ':codeClasse' => $codeClasse, ':codeAnnee' => $codeAnnee, ':heure' => $heure, ':dateDebut' => $dateDebut, ':dateFin' => $dateFin])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function updateype($code, $action, $libelle)
  {

    try {
      $query = $this->connect->createCommand("UPDATE  dj_typeusers SET  action=:action,groupe=:groupe WHERE code=:code")

        ->bindValues([':code' => $code, ':action' => $action, ':groupe' => $libelle])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function insetcatevenement($code, $Libelle, $colore)
  {
    $ets = yii::$app->mainCLass->getets();

    try {
      $query = $this->connect->createCommand("INSERT INTO dj_cat_evenement(code, Libelle, colore,codeetbs) 
        values(:code, :Libelle, :colore,:codeetbs)")
        ->bindValues([':code' => $code, ':Libelle' => $Libelle, ':colore' => $colore, ':codeetbs' => $ets])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function inserevenemet($code, $codeCategorie, $titre, $objet, $datedebut, $datefin, $heuredebut, $heurefin, $typepersonnel)
  {
    $ets = yii::$app->mainCLass->getets();

    try {
      $query = $this->connect->createCommand("INSERT INTO dj_evenement(code, date, codeCategorie, titre, objet,  datedebut, datefin, heuredebut, heurefin, typepersonnel,codeetbs)
        values(:code, :date, :codeCategorie, :titre, :objet,  :datedebut, :datefin, :heuredebut, :heurefin, :typepersonnel,:codeetbs)")
        ->bindValues([
          ':code' => $code,
          ':date' => date('Y-m-d'),
          ':codeCategorie' => $codeCategorie,
          ':titre' => $titre,
          ':objet' => $objet,
          ':datedebut' => $datedebut,
          ':datefin' => $datefin,
          ':heuredebut' => $heuredebut,
          ':heurefin' => $heurefin,
          ':typepersonnel' => $typepersonnel,
          ':codeetbs' => $ets
        ])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }




  public function insertets($code, $nomEtbs, $email, $tel, $commune, $addresse, $logo = "", $signature = "", $slogan = "")
  {

    try {
      $query = $this->connect->createCommand("INSERT INTO dj_etbs( code, nomEtbs, email, tel, commune, addresse, logo, signature, slogan) 
      VALUES (:code, :nomEtbs, :email, :tel, :commune, :addresse, :logo, :signature, :slogan)")
        ->bindValues([':code' => $code, ':nomEtbs' => $nomEtbs, ':email' => $email, ':tel' => $tel, ':commune' => $commune, ':addresse' => $addresse, ':logo' => $logo, ':signature' => $signature, ':slogan' => $slogan])
        ->execute();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function gettypeusersadmin()
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_typeusers WHERE codeetbs=''")
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function geteinfoetsforeleves($matricule)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_lien_eleve_classe.* FROM dj_eleve,dj_lien_eleve_classe
       WHERE dj_lien_eleve_classe.codeEleve = dj_eleve.code  and dj_eleve.matricule=:matricule")
        ->bindValue(':matricule', $matricule)
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }
}
