<?php
$userCode  = yii::$app->mainCLass->getusers();
$user = yii::$app->accessClass->chargerUserAuthData($userCode);
$anneeActive = yii::$app->mainCLass->getAnneeActive();
$reqlibanne = yii::$app->mainCLass->unidata('dj_anneescolaire', $anneeActive);
$ets = yii::$app->mainCLass->getets();
$infoets = yii::$app->mainCLass->unidata('dj_etbs', $ets);
$anneescolairew = ($reqlibanne == true ? $reqlibanne['libelle'] : '');
// $menuString  = yii::$app->menuactionClass->menu($userCode);
?>
<style>
  .modal-head {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem 1rem;

  }

  .nav-tabs.nav-tabs-solid>li>a.active,
  .nav-tabs.nav-tabs-solid>li>a.active:hover,
  .nav-tabs.nav-tabs-solid>li>a.active:focus {
    background-color: <?= $infoets['prim'] ?>;
    border-color: <?= $infoets['prim'] ?>;
    color: #fff;
  }

  .badge-success-border {
    border: 1px solid <?= $infoets['prim'] ?>;
    color: <?= $infoets['prim'] ?>;
    background-color: #fff;
    display: inline-block;
    min-width: 80px;
  }

  .btn-search:hover,
  .btn-search:focus,
  .btn-search.active,
  .btn-search:active,
  .open>.dropdown-toggle.btn-search {
    color: #fff;
    background: <?= $infoets['prim'] ?>;
    border: 1px solid transparent;
  }

  .btn-search:not(:disabled):not(.disabled):active {
    color: #fff;
    background: <?= $infoets['prim'] ?>;
    border: 1px solid transparent;
  }

  .btn-search.active.focus,
  .btn-search.active:focus,
  .btn-search.active:hover,
  .btn-search.focus:active,
  .btn-search:active:focus,
  .btn-search:active:hover,
  .open>.dropdown-toggle.btn-search.focus,
  .open>.dropdown-toggle.btn-search:focus,
  .open>.dropdown-toggle.btn-search:hover {
    color: #fff;
    background: <?= $infoets['prim'] ?>;
    border: 1px solid transparent;
  }

  .text-primary,
  .dropdown-menu>li>a.text-primary {
    color: <?= $infoets['prim'] ?> !important;
  }

  * {
    text-transform: none;
  }

  .bg-primary,
  .badge-primary {
    background-color: <?= $infoets['prim'] ?> !important;
    color: white;
  }

  .modal-header {
    background: <?= $infoets['prim'] ?>;

  }

  .btn-rounded {
    background-color: <?= $infoets['prim'] ?>;
  }

  .text-primary {
    color: <?= $infoets['prim'] ?>;
    ;
  }

  .btn-primary:hover,
  .btn-primary:active,
  .btn-primary:focus {
    background-color: <?= $infoets['prim'] ?>;
    border-color: <?= $infoets['prim'] ?>;

  }

  a:hover,
  a:active,
  a:focus {
    text-decoration: none;
    outline: none;
    color: <?= $infoets['prim'] ?>;
  }

  .btn-outline-primary:hover,
  .btn-outline-primary:focus,
  .btn-outline-primary.active,
  .btn-outline-primary:active,
  .open>.dropdown-toggle.btn-outline-primary {
    background-color: <?= $infoets['prim'] ?>;
    border: 1px solid <?= $infoets['prim'] ?>;
  }

  .btn-outline-primary {
    color: #000;
    border-color: <?= $infoets['prim'] ?>;
  }

  .form-control:focus {
    border-color: <?= $infoets['prim'] ?>;
    box-shadow: none;
    outline: 0;
  }

  .btn-secondary:hover,
  .btn-secondary:active,
  .btn-secondary:focus {
    background-color: <?= $infoets['secon'] ?>;
    border-color: <?= $infoets['secon'] ?>;

  }

  .btn-primary {
    background-color: <?= $infoets['prim'] ?>;
    border-color: <?= $infoets['prim'] ?>;
  }

  .btn-search {
    background-color: <?= $infoets['prim'] ?> !important;
    border-color: <?= $infoets['prim'] ?> !important;
    color: white;
  }

  .page-item.active .page-link,
  .page-item.active .page-link {
    background-color: <?= $infoets['prim'] ?> !important;
    border-color: <?= $infoets['prim'] ?> !important;
  }

  a:hover,
  span:hover,
  a:active,
  span:active a:focus,
  span:focus {
    color: <?= $infoets['prim'] ?>;
  }

  .btn-primary:hover,
  .btn-primary:focus,
  .btn-primary.active,
  .btn-primary:active,
  .open>.dropdown-toggle.btn-primary {
    background-color: <?= $infoets['prim'] ?> !important;
    border-color: <?= $infoets['prim'] ?> !important;
  }


  .btn-primary.active.focus,
  .btn-primary.active:focus,
  .btn-primary.active:hover,
  .btn-primary.focus:active,
  .btn-primary:active:focus,
  .btn-primary:active:hover,
  .open>.dropdown-toggle.btn-primary.focus,
  .open>.dropdown-toggle.btn-primary:focus,
  .open>.dropdown-toggle.btn-primary:hover {
    background-color: <?= $infoets['prim'] ?> !important;
    border-color: <?= $infoets['prim'] ?> !important;
  }

  .mobile-user-menu>a {
    color: <?= $infoets['prim'] ?>;
    padding: 0;
  }

  .mobile-user-menu>a:hover {
    color: <?= $infoets['secon'] ?>;
  }

  .btn-active-color-primary {}

  .btn-secondary {
    background-color: <?= $infoets['secon'] ?>;
    border-color: <?= $infoets['secon'] ?>;
  }

  .page-title {
    border-image: linear-gradient(180deg, <?= $infoets['prim'] ?> 0%, <?= $infoets['secon'] ?> 100%) 1;
  }

  .pagination>li>a,
  .pagination>li>span {
    color: <?= $infoets['prim'] ?>;
  }

  .badge-primary {
    background: <?= $infoets['prim'] ?>;
  }

  .btn-bg-primary {
    background: <?= $infoets['prim'] ?>;
    color: white;
  }

 .sidebar-menu ul ul a.active {
    color:<?= $infoets  ['prim'] ?>;
    text-decoration: underline;
}

.sidebar-menu li.submenu a.active.subdrop {
    color: <?= $infoets['prim'] ?>;
    border-radius: 10px;
}
  .avatar {
    background-color: <?= $infoets['prim'] ?>;
  }

  .inconemenu {
    color: <?= $infoets['prim'] ?>;
  }

  .sidebar-menu li a:hover {
    color: <?= $infoets['prim'] ?>;

  }

  .user-menu.nav>li>a {
    color: <?= $infoets['prim'] ?>;
  }

  /* CSS for hiding the div on mobile devices */
  @media (max-width: 767px) {
    #mobilebreacump {
      display: none;

    }

    #header {
      margin-top: -8px;
    }
  }
</style>

<div class="main-wrapper">
  <div class="header-outer ">
    <div class="header shadow-lg" style="background:<?= $infoets['headerouter'] ?>;">
      <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar">
        <i class="fas fa-bars text-white" aria-hidden="true"></i>
      </a>
      <a id="toggle_btn" class="float-left" href="javascript:void(0);">
        <i class="fas fa-bars fs-1 pt-2" style="font-size: xx-large;color: white"></i>
      </a>
      <ul class="nav float-left">
        <li>
          <div class="top-nav-search">
            <a href="javascript:void(0);" class="responsive-search">
              <i class="fa fa-search"></i>
            </a>

          </div>
        </li>
        <li>
          <a href="#" class="mobile-logo d-md-block d-lg-none d-block">
            <img src="<?= yii::$app->request->baseUrl . '' . yii::$app->params['linkToUploadIndividusProfil'] . '' . $infoets['logo'] ?>" alt="" width="30" height="30">
          </a>
        </li>
      </ul>
      <ul class="nav user-menu float-right">

        <li class="nav-item dropdown d-none d-sm-block">
          <a href="javascript:void(0);" id="" class="text-white">
            ANNEE SCOLAIRE : <?= $anneescolairew ?>
          </a>
        </li>

        <li class="nav-item dropdown d-none d-sm-block ">
          <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications btn btn-white d-none" style="margin-top:2px;height: 80%;xolor:white">
            Modifier
          </a>
        </li>
        <li class="nav-item dropdown has-arrow">
          <a href="#" class=" nav-link user-link" data-toggle="dropdown">
            <span class="user-img">
              <img class="rounded-circle" src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/uploads/<?= $user['admin_image'] ?>" width="30">
              <span class="status online"></span>
            </span>
            <span><?= $user['admin_name'] ?></span>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= yii::$app->request->baseUrl . '/' . md5('site_profil') ?>">Mon profil</a>
            <a class="dropdown-item" href="<?= yii::$app->request->baseUrl . '/' . md5('site_deconnecter') ?>">Deconnection</a>
          </div>
        </li>
      </ul>
      <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="<?= yii::$app->request->baseUrl . '/' . md5('site_profil') ?>">Mon profil</a>
          <a class="dropdown-item" href="<?= yii::$app->request->baseUrl . '/' . md5('site_deconnecter') ?>">Deconnection</a>

        </div>
      </div>
    </div>
  </div>
  <div class="sidebar shadow-lg" id="sidebar">
    <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
        <div class="header-left">
          <a href="#" class="logo">

            <img src="<?= yii::$app->request->baseUrl . '' . yii::$app->params['linkToUploadIndividusProfil'] . '' . $infoets['logo'] ?>" width="70" alt="">
            <!-- <span class="text-uppercase"><?= $infoets['nomEtbs'] ?></span> -->
          </a>
        </div>
        <ul class="sidebar-ul">
          <li class="menu-title">Menu</li>
          <?php $menuString  = yii::$app->menuactionClass->menu($userCode); ?>
        </ul>
      </div>
    </div>
  </div>