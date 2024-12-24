<?php

namespace app\components;

use Yii;
use yii\helpers\Html;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;

class comptabiliteClass extends Component
{
  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }


  public function searchcomptabilite($serah, $classe, $statut, $paiement, $codets)
  {
    // $codeEntite = yii::$app->nonSqlClass->getActiveEnt();
    $anneeActive = yii::$app->mainCLass->getAnneeActive();


    $query = null;
    try {
      if ($serah != "" && $classe == "" && $statut == "" && $paiement == "") {
        $query = $this->connect->createCommand("SELECT dj_eleve.code as codeEleve,restePayer,dj_lien_payement_eleve.statut ,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
        dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,dj_lien_eleve_classe.code as codeLien,dj_classe.libelle as classe,dj_classe.code as codeClsse 
         FROM dj_eleve  ,dj_lien_eleve_classe,dj_classe,dj_lien_payement_eleve
        WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
        and dj_eleve.code = dj_lien_payement_eleve.codeEleve
        AND dj_lien_eleve_classe.codeClasse = 	dj_classe.code
         AND dj_lien_eleve_classe.codeAnnee =:codeAnnee
         and dj_lien_eleve_classe.codeetbs=:codeetbs
        AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%' )
         ")
          ->bindValues([':codeAnnee' => $anneeActive, ':codeetbs' => $codets])

          ->queryAll();

        return $query;
      } else if ($classe != "" && $statut == "" && $paiement == "") {
        $query = $this->connect->createCommand("SELECT  dj_eleve.code as codeEleve,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
        dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,dj_lien_eleve_classe.code as codeLien,dj_classe.libelle as classe,dj_classe.code as codeClsse 
          FROM dj_eleve  ,dj_lien_eleve_classe,dj_classe
        WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
        AND dj_lien_eleve_classe.codeClasse = 	dj_classe.code
        AND dj_lien_eleve_classe.codeClasse =:codeClasse
        AND dj_lien_eleve_classe.codeAnnee =:codeAnnee
        AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%' )
         ")
          ->bindValues([':codeClasse' => $classe, ':codeAnnee' => $anneeActive])
          ->queryAll();
        return $query;
      } else if ($classe == "" && $statut != "" && $paiement == "") {
        return [];
      } else if ($classe == "" && $statut == "" && $paiement != "") {
        $query = $this->connect->createCommand("SELECT restePayer,dj_eleve.code as codeEleve,dj_lien_payement_eleve.statut ,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
        dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,dj_lien_eleve_classe.code as codeLien,dj_classe.libelle as classe,dj_classe.code as codeClsse 
         FROM dj_eleve  ,dj_lien_eleve_classe,dj_lien_payement_eleve,dj_classe
        WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
        and dj_eleve.code = dj_lien_payement_eleve.codeEleve
        AND dj_lien_eleve_classe.codeClasse = 	dj_classe.code
        AND dj_lien_payement_eleve.codePayement =:codePayement
        AND dj_lien_payement_eleve.codeAnnee =:codeAnnee
        AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%' )
         ")
          ->bindValues([':codePayement' => $paiement, ':codeAnnee' => $anneeActive])
          ->queryAll();
        return $query;
      } else if ($classe != "" && $statut != "" && $paiement != "") {


        if ($statut == 1) {
          $query = $this->connect->createCommand("SELECT restePayer, dj_eleve.code as codeEleve,dj_lien_payement_eleve.statut ,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
          dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,dj_lien_eleve_classe.code as codeLien,dj_classe.libelle as classe,dj_classe.code as codeClsse 
            FROM dj_eleve  ,dj_lien_eleve_classe,dj_lien_payement_eleve,dj_classe
          WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
          and dj_eleve.code = dj_lien_payement_eleve.codeEleve
          AND dj_lien_eleve_classe.codeClasse = 	dj_classe.code
          AND dj_lien_payement_eleve.codePayement =:codePayement
          AND dj_lien_payement_eleve.codeAnnee =:codeAnnee
          AND dj_lien_eleve_classe.codeClasse =:codeClasse
          AND dj_lien_payement_eleve.statut ='1'
          AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%' )
           ")
            ->bindValues([':codePayement' => $paiement, ':codeAnnee' => $anneeActive, ':codeClasse' => $classe])
            ->queryAll();

          // die(var_dump($query));
          return $query;
        }
        if ($statut == 3) {

          $query = $this->connect->createCommand("SELECT restePayer, dj_eleve.code as codeEleve,dj_lien_payement_eleve.statut ,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
          dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,dj_lien_eleve_classe.code as codeLien,dj_classe.libelle as classe,dj_classe.code as codeClsse 
            FROM dj_eleve  ,dj_lien_eleve_classe,dj_lien_payement_eleve,dj_classe
          WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
          and dj_eleve.code = dj_lien_payement_eleve.codeEleve
          AND dj_lien_eleve_classe.codeClasse = 	dj_classe.code
          AND dj_lien_payement_eleve.codePayement =:codePayement
          AND dj_lien_payement_eleve.codeAnnee =:codeAnnee
          AND dj_lien_eleve_classe.codeClasse =:codeClasse
          AND dj_lien_payement_eleve.statut ='0'
          AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%' )
           ")
            ->bindValues([':codePayement' => $paiement, ':codeAnnee' => $anneeActive, ':codeClasse' => $classe])
            ->queryAll();
          return $query;
        } else if ($statut == 2) {
          // die('wed');
          $query = $this->connect->createCommand("SELECT  dj_eleve.code as codeEleve,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
          dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,dj_lien_eleve_classe.code as codeLien,dj_classe.libelle as classe,dj_classe.code as codeClsse 
            FROM dj_eleve,dj_classe  ,dj_lien_eleve_classe
          WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
          and dj_eleve.code  not in ( SELECT DISTINCT(dj_lien_payement_eleve.codeEleve) 
                                      FROM dj_lien_payement_eleve,dj_payement,dj_eleve 
                                      WHERE dj_lien_payement_eleve.codeEleve = dj_eleve.code
                                     and dj_payement.code = dj_lien_payement_eleve.codePayement
                                      and dj_payement.code =:codePayement )
          AND dj_lien_eleve_classe.codeClasse = 	dj_classe.code AND dj_lien_eleve_classe.codeAnnee =:codeAnnee
          AND dj_lien_eleve_classe.codeClasse =:codeClasse
           AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%' )
           ")
            ->bindValues([':codePayement' => $paiement, ':codeAnnee' => $anneeActive, ':codeClasse' => $classe])
            ->queryAll();
          return $query;
        }
      } else if ($classe == "" && $statut != "" && $paiement != "") {

        if ($statut == 1) {
          $query = $this->connect->createCommand("SELECT  restePayer,dj_eleve.code as codeEleve,dj_lien_payement_eleve.statut ,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
          dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,dj_lien_eleve_classe.code as codeLien,dj_classe.libelle as classe,dj_classe.code as codeClsse 
            FROM dj_eleve  ,dj_lien_eleve_classe,dj_lien_payement_eleve,dj_classe
          WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
          and dj_eleve.code = dj_lien_payement_eleve.codeEleve
          AND dj_lien_eleve_classe.codeClasse = 	dj_classe.code
          AND dj_lien_payement_eleve.codePayement =:codePayement
          AND dj_lien_payement_eleve.codeAnnee =:codeAnnee
          AND dj_lien_payement_eleve.codeAnnee =:codeAnnee
          AND dj_lien_payement_eleve.statut ='1'
          AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%' )
           ")
            ->bindValues([':codePayement' => $paiement, ':codeAnnee' => $anneeActive])
            ->queryAll();
          return $query;
        }
        if ($statut == 3) {
          $query = $this->connect->createCommand("SELECT  restePayer,dj_eleve.code as codeEleve,dj_lien_payement_eleve.statut ,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
          dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,dj_lien_eleve_classe.code as codeLien,dj_classe.libelle as classe,dj_classe.code as codeClsse 
            FROM dj_eleve  ,dj_lien_eleve_classe,dj_lien_payement_eleve,dj_classe
          WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
          and dj_eleve.code = dj_lien_payement_eleve.codeEleve
          AND dj_lien_eleve_classe.codeClasse = 	dj_classe.code
          AND dj_lien_payement_eleve.codePayement =:codePayement
          AND dj_lien_payement_eleve.codeAnnee =:codeAnnee
          AND dj_lien_payement_eleve.codeAnnee =:codeAnnee
          AND dj_lien_payement_eleve.statut ='3'
          AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%' )
           ")
            ->bindValues([':codePayement' => $paiement, ':codeAnnee' => $anneeActive])
            ->queryAll();
          return $query;
        } else if ($statut == 2) {

          $query = $this->connect->createCommand("SELECT  dj_eleve.code as codeEleve,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
          dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,dj_lien_eleve_classe.code as codeLien,dj_classe.libelle as classe,dj_classe.code as codeClsse 
            FROM dj_eleve  ,dj_lien_eleve_classe,dj_classe
          WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
          AND dj_lien_eleve_classe.codeClasse = 	dj_classe.code
          and dj_eleve.code  not in ( SELECT DISTINCT(dj_lien_payement_eleve.codeEleve) 
                                      FROM dj_lien_payement_eleve,dj_payement,dj_eleve 
                                      WHERE dj_lien_payement_eleve.codeEleve = dj_eleve.code
                                     and dj_payement.code = dj_lien_payement_eleve.codePayement
                                      and dj_payement.code =:codePayement )
          AND dj_lien_eleve_classe.codeAnnee =:codeAnnee
          AND (dj_eleve.matricule like '%$serah%' OR dj_eleve.nom like '%$serah%' OR dj_eleve.prenom like '%$serah%' )
           ")
            ->bindValues([':codePayement' => $paiement, ':codeAnnee' => $anneeActive])
            ->queryAll();
          return $query;
        }
      } else if ($classe != "" && $statut == "" && $paiement != "") {
        die('7');
      } else if ($classe != "" && $statut != "" && $paiement == "") {
        $table = null;
        $main = yii::$app->eloquantClass;

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
        $whereValues["dj_classe.code"] =  "'$classe'";


        $listAtente = $main->selectJoinData($col, $table, $whereValues);
        return  $listAtente;
      }


      // $query = $this->connect->createCommand("SELECT dj_classe.libelle,dj_classe.code,dj_niveau.libelle as libClasse,dj_niveau.typeCompo,dj_niveau.code as codeClsse FROM dj_classe ,dj_niveau WHERE dj_classe.codeNiveau = dj_niveau.code ")






      die(var_dump($query));
    } catch (\PDOException $ex) {
      die(var_dump($query));
    }
  }

  public function insertpaiement($code, $codePers, $codePaiement, $totalHeure, $codeAnnee, $etat, $date, $codeuser, $netPayer, $codeets)
  {

    try {
      $query = $this->connect->createCommand("INSERT INTO dj_payement_pers( code, codePers, codePaiement, totalHeure, etat, datepaiement, codeusers, codeAnnee,netPayer,codeetbs)
       VALUES(:code ,:codePers, :codePaiement, :totalHeure, :etat, :datepaiement, :codeusers, :codeAnnee,:netPayer,:codeetbs);
      ")
        ->bindValues([':code' => $code, ':codePers' => $codePers, ':codePaiement' => $codePaiement, ':totalHeure' => $totalHeure, ':etat' => $etat, ':datepaiement' => $date, ':codeusers' => $codeuser, ':codeAnnee' => $codeAnnee, ':netPayer' => $netPayer, ':codeetbs' => $codeets])
        ->queryAll();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function updatetpaiement($code, $montant, $acteur, $restePayer, $statut = '0')
  {
    try {
      $query = $this->connect->createCommand("UPDATE dj_lien_payement_eleve SET montant=:montant,acteur=:acteur,restePayer=:restePayer,statut=:statut WHERE code=:code
    ")
        ->bindValues([':code' => $code, ':montant' => $montant, ':acteur' => $acteur, ':restePayer' => $restePayer, ':statut' => $statut])
        ->queryAll();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function inserDepense($code, $codeCat, $codeuser, $montant, $dateajout, $libelle, $desc, $codeAnnee, $codeentite = '')
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_depense( code, codeCat, codeuser, montant, dateajout,descri, libelle,codeetbs,codeAnnee) 
     VALUES(:code, :codeCat, :codeuser, :montant, :dateajout,:desc, :libelle,:codeentite,:codeAnnee);
    ")
        ->bindValues([':code' => $code, ':codeCat' => $codeCat, ':codeuser' => $codeuser, ':montant' => $montant, ':dateajout' => $dateajout, ':libelle' => $libelle, ':desc' => $desc, ':codeAnnee' => $codeAnnee, ':codeentite' => $codeentite])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function selectpaiement($codePers, $codeAnnee)
  {
    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_payement_pers 
    where dj_payement_pers.codePers=:codePers
    and dj_payement_pers.codeAnnee=:codeAnnee
    and dj_payement_pers.etat=:etat")
        ->bindValues([':codePers' => $codePers, ':etat' => '1', ':codeAnnee' => $codeAnnee])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function selectpaiemeteleve($codeEleve, $codePayement, $codeAnnee)
  {
    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_lien_payement_eleve 
    where dj_lien_payement_eleve.codePayement=:codePayement
    and dj_lien_payement_eleve.codeAnnee=:codeAnnee
    and dj_lien_payement_eleve.codeEleve=:codeEleve")
        ->bindValues([':codePayement' => $codePayement, ':codeEleve' => $codeEleve, ':codeAnnee' => $codeAnnee])
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function selectinfopaiement($codePayement, $codeclasse)
  {
    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_lien_paiement_classe 
    where dj_lien_paiement_classe.codeClasse=:codeClasse
    and dj_lien_paiement_classe.codePaiement=:codePaiement")
        ->bindValues([':codePaiement' => $codePayement, ':codeClasse' => $codeclasse])
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function selectALLpaiement($codeAnnee)
  {


    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_payement_pers 
    where  dj_payement_pers.codeAnnee=:codeAnnee
    and dj_payement_pers.etat=:etat")
        ->bindValues([':etat' => '1', ':codeAnnee' => $codeAnnee])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function selectfiltrepaiementpers($codeAnnee, $serah, $acte, $groupe)
  {
    $filtreacte = "";
    $filtregroupe = "";
    if ($acte !== "") {
      $filtreacte = "and dj_payement_pers.codePaiement = '$acte'";
    }
    if ($groupe !== "") {
      $filtregroupe = "and dj_personnel.categoriePers = '$groupe'";
    }

    try {
      $query = $this->connect->createCommand(
        "SELECT dj_payement_pers.* FROM dj_payement_pers,dj_personnel,dj_payementpers
    WHERE dj_payementpers.code =dj_payement_pers.codePaiement
    and dj_personnel.code =dj_payement_pers.codePers
    and dj_payement_pers.codeAnnee=:codeAnnee
    and dj_payement_pers.etat=:etat
    $filtreacte
    $filtregroupe
     AND (dj_personnel.matricule like '%$serah%' OR dj_personnel.nom like '%$serah%' OR dj_personnel.prenom like '%$serah%' OR dj_personnel.fonction like '%$serah%' )"

      )
        ->bindValues([':etat' => '1', ':codeAnnee' => $codeAnnee])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function montanttotaldeensepers($codeAnnee, $serah, $acte, $groupe)
  {
    $filtreacte = "";
    $filtregroupe = "";

    if ($acte !== "") {
      $filtreacte = "and dj_payement_pers.codePaiement = '$acte'";
    }
    if ($groupe !== "") {
      $filtregroupe = "and dj_personnel.categoriePers = '$groupe'";
    }

    try {
      $query = $this->connect->createCommand(
        "SELECT sum(netPayer) as montanttotal FROM dj_payement_pers,dj_personnel,dj_payementpers
    WHERE dj_payementpers.code =dj_payement_pers.codePaiement
    and dj_personnel.code =dj_payement_pers.codePers
    and dj_payement_pers.codeAnnee=:codeAnnee
    and dj_payement_pers.etat=:etat
    $filtreacte
    $filtregroupe
     AND (dj_personnel.matricule like '%$serah%' OR dj_personnel.nom like '%$serah%' OR dj_personnel.prenom like '%$serah%' OR dj_personnel.fonction like '%$serah%' )"

      )
        ->bindValues([':etat' => '1', ':codeAnnee' => $codeAnnee])
        ->queryOne();
        if($query) return $query['montanttotal'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }






  public function selectpaienebtfonction($codeFonction)
  {
    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_param_pay_pers WHERE codeFonction=:codeFonction")
        ->bindValues([':codeFonction' => $codeFonction])
        ->queryOne();
      if ($query)
        return $query['montant'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function countreccete($codeAnnee)
  {
    try {
      $query = $this->connect->createCommand("SELECT SUM(montant) as montant from dj_lien_payement_eleve
    WHERE codeAnnee =:codeAnnee")
        ->bindValues([':codeAnnee' => $codeAnnee])
        ->queryOne();
      if ($query)
        return $query['montant'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function countdepenspers($codeAnnee)
  {
    try {
      $query = $this->connect->createCommand("SELECT SUM(netPayer) as montant from dj_payement_pers
    WHERE codeAnnee =:codeAnnee")
        ->bindValues([':codeAnnee' => $codeAnnee])
        ->queryOne();
      if ($query)
        return $query['montant'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function depense($codeAnnee)
  {
    try {
      $query = $this->connect->createCommand("SELECT SUM(montant) as montant from dj_depense
    WHERE codeAnnee =:codeAnnee")
        ->bindValues([':codeAnnee' => $codeAnnee])
        ->queryOne();
      if ($query)
        return $query['montant'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  
  public function selectalertpaiement($codeAnnee,$codepaiement,$codeets,$codeclasse)
  {
    try {
      $query = $this->connect->createCommand("SELECT dj_eleve.telTuteur FROM dj_lien_eleve_classe,dj_eleve 
      WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
      and dj_lien_eleve_classe.codeClasse=:codeclasse
      and dj_eleve.code not  IN(SELECT dj_lien_payement_eleve.codeEleve FROM dj_lien_payement_eleve 
                                WHERE dj_lien_payement_eleve.codePayement=:codepaiement
                               and dj_lien_payement_eleve.codeAnnee=:codeannee
                               and dj_lien_payement_eleve.codeetbs=:codeets)
      GROUP by dj_eleve.telTuteur;")
        ->bindValues([':codeclasse'=>$codeclasse,':codeannee' => $codeAnnee,':codepaiement'=>$codepaiement,':codeets'=>$codeets])
        ->queryAll();
        return $query;
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }
}
