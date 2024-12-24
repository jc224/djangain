<div class="content container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <h5 class="text-uppercase mb-0 mt-0 page-title">Information Générale de l'établissement</h5>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <ul class="breadcrumb float-right p-0 mb-0">
          <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Tableau de bord</a>
          </li>
          <li class="breadcrumb-item"><span> Information </span></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-7">
      <h4 class="page-title"> Information</h4>
    </div>
    <div class="col-sm-5 text-right  m-b-30">
      <a href="<?= yii::$app->request->baseUrl .'/'.md5('param_modifi')?>" class="btn btn-secondary bg-primary btn-rounded"><i class="fa fa-edit" aria-hidden="true"></i> Modification</a>
    </div>
  </div>
  <div class="card-box m-b-0">
    <div class="row">
      <div class="col-md-12">
        <div class="profile-view">
          <div class="profile-img-wrap">
            <div class="profile-img">
              <a href=""><img src="<?=yii::$app->request->baseUrl.'/web/mainAssets/uploads/'.$ets['logo']?>" alt=""></a>
            </div>
          </div>
          <div class="profile-basic">
            <div class="row">
              <div class="col-md-5">
                <div class="profile-info-left">
                  <h3 class="user-name m-t-0"><?=$ets['nomEtbs']?></h3>
                  <h5 class="company-role m-t-0 m-b-0">Ecole d'enseignement Générale</h5>
                  <div class="staff-id">Une Stratégie pédagogique Moderne</div>
                  <div class="staff-id">Située à <?=$ets['addresse']?></div>
                  <div class="staff-msg"><a href="#" class="btn btn-primary bg-primary btn-rounded">
                      En Savoir Plus</a></div>
                </div>
              </div>
              <div class="col-md-5">
                <ul class="personal-info">
                  <li>
                    <span class="title">Email:</span>
                    <span class="text"><a href=""><?=$ets['email']?></a></span>
                  </li>
                  <li>
                    <span class="title">Tel:</span>
                    <span class="text"><a href=""><?=$ets['tel']?></a></span>
                  </li>
                  <li>
                    <span class="title">Commune:</span>
                    <span class="text"><?=$ets['commune']?></span>
                  </li>
                  <li>
                    <span class="title">Addresse:</span>
                    <span class="text"><?=$ets['addresse']?></span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
