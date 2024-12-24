<?php

namespace app\components;

use Yii;
use yii\helpers\Html;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use HTTP_Request2;
use Informagenie\OrangeSDK;



class simplelClass extends Component
{


  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }



  public function etat()
  {
    return [
      '1' => 'ACTIVE',
      '2' => 'SUPPRIMER',
    ];
  }

  public function getlangage($id){
    switch ($id) {
      case 1:
        return "Langage Oral";
        break;
      case 2:
        return "Langage Ecrit";
        break;
      case 3:
        return "Activités Artistiques";
        break;
      case 4:
        return "Explorer le monde";
      case 5:
       return "Outils Mathématiques ";
        break;
      default:
        # code...
        break;
    }
  }
  public function selectsat() {}

  //public function envoi msg
  // public function envoieSmsoanfe($from, $message, $to)
  // {

  //   $credentials = [
  //     'client_id' => 'QjOm511Y1AcQn64l5xYGYMgE8jPGvTfv',
  //     'client_secret' => 'QH0PIHEWTVf4nHA0'
  //   ];

  //   $version = 'v3'; //per default 

  //   /*
  //    You can use directly authorization header instead of client_id and client_secret
  //    $credentials = [
  //        'authorization_header' => 'Basic xxx...',
  //    ];
  //  */

  //   try {
  //   $sms = new OrangeSDK($credentials);

  //     $response = $sms->message($message, $version)
  //       ->from(224623516202)       // Sender phone's number
  //       // ->as('224623516202')      // Sender's name (optional)
  //       ->to($to)      // Recipiant phone's number
  //       ->send();
  //   } catch (\Throwable $th) {
  //     // die($th);
  //   }
  // }




  public function envoieSms($from, $message, $to)
  {
    $to = preg_replace("/^224/", "", $to);
    // die($to);
    $url = "https://api.nimbasms.com/v1/messages";

    $headers = array(
      "Authorization: Basic ZGNkMTlmZjRmMzlkNGM0NDVjYWU2MGZhMTU1MzY2YzQ6SXNCeG9aR0hMZmd4VTNHUlM1WkU4TXFWQUN3cXh5enV3NlVoQ2psVUEwQ081QVI3RXJuY3VTQ3Y1M1BmOUpNUTF6TFJDTzBvTFJZZXBFSXJXdUtzcXJESHJvVkpadndsdVptSFRZSXdVNXM=",
      "Content-Type: application/json"
    );

    $body = array(
      "to" => array($to),
      "sender_name" => "Djangain",
      "message" => $message
    );

    $options = array(
      "http" => array(
        "method" => "POST",
        "header" => implode("\r\n", $headers),
        "content" => json_encode($body),
        "ignore_errors" => true
      )
    );

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    $http_response_header = isset($http_response_header) ? $http_response_header : [];
    $status_line = $http_response_header[0];
    preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
    $status_code = $match[1];

    if ($status_code != 201) {
      return "Réponse:" . $response;
    }

    print_r($response);
  }






  public function maxmincoef($coef, $typecompte)
  {
    $max = $min = 0;
    if ($typecompte == 1) {
      $max = 5 * $coef;
      $min = 10 * $coef;
    } elseif ($typecompte == 2) {
      $max = 20 * $coef;
      $min = 10 * $coef;
    }
    return [$max, $min];
  }


  public function getHiddenFormTokenField()
  {
    $token = Yii::$app->getSecurity()->generateRandomString();
    $token = str_replace('+', '.', base64_encode($token));
    Yii::$app->session->set('postToken', $token);
    return Html::hiddenInput('postToken', $token);
  }


  public function typeCompo()
  {
    $typCompo = [

      '1' => ['code' => '1', 'libelle' => 'Trimestre'],
      '2' => ['code' => '2', 'libelle' => 'Semestre'],


    ];
    //  var_dump($mois[3]['code']);die();
    return $typCompo;
  }



  public function selectPeriode($periode)
  {
    switch ($periode) {
      case '1':
        return '1er Trimestre';
        break;
      case '2':
        return '2eme Trimestre';
        break;
      case '3':
        return '3eme Trimestre';
        break;
      case '4':
        return '1er Semestre';
        break;
      case '5':
        return '2eme Semestre';
        break;



      default:
        # code...
        break;
    }
  }





  public function moyenne($note1, $note2, $note3, $periode)
  {

    if ($periode > 3 && $note3 > 0) {

      return round(($note1 + $note2 + $note3) / 3, 2);
    } elseif ($note2 > 0) {
      return round(($note1 + $note2) / 2, 2);
    } else {
      return 0;
    }
  }


  public function matricule($codeets)
  {

    try {
      $query = $this->connect->createCommand("SELECT matricule FROM dj_eleve  where codeetbs=:codeetbs order by id desc limit 1 ")
        ->bindValue(':codeetbs', $codeets)
        ->queryOne();
      if ($query != null)
        return $query['matricule'];
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }
  public function genereMatricule($lastid, $codeets = "")
  {
    
    $lastid=intval(substr(date($lastid), 0, 3));

    if ($codeets == '1858e3a7453dd1b90e8fafdbca2c34f8f507dc6bfece38f1') {

      $date = substr(date('Y-m-d'), -8, 2);
      $num = $lastid + 1;


      $Pcode = Null;
      // $Fcode = $Pcode . rand(11, 99);
      return $num . '/EC/' . $date;
    }else{
      $date = substr(date('Y-m-d'), -8, 2);
      $num = $lastid + 1;
      if ($num < 10) {
        $Fcode = '00' . $num;
      } else if ($num > 10 && $num < 100) {
        $Fcode = '0' . $num;
      } else {
        $Fcode = '0' . $num;
      }

      $Pcode = Null;
      // $Fcode = $Pcode . rand(11, 99);
      return $Fcode . '/JC/' . $date;
    }
  }
  public function mentionTrimestre($moyenne)
  {
    $mention = '';
    if ($moyenne >= 9 && $moyenne <= 10) {
      $mention = 'Excellent';
    } elseif ($moyenne < 9 && $moyenne >= 8) {
      $mention = "Trés Bien";
    } elseif ($moyenne < 8 && $moyenne >= 7) {
      $mention = 'Bien';
    } elseif ($moyenne < 7 && $moyenne >= 6) {
      $mention = "Assez Bien";
    } elseif ($moyenne < 6 && $moyenne >= 5) {
      $mention = "Passable";
    } elseif ($moyenne < 5 && $moyenne >= 4) {
      $mention = "Insuffisant";
    } elseif ($moyenne < 4) {
      $mention = "Médiocre";
    }
    return $mention;
  }
  public function mentionSecondaire($moyenne)
  {
    $mention = '';
    if ($moyenne >= 18 && $moyenne <= 20) {
      $mention = 'Excelent';
    } elseif ($moyenne >= 16 && $moyenne < 18) {

      $mention = 'Trés Bien';
    } elseif ($moyenne >= 14 && $moyenne < 16) {
      $mention = 'Bien';
    } elseif ($moyenne < 14 && $moyenne >= 12) {
      $mention = 'Assez Bien';
    } elseif ($moyenne < 12 && $moyenne >= 10) {
      $mention = "Passable";
    } elseif ($moyenne < 10 && $moyenne >= 7) {
      $mention = "Insuffisant";
    } elseif ($moyenne < 7) {
      $mention = "Mediocre";
    } else {
      $mention = 'Pas de note dans l\'intervale';
    }
    return $mention;
  }

  public function mention($moy = 0)
  {
    return $moy;
  }

  //CALCUL MOYENNE COMPOSITION
  public function moySemestre($data, $typecompo)
  {


    // die(var_dump($data));
    if (sizeof($data) > 0) {
      $i = 0;
      $total = 0;
      $coef = 0;
      $matiere = 0;
      $compo = 0;
      $general = 0;
      foreach ($data as $key => $value) {
        //die(var_dump($value));
        $matiere = $matiere + ($value['cours'] * $value['coef']);
        $coef = $coef + $value['coef'];
        $compo = $compo + ($value['compo'] * $value['coef']);
        // $general = $general + ($value['moy'] * $value['coef']);
      }

      $totalCours = $matiere;
      $moyenneCours = round(($totalCours / $coef), 2);
      $moyennecompo = round(($compo / $coef), 2);

      if ($typecompo == '1') {
        $moyenneGeneral = round((($moyenneCours + $moyennecompo) / 2), 2);
      } else if ($typecompo == '2') {

        $moyenneGeneral = round((($moyenneCours + (2 * $moyennecompo)) / 3), 2);
      }
      // die(var_dump($totalCours ));
      //  die(var_dump(    $moyenneGeneral));
      return [
        'Totalcours' => $totalCours,
        'MoyenneCours' => $moyenneCours,
        'totalCompo' => $compo,
        'moyennecompo' => $moyennecompo,
        'moyenneGenerale' => $moyenneGeneral
      ];
    }
  }

  public function moyenneMoyennegenral($cours, $composition)
  {
    return round(($cours + 2 * $composition) / 3, 2);
  }
  public function moyenneMoyennegenralTrim($cours, $composition)
  {
    return round(($cours + $composition) / 2, 2);
  }
  /** Methode : gener un uniq id **/
  public function generateUniq()
  {
    return strVal(bin2hex(random_bytes(24)));
  }
  /** Methode : Charger le message d'erreur **/
  //notification pour les message
  public function afficherNofitication($code = Null, $msg = Null, $color = Null)
  {
    $code = intval($code);
    Yii::$app->view->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css');
    Yii::$app->view->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
    //return 'ok';

    switch ($code) {

        //Code pour attention
      case 412:
        $color = 'warning';
        break;

        //Code pour erreur
      case 400:
        $color = 'error';
        break;

        //Code pour succes
      case 200:
        $color = 'success';
        break;

        //Information
      case 100:
        $color = 'info';
        break;

        //
      default:
        return;
        break;
    }
    return ['msg' => $msg, 'code' => $code];

    // return '<script></script>';

    $js = <<<JS
      toastr.{$color}('{$msg}', '{$color}');
      JS;

    Yii::$app->view->registerJs($js);

    // return '
    //       <script>

    //         toastr.options = {
    //         closeButton: true,
    //         debug: false,
    //         newestOnTop: false,
    //         progressBar: true,
    //         positionClass: "toast-top-right",
    //         preventDuplicates: false,
    //         onclick: null,
    //         showDuration: "300",
    //         hideDuration: "1000",
    //         timeOut: "5000",
    //         extendedTimeOut: "1000",
    //         showEasing: "swing",
    //         hideEasing: "linear",
    //         showMethod: "fadeIn",
    //         hideMethod: "fadeOut"
    //     };

    //     // Display a notification
    //     toastr.success("Hello, world!", "Toastr Notification");
    //     </script>

    //     ';
  }

  /** Methode : telecharger l image de l artice **/
  public function upload_image($link_to_upload, $uploadFile)
  {
    $file = $uploadFile;
    $rand_numb = Yii::$app->simplelClass->generateUniq();
    if (isset($file) && sizeof($file) > 0) {

      $file_name = $file['name'];
      $file_size = $file['size'];
      $file_tmp = $file['tmp_name'];
      $file_type = $file['type'];
      $extCounter = explode('.', $file_name);

      $file_ext = end($extCounter);

      $file_uni_name = $rand_numb . $extCounter[0] . '.' . $file_ext;
      $expensions = array("jpeg", "jpg", "png");

      if (in_array($file_ext, $expensions) === false) {
        $rslt = 'error';
      }
      if ($file_size > '3000') {
        $rslt = 'error';
      }

      // if(empty($errors)==true)
      // {
      //Yii::getAlias(Yii::$app->basePath.$link_to_upload)
      $targetfolder = \Yii::getAlias(yii::$app->basePath . $link_to_upload);

      if (move_uploaded_file($file_tmp, $targetfolder . $file_uni_name)) {
        return $file_uni_name;
      }
      // }
      return;
    }
  }

  /** Methode : telecharger l image en utilisant  l'encodage 64**/
  public function upload_image64($link_to_upload, $uploadFile)
  {
    $file = $uploadFile;
    $rand_numb = Yii::$app->simplelClass->generateUniq();

    $file_uni_name = $rand_numb . '.jpg';
    $imageArray = explode(";", $file);
    $imageContents = explode(",", $imageArray[1]);

    $imagebase64 = base64_decode($imageContents[1]);
    // die(\var_dump($imagebase64));
    $tempPath = $link_to_upload . "" . $file_uni_name;
    $targetfolder = \Yii::getAlias(yii::$app->basePath . $tempPath);


    if (file_put_contents($targetfolder, $imagebase64)) {
      return $file_uni_name;
    }

    return;
  }

  // fonction de génération du code qr
  public function codeqr($lien)
  {
    $dataEncode = "
             *** Lien de verification ***%0A%0A
                $lien %0A
      ";
    $imgSize = "150x150";
    $url = "http://api.qrserver.com/v1/create-qr-code/?data=" . $dataEncode . "&size=" . $imgSize;
    return $url;
  }



  // fonction de génération du code qr
  public function codeqreleve($value, $classe)
  {
    $dataEncode = '
             *** PROFIL ELEVE***%0A%0A
             Nom : ' . $value['nom'] . ' ' . $value['prenom'] . '  %0A
            *** INFORMATION SUR L\'ETABLISSEMENT ***%0A%
              Nom de L\'ecole : G.S WAMY   %0A
              Tel:628540250%0A
              *** Info sur le Tuteur ***%0A%
              Nom : ' . $value['nomTuteur'] . ' ' . $value['prenomTuteur'] . '  %0A
              Adresse : ' . $value['adresse'] . ' %0A
              Tel : ' . $value['telTuteur'] . ' %0A

       ';
    $imgSize = "150x150";
    $url = "http://api.qrserver.com/v1/create-qr-code/?data=" . $dataEncode . "&size=" . $imgSize;
    return $url;
  }


  public function courbe($moy1, $moye2, $moyfinal)
  {
    // Créez une image vide de taille 600x400 pixels
    $image_width = 600;
    $image_height = 400;
    $image = imagecreatetruecolor($image_width, $image_height);

    // Couleurs
    $background_color = imagecolorallocate($image, 255, 255, 255); // Blanc (Rouge, Vert, Bleu)
    $line_color = imagecolorallocate($image, 0, 0, 255); // Bleu (Rouge, Vert, Bleu)
    $text_color = imagecolorallocate($image, 0, 0, 0); // Noir (Rouge, Vert, Bleu)

    // Remplissez l'arrière-plan en blanc
    imagefill($image, 0, 0, $background_color);

    // Données pour le graphique (à personnaliser)
    $categories = ["1erSem", "2emSem", "Moyenne"];
    $values = [$moy1, $moye2, $moyfinal];


    // Dimensions du graphique
    $width = $image_width;
    $height = $image_height;

    // Trouvez les valeurs maximales et minimales dans les données
    $max_value = max($values);
    $min_value = min($values);

    // Échelles pour les axes
    $x_scale = ($width - 40) / (count($categories) - 1);
    $y_scale = ($height - 40) / ($max_value - $min_value);

    // Dessinez l'axe des ordonnées (axe vertical)
    imageline($image, 30, 20, 30, $height - 20, $line_color);

    // Dessinez l'axe des abscisses (axe horizontal)
    imageline($image, 30, $height - 20, $width - 20, $height - 20, $line_color);

    // Dessinez les catégories
    for ($i = 0; $i < count($categories); $i++) {
      $x = 30 + ($i * $x_scale);
      $y = $height - 10;
      imagestring($image, 5, $x - 20, $y, $categories[$i], $text_color);
    }

    // Dessinez la courbe
    for ($i = 0; $i < count($values) - 1; $i++) {
      $x1 = 30 + ($i * $x_scale);
      $y1 = $height - 20 - ($values[$i] - $min_value) * $y_scale;
      $x2 = 30 + (($i + 1) * $x_scale);
      $y2 = $height - 20 - ($values[$i + 1] - $min_value) * $y_scale;
      imageline($image, $x1, $y1, $x2, $y2, $line_color);
    }

    // Créez un fichier image PNG pour sauvegarder le graphique
    $image_filename = 'graphique.png';

    // Enregistrez l'image dans un fichier
    imagepng($image, $image_filename);

    // Libérez la mémoire en détruisant l'image
    imagedestroy($image);


    // Ajouter l'image au PDF avec MPDF
    return $image_filename;
  }


  public function graphesecond($moy1, $moye2, $moyfinal)
  {


    // Créez une image vide de taille 600x400 pixels
    $image_width = 250;
    $image_height = 250;
    $image = imagecreatetruecolor($image_width, $image_height);

    // Couleurs
    $background_color = imagecolorallocatealpha($image, 255, 255, 255, 127); // Fond transparent (Rouge, Vert, Bleu, Transparence)
    $bar_color = imagecolorallocate($image, 49, 132, 155);
    $text_color = imagecolorallocate($image, 0, 0, 0);

    // Remplissez l'arrière-plan en blanc (facultatif)
    imagefill($image, 0, 0, $background_color);
    imagealphablending($image, false);
    imagesavealpha($image, true);

    // Données pour le graphique (à personnaliser)
    $categories = ["1erSem", "2emSem", "Moyenne"];
    $values = [$moy1, $moye2, $moyfinal];

    // Largeur et espacement des barres
    $bar_width = 20;
    $bar_spacing = 60;

    // Coordonnées de départ pour les barres, les libellés et les valeurs
    $x = 20;
    $y = 200;

    // Dessinez les barres, ajoutez les libellés et les valeurs
    for ($i = 0; $i < count($categories); $i++) {
      // Dessinez la barre
      $bar_height = $values[$i] * 10; // Vous pouvez ajuster la hauteur en fonction de vos données
      imagefilledrectangle($image, $x, $y - $bar_height, $x + $bar_width, $y, $bar_color);

      // Ajoutez le libellé de la catégorie
      $label_x = $x + ($bar_width / 2) - (strlen($categories[$i]) * 3);
      $label_y = $y + 10;
      imagestring($image, 5, $label_x, $label_y, $categories[$i], $text_color);

      // Ajoutez la valeur au-dessus de la barre
      $value_x = $x + ($bar_width / 2) - (strlen($values[$i]) * 4);
      $value_y = $y - $bar_height - 20;
      imagestring($image, 5, $value_x, $value_y, $values[$i], $text_color);

      // Ajustez les coordonnées pour la prochaine barre, libellé et valeur
      $x += $bar_width + $bar_spacing;
    }

    // Ajoutez un titre au graphique
    // $title_x = ($image_width - 200) / 2;
    // $title_y = 10;
    // imagestring($image, 5, $title_x, $title_y, "Exemple de Graphique", $text_color);


    // Créer un fichier temporaire pour l'image
    $image_filename = tempnam(sys_get_temp_dir(), 'graph_');
    imagepng($image, $image_filename);
    imagedestroy($image);

    // Ajouter l'image au PDF avec MPDF
    return $image_filename;
  }




  public function graphesecond2($moy1, $moye2, $moye3, $moyfinal)
  {


    // Créez une image vide de taille 600x400 pixels
    $image_width = 250;
    $image_height = 450;
    $image = imagecreatetruecolor($image_width, $image_height);

    // Couleurs
    $background_color = imagecolorallocatealpha($image, 255, 255, 255, 127); // Fond transparent (Rouge, Vert, Bleu, Transparence)
    $bar_color = imagecolorallocate($image, 49, 132, 155);
    $text_color = imagecolorallocate($image, 0, 0, 0);

    // Remplissez l'arrière-plan en blanc (facultatif)
    imagefill($image, 0, 0, $background_color);
    imagealphablending($image, false);
    imagesavealpha($image, true);

    // Données pour le graphique (à personnaliser)
    $categories = ["1erT", "2emT", "3emT", "Moyenne"];
    $values = [$moy1, $moye2, $moye3, $moyfinal];

    // Largeur et espacement des barres
    $bar_width = 20;
    $bar_spacing = 30;

    // Coordonnées de départ pour les barres, les libellés et les valeurs
    $x = 20;
    $y = 250;

    // Dessinez les barres, ajoutez les libellés et les valeurs
    for ($i = 0; $i < count($categories); $i++) {
      // Dessinez la barre
      $bar_height = $values[$i] * 10; // Vous pouvez ajuster la hauteur en fonction de vos données
      imagefilledrectangle($image, $x, $y - $bar_height, $x + $bar_width, $y, $bar_color);

      // Ajoutez le libellé de la catégorie
      $label_x = $x + ($bar_width / 2) - (strlen($categories[$i]) * 3);
      $label_y = $y + 10;
      imagestring($image, 5, $label_x, $label_y, $categories[$i], $text_color);

      // Ajoutez la valeur au-dessus de la barre
      $value_x = $x + ($bar_width / 2) - (strlen($values[$i]) * 4);
      $value_y = $y - $bar_height - 20;
      imagestring($image, 5, $value_x, $value_y, $values[$i], $text_color);

      // Ajustez les coordonnées pour la prochaine barre, libellé et valeur
      $x += $bar_width + $bar_spacing;
    }

    // Ajoutez un titre au graphique
    // $title_x = ($image_width - 200) / 2;
    // $title_y = 10;
    // imagestring($image, 5, $title_x, $title_y, "Exemple de Graphique", $text_color);


    // Créer un fichier temporaire pour l'image
    $image_filename = tempnam(sys_get_temp_dir(), 'graph_');
    imagepng($image, $image_filename);
    imagedestroy($image);

    // Ajouter l'image au PDF avec MPDF
    return $image_filename;
  }




  
  //CALCUL MOYENNE COMPOSITION
  public function moySemestreConcinelle($data, $typecompo)
  {


    // die(var_dump($data));
    if (sizeof($data) > 0) {
      $i = 0;
      $total = 0;
      $coef = 0;
      $matiere = 0;
      $compo = 0;
      $general = 0;
      foreach ($data as $key => $value) {
        //die(var_dump($value));
        $matiere = $matiere + ($value['Evalluation1'] * $value['coef']);
        $coef = $coef + $value['coef'];
        $compo = $compo + ($value['Evalluation2'] * $value['coef']);
        // $general = $general + ($value['moy'] * $value['coef']);
      }

      $totalCours = $matiere;
      $moyenneCours = round(($totalCours / $coef), 2);
      $moyennecompo = round(($compo / $coef), 2);

      if ($typecompo == '1') {
        $moyenneGeneral = round((($moyenneCours + $moyennecompo) / 2), 2);
      } else if ($typecompo == '2') {

        $moyenneGeneral = round((($moyenneCours + (2 * $moyennecompo)) / 3), 2);
      }
      // die(var_dump($totalCours ));
      //  die(var_dump(    $moyenneGeneral));
      return [
        'Totalcours' => $totalCours,
        'MoyenneCours' => $moyenneCours,
        'totalCompo' => $compo,
        'moyennecompo' => $moyennecompo,
        'moyenneGenerale' => $moyenneGeneral
      ];
    }
  }
}
