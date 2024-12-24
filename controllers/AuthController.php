<?php

namespace app\controllers;

use Yii;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\db\Query;


// use yii\filters\VerbFilter;
// use app\models\RgUsrInfo;

class AuthController extends Controller {
	public $request;
	public $cruizer = false;

	public function __construct(){
		$cruizer = true;
	}



	
      /** Methode : gener un uniq id **/
      public function generateUniq()
      {
        return strVal(bin2hex(random_bytes(Yii::$app->params['PBKDF2_SALT_BYTE_SIZE'])));
      }

	public static function store_auth($code=Null, $identifiant=Null ,$codeEts=null){

		$codeAnneeActive = Null;

		$codeAnneeActive = yii::$app->mainCLass->chargerAnneeActive($codeEts);

		$userAuthDtlsArray = ['userCode'=>$code, 'codeAnneeActive'=>$codeAnneeActive,'codeets'=>$codeEts];
		
		$salt = Yii::$app->simplelClass->generateUniq();

		Yii::$app->session[Yii::$app->params['massesion']] = serialize($userAuthDtlsArray);

		$userSession = unserialize(Yii::$app->session[Yii::$app->params['massesion']]);

		Yii::$app->session['token'] = base64_encode(md5($identifiant.Yii::$app->params['key_connector'].$salt));

			//Mettre à jour le salt dans la base de données
		Yii::$app->accessClass->mettreStatPresenceSaltAJour($salt, $code);
		return true;
	}

	private static function compareDateToToday($dte_in_string){
		$cmparer = Null;
		$dteJour = date('Y-m-d');
		$data = explode('-',$dteJour);
		$dtetoday = $data['0'].$data['1'].$data['2'];
		$licencedate = base64_decode($dte_in_string);
		if($dtetoday >= $licencedate){
			$cmparer = '2692';
		}
		return $cmparer;
	}

	public static function UserAuthDtls($identifiant,$motPass){
	
		$vraisMotPass = false;
		$dteJour = date('Y-m-d');
		$estPermit = false;
		$connection = \Yii::$app->db;
		
   
		if(!empty($identifiant)){
       
			$auth = Yii::$app->mainCLass->demarrer_auth($identifiant);
			
			if(!is_array($auth) OR $auth==false){ # MEANING ,NO RECORD MATCHES THE userName SERCHED
				return 22;
			}else{

				// $pswrd = Yii::$app->accessClass->create_pass($identifiant, $motPass);
				// die(var_dump($pswrd));

					// PREPARE MOT PASSE A ANALYSER
				$motPass_constitue = $identifiant.Yii::$app->params['key_connector'].$motPass; 
			
					// RASSURER QUE MOT PASS EST CORRECT
				$veraciteMot_passe = Yii::$app->cryptoClass->validate_password($motPass_constitue, $auth['admin_password']); 
			  	// 	  var_dump($veraciteMot_passe);die() ;	
				switch ($veraciteMot_passe) {

						// Mot de passe est correct
					case true:
					case 1: 
							// Demarrer l'enregistrement des datas
							
						$storageProcess = AuthController::store_auth($auth['code'],$auth['identifiant'], $auth['codeetbs']);
							switch ($storageProcess) {
							case true:
							case 1:
								//if(Yii::$app->mainCLass->creerEvent('001','CONNEXION REUSSIE')) {
									return 'success';
								//}
							break;

							default:
								return 22;
							break;
						}
					break;

						// Mot de passe est incorrect
					default:
						//die(var_dump(Yii::$app->accessClass->create_pass($auth['identifiant'], $motPass)));
						return 22;
					break;
				}
				die(var_dump('Ooops'));
			}
		} else { 
			return false; 
		}
	}

	#****************************************************
	# AUTHENTIFICATION DES UTILISATEURS
	#****************************************************
	public static function Authentifcation(){
		// START : DECLARE VARIABLES
		$cruizer = true;
		$session = null;
		// END : DECLARE VARIABLES

		$request = Yii::$app->request;
		$userName = $request->post('userName');
		$motPass = $request->post('motPass');
		$sugarpot = $request->post('sugarpot');
		$token = isset($session['token']) ? $session['token'] : ''; 
		# GET THE VALUE OF THE TOKEN PREVIOUSLY SET
		// if(!empty($token) ){ # WE CHEQUE IF TOKEN HAS BEEN SET
		// 	if($usr_confirmed){
		// 		if(Yii::$app->mainCLass->validiteToken($token)){
		// 			return 'success';
		// 		}else{
		// 			return 22; # INVALIDE AUTHENTIFICATION
		// 		}
		// 	}else{return $usr_confirmed;}
		// }

		if($userName == Null || $motPass == Null){ // ICHECK IF ONE FIELD IS EMPTY OR NOT
			return 11;
		}

		if(!empty($sugarpot) OR $sugarpot!=""){
			return 12;
		}

		if($cruizer){ // WE CONFIRM THE userName
			$UserAuthDtls = AuthController::UserAuthDtls($userName, $motPass);
			return $UserAuthDtls;
		}
	}

}
