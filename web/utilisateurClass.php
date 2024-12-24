<?php
namespace app\components;

use Override;
use Yii;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;


class utilisateurClass extends Component
{


  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }


  // requette d'insertion de utilisateur

  public function addUsers($code, $nom, $prenom, $email, $motpasse, $codegroupe, $codeuser, $identifiant, $genre = '', $typeusers = '', $photo = '', $tel = '')
  {
    $motpasse = Yii::$app->accessClass->create_pass($identifiant, $motpasse);


    try {
      $req = $this->connect->createCommand('INSERT INTO gtech.utilisateur(code,nom, prenom, email, motpasse, codegroupe,codeuser,identifiant,typeusers,genre,photo,tel)
        	VALUES (:code,:nom, :prenom, :email, :motpasse, :codegroupe, :codeuser,:identifiant,:typeusers,:genre,:photo,:tel)')
        ->bindValues([':code' => $code, ':nom' => $nom, 'prenom' => $prenom, ':email' => $email, ':motpasse' => $motpasse, 'codegroupe' => $codegroupe, ':codeuser' => $codeuser, ':identifiant' => $identifiant, ':typeusers' => $typeusers, ':genre' => $genre, ':photo' => $photo, ':tel' => $tel])
        ->execute();

    } catch (\Throwable $th) {
      return ($th->getMessage());
    }

  }

  public function updateuserfournisseur($code, $nom, $prenom, $email, $genre = '', $photo = '', $tel = '')
  {


    try {
      $req = $this->connect->createCommand('UPDATE  gtech.utilisateur SET nom=:nom, prenom=:prenom, email=:email,genre=:genre,photo=:photo,tel=:tel WHERE code=:code')
        ->bindValues([':code' => $code, ':nom' => $nom, 'prenom' => $prenom, ':email' => $email,  ':genre' => $genre, ':photo' => $photo, ':tel' => $tel])
        ->execute();

    } catch (\Throwable $th) {
      return ($th->getMessage());
    }

  }



  public function addUsersapi($code, $nom, $prenom, $email, $motpasse, $tel)
  {
    $motpasse = Yii::$app->accessClass->create_pass($tel, $motpasse);


    try {
      $req = $this->connect->createCommand('INSERT INTO gtech.utilisateur(code,nom, prenom, email, motpasse, identifiant,tel,typeusers)
        	VALUES (:code,:nom, :prenom, :email, :motpasse,:identifiant,:tel,:typeusers)')
        ->bindValues([':code' => $code, ':nom' => $nom, 'prenom' => $prenom, ':email' => $email, ':motpasse' => $motpasse, ':identifiant' => $tel, ':tel' => $tel, ':typeusers' => 2])
        ->execute();
      return 201;
    } catch (\Throwable $th) {
      return ($th->getMessage());
    }

  }

  // ajout d'un utilisateur en attente

  public function addUserAttente($code, $nom, $prenom, $email, $groupe, $genre = '', $typeusers = 1, $photo, $tel)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO gtech.user_attente(code, nom, prenom, email,lien,date,genre,typeusers,photo,tel) 
        VALUES (:code, :nom,:prenom,:email,:lien,:date,:genre,:typeusers,:photo,:tel)")
        ->bindValues([':code' => $code, ':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':lien' => $groupe, ':date' => date('Y-m-d'), ':genre' => $genre, ':typeusers' => $typeusers, ':photo' => $photo, ':tel' => $tel])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }


  }


  public function listeUser()
  {
    try {
      $req = $this->connect->createCommand('SELECT * FROM gtech.utilisateur WHERE  statut=1 ')
        ->queryAll();
      return $req;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }

  }


  public function updateuser($typeuser, $statut, $code)
  {

    try {
      $query = $this->connect->createCommand('UPDATE gtech.utilisateur
        SET  codegroupe=:codegroupe,statut=:statut
        where code=:code ')
        ->bindValues([':codegroupe' => $typeuser, ':statut' => $statut, ':code' => $code])
        ->execute();
      // die($action);

    } catch (\PDOException $ex) {
      die($ex->getMessage());
    }
  }

  public function searchUsers($donneeRecherche = '', $limit = '1')
  {
    $query = null;

    $limit = Yii::$app->productClass->getRealLimit($limit);
    if (isset($limit) && $limit > 0) {
      $limit = 'LIMIT ' . $limit;
    }

    try {
      $req = $this->connect->createCommand('SELECT * FROM gtech.utilisateur where 
         	(utilisateur.nom like :donnerechercher
          or utilisateur.prenom like :donnerechercher)
                ORDER BY utilisateur.id desc ' . $limit)

        ->bindValues([':donnerechercher' => '%' . $donneeRecherche . '%'])
        ->queryAll();
      return $req;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }

  }










  /********************************************************************groupe utilisateur */

  // ajouter un groupeuser
  public function addgroupeUser($code, $libelle, $action, $codeuser)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO gtech.groupe_utilisateurs(code, libelle,action,codeuser,dateajout) 
        VALUES (:code, :libelle,:action,:codeuser,:dateajout)")
        ->bindValues([':code' => $code, ':libelle' => $libelle, ':action' => $action, ':codeuser' => $codeuser, ':dateajout' => date('Y-m-d')])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }


  }

  //liste groupeusr
  public function listegroupeUser()
  {
    try {
      $req = $this->connect->createCommand('SELECT * FROM gtech.groupe_utilisateurs WHERE  statut=1 ')
        ->queryAll();
      return $req;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }

  }

  // modifier un groupe d'utiisateur
  public function updategroupeuser($nomgroupe, $typeuser, $action = '')
  {

    try {
      $query = $this->connect->createCommand('UPDATE gtech.groupe_utilisateurs
        SET  action=:action,libelle=:libelle
        where code=:code ')
        ->bindValues([':code' => $typeuser, ':action' => $action, ':libelle' => $nomgroupe])
        ->execute();
      // die($action);

    } catch (\PDOException $ex) {
      die($ex->getMessage());
    }
  }


  // filtrer un groupe d'utilisateur
  public function searchgroupeuser($donneeRecherche = '', $limit = '1')
  {
    $query = null;

    $limit = Yii::$app->productClass->getRealLimit($limit);
    if (isset($limit) && $limit > 0) {
      $limit = 'LIMIT ' . $limit;
    }

    try {
      $req = $this->connect->createCommand('SELECT * FROM gtech.groupe_utilisateurs where 
         	(groupe_utilisateurs.libelle like :donnerechercher
                )
                ORDER BY groupe_utilisateurs.id desc ' . $limit)

        ->bindValues([':donnerechercher' => '%' . $donneeRecherche . '%'])
        ->queryAll();
      return $req;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }

  }



  //code for api
  public function demandecourse($code, $depart, $destination, $codeclient, $expoPushToken,$date,$heure,$typecourse)
  {

    try {
      $req = $this->connect->createCommand('INSERT INTO gtech.courses(
        code, adresse_depart, adresse_destination ,code_client,devisetoken,date_depart ,heure,typereservation )
        VALUES ( :code, :depart, :destination ,:codeclient,:devisetoken,:date_depart ,:heure,:typereservation);
          '
      )

        ->bindValues([':code' => $code, ':depart' => $depart, ':destination' => $destination,  ':codeclient' => $codeclient, ':devisetoken' => $expoPushToken,':date_depart'=>$date ,':heure'=>$heure,':typereservation'=>$typecourse  ])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }

  }



  public function updatecourse($code, $statut)
  {


    // if ($statut == 2) {

    //   $course = Yii::$app->mainClass->getuniquedatafortable('gtech.courses', $code, 'code');
  
    //   try {
    //     $req = $this->connect->createCommand('UPDATE  gtech.chauffeurs SET etat=:etat WHERE code=:code')

    //       ->bindValues([':code' => $course['code_chauf'], ':etat' => 1])
    //       ->execute();
    //   } catch (\Throwable $th) {
    //     return ($th->getMessage());
    //   }

    // }else if($statut ==3){
    //   $course = Yii::$app->mainClass->getuniquedatafortable('gtech.courses', $code, 'code');
    //   try {
    //     $req = $this->connect->createCommand('UPDATE  gtech.chauffeurs SET etat=:etat WHERE code=:code')

    //       ->bindValues([':code' => $course['code_chauf'], ':etat' => 0])
    //       ->execute();
    //   } catch (\Throwable $th) {
    //     return ($th->getMessage());
    //   }

    // }
    try {
      
      $req = $this->connect->createCommand('UPDATE  gtech.courses SET statut_course=:statut WHERE code=:code')

        ->bindValues([':code' => $code, ':statut' => $statut])
        ->execute();
      return $req;
    } catch (\Throwable $th) {
      return ($th->getMessage());
    }

  }


  public function listecourse($codeclient, $limit = '5')
  {

    try {
      $req = $this->connect->createCommand("SELECT * FROM gtech.courses WHERE code_client = :codeclient order by dateajout desc  limit $limit")
        ->bindValue(':codeclient', $codeclient)
        ->queryAll();
      return $req;
    } catch (\Throwable $th) {
      returm($th->getMessage());
    }

  }

  public function detailscourse($code)
  {

    try {
      $req = $this->connect->createCommand("SELECT * from gtech.courses where code=:code")
        ->bindValue(':code', $code)
        ->queryOne();
      return $req;
    } catch (\Throwable $th) {
      returm($th->getMessage());
    }

  }

  public function getAllinfoChauffeur($code)
  {

    try {
      $req = $this->connect->createCommand("SELECT * from gtech.chauffeurs, gtech.engins,gtech.utilisateur 
       where chauffeurs.code =engins.codechauffeur
       and chauffeurs.code =utilisateur.code
       and chauffeurs.code=:code")
        ->bindValue(':code', $code)
        ->queryOne();
      return $req;
    } catch (\Throwable $th) {
      returm($th->getMessage());
    }

  }


}

