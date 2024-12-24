<?php
$userCode = unserialize(Yii::$app->session[Yii::$app->params['userSession']])['userCode'];
$user = yii::$app->accessClass->chargerUserAuthData($userCode);
// die(var_dump(  $user ));
?>

<div class="main-wrapper">
  <div class="header-outer">
    <div class="header">
      <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar">
        <i class="fas fa-bars" aria-hidden="true"></i>
      </a>
      <a id="toggle_btn" class="float-left" href="javascript:void(0);">
        <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets//img/sidebar/icon-21.png" alt="">
      </a>
      <ul class="nav float-left">
        <li>
          <div class="top-nav-search">
            <a href="javascript:void(0);" class="responsive-search">
              <i class="fa fa-search"></i>
            </a>
            <form action="search.html">
              <input class="form-control" type="text" placeholder="Search here">
              <button class="btn" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </form>
          </div>
        </li>
        <li>
          <a href="index.html" class="mobile-logo d-md-block d-lg-none d-block">
            <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/logo/logo.png" alt="" width="30" height="30">
          </a>
        </li>
      </ul>
      <ul class="nav user-menu float-right">
        <li class="nav-item dropdown d-none d-sm-block">
          <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets//img/sidebar/icon-22.png" alt="">
          </a>
          <div class="dropdown-menu notifications">
            <div class="topnav-dropdown-header">
              <span>Notifications</span>
            </div>
            <div class="drop-scroll">
              <ul class="notification-list">
                <li class="notification-message">
                  <a href="activities.html">
                    <div class="media">
                      <span class="avatar">
                        <img alt="John Doe"
                          src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/uploads/<?= $user['admin_image'] ?>"
                          class="img-fluid rounded-circle">
                      </span>
                      <div class="media-body">
                        <p class="noti-details">
                          <span class="noti-title">John Doe</span> is now following you
                        </p>
                        <p class="noti-time">
                          <span class="notification-time">4 mins ago</span>
                        </p>
                      </div>
                    </div>
                  </a>
                </li>

              </ul>
            </div>
            <div class="topnav-dropdown-footer">
              <a href="activities.html">View all Notifications</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown d-none d-sm-block">
          <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link">
            <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/img/sidebar/icon-23.png" alt="">
          </a>
        </li>
        <li class="nav-item dropdown has-arrow">
          <a href="#" class=" nav-link user-link" data-toggle="dropdown">
            <span class="user-img">
              <img class="rounded-circle"
                src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/uploads/<?= $user['admin_image'] ?>" width="30"
                alt="Admin">
              <span class="status online"></span>
            </span>
            <span>Admin</span>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Mon profil</a>
            <a class="dropdown-item" href="#">Modifier Mon Profil</a>
            <a class="dropdown-item"
              href="<?= yii::$app->request->baseUrl . '/' . md5('site_deconnecter') ?>">Déconnection</a>
          </div>
        </li>
      </ul>
      <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="#">Mon profil</a>
          <a class="dropdown-item" href="#">Modifier Mon Profil</a>
          <a class="dropdown-item"
            href="<?= yii::$app->request->baseUrl . '/' . md5('site_deconnecter') ?>">Déconnection</a>

        </div>
      </div>
    </div>
  </div>
  <div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
        <div class="header-left">
          <a href="index.html" class="logo">
            <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/logo/logo.png" width="40" height="40" alt="">
            <span class="text-uppercase">GS WAMY</span>
          </a>
        </div>
        <ul class="sidebar-ul">
          <li class="nav-item ">
            <a href="<?= yii::$app->request->baseurl . '/' . md5('site_index') ?>" class="border-top-0">
              <i class="fas fa-home back-icon"></i> TABLEAU DE BORD </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link " href="<?= yii::$app->request->baseurl . '/' . md5('param_parametre') ?>" id="btnEtb"
              style="font-size:12px ;">Paramètres Etablissement</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->request->baseurl . '/' . md5('param_anneescolaire') ?>">Années
              Scolaires</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->request->baseurl . '/' . md5('param_niveau') ?>">Niveaux</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->request->baseurl . '/' . md5('param_classe') ?>">Classes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->request->baseurl . '/' . md5('param_matiere') ?>">Matières</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->request->baseurl . '/' . md5('param_fonction') ?>">Fonctions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->request->baseurl . '/' . md5('param_paiement') ?>">Ajouter un
              payement</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->request->baseurl . '/' . md5('param_payementpers') ?>">
              payement R.H</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->request->baseurl . '/' . md5('param_paramscolaire') ?>">Paramètre
              comptabilité</a>
          </li>
   
          <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->request->baseurl . '/' . md5('param_tauxhoraire') ?>">Taux Horaires</a>
          </li>
          <li>
            <a href="<?= yii::$app->request->baseurl . '/' . md5('param_creatusers') ?>">
              <span>Type Utilisateurs</span>
            </a>
          </li>

        </ul>
      </div>
    </div>
  </div>