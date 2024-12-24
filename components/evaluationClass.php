<?php

namespace app\components;

use yii;
use yii\helpers\Html;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;


class evaluationClass extends  Component
{
  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }

  public function updatelanguage($libelle, $description, $etat, $codeclasse, $typelangage, $code)
  {
    // die( var_dump($composition));
    try {
      $query = $this->connect->createCommand("UPDATE dj_language SET libelle =:libelle,description=:descri,etat=:etat,codeclasse=:codeclasse,typelangage=:typelangage  WHERE code=:code
                                        ")
        ->bindValues([':libelle' => $libelle, ':descri' => $description, ':etat' => $etat, ':codeclasse' => $codeclasse, ':typelangage' => $typelangage, ':code' => $code])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  
  public function filtrelangage($codeetbs,$codeclasse,$langage)
  {
    // return $codeclasse;
    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_language WHERE codeetbs=:codeetbs 
         and (codeclasse like '%$codeclasse%' and typelangage like  '%$langage%' )")
        ->bindValue(':codeetbs', $codeetbs)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());

    }
  }



  public function infoclasse($codeclasse)
  {
    try {
      $query = $this->connect->createCommand("SELECT dj_matiere_classe.code as codelien, dj_matiere_classe.codeMatiere,dj_matiere.libelle,coef,dj_matiere_classe.code   from dj_matiere_classe,dj_matiere
                                            WHERE  dj_matiere_classe.codeMatiere = dj_matiere.code
                                            and dj_matiere_classe.codeClasse=:codeClasse")
        ->bindValue(':codeClasse', $codeclasse)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function infoEval($matricule, $codeEvaluation)
  {
    try {
      $query = $this->connect->createCommand("SELECT dj_evaluation.code as codeEva,dj_lien_eleve_note.note1,dj_lien_eleve_note.note2,dj_lien_eleve_note.note3,dj_lien_eleve_note.composition,dj_lien_eleve_note.matricule
                                           FROM dj_lien_eleve_note,dj_evaluation 
                                          WHERE dj_evaluation.code =dj_lien_eleve_note.codeEvaluation
                                          and dj_lien_eleve_note.matricule=:matricule
                                          AND dj_lien_eleve_note.codeEvaluation =:codeEvaluation")
        ->bindValues([':matricule' => $matricule, ':codeEvaluation' => $codeEvaluation])
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function infoEvalformatiere($matricule, $codeEvaluation)
  {
    try {
      $query = $this->connect->createCommand("SELECT dj_evaluation.code as codeEva,dj_lien_eleve_note.note1,dj_lien_eleve_note.note2,dj_lien_eleve_note.note3,dj_lien_eleve_note.composition,dj_lien_eleve_note.matricule
                                         FROM dj_lien_eleve_note,dj_evaluation 
                                        WHERE dj_evaluation.code =dj_lien_eleve_note.codeEvaluation
                                        and dj_lien_eleve_note.matricule=:matricule
                                        AND dj_lien_eleve_note.codeEvaluation =:codeEvaluation")
        ->bindValues([':matricule' => $matricule, ':codeEvaluation' => $codeEvaluation])
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function infoEvalmatricule($matricule, $codeMatiere, $periode, $codeAnnee)
  {
    try {
      $query = $this->connect->createCommand("SELECT dj_evaluation.code as codeEva,dj_lien_eleve_note.note1,dj_lien_eleve_note.note2,dj_lien_eleve_note.note3,dj_lien_eleve_note.composition,dj_lien_eleve_note.matricule
                                         FROM dj_lien_eleve_note,dj_evaluation 
                                        WHERE dj_evaluation.code =dj_lien_eleve_note.codeEvaluation
                                        and dj_lien_eleve_note.matricule=:matricule
                                        AND dj_evaluation.codeMatiere =:codeMatiere
                                        AND dj_evaluation.codeAnnee =:codeAnnee
                                        AND dj_evaluation.periode =:periode")
        ->bindValues([':codeAnnee' => $codeAnnee, ':matricule' => $matricule, ':codeMatiere' => $codeMatiere, ':periode' => $periode])
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }








  public function typeEva($codeclasse)
  {
    // return $codeclasse;
    try {
      $query = $this->connect->createCommand("SELECT typeCompo as typeEva FROM dj_classe,dj_niveau
                                        WHERE dj_niveau.code =dj_classe.codeNiveau
                                            and dj_classe.code =:codeClasse")
        ->bindValue(':codeClasse', $codeclasse)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      // die($th->getMessage());

    }
  }


  public function coef($matiere, $codeclasse)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_matiere_classe.coef  FROM dj_matiere_classe 
                                        WHERE dj_matiere_classe.codeMatiere=:matiere
                                        AND  dj_matiere_classe.codeClasse=:codeClasse")
        ->bindValues([':matiere' => $matiere, 'codeClasse' => $codeclasse])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      // die($th->getMessage());

    }
  }


  public function evalClasse($codeAnnee, $codeclasse, $periode)
  {

    try {
      $query = $this->connect->createCommand("SELECT *  from dj_evaluation 
                                  WHERE  dj_evaluation.codeAnnee=:codeAnnee 
                                  and  dj_evaluation.codeClasse =:codeClasse
                                  and  dj_evaluation.periode =:periode
                                  order by dj_evaluation.periode")
        ->bindValues([':codeAnnee' => $codeAnnee, ':codeClasse' => $codeclasse, ':periode' => $periode])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function inserteval($code, $periode, $codeMatiere, $date, $codeclasse, $codeAnnee, $sujet, $coef, $typeEval, $codeets)
  {

    try {
      $query = $this->connect->createCommand("INSERT INTO dj_evaluation( code, periode, codeMatiere, date, codeClasse, codeAnnee, sujet,coef,typeEval,codeetbs)
                                     VALUES(:code, :periode, :codeMatiere, :date, :codeClasse, :codeAnnee, :sujet,:coef,:typeEval,:codeetbs)")
        ->bindValues([':code' => $code, ':periode' => $periode, ':codeMatiere' => $codeMatiere, ':date' => $date, ':codeClasse' => $codeclasse, ':codeAnnee' => $codeAnnee, ':sujet' => $sujet, ':coef' => $coef, 'typeEval' => $typeEval, ':codeetbs' => $codeets])
        ->execute();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function suprimeeval($code)
  {

    try {
      $query = $this->connect->createCommand("DELETE FROM  dj_evaluation WHERE code=:code")
        ->bindValue(':code', $code)
        ->execute();
        $query = $this->connect->createCommand("DELETE FROM  dj_lien_eleve_note WHERE codeEvaluation=:code")
        ->bindValue(':code', $code)
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function insertNote($code, $matricule, $note, $note2, $note3, $codeEvaluation, $composition = 0)
  {
    // die(var_dump($composition));
    try {
      $query = $this->connect->createCommand("INSERT INTO dj_lien_eleve_note( code, matricule, note1,note2,note3, codeEvaluation,composition)
                                     VALUES(:code, :matricule, :note1,:note2,:note3, :codeEvaluation,:composition)")
        ->bindValues([':code' => $code, ':matricule' => $matricule, ':note1' => $note, ':note2' => $note2, ':note3' => $note3, ':codeEvaluation' => $codeEvaluation, ':composition' => $composition])
        ->execute();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }



  public function Updatenote($matricule, $composition, $codeEvaluation, $note, $note2, $note3)
  {
    // die( var_dump($composition));
    try {
      $query = $this->connect->createCommand("UPDATE dj_lien_eleve_note SET composition =:composition,note1=:note1,note2=:note2,note3=:note3  WHERE dj_lien_eleve_note.codeEvaluation=:codeEvaluation
                                          AND dj_lien_eleve_note.matricule=:matricule")
        ->bindValues([':composition' => $composition, ':matricule' => $matricule, ':codeEvaluation' => $codeEvaluation, ':note1' => $note, ':note2' => $note2, ':note3' => $note3])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function selectEval($codeAnnee)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_evaluation.code as codeEva ,dj_evaluation.codeClasse,dj_classe.libelle as classe ,dj_matiere.libelle as matiere,coef,dj_evaluation.periode,dj_evaluation.date
        FROM dj_evaluation,dj_classe,dj_matiere
        WHERE dj_evaluation.codeMatiere =dj_matiere.code
        and dj_evaluation.codeClasse =dj_classe.code
        AND dj_evaluation.codeAnnee =:codeAnnee
        order by dj_evaluation.id desc

            ")
        ->bindValue('codeAnnee', $codeAnnee)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      // die($th->getMessage());

    }
  }

  public function selectEvalforclasse($codeAnnee, $codeclasse)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_evaluation.code as codeEva ,dj_evaluation.codeClasse,dj_classe.libelle as classe ,dj_matiere.libelle as matiere,coef,dj_evaluation.periode,dj_evaluation.date
  FROM dj_evaluation,dj_classe,dj_matiere
  WHERE dj_evaluation.codeMatiere =dj_matiere.code
  and dj_evaluation.codeClasse =dj_classe.code
  and dj_evaluation.codeClasse =:codeclasse
  AND dj_evaluation.codeAnnee =:codeAnnee
  order by dj_evaluation.id desc

      ")
        ->bindValues(['codeAnnee' => $codeAnnee, ':codeclasse' => $codeclasse])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      // die($th->getMessage());

    }
  }



  public function selectEvalformatiere($codeAnnee, $codeclasse, $matiere)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_evaluation.code as codeEva ,dj_evaluation.codeClasse,dj_classe.libelle as classe ,dj_matiere.libelle as matiere,coef,dj_evaluation.periode,dj_evaluation.date
  FROM dj_evaluation,dj_classe,dj_matiere
  WHERE dj_evaluation.codeMatiere =dj_matiere.code
  and dj_evaluation.codeClasse =dj_classe.code
  and dj_evaluation.codeClasse =:codeclasse
  AND dj_evaluation.codeAnnee =:codeAnnee
  AND dj_evaluation.codeMatiere =:codeMatiere
  order by dj_evaluation.id desc

      ")
        ->bindValues(['codeAnnee' => $codeAnnee, ':codeclasse' => $codeclasse, ':codeMatiere' => $matiere])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      // die($th->getMessage());

    }
  }




  public function selectEvalforclassefrmatiere($codeAnnee, $codeclasse, $matiere)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_evaluation.code as codeEva ,dj_evaluation.codeClasse,dj_classe.libelle as classe ,dj_matiere.libelle as matiere,coef,dj_evaluation.periode,dj_evaluation.date
  FROM dj_evaluation,dj_classe,dj_matiere
  WHERE dj_evaluation.codeMatiere =dj_matiere.code
  and dj_evaluation.codeClasse =dj_classe.code
  and dj_evaluation.codeClasse =:codeclasse
  AND dj_evaluation.codeAnnee =:codeAnnee
  AND dj_evaluation.codeMatiere =:codeMatiere
  order by dj_evaluation.id desc

      ")
        ->bindValues(['codeAnnee' => $codeAnnee, ':codeclasse' => $codeclasse, ':codeMatiere' => $matiere])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      // die($th->getMessage());

    }
  }



  public function selecuniquetEval($codeEva)
  {

    try {
      $query = $this->connect->createCommand("SELECT dj_evaluation.code as codeEva ,dj_evaluation.codeClasse,dj_classe.libelle as classe ,dj_matiere.libelle as matiere,coef,dj_evaluation.periode,dj_evaluation.date
    FROM dj_evaluation,dj_classe,dj_matiere
    WHERE dj_evaluation.codeMatiere =dj_matiere.code
    and dj_evaluation.codeClasse =dj_classe.code
    AND dj_evaluation.code =:code")
        ->bindValue('code', $codeEva)
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      // die($th->getMessage());

    }
  }


  public function selectnote($codeEva, $matricule)
  {

    try {
      $query = $this->connect->createCommand("SELECT * FROM dj_lien_eleve_note WHERE dj_lien_eleve_note.codeEvaluation = :code 
            and dj_lien_eleve_note.matricule =:matricule")
        ->bindValues(['code' => $codeEva, ':matricule' => $matricule])
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      // die($th->getMessage());

    }
  }



  public function noteall($anneeActive, $classe, $typecompo)
  {



    $matiere = yii::$app->evaluationClass->infoclasse($classe['code']);
    $classe = yii::$app->configClass->infClasse($classe['code']);

    $O = 0;
    $donneNoteE = [];
    //CHARGER LA LISTE DE ELEVES
    $liste = yii::$app->eleveClass->listeclasse($anneeActive, $classe['code']);

    if (sizeof($liste) > 0) {

      foreach ($liste as $key => $info) {

        if (sizeof($matiere) > 0) {

          //DECLARATION DES VARIABLE DE SEM ET AUTRES
          $maximun = 0;
          $minimun = 0;
          $cours1 = 0;
          $comp1 = 0;
          $moyenneGen = 0;
          $cours2 = 0;
          $cours3 = 0;
          $comp2 = 0;
          $comp3 = 0;
          $moyenneGen2 = 0;
          $mgeneral = 0;
          $moyenneGen3 = 0;
          $totalsemestre1 = 0;
          $totalsemestre2 = 0;
          $totaltrim1 = 0;
          $totaltrim2 = 0;
          $totaltrim3 = 0;
          //moy/20
          $j = 0;
          $moyenneT1 = 0;
          $moyenneT2 = 0;
          $moyenne2 = 0;
          $moyenneT3 = null;
          $moyenne3 = 0;
          $moyenne1 = 0;
          $dataSem2 = null;
          $i = 0;
          $k = 0;
          $dataTrim1 = null;
          $dataMoy = 0;
          $dataTrim2 = null;
          $dataTrim3 = null;


          if ($typecompo == '1') {
            foreach ($matiere as $key => $value) {
              # code...
              // $data=null;



              $coef = yii::$app->simplelClass->maxmincoef($value['coef'], $classe['typeCompo']);
              $maximun = $maximun + $coef['0'];
              $minimun = $minimun + $coef['1'];

              $moy1 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], '1', $anneeActive);



              if ($moy1 == false) {
                $dataTrim1[$i] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                $i++;
              } else {
                $cours = 0;
                $cours = yii::$app->simplelClass->moyenne($moy1['note1'], $moy1['note2'], $moy1['note3'], '1');
                $cours1 = $cours1 + $cours;


                $comp1 = $comp1 +  $moy1['composition'];

                $dataTrim1[$i] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy1['composition'], 'moy' => round(($cours + $moy1['composition']) / 2, 2)];
                $i++;


                $moyenne1 = yii::$app->simplelClass->moyenneMoyennegenralTrim($cours, $moy1['composition']);

                $moyenneGen = $moyenneGen + $moyenne1;
                $totaltrim1 += $moyenne1;
              }

              $moyenne2 = 0;
              $moy2 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], '2', $anneeActive);


              if ($moy2 == false) {
                $dataTrim2[$j] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                $j++;
              } else {
                // $dataSem2[$i] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy['composition'] ,'moy' => round(($cours+2*$moy['composition'])/3,2)];

                $cours = 0;
                $cours = yii::$app->simplelClass->moyenne($moy2['note1'], $moy2['note2'], $moy2['note3'], '1');


                // die($cours);
                $cours2 = $cours2 + $cours;
                $comp2 = $moy2['composition'] + $comp2;

                $dataTrim2[$j] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy2['composition'], 'moy' => round(($cours + $moy2['composition']) / 2, 2)];
                $moyenne2 = yii::$app->simplelClass->moyenneMoyennegenral($cours, $moy2['composition']);
                $moyenneGen2 += $moyenne2;
                $totaltrim2 += $moyenne2;
                $j++;
              }

              $moyenne3 = 0;
              $moy3 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], '3', $anneeActive);

              // die(var_dump($moy3));

              if ($moy3 == false) {
                $dataTrim3[$k] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                $k++;
              } else {
                // $dataSem2[$i] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy['composition'] ,'moy' => round(($cours+2*$moy['composition'])/3,2)];

                $cours = 0;
                $cours = yii::$app->simplelClass->moyenne($moy3['note1'], $moy3['note2'], $moy3['note3'], '1');


                // die($cours);
                $cours3 = $cours3 + $cours;
                $comp3 = $moy3['composition'] + $comp3;

                $dataTrim3[$k] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy3['composition'], 'moy' => round(($cours + $moy3['composition']) / 2, 2)];
                $moyenne3 = yii::$app->simplelClass->moyenneMoyennegenralTrim($cours, $moy3['composition']);
                $moyenneGen3 += $moyenne3;
                $totaltrim3 += $moyenne3;
                $k++;
              }




              $mgeneralgeneral = ($moyenne1 + $moyenne2 + $moyenne3) / 3;

              $mgeneral += $mgeneralgeneral;

              // $mgeneralgeneral=  yii::$app->simplelClass->moySemestre($data);
              $dataMoy += $mgeneralgeneral;
            }
          }
          //DETERMON LES COEFICCIENTS DE CHAQUE MATERS
          if ($typecompo == '2') {
            foreach ($matiere as $key => $value) {
              # code...
              // $data=null;



              $coef = yii::$app->simplelClass->maxmincoef($value['coef'], $classe['typeCompo']);
              $maximun = $maximun + $coef['0'];
              $minimun = $minimun + $coef['1'];

              $moy = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], '4', $anneeActive);



              if ($moy == false) {
                $dataSem1[$i] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                $i++;
              } else {
                $cours = 0;

                $cours = yii::$app->simplelClass->moyenne($moy['note1'], $moy['note2'], $moy['note3'], '4');
                $cours1 = $cours1 + $cours;

                $comp1 = $comp1 +  $moy['composition'];
                $dataSem1[$i] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy['composition'], 'moy' => round(($cours + 2 * $moy['composition']) / 3, 2)];
                $i++;
                $moyenne1 = yii::$app->simplelClass->moyenneMoyennegenral($cours, $moy['composition']);
                $moyenneGen = $moyenneGen + $moyenne1;
                $totalsemestre1 += $moyenne1;
              }
              $moyenne2 = 0;
              $moy2 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], '5', $anneeActive);

              if ($moy2 == false) {
                $dataSem2[$j] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                $j++;
              } else {
                $dataSem2[$i] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy['composition'], 'moy' => round(($cours + 2 * $moy['composition']) / 3, 2)];

                $cours = 0;
                if ($classe['typeCompo'] == 1) {
                  $cours = yii::$app->simplelClass->moyenne($moy2['note1'], $moy2['note2'], $moy2['note3'], '1');
                } else if ($classe['typeCompo'] == 2) {

                  $cours = yii::$app->simplelClass->moyenne($moy2['note1'], $moy2['note2'], $moy2['note3'], '4');
                }
                // die($cours);
                $cours2 = $cours2 + $cours;
                $comp2 = $moy2['composition'] + $comp2;

                $dataSem2[$j] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy2['composition'], 'moy' => round(($cours + 2 * $moy2['composition']) / 3, 2)];
                $moyenne2 = yii::$app->simplelClass->moyenneMoyennegenral($cours, $moy2['composition']);
                $moyenneGen2 += $moyenne2;
                $totalsemestre2 += $moyenne2;
                $j++;
              }

              $mgeneralgeneral = ($moyenne1 + $moyenne2) / 2;

              $mgeneral += $mgeneralgeneral;
              // $mgeneralgeneral=  yii::$app->simplelClass->moySemestre($data);
              $dataMoy += $mgeneralgeneral;
            }
          }

          if ($classe['typeCompo'] == 1) {
            $moyenneT1 =  yii::$app->simplelClass->moySemestre($dataTrim1, '1');
            $moyenneT2 =  yii::$app->simplelClass->moySemestre($dataTrim2, '1');
            $moyenneT3 =  yii::$app->simplelClass->moySemestre($dataTrim3, '1');
            $moygen3 = $moyenneT3['moyenneGenerale'];
            $moyfinal = ($moyenneT1['moyenneGenerale'] + $moyenneT2['moyenneGenerale'] + $moyenneT3['moyenneGenerale']) / 3;
          } else {

            $moyenneT1 =  yii::$app->simplelClass->moySemestre($dataSem1, '2');
            $moyenneT2 =  yii::$app->simplelClass->moySemestre($dataSem2, '2');
            $moygen3 = 0;
            $moyfinal = ($moyenneT1['moyenneGenerale'] + $moyenneT2['moyenneGenerale']) / 2;
          }
          $donneNoteE[$O] = [
            'code' => $info['codeEleve'],
            'Moye1' => $moyenneT1['moyenneGenerale'],
            'Moye2' => $moyenneT2['moyenneGenerale'],
            'Moye3' => $moygen3,
            'moyfinal' => $moyfinal
          ];
          $O++;
        }
      }
    }
    return $donneNoteE;
  }

  public function noteallbystatitque($annee, $classe, $periode)
  {


    $anneeActive  = yii::$app->mainCLass->getAnneeActive();

    $moyenneminmax = null;
    $z = 0;
    $mentionT = '';
    $matiere = yii::$app->evaluationClass->infoclasse($classe);
    $classe = yii::$app->configClass->infClasse($classe);
    $oncompose = 0;
    $nomcomposer = 0;
    $oncomposefile = 0;
    $nomcomposerfile = 0;
    $moyennepourcent = 0;
    $admis = 0;
    $nonadmis = 0;
    $admisfille = 0;

    $O = 0;
    $donneNoteE = [];
    //CHARGER LA LISTE DE ELEVES
    $liste = yii::$app->eleveClass->listeclasse($anneeActive, $classe['code']);
    $totaleleve = sizeof($liste);
    $totalfille = yii::$app->eleveClass->actionclassewomwne($classe['code']);

    if (sizeof($liste) > 0) {
      foreach ($liste as $key => $info) {
        if (sizeof($matiere) > 0) {

          //DECLARATION DES VARIABLE DE SEM ET AUTRES
          $maximun = 0;
          $minimun = 0;
          $cours1 = 0;
          $comp1 = 0;
          $moyenneGen = 0;
          $cours2 = 0;
          $comp2 = 0;
          $moyenneGen2 = 0;
          $mgeneral = 0;
          $moyenneGen3 = 0;
          $totalsemestre1 = 0;
          $totalsemestre2 = 0;
          $totaltrim1 = 0;
          $totaltrim2 = 0;
          $totaltrim3 = 0;
          //moy/20
          $j = 0;
          $moyenneT1 = 0;
          $moyenneT2 = 0;
          $moyenne2 = 0;
          $moyenneT3 = null;
          $moyenne3 = 0;
          $moyenne1 = 0;
          $dataSem2 = null;
          $i = 0;
          $k = 0;
          $dataTrim1 = null;
          $dataMoy = 0;
          $dataTrim2 = null;
          $dataTrim3 = null;



          foreach ($matiere as $key => $value) {
            $moy1 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], $periode, $anneeActive);


            if ($moy1 == false) {
              $dataTrim1[$i] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];

              $i++;
            } else {
              $cours = 0;
              $cours = yii::$app->simplelClass->moyenne($moy1['note1'], $moy1['note2'], $moy1['note3'], $periode);
              $cours1 = $cours1 + $cours;


              $comp1 = $comp1 +  $moy1['composition'];
              if ($periode < 4) {
                $dataTrim1[$i] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy1['composition'], 'moy' => round(($cours + $moy1['composition']) / 2, 2)];
              } else {
                $dataTrim1[$i] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy1['composition'], 'moy' => round(($cours + 2 * $moy1['composition']) / 3, 2)];
              }

              $i++;


              $moyenne1 = yii::$app->simplelClass->moyenneMoyennegenralTrim($cours, $moy1['composition']);

              $moyenneGen = $moyenneGen + $moyenne1;
              $totaltrim1 += $moyenne1;
            }
          }
        }




        if ($periode < 4) {
          $moyenneT1 =  yii::$app->simplelClass->moySemestre($dataTrim1, '1');
          $mention = yii::$app->simplelClass->mentionTrimestre($moyenneT1['moyenneGenerale']);

          if ($moyenneT1['moyenneGenerale'] >= 5) {
            $admis++;
          } else {
            $nonadmis++;
          }

          if ($moyenneT1['moyenneGenerale'] >= 5 && $info['genre'] == 2) {
            $admisfille++;
          }
        } else {

          $moyenneT1 =  yii::$app->simplelClass->moySemestre($dataTrim1, '2');
          $mention = yii::$app->simplelClass->mentionSecondaire($moyenneT1['moyenneGenerale']);

          if ($moyenneT1['moyenneGenerale'] >= 10) {
            $admis++;
          } else {
            $nonadmis++;
          }

          if ($moyenneT1['moyenneGenerale'] >= 10 && $info['genre'] == 2) {
            $admisfille++;
          }
        }


        //  die(var_dump($moyenneT1));


        if ($moyenneT1['moyennecompo'] == 0 && $info['genre'] == 2) {
          $nomcomposerfile++;
        } else if ($moyenneT1['moyennecompo'] != 0 && $info['genre'] == 2) {
          $oncomposefile++;
        }

        if ($moyenneT1['moyennecompo'] == 0) {
          $nomcomposer++;
        } else {
          $oncompose++;
        }
        $moyenneminmax[$z] = $moyenneT1['moyenneGenerale'];
        $z++;

        $donneNoteE[$O] = [
          'code' => $info['codeEleve'],
          'Moye1' => $moyenneT1['moyenneGenerale'],
          'Nom Complet' => $info['nom'] . ' ' . $info['prenom'],
          'photo' => $info['photo'],
          'mention' => $mention

        ];
        $O++;
      }
    }


    $max1 = max($moyenneminmax);
    $min1 = min($moyenneminmax);
    if ($oncompose > 0) {
      $moyennepourcent = (($admis * 100) / $oncompose);
    } else {
      $moyennepourcent = 0;
    }
    $moyenneclasse = round(($max1 + $min1) / 2, 2);
    if ($periode < 4) {
      $mentionT = yii::$app->simplelClass->mentionTrimestre($moyenneclasse);
    } else {

      $mentionT = yii::$app->simplelClass->mentionSecondaire($moyenneclasse);
    }
    // die(var_dump($moyenneminmax));
    array_multisort($moyenneminmax, SORT_DESC, $liste, SORT_ASC, $donneNoteE);

    return [
      'dataeleve' => $donneNoteE,
      'moyennepourcent' => $moyennepourcent,
      'moyenneclasse' => $moyenneclasse,
      'totalclasse' => $totaleleve,
      'totalfille' => $totalfille,
      'totalcompose' => $oncompose,
      'totalcomposefille' => $oncomposefile,
      'onmoyenne' => $admis,
      'moyennefille' => $admisfille,
      'moyenneclasse' => $moyenneclasse,
      'mention' => $mentionT,
    ];
  }





  public function rang($noteAllElve, $code)
  {
    $i = 0;
    $moyenne1 = null;
    $moyenne3 = null;
    $totaleleve = sizeof($noteAllElve);
    foreach ($noteAllElve as $key => $value) {
      $eleve[$i] = $value['code'];
      $moyenne1[$i] = $value['Moye1'];
      $moyenne2[$i] = $value['Moye2'];
      $moyenne3[$i] = $value['Moye2'];
      $moyfinal[$i] = $value['moyfinal'];
      $i++;
    }


    array_multisort($moyenne1, SORT_DESC, $eleve, SORT_ASC, $noteAllElve);
    $j = 1;
    foreach ($noteAllElve as $key => $value) {
      if ($code == $value['code']) {
        $rang1 = $j . " eme/" . $totaleleve . " Elèves";

        if ($j == 1) {
          $rang1 = $j . " er/" . $totaleleve . " Elèves";
        }
      }
      $j++;
      //  var_dump($value['moyfinal']);

    }

    //2eme trimestre
    array_multisort($moyenne2, SORT_DESC, $eleve, SORT_ASC, $noteAllElve);
    // die(var_dump($noteAllElve));
    $j = 1;
    foreach ($noteAllElve as $key => $value) {

      if ($code == $value['code']) {
        $rang2 = $j . " eme/" . $totaleleve . " Elèves";

        if ($j == 1) {
          $rang2 = $j . " er/ " . $totaleleve . " Elèves";
        }
      }
      $j++;
      //  var_dump($value['moyfinal']);

    }


    //2eme trimestre
    array_multisort($moyenne3, SORT_DESC, $eleve, SORT_ASC, $noteAllElve);
    $j = 1;
    foreach ($noteAllElve as $key => $value) {

      if ($code == $value['code']) {
        $rang3 = $j . " eme/" . $totaleleve . " Elèves";

        if ($j == 1) {
          $rang3 = $j . " er/ " . $totaleleve . " Elèves";
        }
      }
      $j++;
      //  var_dump($value['moyfinal']);

    }


    //2eme trimestre
    array_multisort($moyfinal, SORT_DESC, $eleve, SORT_ASC, $noteAllElve);
    // die(var_dump($noteAllElve));
    $j = 1;
    foreach ($noteAllElve as $key => $value) {
      if ($code == $value['code']) {
        $rangfinal = $j . " eme/ " . $totaleleve . " Elèves";

        if ($j == 1) {
          $rangfinal = $j . " er/" . $totaleleve . " Elèves";
        }
      }
      $j++;
      //  var_dump($value['moyfinal']);

    }

    $max1 = max($moyenne1);
    $min1 = min($moyenne1);
    $max2 = max($moyenne2);
    $min2 = min($moyenne2);
    $max3 = max($moyenne3);
    $min3 = min($moyenne3);
    $maxfinal = max($moyfinal);
    $minfinal = min($moyfinal);
    //  die(var_dump($maxfinal));
    return [
      'rang1' => $rang1,
      'rang2' => $rang2,
      'rang3' => $rang3,
      'rangfinal' => $rangfinal,
      'max1' => $max1,
      'min1' => $min1,
      'max2' => $max2,
      'min2' => $min2,
      'max3' => $max3,
      'min3' => $min3,
      'maxfinal' => $maxfinal,
      'minfinal' => $minfinal,

    ];
  }



  public function noteallbyfinalstatistique($anneeActive, $classe, $typecompo)
  {

    $moyenneminmax = null;
    $z = 0;
    $mentionT = '';
    $oncompose = 0;
    $nomcomposer = 0;
    $oncomposefile = 0;
    $nomcomposerfile = 0;
    $moyennepourcent = 0;
    $admis = 0;
    $nonadmis = 0;
    $admisfille = 0;

    $matiere = yii::$app->evaluationClass->infoclasse($classe);

    $classe = yii::$app->configClass->infClasse($classe);

    $O = 0;
    $donneNoteE = [];
    //CHARGER LA LISTE DE ELEVES
    $liste = yii::$app->eleveClass->listeclasse($anneeActive, $classe['code']);
    $totaleleve = sizeof($liste);
    $totalfille = yii::$app->eleveClass->actionclassewomwne($classe['code']);

    if (sizeof($liste) > 0) {

      foreach ($liste as $key => $info) {

        if (sizeof($matiere) > 0) {

          //DECLARATION DES VARIABLE DE SEM ET AUTRES
          $maximun = 0;
          $minimun = 0;
          $cours1 = 0;
          $comp1 = 0;
          $moyenneGen = 0;
          $cours2 = 0;
          $cours3 = 0;
          $comp2 = 0;
          $comp3 = 0;
          $moyenneGen2 = 0;
          $mgeneral = 0;
          $moyenneGen3 = 0;
          $totalsemestre1 = 0;
          $totalsemestre2 = 0;
          $totaltrim1 = 0;
          $totaltrim2 = 0;
          $totaltrim3 = 0;
          //moy/20
          $j = 0;
          $moyenneT1 = 0;
          $moyenneT2 = 0;
          $moyenne2 = 0;
          $moyenneT3 = null;
          $moyenne3 = 0;
          $moyenne1 = 0;
          $dataSem2 = null;
          $i = 0;
          $k = 0;
          $dataTrim1 = null;
          $dataMoy = 0;
          $dataTrim2 = null;
          $dataTrim3 = null;


          if ($typecompo == '1') {
            foreach ($matiere as $key => $value) {
              # code...
              // $data=null;




              $coef = yii::$app->simplelClass->maxmincoef($value['coef'], $classe['typeCompo']);
              $maximun = $maximun + $coef['0'];
              $minimun = $minimun + $coef['1'];

              $moy1 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], '1', $anneeActive);


              if ($moy1 == false) {
                $dataTrim1[$i] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                $i++;
              } else {
                $cours = 0;
                $cours = yii::$app->simplelClass->moyenne($moy1['note1'], $moy1['note2'], $moy1['note3'], '1');
                $cours1 = $cours1 + $cours;


                $comp1 = $comp1 +  $moy1['composition'];

                $dataTrim1[$i] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy1['composition'], 'moy' => round(($cours + $moy1['composition']) / 2, 2)];
                $i++;


                $moyenne1 = yii::$app->simplelClass->moyenneMoyennegenralTrim($cours, $moy1['composition']);

                $moyenneGen = $moyenneGen + $moyenne1;
                $totaltrim1 += $moyenne1;
              }

              $moyenne2 = 0;
              $moy2 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], '2', $anneeActive);


              if ($moy2 == false) {
                $dataTrim2[$j] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                $j++;
              } else {
                // $dataSem2[$i] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy['composition'] ,'moy' => round(($cours+2*$moy['composition'])/3,2)];

                $cours = 0;
                $cours = yii::$app->simplelClass->moyenne($moy2['note1'], $moy2['note2'], $moy2['note3'], '1');


                // die($cours);
                $cours2 = $cours2 + $cours;
                $comp2 = $moy2['composition'] + $comp2;

                $dataTrim2[$j] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy2['composition'], 'moy' => round(($cours + $moy2['composition']) / 2, 2)];
                $moyenne2 = yii::$app->simplelClass->moyenneMoyennegenral($cours, $moy2['composition']);
                $moyenneGen2 += $moyenne2;
                $totaltrim2 += $moyenne2;
                $j++;
              }

              $moyenne3 = 0;
              $moy3 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], '3', $anneeActive);

              // die(var_dump($moy3));

              if ($moy3 == false) {
                $dataTrim3[$k] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                $k++;
              } else {
                // $dataSem2[$i] =['cours'=>  $cours ,'coef'=>$value['coef'] ,'compo'=>$moy['composition'] ,'moy' => round(($cours+2*$moy['composition'])/3,2)];

                $cours = 0;
                $cours = yii::$app->simplelClass->moyenne($moy3['note1'], $moy3['note2'], $moy3['note3'], '1');


                // die($cours);
                $cours3 = $cours3 + $cours;
                $comp3 = $moy3['composition'] + $comp3;

                $dataTrim3[$k] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy3['composition'], 'moy' => round(($cours + $moy3['composition']) / 2, 2)];
                $moyenne3 = yii::$app->simplelClass->moyenneMoyennegenralTrim($cours, $moy3['composition']);
                $moyenneGen3 += $moyenne3;
                $totaltrim3 += $moyenne3;
                $k++;
              }




              $mgeneralgeneral = ($moyenne1 + $moyenne2 + $moyenne3) / 3;

              $mgeneral += $mgeneralgeneral;

              // $mgeneralgeneral=  yii::$app->simplelClass->moySemestre($data);
              $dataMoy += $mgeneralgeneral;
            }
          }

          //DETERMON LES COEFICCIENTS DE CHAQUE MATERS
          if ($typecompo == '2') {
            foreach ($matiere as $key => $value) {
              # code...
              // $data=null;



              $coef = yii::$app->simplelClass->maxmincoef($value['coef'], $classe['typeCompo']);
              $maximun = $maximun + $coef['0'];
              $minimun = $minimun + $coef['1'];

              $moy = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], '4', $anneeActive);



              if ($moy == false) {
                $dataSem1[$i] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                $i++;
              } else {
                $cours = 0;

                $cours = yii::$app->simplelClass->moyenne($moy['note1'], $moy['note2'], $moy['note3'], '4');
                $cours1 = $cours1 + $cours;

                $comp1 = $comp1 +  $moy['composition'];
                $dataSem1[$i] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy['composition'], 'moy' => round(($cours + 2 * $moy['composition']) / 3, 2)];
                $i++;
                $moyenne1 = yii::$app->simplelClass->moyenneMoyennegenral($cours, $moy['composition']);
                $moyenneGen = $moyenneGen + $moyenne1;
                $totalsemestre1 += $moyenne1;
              }
              $moyenne2 = 0;
              $moy2 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], '5', $anneeActive);

              if ($moy2 == false) {
                $dataSem2[$j] = ['cours' =>  0, 'coef' => $value['coef'], 'compo' => 0, 'moy' => 0];
                $j++;
              } else {
                $dataSem2[$i] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy['composition'], 'moy' => round(($cours + 2 * $moy['composition']) / 3, 2)];

                $cours = 0;
                if ($classe['typeCompo'] == 1) {
                  $cours = yii::$app->simplelClass->moyenne($moy2['note1'], $moy2['note2'], $moy2['note3'], '1');
                } else if ($classe['typeCompo'] == 2) {

                  $cours = yii::$app->simplelClass->moyenne($moy2['note1'], $moy2['note2'], $moy2['note3'], '4');
                }
                // die($cours);
                $cours2 = $cours2 + $cours;
                $comp2 = $moy2['composition'] + $comp2;

                $dataSem2[$j] = ['cours' =>  $cours, 'coef' => $value['coef'], 'compo' => $moy2['composition'], 'moy' => round(($cours + 2 * $moy2['composition']) / 3, 2)];
                $moyenne2 = yii::$app->simplelClass->moyenneMoyennegenral($cours, $moy2['composition']);
                $moyenneGen2 += $moyenne2;
                $totalsemestre2 += $moyenne2;
                $j++;
              }

              $mgeneralgeneral = ($moyenne1 + $moyenne2) / 2;

              $mgeneral += $mgeneralgeneral;
              // $mgeneralgeneral=  yii::$app->simplelClass->moySemestre($data);
              $dataMoy += $mgeneralgeneral;
            }
          }

          if ($classe['typeCompo'] == 1) {
            $moyenneT1 =  yii::$app->simplelClass->moySemestre($dataTrim1, '1');
            $moyenneT2 =  yii::$app->simplelClass->moySemestre($dataTrim2, '1');
            $moyenneT3 =  yii::$app->simplelClass->moySemestre($dataTrim3, '1');
            $moygen3 = $moyenneT3['moyenneGenerale'];
            $moyfinal = ($moyenneT1['moyenneGenerale'] + $moyenneT2['moyenneGenerale'] + $moyenneT3['moyenneGenerale']) / 3;
            if ($moyfinal >= 5) {
              $admis++;
            } else {
              $nonadmis++;
            }

            if ($moyfinal >= 5 && $info['genre'] == 2) {
              $admisfille++;
            }
          } else {

            $moyenneT1 =  yii::$app->simplelClass->moySemestre($dataSem1, '2');
            $moyenneT2 =  yii::$app->simplelClass->moySemestre($dataSem2, '2');
            $moygen3 = 0;
            $moyfinal = ($moyenneT1['moyenneGenerale'] + $moyenneT2['moyenneGenerale']) / 2;


            if ($moyfinal >= 10) {
              $admis++;
            } else {
              $nonadmis++;
            }

            if ($moyfinal >= 10 && $info['genre'] == 2) {
              $admisfille++;
            }
          }

          $moyenneminmax[$z] = $moyfinal;
          $z++;

          $donneNoteE[$O] = [
            'code' => $info['codeEleve'],
            'Moye1' => $moyenneT1['moyenneGenerale'],
            'Moye2' => $moyenneT2['moyenneGenerale'],
            'Moye3' => $moygen3,
            'moyfinal' => $moyfinal
          ];
          $O++;
        }
      }
    }

    $max1 = max($moyenneminmax);
    $min1 = min($moyenneminmax);
    if ($totaleleve > 0) {
      $moyennepourcent = (($admis * 100) / $totaleleve);
    } else {
      $moyennepourcent = 0;
    }
    $moyenneclasse = round(($max1 + $min1) / 2, 2);
    if ($classe['typeCompo'] == 1) {
      $mentionT = yii::$app->simplelClass->mentionTrimestre($moyenneclasse);
    } else {

      $mentionT = yii::$app->simplelClass->mentionSecondaire($moyenneclasse);
    }
    // die(var_dump($moyenneminmax));
    array_multisort($moyenneminmax, SORT_DESC, $liste, SORT_ASC, $donneNoteE);

    return [
      'dataeleve' => $donneNoteE,
      'moyennepourcent' => $moyennepourcent,
      'moyenneclasse' => $moyenneclasse,
      'totalclasse' => $totaleleve,
      'totalfille' => $totalfille,
      'onmoyenne' => $admis,
      'moyennefille' => $admisfille,
      'moyenneclasse' => $moyenneclasse,
      'mention' => $mentionT,
    ];
  }








  public function noteallbystatitqueconcinelle($annee, $classe, $periode)
  {

    $anneeActive  = yii::$app->mainCLass->getAnneeActive();

    $moyenneminmax = null;
    $z = 0;
    $mentionT = '';
    $matiere = yii::$app->evaluationClass->infoclasse($classe);
    $classe = yii::$app->configClass->infClasse($classe);
    $oncompose = 0;
    $nomcomposer = 0;
    $oncomposefile = 0;
    $nomcomposerfile = 0;
    $moyennepourcent = 0;
    $admis = 0;
    $nonadmis = 0;
    $admisfille = 0;

    $O = 0;
    $donneNoteE = [];
    //CHARGER LA LISTE DE ELEVES
    $liste = yii::$app->eleveClass->listeclasse($anneeActive, $classe['code']);
    $totaleleve = sizeof($liste);
    $totalfille = yii::$app->eleveClass->actionclassewomwne($classe['code']);

    if (sizeof($liste) > 0) {
      foreach ($liste as $key => $info) {
        if (sizeof($matiere) > 0) {

          //DECLARATION DES VARIABLE DE SEM ET AUTRES
          $maximun = 0;
          $minimun = 0;
          $cours1 = 0;
          $comp1 = 0;
          $moyenneGen = 0;
          $cours2 = 0;
          $comp2 = 0;
          $moyenneGen2 = 0;
          $mgeneral = 0;
          $moyenneGen3 = 0;
          $totalsemestre1 = 0;
          $totalsemestre2 = 0;
          $totaltrim1 = 0;
          $totaltrim2 = 0;
          $totaltrim3 = 0;
          //moy/20
          $j = 0;
          $moyenneT1 = 0;
          $moyenneT2 = 0;
          $moyenne2 = 0;
          $moyenneT3 = null;
          $moyenne3 = 0;
          $moyenne1 = 0;
          $dataSem2 = null;
          $i = 0;
          $k = 0;
          $dataTrim1 = null;
          $dataMoy = 0;
          $dataTrim2 = null;
          $dataTrim3 = null;



          foreach ($matiere as $key => $value) {
            $moy1 = yii::$app->evaluationClass->infoEvalmatricule($info['matricule'], $value['codeMatiere'], $periode, $anneeActive);


            if ($moy1 == false) {
              $dataTrim1[$i] = ['Evalluation1' => 0, 'coef' => $value['coef'], 'Evalluation2' => 0, 'moy' => 0];


              $i++;
            } else {
              $cours = 0;
              $cours = $moy1['note1'];
              $cours1 = $cours1 + $cours;


              $comp1 = $comp1 +  $moy1['note2'];
              if ($periode < 4) {
                $dataTrim1[$i] = ['Evalluation1' =>  $cours, 'coef' => $value['coef'], 'Evalluation2' => $moy1['note2'], 'moy' => round(($cours + $moy1['composition']) / 2, 2)];
              } else {
                $dataTrim1[$i] = ['Evalluation1' =>  $cours, 'coef' => $value['coef'], 'Evalluation2' => $moy1['composition'], 'moy' => round(($cours + 2 * $moy1['composition']) / 3, 2)];
              }

              $i++;


              $moyenne1 = yii::$app->simplelClass->moyenneMoyennegenralTrim($moy1['note1'], $moy1['note2']);
              $moyenneGen = $moyenneGen + $moyenne1;
              $totaltrim1 += $moyenne1;
            }
          }
        }




        if ($periode < 4) {
          $moyenneT1 =  yii::$app->simplelClass->moySemestreConcinelle($dataTrim1, '1');
          $mention = yii::$app->simplelClass->mentionTrimestre($moyenneT1['moyenneGenerale']);

          if ($moyenneT1['moyenneGenerale'] >= 5) {
            $admis++;
          } else {
            $nonadmis++;
          }

          if ($moyenneT1['moyenneGenerale'] >= 5 && $info['genre'] == 2) {
            $admisfille++;
          }
        } else {

          $moyenneT1 =  yii::$app->simplelClass->moySemestreConcinelle($dataTrim1, '2');
          $mention = yii::$app->simplelClass->mentionSecondaire($moyenneT1['moyenneGenerale']);

          if ($moyenneT1['moyenneGenerale'] >= 10) {
            $admis++;
          } else {
            $nonadmis++;
          }

          if ($moyenneT1['moyenneGenerale'] >= 10 && $info['genre'] == 2) {
            $admisfille++;
          }
        }


        //  die(var_dump($moyenneT1));


        if ($moyenneT1['moyennecompo'] == 0 && $info['genre'] == 2) {
          $nomcomposerfile++;
        } else if ($moyenneT1['moyennecompo'] != 0 && $info['genre'] == 2) {
          $oncomposefile++;
        }

        if ($moyenneT1['moyennecompo'] == 0) {
          $nomcomposer++;
        } else {
          $oncompose++;
        }
        $moyenneminmax[$z] = $moyenneT1['moyenneGenerale'];
        $z++;

        $donneNoteE[$O] = [
          'code' => $info['codeEleve'],
          'Moye1' => $moyenneT1['moyenneGenerale'],
          'Nom Complet' => $info['nom'] . ' ' . $info['prenom'],
          'photo' => $info['photo'],
          'mention' => $mention

        ];
        $O++;
      }
    }


    $max1 = max($moyenneminmax);
    $min1 = min($moyenneminmax);
    if ($oncompose > 0) {
      $moyennepourcent = (($admis * 100) / $oncompose);
    } else {
      $moyennepourcent = 0;
    }
    $moyenneclasse = round(($max1 + $min1) / 2, 2);
    if ($periode < 4) {
      $mentionT = yii::$app->simplelClass->mentionTrimestre($moyenneclasse);
    } else {

      $mentionT = yii::$app->simplelClass->mentionSecondaire($moyenneclasse);
    }
    // die(var_dump($moyenneminmax));
    array_multisort($moyenneminmax, SORT_DESC, $liste, SORT_ASC, $donneNoteE);

    return [
      'dataeleve' => $donneNoteE,
      'moyennepourcent' => $moyennepourcent,
      'moyenneclasse' => $moyenneclasse,
      'totalclasse' => $totaleleve,
      'totalfille' => $totalfille,
      'totalcompose' => $oncompose,
      'totalcomposefille' => $oncomposefile,
      'onmoyenne' => $admis,
      'moyennefille' => $admisfille,
      'moyenneclasse' => $moyenneclasse,
      'mention' => $mentionT,
    ];
  }
}
