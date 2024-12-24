<?php

namespace app\components;

use yii;
use yii\helpers\Html;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;


class personnelClass extends Component
{
  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }






  public function selaalproffeseur($codeets, $codeAnnee)
  {
    try {
      $query = $this->connect->createCommand("SELECT dj_personnel.nom,dj_personnel.prenom,dj_personnel.tel FROM dj_personnel,dj_lien_professeur_classe where dj_lien_professeur_classe.codeProf  = dj_personnel.code
          and dj_lien_professeur_classe.codeAnnee=:codeAnnee
          and dj_lien_professeur_classe.codeetbs=:codeetbs
          GROUP by dj_personnel.tel")
        ->bindValues([':codeetbs' => $codeets, ':codeAnnee' => $codeAnnee])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function countpers($categoriePers)
  {
    try {
      $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
      $ets = yii::$app->mainCLass->getets();


      $query = $this->connect->createCommand("SELECT count(dj_personnel.code) AS nb FROM dj_personnel
                                          WHERE dj_personnel.statut = 1
                                          and dj_personnel.categoriePers =:categoriePers
                                          and dj_personnel.codeetbs =:codeetbs
                                          GROUP BY categoriePers")
        ->bindValues([':categoriePers'=> $categoriePers,':codeetbs'=>$ets])
        ->queryOne();
      if ($query != null)
        return $query['nb'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function selsectpaiement($serah="",$acte = "")
  {
    try {

      $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
      $filtreacte = "";
      if ($acte !== "") {
        $filtreacte = "and codePayement= '$acte'";
      }
        $query = $this->connect->createCommand("SELECT dj_lien_payement_eleve.* FROM dj_lien_payement_eleve,dj_eleve 
          where dj_eleve.code = dj_lien_payement_eleve.codeEleve
          and codeAnnee=:codeAnnee 
          $filtreacte
     AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%'  )"
        )
          ->bindValue(':codeAnnee', $anneeActive)
          ->queryAll();
        return $query;
  
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function montantscolarite($serah="",$acte = "")
  {
    try {

      $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
      $filtreacte = "";
      if ($acte !== "") {
        $filtreacte = "and codePayement= '$acte'";
      }
        $query = $this->connect->createCommand("SELECT sum(montant) as montant FROM dj_lien_payement_eleve,dj_eleve 
          where dj_eleve.code = dj_lien_payement_eleve.codeEleve
          and codeAnnee=:codeAnnee 
          $filtreacte
     AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%'  )"
        )
          ->bindValue(':codeAnnee', $anneeActive)
          ->queryOne();
          if($query) return $query['montant'];
        return 0;
  
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function listepers($codeets)
  {


    $main = yii::$app->eloquantClass;
    try {
      $tab['2'] = 'dj_fonction';
      $tab['1'] = 'dj_personnel';

      $col[0] = "dj_personnel.code as codePers";
      $col[1] = "dj_personnel.nom";
      $col[2] = "dj_personnel.prenom";
      $col[3] = "dj_personnel.genre";
      $col[4] = "dj_personnel.photo";
      $col[5] = "dj_personnel.adresse";
      $col[6] = "dj_personnel.matricule";
      $col[7] = "dj_fonction.libelle";
      $col[8] = "dj_personnel.tel";
      $col[9] = "dj_personnel.email";
      $col[10] = "dj_fonction.code as codeFonction";

      $formatBy['DESC'] = "dj_personnel.id";
      $whereValues["dj_personnel.statut"] = '1';
      $whereValues["dj_personnel.categoriePers"] = '1';
      $whereValues["dj_personnel.codeetbs"] = "'$codeets'";
      $whereValues["dj_personnel.fonction"] = "dj_fonction.code";


      $liste = $main->selectJoinData($col, $tab, $whereValues, $formatBy);
      return $liste;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function listepersfiltre($search, $type, $codeets)
  {
    try {
      if (!empty($type)) {
        $query = $this->connect->createCommand("SELECT dj_fonction.code as codeFonction, dj_fonction.libelle, dj_personnel.code as codePers,dj_personnel.nom,dj_personnel.prenom,dj_personnel.genre,dj_personnel.photo,dj_personnel.adresse,dj_personnel.matricule,dj_personnel.groupePers,dj_personnel.tel,dj_personnel.email
        from   dj_personnel,dj_fonction
        WHERE dj_personnel.categoriePers ='1'
        and (dj_personnel.nom like '%$search%' or dj_personnel.prenom like  '%$search%' or dj_personnel.matricule like  '%$search%' )
        and dj_personnel.statut =1
        and  dj_personnel.fonction =dj_fonction.code
        and dj_fonction.code =:code
        ")
          ->bindValue(':code', $type)
          ->queryAll();
        return $query;
      } else {
        $query = $this->connect->createCommand("SELECT  dj_fonction.libelle, dj_personnel.code as codePers,dj_personnel.nom,dj_personnel.prenom,dj_personnel.genre,dj_personnel.photo,dj_personnel.adresse,dj_personnel.matricule,dj_personnel.groupePers,dj_personnel.tel,dj_personnel.email
                from   dj_personnel,dj_fonction

         WHERE dj_personnel.categoriePers ='1'
         and (dj_personnel.nom like '%$search%' or dj_personnel.prenom like  '%$search%' or dj_personnel.matricule like  '%$search%' )
         and dj_personnel.statut =1
         and  dj_personnel.fonction =dj_fonction.code
        and dj_personnel.codeetbs = '$codeets'
          ")
          ->queryAll();
        return $query;
      }
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }







  public function listeprof($etat = '1')
  {
    $ets = yii::$app->mainCLass->getets();
    $main = yii::$app->eloquantClass;
    try {
      $tab = 'dj_personnel';

      $col[0] = "dj_personnel.code as codePers";
      $col[1] = "dj_personnel.nom";
      $col[2] = "dj_personnel.prenom";
      $col[3] = "dj_personnel.genre";
      $col[4] = "dj_personnel.photo";
      $col[5] = "dj_personnel.adresse";
      $col[6] = "dj_personnel.matricule";
      $col[7] = "dj_personnel.groupePers";
      $col[8] = "dj_personnel.tel";
      $col[9] = "dj_personnel.email";
      $formatBy['DESC'] = "dj_personnel.id";
      $whereValues["dj_personnel.statut"] = '1';
      $whereValues["dj_personnel.etat"] = '1';
      $whereValues["dj_personnel.categoriePers"] = '2';
      $whereValues["dj_personnel.codeetbs	"] = "'$ets'";


      $liste = $main->selectJoinData($col, $tab, $whereValues, $formatBy);
      return $liste;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function listeproffiltre($search, $type, $codeets)
  {
    try {
      if (!empty($type)) {
        $query = $this->connect->createCommand("SELECT   dj_personnel.code as codePers,dj_personnel.nom,dj_personnel.prenom,dj_personnel.genre,dj_personnel.photo,dj_personnel.adresse,dj_personnel.matricule,dj_personnel.groupePers,dj_personnel.tel,dj_personnel.email
             from   dj_personnel
             WHERE dj_personnel.categoriePers ='2'
             and (dj_personnel.nom like '%$search%' or dj_personnel.prenom like  '%$search%' or dj_personnel.matricule like  '%$search%' )
             and dj_personnel.statut =1
             and dj_personnel.groupePers =:groupePers
             ")
          ->bindValue(':groupePers', $type)
          ->queryAll();
        return $query;
      } else {
        $query = $this->connect->createCommand("SELECT   dj_personnel.code as codePers,dj_personnel.nom,dj_personnel.prenom,dj_personnel.genre,dj_personnel.photo,dj_personnel.adresse,dj_personnel.matricule,dj_personnel.groupePers,dj_personnel.tel,dj_personnel.email
              from   dj_personnel
              WHERE dj_personnel.categoriePers ='2'
              and (dj_personnel.nom like '%$search%' or dj_personnel.prenom like  '%$search%' or dj_personnel.matricule like  '%$search%' )
              and dj_personnel.statut =1
              and dj_personnel.codeetbs ='$codeets'
               ")
          ->queryAll();
        return $query;
      }
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function addpersonnel($data, $fontion, $categorie, $groupe, $photo, $codeets)
  {
    $main = yii::$app->eloquantClass;
    $nonSql = yii::$app->simplelClass;
    $columnName = $tableName = $tableNames = $whereValue = $whereValueSelect = $inColumn = $inValue = $formatBy = $paginate = null;
    $tableName = 'dj_personnel';
    $code = $nonSql->generateUniq();
    $columnValue["code"] = $code;
    $columnValue["nom"] = $data['nom'];
    $columnValue["prenom"] = $data['prenom'];
    $columnValue["adresse"] = $data['adresse'];
    $columnValue["photo"] = $photo;
    $columnValue["matricule"] = $data['mat'];
    $columnValue["dateAjout"] = date('Y-m-d');
    $columnValue["tel"] = $data['tel'];
    $columnValue["dateNais"] = $data['dnais'];
    $columnValue["lieuNais"] = $data['lieuNai'];
    $columnValue["Datedebutservice"] = $data['Datedebutservice'];
    $columnValue["groupePers"] = $groupe;
    $columnValue["genre"] = $data['genre'];
    $columnValue["categoriePers"] = $categorie;
    $columnValue["email"] = $data['email'];
    $columnValue["fonction"] = $fontion;
    $columnValue["apropos"] = $data['desc'];
    $columnValue["codeetbs"] = $codeets;
    $main->insertData($tableName, $columnValue);
    return $code;
  }

  public function updatepersonnel($code, $data, $fontion, $categorie, $groupe, $photo)
  {
    $main = yii::$app->eloquantClass;
    $nonSql = yii::$app->simplelClass;
    $columnName = $tableName = $tableNames = $whereValue = $whereValueSelect = $inColumn = $inValue = $formatBy = $paginate = null;
    $tableName = 'dj_personnel';

    $whereValue["code"] = $code;
    $columnValue["nom"] = $data['nom'];
    $columnValue["prenom"] = $data['prenom'];
    $columnValue["adresse"] = $data['adresse'];
    $columnValue["photo"] = $photo;
    $columnValue["matricule"] = $data['mat'];
    $columnValue["dateAjout"] = date('Y-m-d');
    $columnValue["tel"] = $data['tel'];
    $columnValue["dateNais"] = $data['dnais'];
    $columnValue["lieuNais"] = $data['lieuNai'];
    $columnValue["Datedebutservice"] = $data['Datedebutservice'];
    $columnValue["groupePers"] = $groupe;
    $columnValue["genre"] = $data['genre'];
    $columnValue["categoriePers"] = $categorie;
    $columnValue["email"] = $data['email'];
    $columnValue["fonction"] = $fontion;
    $columnValue["apropos"] = $data['desc'];
    $main->updateData($tableName, $columnValue, $whereValue);
  }


  public function actionListdevoirs($anneeActive, $codePers)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_devoirs WHERE codeprof=:codeprof and anneeactive=:anneeactive")

        ->bindValues([':anneeactive' => $anneeActive, ':codeprof' => $codePers])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function actionListdevoirsforclasse($anneeActive, $codeclasse)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_devoirs WHERE codeclasse=:codeclasse and anneeactive=:anneeactive")

        ->bindValues([':anneeactive' => $anneeActive, ':codeclasse' => $codeclasse])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function actionListpaiement($anneeActive, $codePers)
  {
    $ets = yii::$app->mainCLass->getets();
    try {
      $query = $this->connect->createCommand("SELECT * from dj_payementpers
      where dj_payementpers.code  not in(SELECT dj_payement_pers.codePaiement FROM dj_payement_pers
       WHERE dj_payement_pers.codePers=:codePers and  dj_payement_pers.codeAnnee=:codeAnnee)
       and dj_payementpers.codeetbs	=:codeetbs
         ")
        ->bindValues([':codeAnnee' => $anneeActive, ':codePers' => $codePers, ':codeetbs' => $ets])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }




  public function selectlisteclasseforprof($anneeActive, $codePers)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_classe.libelle,dj_classe.code,dj_classe.codeNiveau FROM dj_lien_professeur_classe,dj_matiere_classe,dj_classe WHERE dj_lien_professeur_classe.code_classmat = dj_matiere_classe.code
      and dj_classe.code = dj_matiere_classe.codeClasse
      and dj_lien_professeur_classe.codeProf =:codeProf
      and dj_lien_professeur_classe.codeAnnee=:codeAnnee
      group by  dj_matiere_classe.codeClasse
         ")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeProf' => $codePers])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  //info evaluation
  public function infoeval($code)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM `dj_devoirs` WHERE code =:code
         ")
        ->bindValue(':code', $code)
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function listmatiereformprof($codeProf, $anneeactive)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_lien_professeur_classe WHERE codeAnnee=:anneeactive and codeProf=:codeProf
         ")
        ->bindValues([':codeProf' => $codeProf, ':anneeactive' => $anneeactive])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function listematiereonmatiereclasse($code)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_matiere.libelle as matiere,dj_classe.libelle as classe FROM `dj_matiere_classe` ,dj_matiere,dj_classe
      WHERE dj_matiere.code = dj_matiere_classe.codeMatiere 
       and dj_classe.code = dj_matiere_classe.codeClasse
        and dj_matiere_classe.code =:code
         ")
        ->bindValue(':code', $code)
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function infoevalforcode($code, $anneeactive)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM `dj_devoirs` WHERE codeclasse =:code and anneeactive=:anneeactive
         ")
        ->bindValues([':code' => $code, 'anneeactive' => $anneeactive])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function selectlistematiereforprof($anneeActive, $codePers, $codeClasse)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_matiere.libelle,dj_matiere.code FROM dj_lien_professeur_classe,dj_matiere_classe,dj_matiere
      WHERE dj_lien_professeur_classe.code_classmat = dj_matiere_classe.code
            and dj_matiere.code = dj_matiere_classe.codeMatiere
            and dj_matiere_classe.codeClasse =:codeClasse
      and dj_lien_professeur_classe.codeProf =:codeProf
      and dj_lien_professeur_classe.codeAnnee=:codeAnnee
      group by  dj_matiere_classe.codeClasse
         ")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeProf' => $codePers, ':codeClasse' => $codeClasse])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function selectemploidutemps($anneeActive, $codeMatiere, $codeClasse)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM  dj_empoidutemps 
      WHERE codeMatiere=:codeMatiere
       and codeClasse =:codeClasse
        and codeAnnee =:codeAnnee 
        order by  dj_empoidutemps.code
         ")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeMatiere' => $codeMatiere, ':codeClasse' => $codeClasse])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function inserdevoris($anneeActive, $fichier, $codePers, $code, $libelle, $datedebut, $datefin, $descrip, $codeclasse, $matiere)
  {

    try {
      $query = $this->connect->createCommand("INSERT INTO dj_devoirs(code, libelle, date, fichier, codeclasse, codeprof, anneeactive, statut,datedebut,datefin,descrip,matiere) 
          VALUES(:code, :libelle, :date, :fichier, :codeclasse, :codeprof, :anneeactive, :statut,:datedebut,:datefin,:descri,:matiere)
         ")
        ->bindValues([':anneeactive' => $anneeActive, ':fichier' => $fichier, ':codeprof' => $codePers, ':code' => $code, ':matiere' => $matiere, ':libelle' => $libelle, ':date' => date('Y-m-d'), ':datedebut' => $datedebut, ':datefin' => $datefin, 'descri' => $descrip, ':statut' => '0', ':codeclasse' => $codeclasse])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }
}
