<?php

namespace app\components;

use yii;
use yii\helpers\Html;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;


class eleveClass extends Component
{
  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }

  public function selectstatis($codeclasse)
  {
    try {

      $query = $this->connect->createCommand("SELECT COUNT(dj_presence.codeeleve) as total FROM  dj_presence,dj_lien_eleve_classe WHERE dj_presence.codeeleve = dj_lien_eleve_classe.codeEleve
               and dj_presence.dataajout=:dateajout
               and dj_lien_eleve_classe.codeClasse=:codeclasse")
        ->bindValues([':codeclasse' => $codeclasse, ':dateajout' => date('Y-m-d')])
        ->queryOne();
      if ($query) return $query['total'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function insertcomunication($code, $codeets, $codeannee, $message, $groupe)
  {
    try {

      $query = $this->connect->createCommand("INSERT INTO dj_communication(code, codeets, codeannee, message, groupe) 
      VALUES (:code, :codeets, :codeannee, :message, :groupe)")
        ->bindValues([':code' => $code, ':codeets' => $codeets, ':codeannee' => $codeannee, ':message' => $message, ':groupe' => $groupe])
        ->execute();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function sellaalmesage($groupe, $codeets, $codeannee)
  {
    try {

      $query = $this->connect->createCommand("SELECT * FROM dj_communication WHERE dj_communication.codeets=:codeets 
      and dj_communication.codeannee=:codeannee and dj_communication.groupe=:groupe
      order by  id desc")
        ->bindValues([':codeets' => $codeets, ':codeannee' => $codeannee, ':groupe' => $groupe])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function slectalltuteur($codeets, $codeAnnee)
  {
    try {
      $anneeActive = yii::$app->mainCLass->chargerAnneeActive();


      $query = $this->connect->createCommand("SELECT dj_eleve.prenomTuteur,dj_eleve.nomTuteur,dj_eleve.telTuteur as tel FROM dj_eleve,dj_lien_eleve_classe 
              WHERE dj_lien_eleve_classe.codeEleve =dj_eleve.code  and dj_lien_eleve_classe.codeetbs=:codeetbs and dj_lien_eleve_classe.codeAnnee=:codeAnnee
              GROUP BY telTuteur")
        ->bindValues([':codeetbs' => $codeets, ':codeAnnee' => $codeAnnee])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function selectgroupuser($codeets, $codegroupe)
  {
    try {

      $query = $this->connect->createCommand("SELECT  dj_admins.admin_name as 'nom' ,dj_admins.tel FROM dj_admins 
          WHERE codeetbs=:codeetbs and dj_admins.admin_type=:codegroupe GROUP BY tel")
        ->bindValues([':codeetbs' => $codeets, ':codegroupe' => $codegroupe])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function listeclasse($anneeActive, $classe)
  {
    $main = yii::$app->eloquantClass;
    try {
      $tab[0] = 'dj_eleve';
      $tab[1] = 'dj_lien_eleve_classe';

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
      $whereValues["dj_eleve.code"] = "dj_lien_eleve_classe.codeEleve";
      $whereValues["dj_eleve.statut"] = 1;
      $whereValues["dj_lien_eleve_classe.codeAnnee"] = "'$anneeActive'";
      $whereValues["dj_lien_eleve_classe.codeClasse"] = "'$classe'";


      $liste = $main->selectJoinData($col, $tab, $whereValues);
      return $liste;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function listefiltre($search, $anneeActive, $classe = "")
  {
    $main = yii::$app->eloquantClass;
    try {
      if (!empty($classe)) {
        $query = $this->connect->createCommand("SELECT     dj_eleve.code as codeEleve,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
        dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,   dj_lien_eleve_classe.code as codeLien
       from   dj_eleve,dj_lien_eleve_classe
       WHERE dj_eleve.code =dj_lien_eleve_classe.codeEleve
       and (dj_eleve.nom like '%$search%' or dj_eleve.prenom like  '%$search%' or dj_eleve.matricule like  '%$search%' )
       and dj_eleve.statut =1
       and dj_lien_eleve_classe.codeAnnee =:codeAnnee
       and dj_lien_eleve_classe.codeClasse =:classe
       ")
          ->bindValues([':codeAnnee' => $anneeActive, ':classe' => $classe])
          ->queryAll();
        return $query;
      } else {
        $query = $this->connect->createCommand("SELECT     dj_eleve.code as codeEleve,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,dj_eleve.telTuteur,
          dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,   dj_lien_eleve_classe.code as codeLien
         from   dj_eleve,dj_lien_eleve_classe
         WHERE dj_eleve.code =dj_lien_eleve_classe.codeEleve
         and (dj_eleve.nom like  '%$search%' or dj_eleve.prenom like  '%$search%' or dj_eleve.matricule like  '%$search%' )
         and dj_eleve.statut =1
         and dj_lien_eleve_classe.codeAnnee =:codeAnnee
         ")
          ->bindValue(':codeAnnee', $anneeActive)
          ->queryAll();
        return $query;
      }
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }





  public function listeclassecarte($anneeActive, $classe)
  {
    $main = yii::$app->eloquantClass;
    try {
      $tab[0] = 'dj_eleve';
      $tab[1] = 'dj_lien_eleve_classe';
      $tab[2] = 'dj_carte';

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

      $whereValues["dj_eleve.code"] = "dj_lien_eleve_classe.codeEleve";
      $whereValues["dj_carte.codeEleve"] = "dj_eleve.code";
      $whereValues["dj_carte.statut"] = 0;
      $whereValues["dj_eleve.statut"] = 1;
      $whereValues["dj_lien_eleve_classe.codeAnnee"] = "'$anneeActive'";
      $whereValues["dj_lien_eleve_classe.codeClasse"] = "'$classe'";


      $liste = $main->selectJoinData($col, $tab, $whereValues);
      return $liste;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function addEleves($code, $nom, $prenom, $genre, $dateNaissance, $lieuNaissance, $niveau, $matricule, $photo, $adresse, $telTuteur, $codeEtbs, $nomP, $nomMere, $prenomMere, $nomtuteur, $prenomtuteur, $document, $groupeSanguin, $alergies, $maladies, $typepaiement)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_eleve( code, nom, prenom, genre, dateNaissance, lieuNaissance, niveau,matricule, photo, adresse,nomTuteur,prenomTuteur,telTuteur, codeEtbs,nomP,nomMere,prenomMere,document, groupeSanguin, alergies, maladies,typepaiement	)
        VALUES (:code, :nom, :prenom, :genre, :dateNaissance, :lieuNaissance, :niveau,:matricule, :photo, :adresse, :nomTuteur,:prenomTuteur,:telTuteur,:codeEtbs,:nomP,:nomMere,:prenomMere,:document,:groupeSanguin, :alergies, :maladies,:typepaiement	)")
        ->bindValues([
          ':code' => $code,
          ':nom' => $nom,
          ':prenom' => $prenom,
          ':genre' => $genre,
          ':dateNaissance' => $dateNaissance,
          ':lieuNaissance' => $lieuNaissance,
          ':niveau' => $niveau,
          ':matricule' => $matricule,
          ':photo' => $photo,
          ':adresse' => $adresse,
          ':nomTuteur' => $nomtuteur,
          ':prenomTuteur' => $prenomtuteur,
          ':telTuteur' => $telTuteur,
          ':codeEtbs' => $codeEtbs,
          ':nomP' => $nomP,
          ':nomMere' => $nomMere,
          ':prenomMere' => $prenomMere,
          ':document' => $document,
          ':groupeSanguin' => $groupeSanguin,
          ':alergies' => $alergies,
          ':maladies' => $maladies,
          ':typepaiement' => $typepaiement
        ])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }




  public function editEleves($code, $nom, $prenom, $genre, $dateNaissance, $lieuNaissance, $niveau, $matricule, $photo, $adresse, $telTuteur, $codeEtbs, $nomP, $nomMere, $prenomMere, $nomtuteur, $prenomtuteur, $document, $groupeSanguin, $alergies, $maladies, $typepaiement)
  {
    try {
      $query = $this->connect->createCommand("UPDATE  dj_eleve set   nom=:nom, prenom=:prenom, genre=:genre, dateNaissance=:dateNaissance, lieuNaissance=:lieuNaissance, niveau=:niveau,matricule=:matricule, photo=:photo, adresse=:adresse,nomTuteur=:nomTuteur,
                  prenomTuteur=:prenomTuteur,telTuteur=:telTuteur, codeEtbs=:codeEtbs,nomP=:nomP,nomMere=:nomMere,prenomMere=:prenomMere,document =:document,groupeSanguin=:groupeSanguin,alergies=:alergies,maladies=:maladies,typepaiement=:typepaiement where code=:code")
        ->bindValues([
          ':code' => $code,
          ':nom' => $nom,
          ':prenom' => $prenom,
          ':genre' => $genre,
          ':dateNaissance' => $dateNaissance,
          ':lieuNaissance' => $lieuNaissance,
          ':niveau' => $niveau,
          ':matricule' => $matricule,
          ':photo' => $photo,
          ':adresse' => $adresse,
          ':nomTuteur' => $nomtuteur,
          ':prenomTuteur' => $prenomtuteur,
          ':telTuteur' => $telTuteur,
          ':codeEtbs' => $codeEtbs,
          ':nomP' => $nomP,
          ':nomMere' => $nomMere,
          ':prenomMere' => $prenomMere,
          ':document' => $document,
          ':groupeSanguin' => $groupeSanguin,
          ':alergies' => $alergies,
          ':maladies' => $maladies,
          ':typepaiement' => $typepaiement
        ])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function actionListclass()
  {
    $ets = yii::$app->mainCLass->getets();
    try {
      $query = $this->connect->createCommand("SELECT dj_classe.code,dj_classe.libelle as nomCLasse,dj_niveau.libelle as niveau from dj_classe,dj_niveau
                                                  WHERE dj_classe.codeNiveau = dj_niveau.code
                                                  and dj_classe.codeetbs=:codeetbs")
        ->bindValue(':codeetbs', $ets)

        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function actionhistorique($anneeActive, $codeEleve)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_lien_payement_eleve,dj_payement
                                  where dj_payement.code =dj_lien_payement_eleve.codePayement
                                  and dj_lien_payement_eleve.codeAnnee =:codeAnnee
                                  and dj_lien_payement_eleve.codeEleve =:codeEleve;")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeEleve' => $codeEleve])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function listeparclasse($anneeActive, $codeclasse)
  {
    try {
      $query = $this->connect->createCommand("SELECT * from dj_eleve,dj_lien_eleve_classe WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve
                                      and dj_lien_eleve_classe.codeClasse = :codeClasse
                                      and dj_lien_eleve_classe.codeAnnee =:codeAnnee")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeClasse' => $codeclasse])

        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }





  public function verifuniparents($tel, $codeEtbs = "")
  {
    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_parent WHERE tel=:tel and codeetbs=:codeetbs")
        ->bindValues([':tel' => $tel, ':codeetbs' => $codeEtbs])

        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }




  public function infoformatricule($anneeActive, $codeeleves)
  {

    try {
      $query = $this->connect->createCommand("SELECT * from dj_eleve,dj_lien_eleve_classe
                                         WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve 
                                        AND dj_eleve.matricule =:codeelve 
                                        and dj_lien_eleve_classe.codeAnnee =:codeAnnee
                                      ")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeelve' => $codeeleves])

        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function infoeleve($anneeActive, $codeeleves)
  {

    try {
      $query = $this->connect->createCommand("SELECT * from dj_eleve,dj_lien_eleve_classe
                                         WHERE dj_eleve.code = dj_lien_eleve_classe.codeEleve 
                                        AND dj_eleve.code =:codeelve 
                                        and dj_lien_eleve_classe.codeAnnee =:codeAnnee
                                      ")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeelve' => $codeeleves])

        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function actionsTATcLASSE($codeclasse)
  {
    try {
      $anneeActive = yii::$app->mainCLass->getAnneeActive();


      $query = $this->connect->createCommand("SELECT count(dj_lien_eleve_classe.codeEleve) as nb FROM dj_lien_eleve_classe ,dj_eleve
                                            where dj_lien_eleve_classe.codeClasse =:codeClasse 
                                            and dj_lien_eleve_classe.codeEleve = dj_eleve.code
                                            AND dj_eleve.statut =1 

                                            and dj_lien_eleve_classe.codeAnnee=:codeAnnee GROUP by dj_lien_eleve_classe.codeClasse")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeClasse' => $codeclasse])
        ->queryOne();

      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function actionstatcarte($codeclasse, $anneeActive, $statut)
  {
    try {
      $anneeActive = yii::$app->mainCLass->getAnneeActive();


      $query = $this->connect->createCommand("SELECT count(dj_carte.codeEleve) as nb FROM dj_carte 
                                          where dj_carte.codeClasse =:codeClasse 
                                          and dj_carte.codeAnnee =:codeAnnee 
                                          AND dj_carte.statut =:statut ")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeClasse' => $codeclasse, ':statut' => $statut])
        ->queryOne();

      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function actionclassewomwne($codeclasse)
  {
    try {
      $anneeActive = yii::$app->mainCLass->getAnneeActive();


      $query = $this->connect->createCommand("SELECT count(dj_lien_eleve_classe.codeEleve) as nb FROM dj_lien_eleve_classe ,dj_eleve
                                          where dj_lien_eleve_classe.codeClasse =:codeClasse 
                                          and dj_lien_eleve_classe.codeEleve =dj_eleve.code 
                                          and dj_lien_eleve_classe.codeAnnee=:codeAnnee 
                                          and dj_eleve.genre='2' 
                                          GROUP by dj_lien_eleve_classe.codeClasse")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeClasse' => $codeclasse])
        ->queryOne();
      if ($query)
        return $query['nb'];
      else
        return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function updateLien()
  {
    try {
      $query = $this->connect->createCommand(" UPDATE dj_lien_eleve_classe SET statut=1 WHERE dj_lien_eleve_classe.codeEleve=:DJ_LIEN_ELEVE_CLASSE.CODEELEVE AND dj_lien_eleve_classe.codeAnnee=:DJ_LIEN_ELEVE_CLASSE.CODEANNEE")
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function stateleve()
  {
    try {
      $ets = yii::$app->mainCLass->getets();
      $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
      $query = $this->connect->createCommand("SELECT count(dj_eleve.code) AS Nbeleve FROM dj_eleve ,dj_lien_eleve_classe
                                          WHERE dj_lien_eleve_classe.codeEleve = dj_eleve.code
                                          and dj_lien_eleve_classe.codeAnnee=:codeAnnee
                                          and dj_eleve.statut=:statut
                                          and dj_eleve.codeetbs=:codeetbs")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeetbs' => $ets,':statut'=>'1'])
        ->queryOne();
      if ($query != null)
        return $query['Nbeleve'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function stateleveAns()
  {
    try {
      $anneeActive = yii::$app->mainCLass->chargerAnneeActive();
      $ets = yii::$app->mainCLass->getets();


      $query = $this->connect->createCommand("SELECT count(dj_eleve.code) AS Nbeleve,dj_anneescolaire.libelle FROM dj_eleve ,dj_lien_eleve_classe,dj_anneescolaire
                                          WHERE dj_lien_eleve_classe.codeEleve = dj_eleve.code
                                          and dj_eleve.statut =1
                                          and dj_anneescolaire.code =dj_lien_eleve_classe.codeAnnee
                                          and dj_anneescolaire.code =:codeAnnee
                                          and dj_anneescolaire.codeetbs =:codeetbs
                                          GROUP BY dj_anneescolaire.code")
        ->bindValues([':codeetbs'=>$ets,':codeAnnee'=>$anneeActive])
        ->queryall();
      if ($query != null)
        return $query;
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function stateleveWomen()
  {
    $ets = yii::$app->mainCLass->getets();

    try {
      $anneeActive = yii::$app->mainCLass->chargerAnneeActive();


      $query = $this->connect->createCommand("SELECT count(dj_eleve.code) AS Nbeleve FROM dj_eleve ,dj_lien_eleve_classe
                                          WHERE dj_lien_eleve_classe.codeEleve = dj_eleve.code
                                          and dj_eleve.statut =1
                                          and dj_eleve.genre =2 
                                          and dj_lien_eleve_classe.codeAnnee=:codeAnnee
                                           and dj_eleve.codeetbs=:codeetbs")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeetbs' => $ets])
        ->queryOne();
      if ($query != null)
        return $query['Nbeleve'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }






  public function stateleveWomanforclasse($codeClasse)
  {
    try {
      $anneeActive = yii::$app->mainCLass->chargerAnneeActive();


      $query = $this->connect->createCommand("SELECT count(dj_eleve.code) AS Nbeleve FROM dj_eleve ,dj_lien_eleve_classe
                                          WHERE dj_lien_eleve_classe.codeEleve = dj_eleve.code
                                          and dj_eleve.statut =1
                                          and dj_eleve.genre =2 
                                          and dj_lien_eleve_classe.codeClasse =:codeClasse
                                          and dj_lien_eleve_classe.codeAnnee=:codeAnnee")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeClasse' => $codeClasse])
        ->queryOne();
      if ($query != null)
        return $query['Nbeleve'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }




  public function stateleveWomanforniveau($codeClasse)
  {
    try {
      $anneeActive = yii::$app->mainCLass->chargerAnneeActive();


      $query = $this->connect->createCommand("SELECT count(dj_eleve.code) AS Nbeleve FROM dj_eleve ,dj_lien_eleve_classe,dj_classe
                                          WHERE dj_lien_eleve_classe.codeEleve = dj_eleve.code
                                          and dj_eleve.statut =1
                                          and dj_eleve.genre =2 
                                          and dj_classe.code =dj_lien_eleve_classe.codeClasse
                                          and dj_classe.codeNiveau =:codeClasse
                                          and dj_lien_eleve_classe.codeAnnee=:codeAnnee")
        ->bindValues([':codeAnnee' => $anneeActive, ':codeClasse' => $codeClasse])
        ->queryOne();
      if ($query != null)
        return $query['Nbeleve'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function listepaiementelevecocineele($codeClasse, $codeEleve ,$typeeleve = "")
  {

    if($typeeleve== 0){
      
      try {
        $anneeActive = yii::$app->mainCLass->getAnneeActive();
  
  
        $query = $this->connect->createCommand("SELECT * FROM dj_lien_paiement_classe,dj_payement
                                              where dj_lien_paiement_classe.codePaiement not in(SELECT dj_lien_payement_eleve.codePayement from dj_lien_payement_eleve
                                               WHERE dj_lien_payement_eleve.codeEleve =:codeEleve and dj_lien_payement_eleve.codeAnnee=:anneeActive )
                                              and dj_lien_paiement_classe.codeClasse =:codeClasse
                                              AND dj_payement.code =dj_lien_paiement_classe.codePaiement ")
          ->bindValues([':anneeActive' => $anneeActive, ':codeClasse' => $codeClasse, ':codeEleve' => $codeEleve])
          ->queryAll();
        return $query;
      } catch (\Throwable $th) {
        return $th->getMessage();
      }
    }
    // return 'ok';
    try {
      $anneeActive = yii::$app->mainCLass->getAnneeActive();


      $query = $this->connect->createCommand("SELECT * FROM dj_lien_paiement_classe,dj_payement
                                            where dj_lien_paiement_classe.codePaiement not in(SELECT dj_lien_payement_eleve.codePayement from dj_lien_payement_eleve
                                             WHERE dj_lien_payement_eleve.codeEleve =:codeEleve and dj_lien_payement_eleve.codeAnnee=:anneeActive )
                                            and dj_lien_paiement_classe.codeClasse =:codeClasse
                                            and dj_payement.code not in('38647b3110fa65232f65f2111c0474fe8c804eed0aad15d7','6f74a090ba0115d59b0bad3e86ae14742b3b4baf4fbde4fc')
                                            AND dj_payement.code =dj_lien_paiement_classe.codePaiement ")
        ->bindValues([':anneeActive' => $anneeActive, ':codeClasse' => $codeClasse, ':codeEleve' => $codeEleve])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }
   
  }

  public function listepaiementeleve($codeClasse, $codeEleve)
  {
    try {
      $anneeActive = yii::$app->mainCLass->getAnneeActive();


      $query = $this->connect->createCommand("SELECT * FROM dj_lien_paiement_classe,dj_payement
                                            where dj_lien_paiement_classe.codePaiement not in(SELECT dj_lien_payement_eleve.codePayement from dj_lien_payement_eleve
                                             WHERE dj_lien_payement_eleve.codeEleve =:codeEleve and dj_lien_payement_eleve.codeAnnee=:anneeActive )
                                            and dj_lien_paiement_classe.codeClasse =:codeClasse
                                            AND dj_payement.code =dj_lien_paiement_classe.codePaiement ")
        ->bindValues([':anneeActive' => $anneeActive, ':codeClasse' => $codeClasse, ':codeEleve' => $codeEleve])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }
  }


  //selectionner les eleves a travers les parents

  public function listeparents($telTuteur)
  {
    try {

      $anneeActive = yii::$app->mainCLass->getAnneeActive();


      $query = $this->connect->createCommand("SELECT * FROM dj_eleve WHERE telTuteur=:telTuteur ")
        ->bindValue(':telTuteur', $telTuteur)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }
  }



  public function insertdatacard($code, $statut, $codeclasse, $codeEleve, $codeAnnee, $codeets = '')
  {
    try {
      $anneeActive = yii::$app->mainCLass->getAnneeActive();


      $query = $this->connect->createCommand("INSERT INTO dj_carte(code, codeEleve, statut, codeetbs	, codeAnnee, codeClasse)
                                          VALUES (:code,:codeEleve,:statut,:codeets,:codeAnnee,:codeClasse)")
        ->bindValues([':code' => $code, ':codeEleve' => $codeEleve, ':statut' => $statut, ':codeets' => $codeets, ':codeClasse' => $codeclasse, ':codeAnnee' => $codeAnnee])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function insertparents($code, $nom, $prenom, $tel, $codeets = " ")
  {
    try {


      $query = $this->connect->createCommand("INSERT INTO dj_parent( code, nom, prenom, tel,codeetbs)
                                          VALUES (:code,:nom,:prenom,:tel,:codeetbs)")
        ->bindValues([':code' => $code, ':nom' => $nom, ':prenom' => $prenom, ':tel' => $tel, ':codeetbs' => $codeets])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function insertlientparents($code, $codeparent, $codeeleve, $codeets)
  {
    try {


      $query = $this->connect->createCommand("INSERT INTO dj_lien_parent_eleve(codeparent, codeeleve, code,codeetbs) 
                                          VALUES (:codeparent,:codeeleve,:code,:codeetbs)")
        ->bindValues([':code' => $code, ':codeparent' => $codeparent, ':codeeleve' => $codeeleve, ':codeetbs' => $codeets])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function inserpresence($code, $codeeleve, $codeets)
  {
    try {


      $query = $this->connect->createCommand("INSERT INTO dj_presence(code, codeetbs, codeeleve)  
                                          VALUES (:code,:codeetbs,:codeeleve)")
        ->bindValues([':code' => $code, ':codeeleve' => $codeeleve, ':codeetbs' => $codeets])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function stateleveforclasse($codeNiveau, $codeAnnee)
  {
    try {


      $query = $this->connect->createCommand("SELECT COUNT(dj_lien_eleve_classe.codeEleve) as nb FROM dj_lien_eleve_classe,dj_classe
            WHERE dj_lien_eleve_classe.codeClasse = dj_classe.code
            and dj_classe.codeNiveau =:codeNiveau
            and dj_lien_eleve_classe.codeAnnee=:codeAnnee")
        ->bindValues([':codeNiveau' => $codeNiveau, ':codeAnnee' => $codeAnnee])
        ->queryOne();
      if ($query)
        return $query['nb'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function statistiqueforclasse($codeClasse, $codeAnnee)
  {
    try {


      $query = $this->connect->createCommand("SELECT COUNT(codeEleve) as nb FROM dj_lien_eleve_classe ,dj_eleve
      WHERE codeAnnee =:codeAnnee 
      and dj_eleve.code = dj_lien_eleve_classe.codeEleve
      and dj_eleve.statut =1
      and codeClasse=:codeClasse")
        ->bindValues([':codeClasse' => $codeClasse, ':codeAnnee' => $codeAnnee])
        ->queryOne();
      // die(var_dump($codeClasse));
      if ($query) return $query['nb'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function statistiqueforNIVEAU($niveau, $codeAnnee)
  {
    try {


      $query = $this->connect->createCommand("SELECT COUNT(codeEleve) as nb FROM dj_lien_eleve_classe ,dj_classe,dj_eleve 
      where dj_classe.code = dj_lien_eleve_classe.codeClasse
      and dj_classe.codeNiveau=:niveau
      and dj_eleve.code = dj_lien_eleve_classe.codeEleve
       and dj_eleve.statut =1
      and dj_lien_eleve_classe.codeAnnee=:codeAnnee")
        ->bindValues([':niveau' => $niveau, ':codeAnnee' => $codeAnnee])
        ->queryOne();
      if ($query)
        return $query['nb'];
      return 0;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function verifiepresnece($codeeleve)
  {
    try {


      $query = $this->connect->createCommand("SELECT * FROM dj_presence WHERE codeeleve=:codeeleve and dataajout=:dataajout ")
        ->bindValues([':codeeleve' => $codeeleve, ':dataajout' => date('Y-m-d')])
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }
  }

  public function presenceFordata($codeIndividu, $codeEts)
  {
    $query = null;
    try {
      $query = $this->connect->createCommand('SELECT *  FROM dj_presence
                                                      WHERE codeeleve= :codeIndividu                                              
                                                      AND codeetbs = :codeEts 
                                                      ORDER BY id desc')
        ->bindValues([':codeEts' => $codeEts, ':codeIndividu' => $codeIndividu])
        ->queryAll();

      return $query;
    } catch (\PDOException $ex) {
    }
  }

  public function listeprensececlasse($codeclasse)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_eleve.code as codeEleve ,dj_eleve.nom,dj_eleve.prenom,dj_eleve.genre,dj_eleve.photo,dj_eleve.prenomTuteur,
      dj_eleve.telTuteur,dj_eleve.nomTuteur,dj_eleve.adresse,dj_eleve.matricule,dj_lien_eleve_classe.code as codeLien
       FROM dj_presence,dj_lien_eleve_classe,dj_eleve
       WHERE codeClasse=:codeclasse
       and dj_lien_eleve_classe.codeEleve=dj_presence.codeeleve
       and dj_eleve.code = dj_lien_eleve_classe.codeEleve
       and dj_presence.dataajout=:dataajout ")
        ->bindValues([':codeclasse' => $codeclasse, ':dataajout' => date('Y-m-d')])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }
  }

}
