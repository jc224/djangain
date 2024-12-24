<?php

namespace app\components;

use Yii;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;
use yii\filters\VerbFilter;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;


class mainCLass extends Component
{

  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }


  public function gsanguuin()
  {
    return [
      '1' => 'A+',
      '2' => 'A-',
      '3' => 'B+',
      '4' => 'B-',
      '5' => 'AB+',
      '6' => 'AB-',
      '7' => 'O+',
      '8' => 'O-',


    ];
  }


  public function getgsanguin($gsa)
  {
    $gs = "";
    switch ($gsa) {
      case '1':
        return 'A+';
        break;
      case '2':
        return 'A-';
        break;
      case '3':
        return 'B+';
        break;
      case '4':
        return 'B-';
        break;
      case '5':
        return 'AB+';
        break;
      case '6':
        return 'AB-';
        break;
      case '7':
        return 'O-';
        break;
      case '8':
        return 'O+';
        break;

      default:
        return '';
        break;
    }
  }
  public function getAlltableData($table, $etat = '1')
  {
    $query = null;
    $ets = yii::$app->mainCLass->getets();

    try {
      $query = $this->connect->createCommand("SELECT * FROM $table where etat= $etat and codeetbs= '$ets' ")
        ->queryAll();
      return $query;
      return;
    } catch (\PDOException $ex) {
    }
  }


  //recuperer la matiere
  public function selectmatiere($codeemploie, $jours, $heure)
  {
    $codemat = Yii::$app->configClass->afficheemploie($codeemploie, $jours, $heure);
    $getmatiere = Yii::$app->mainCLass->databycode('dj_matiere', $codemat, 'code');
    return (sizeof($getmatiere) > 0) ? $getmatiere['0']['libelle'] : '';
  }
  public function uniLibelle($table, $libelle, $columns, $etat = '1')
  {
    $ets = yii::$app->mainCLass->getets();

    $query = null;
    try {
      $query = $this->connect->createCommand("SELECT * FROM $table where $columns = :libelle and etat= $etat and codeetbs='$ets'")
        ->bindValue(':libelle', $libelle)
        ->queryAll();
      if ($query != null) return true;
      return false;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }



  public function databycode($table, $libelle, $columns)
  {
    $query = null;
    // $codeEntite = yii::$app->nonSqlClass->getActiveEnt();
    try {
      $query = $this->connect->createCommand("SELECT * FROM $table where $columns = :libelle  and etat='1'")
        ->bindValue(':libelle', $libelle)
        ->queryAll();
      return $query;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }



  public function unidata($table, $code)
  {
    $query = null;
    try {
      $query = $this->connect->createCommand("SELECT * FROM $table where code = :code ")
        ->bindValue(':code', $code)
        ->queryOne();
      if ($query != null) return $query;
      return null;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }

  public function chargerAnneeActive($codeEts = "")
  {

    if($codeEts == ""){
      $codeEts =yii::$app->mainCLass->getets();

    }
    $rslt = $this->connect->createCommand('SELECT * FROM dj_anneescolaire WHERE   statut=:statut and codeetbs=:codeEts')
      ->bindValues([':statut' => 1, ':codeEts' => $codeEts])
      ->queryOne();
    if ($rslt) return $rslt['code'];
    return;
  }






  public function getusers()
  {
    return  unserialize(Yii::$app->session[Yii::$app->params['massesion']])['userCode'];
  }


  public function getets()
  {
    return  unserialize(Yii::$app->session[Yii::$app->params['massesion']])['codeets'];
  }

  public function getAnneeActive()
  {
    return  unserialize(Yii::$app->session[Yii::$app->params['massesion']])['codeAnneeActive'];
  }



  /** Methode : Demarrer le process d'authentification **/
  public function demarrer_auth($identifiant = '')
  {
    $auth = $this->connect->createCommand('SELECT * FROM dj_admins WHERE identifiant=:identifiant')
      ->bindValue(':identifiant', $identifiant)
      ->queryOne();
    return $auth;
  }
}
