
<div class="content container-fluid">

<div class="page-header">
  <div class="row">
    <div class="col-md-6">
      <h3 class="page-title mb-0" style="font-weight: bolder;"> BIENVENUE AU GROUPE SCOLAIRE WAMY INTERNATIONAL </h3>
    </div>
    <div class="col-md-6">
      <ul class="breadcrumb mb-0 p-0 float-right">
        <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Acceuil</a>
        </li>
        <li class="breadcrumb-item"><span>Tableau de bord</span></li>
      </ul>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget dash-widget5">
      <span class="float-left"><img src="<?=yii::$app->request->baseUrl?>/web/mainAssets/img/dash/dash-1.png" alt="" width="80"></span>
      <div class="dash-widget-info text-right">
        <span>Total des élèves Inscrits</span>
        <h3><?= $nbE ?></h3>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget dash-widget5">
      <span class="float-left"><img src="<?=yii::$app->request->baseUrl?>/web/mainAssets/img/dash/dash-3.png" alt="" width="80"></span>
      <div class="dash-widget-info text-right">
        <span>Total filles</span>
      <h3><?= $wm?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget dash-widget5">
      <div class="dash-widget-info text-left d-inline-block">
        <span>Total Enseignats</span>
        <h3><?= $ens?></h3>
      </div>
      <span class="float-right"><img src="<?=yii::$app->request->baseUrl?>/web/mainAssets/img/dash/dash-2.png" width="80" alt=""></span>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget dash-widget5">
      <div class="dash-widget-info text-left d-inline-block">
        <span>Total Personnel</span>
        <h3><?= $pers?></h3>
      </div>
      <span class="float-right"><img src="<?=yii::$app->request->baseUrl?>/web/mainAssets/img/dash/dash-2.png" width="80" alt=""></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <div class="page-title">
              Evolution des Elèves Par Année Scolaire
            </div>
          </div>
        
        </div>
      </div>
      <div class="card-body">
        <div id="chartans"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-md-12 col-12 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <div class="page-title">
            calendrier
            </div>
          </div>
          <div class="col text-right">
            <div class=" mt-sm-0 mt-2">
              <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Another action</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
      <input type="hidden" id="csrf" value="<?=Yii::$app->request->getCsrfToken()?>">
                      <input type="hidden" id="lien" value="<?=Yii::$app->request->baseUrl . "/" . md5("gestion_ajax")?>">
                      <input type="hidden" id="type" value="0">
        <div id="calendar" class=" overflow-hidden"></div>
      </div>
    </div>
  </div>

</div>
<div class="row">
<div class="col-lg-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <div class="page-title">
              Statistiques des Note Par mois
            </div>
          </div>
          <div class="col text-right">
            <div class=" mt-sm-0 mt-2">
              <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Another action</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div id="chart2"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-md-12 col-12 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <div class="page-title">
                Répartitions par types d'individus
            </div>
          </div>
          <div class="col text-right">
            <div class=" mt-sm-0 mt-2">
              <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Another action</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body d-flex align-items-center justify-content-center overflow-hidden">
        <div id="statindividus"> </div>
      </div>
    </div>
  </div>
</div>


<div class="notification-box">
  <div class="msg-sidebar notifications msg-noti">
    <div class="topnav-dropdown-header">
      <span>Messages</span>
    </div>
    <div class="drop-scroll msg-list-scroll">
      <ul class="list-box">
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">A</span>
              </div>
              <div class="list-body">
                <span class="message-author">Amadou Bailo </span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Bonjour je viens de vous envoyer un mail,
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item new-message">
              <div class="list-left">
                <span class="avatar">E</span>
              </div>
              <div class="list-body">
                <span class="message-author">Elhadj Ahmad</span>
                <span class="message-time">1 Aug</span>
                <div class="clearfix"></div>
                <span class="message-content"> Bonjour je n'arrive pas à ouvrir
                à ouvrir</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">B</span>
              </div>
              <div class="list-body">
                <span class="message-author"> Bangaly </span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Merci pour l'information
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">T</span>
              </div>
              <div class="list-body">
                <span class="message-author">Touré</span>
                <span class="message-ime">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">C'est reçu
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">C</span>
              </div>
              <div class="list-body">
                <span class="message-author"> Catherine Manseau </span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">D</span>
              </div>
              <div class="list-body">
                <span class="message-author"> Domenic Houston </span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">B</span>
              </div>
              <div class="list-body">
                <span class="message-author"> Buster Wigton </span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">R</span>
              </div>
              <div class="list-body">
                <span class="message-author"> Rolland Webber </span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">C</span>
              </div>
              <div class="list-body">
                <span class="message-author"> Claire Mapes </span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">M</span>
              </div>
              <div class="list-body">
                <span class="message-author">Melita Faucher</span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">J</span>
              </div>
              <div class="list-body">
                <span class="message-author">Jeffery Lalor</span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">L</span>
              </div>
              <div class="list-body">
                <span class="message-author">Loren Gatlin</span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="chat.html">
            <div class="list-item">
              <div class="list-left">
                <span class="avatar">T</span>
              </div>
              <div class="list-body">
                <span class="message-author">Tarah Shropshire</span>
                <span class="message-time">12:28 AM</span>
                <div class="clearfix"></div>
                <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                  adipiscing</span>
              </div>
            </div>
          </a>
        </li>
      </ul>
    </div>
    <div class="topnav-dropdown-footer">
      <a href="chat.html">See all messages</a>
    </div>
  </div>
</div>
</div>


<?php
require('script/script.php');
?>
