<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
  'id' => 'basic',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'language' => $_SESSION['lang'],

  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm'   => '@vendor/npm-asset',
  ],
  'components' => [
    'request' => [
      // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => 'bg@@@ygf@@jeune@@codeurs@@bangaly',
    ],

    'simplelClass' => [
      'class' => 'app\components\simplelClass', // CLass pour les fichiers
    ],

    'menuactionClass' => [
      'class' => 'app\components\menuactionClass', // CLass pour les fichiers
    ],


    'personnelClass' => [
      'class' => 'app\components\personnelClass', // CLass pour les fichiers
    ],


    'mainCLass' => [
      'class' => 'app\components\mainClass', //class pour les configurations
    ],

    'eloquantClass' => [
      'class' => 'app\components\eloquantClass', //class pour les configurations
    ],

    'importClass' => [
      'class' => 'app\components\importClass', //class pour les configurations
    ],

    'evaluationClass' => [
      'class' => 'app\components\evaluationClass', //class pour les configurations
    ],

    'configClass' => [
      'class' => 'app\components\configClass', //class pour les configurations
    ],
    'comptabiliteClass' => [
      'class' => 'app\components\comptabiliteClass', //class pour les configurations
    ],


    'accessClass' => [
      'class' => 'app\components\accessClass', //class pour les configurations
    ],

    'cryptoClass' => [
      'class' => 'app\components\cryptoClass', //class pour les configurations
    ],

    'eleveClass' => [
      'class' => 'app\components\eleveClass', //class pour les configurations
    ],

    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    'user' => [
      'identityClass' => 'app\models\User',
      'enableAutoLogin' => true,
    ],
    'errorHandler' => [
      'errorAction' => 'site/error',
    ],
    'mailer' => [
      'class' => \yii\symfonymailer\Mailer::class,
      'viewPath' => '@app/mail',
      // send all mails to a file by default.
      'useFileTransport' => true,
    ],
    'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => ['error', 'warning'],
        ],
      ],
    ],
    'db' => $db,

    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
        '' => 'site/login',
        'login' => 'site/login',
        md5('login') => 'site/login',
        md5('visiteur_index') => 'visiteur/index',
        md5('site_login') => 'site/login',
        md5('site_profil') => 'site/profil',
        md5('site_index') => 'site/index',

        md5('tb_admin') => 'tb/admin',
        md5('tb_statistique') => 'tb/statistique',

        md5('admin_prof') => 'admin/prof',
        md5('tb_prof') => 'tb/prof',
        md5('tb_comptable') => 'tb/comptable',


        md5('site_deconnecter') => 'site/deconnecter',
        md5('visiteur_apropos') => 'visiteur/apropos',
        md5('visiteur_contacte') => 'visiteur/contacte',
        md5('visiteur_validebuletin') . '/<codeE:\w+>' . '/<codeA:\w+>' => 'visiteur/validebuletin',
        md5('site_statistique') => 'site/statistique',
        md5('visiteur_profil') . '/<code:\w+>' . '/<codeA:\w+>' => 'visiteur/profil',
        md5('visiteur_finaliserprof') . '/<code:\w+>' => 'visiteur/finaliserprof',
        md5('visiteur_finaliser') . '/<code:\w+>' => 'visiteur/finaliser',
        md5('visiteur_finaliser') => 'visiteur/finaliser',
        md5('visiteur_initier') => 'visiteur/initier',
        md5('site_comptable') => 'site/comptable',
        md5('site_racourcis') => 'site/racourcis',


        //gestion des parents
        md5('parents_encadrer') => 'parents/encadrer',


        md5('gestion_creatusers') => 'gestion/creatusers',
        md5('gestion_agmatier') => 'gestion/agmatier',
        md5('gestion_payementpers') => 'gestion/payementpers',
        md5('gestion_ajax') => 'gestion/ajax',
        md5('gestion_detailsmatiers') . '/<code:\w+>' => 'gestion/detailsmatiers',
        md5('gestion_detailsmatiers') => 'gestion/detailsmatiers',
        md5('gestion_evenement') => 'gestion/evenement',


        md5('emploie_emploie') => 'emploie/emploie',
        md5('emploie_liste') . '/<code:\w+>' => 'emploie/liste',
        md5('emploie_ajax') => 'emploie/ajax',
        md5('emploie_ajouter') => 'emploie/ajouter',

        md5('evaluation_organiser') => 'evaluation/organiser',
        md5('evaluation_organiserconcinelle') => 'evaluation/organiserconcinelle',
        md5('evaluation_langage') => 'evaluation/langage',
        md5('evaluation_maternelle') => 'evaluation/maternelle',
        md5('evaluation_gevalprof') => 'evaluation/gevalprof',
        md5('evaluation_compositionprof') => 'evaluation/compositionprof',
        md5('evaluation_resultat') => 'evaluation/resultat',
        md5('evaluation_resultatconcinelle') => 'evaluation/resultatconcinelle',
        md5('evaluation_resultatconcinelle'). '/<code:\w+>' => 'evaluation/resultatconcinelle',
        md5('evaluation_resultat') . '/<code:\w+>' => 'evaluation/resultat',
        md5('evaluation_rapport') => 'evaluation/rapport',
        md5('evaluation_ajax') => 'evaluation/ajax',
        md5('evaluation_listeleve') => 'evaluation/listeleve',
        md5('evaluation_details') . '/<detailsnote:\w+>' => 'evaluation/details',
        md5('evaluation_concinelledetails') . '/<detailsnote:\w+>' => 'evaluation/concinelledetails',
        md5('evaluation_composition') => 'evaluation/composition',
        md5('evaluation_resultatfinal') => 'evaluation/resultatfinal',
        md5('evaluation_resultatfinal') . '/<code:\w+>' => 'evaluation/resultatfinal',
        //rapport
        md5('impression_eleve') => 'impression/eleve',


        md5('rapport_resultat') => 'rapport/resultat',
        //confg
        md5('param_anneescolaire') => 'param/anneescolaire',
        md5('param_niveau') => 'param/niveau',
        md5('param_classe') => 'param/classe',
        md5('param_fonction') => 'param/fonction',
        md5('param_matiere') => 'param/matiere',
        md5('param_paiement') => 'param/paiement',
        md5('param_ets') => 'param/ets',
        md5('param_tauxhoraire') => 'param/tauxhoraire',
        md5('param_paramscolaire') => 'param/paramscolaire',
        md5('param_parametre') => 'param/parametre',
        md5('param_modifi') => 'param/modifi',
        md5('param_creatusers') => 'param/creatusers',
        md5('param_adduser') => 'param/adduser',
        md5('param_typeusersadmin') => 'param/typeusersadmin',


        md5('param_payementpers') => 'param/payementpers',
        //comptable
        md5('comptable_depense') => 'comptable/depense',
        md5('comptable_catdepense') => 'comptable/catdepense',
        md5('comptable_scolarite') => 'comptable/scolarite',
        md5('comptable_paiementprof') => 'comptable/paiementprof',
        md5('comptable_personnel') => 'comptable/personnel',
        md5('comptable_histroique') => 'comptable/histroique',
        md5('comptable_historiquepaiement') . '/<code:\w+>' => 'comptable/historiquepaiement',
        md5('comptable_ajax') => 'comptable/ajax',
        md5('comptable_hispaiemnteleves') => 'comptable/hispaiemnteleves',


        //personnel
        md5('personnel_personnel') => 'personnel/personnel',
        md5('personnel_addpersonnel') => 'personnel/addpersonnel',
        md5('personnel_updatpers') . '/<code:\w+>' => 'personnel/updatpers',
        md5('personnel_updatpers') => 'personnel/updatpers',
        md5('personnel_profi') . '/<code:\w+>' => 'personnel/profi',

        md5('etablissement_liste')=>'etablissement/liste',

        //parent
        md5('parents_emploie') => "parents/emploie",
        //devoirs
        md5('devoirs_ajouter') => 'devoirs/ajouter',
        md5('devoirs_liste') => 'devoirs/liste',
        md5('devoirs_ajax') => 'devoirs/ajax',


        md5('personnel_proffeseurs') => 'personnel/proffeseurs',
        md5('personnel_addteachers') => 'personnel/addteachers',
        md5('personnel_updatprof') . '/<code:\w+>' => 'personnel/updatprof',
        md5('personnel_profie') . '/<code:\w+>' => 'personnel/profie',
        md5('personnel_updatprof') => 'personnel/updatprof',
        //Elevwes
        md5('eleve_enrollement') => 'eleve/enrollement',
        md5('eleve_list') . '/<classe:\w+>' => 'eleve/list',
        md5('eleve_list') . '/<classe:\w+>' => 'eleve/list',
        md5('eleve_filtre') => 'eleve/filtre',
        md5('eleve_listeleve') => 'eleve/listeleve',
        md5('eleve_inscription') => 'eleve/inscription',
        md5('eleve_importdata') => 'eleve/importdata',
        md5('eleve_listelevep') => 'eleve/listelevep',
        md5('impression_certificat') => 'impression/certificat',
        md5('impression_framecertificat') . '/<code:\w+>' => 'impression/framecertificat',
        //visiteur
        md5('visiteur_unicitelibelle') => 'visiteur/unicitelibelle',
        md5('communication_canalcommunication') => 'communication/canalcommunication',
        md5('communication_ajax') => 'communication/ajax',
        md5('communication_bienvenue') => 'communication/bienvenue',
        md5('communication_individuelle') => 'communication/individuelle',
        md5('communication_comptabiliter') => 'communication/comptabilite',
        md5('presence_presence') => 'presence/presence',
        md5('presence_statistique') => 'presence/statistique',
        md5('presence_ajax') => 'presence/ajax',
        md5('presence_liste') . '/<classe:\w+>' => 'presence/liste',
      ],
    ],

  ],
  'params' => $params,
];
if (YII_ENV_DEV) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'debug';
  $config['modules']['debug'] = [
    'class' => 'yii\debug\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    //'allowedIPs' => ['127.0.0.1', '::1'],
  ];

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    //'allowedIPs' => ['127.0.0.1', '::1'],
  ];
}

return $config;
