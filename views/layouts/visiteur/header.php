<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-right">
						<p class="site">www.wamy.org</p>
						<p class="num">Tel : +224 624624201</p>
						<ul class="fh5co-social">
							<li><a href="https://www.facebook.com/lyceewamy"><i class="icon-facebook2"></i></a></li>
							<li><a href="#"><i class="icon-twitter2"></i></a></li>
							<li><a href="#"><i class="icon-dribbble2"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-2">
                    <img src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/logo/logo.png" alt="" style="border-radius:50%; width: 100px; height: 100px;">
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li class="active"><a href="<?= yii::$app->request->baseurl.'/'?>">Acceuil</a></li>
							<li><a href="<?= yii::$app->request->baseurl.'/'.md5('visiteur_apropos')?>">A&nbsp; Propos</a></li>
							<li><a href="<?= yii::$app->request->baseurl.'/'.md5('visiteur_contacte')?>">Nous Contactez</a></li>
							<i class="fa fa-user" aria-hidden="true"></i><li class="btn-cta"><a href="<?= yii::$app->request->baseurl.'/'.md5('site_login')?>"><span>Connexion</span></a></li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</nav>
	