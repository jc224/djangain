<section>

			<div class="left-side sticky-left-side">														

				<div class="logo">

					<a href="dashboard.php">

						<img src="<?= Yii::$app->request->baseUrl ?>/public/assets/images/favicon/logoBackEnd.png" alt="" height="36px">

					</a>

				</div>

				<div class="logo-icon text-center">

					<a href="dashboard.php">

						<img src="<?= Yii::$app->request->baseUrl ?>/public/assets/images/favicon/logoBackEnd(1).png" alt="" height="34px" width="34px">

					</a>

				</div>

				<div class="left-side-inner">

					

					<!--=*= VISIBLE ON SMALL DEVICES =*=-->

					<div class="visible-xs hidden-sm hidden-md hidden-lg">			

						<div class="media logged-user">

							<img alt="" src="<?= Yii::$app->request->baseUrl ?>/public/uploads/<?php echo  $_SESSION['SMC_login_admin_image']; ?>" class="media-object">

							<div class="media-body">

								<h4> <a href="#"> <?php echo $_SESSION['SMC_login_admin_name']; ?> </a> </h4>

								<span> FULL STACK WEB DEVELOPER </span>

							</div>

						</div>

						<h5 class="left-nav-title"> Account Information </h5>

						<ul class="nav nav-pills nav-stacked custom-nav">

							<li>

								<a href="?exit=lock"> <i class="fa fa-user"></i> <span> Lock Screen </span> </a>

							</li>

							<li>

								<a href="?exit=yes"> <i class="fa fa-sign-out"></i> <span> Sign Out </span> </a>

							</li>

						</ul>

					</div>

					<!--=*= VISIBLE ON SMALL DEVICES =*=-->

					

					<ul class="nav nav-pills nav-stacked custom-nav">

						<li>

							<a href="dashboard.php">

								<i class="fa fa-home"></i> <span> Tableau de Bord</span>

							</a>

						</li>

						

						<?php

							## ===*=== [A]CCESS CONTROL CONTENT START ===*=== ##

							if($_SESSION['SMC_login_admin_type'] == "Root        Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator")

							{

								echo '

								<li class="menu-list">

									<a href="#"> <i class="fa fa-user"></i> <span>Manage Admin</span> </a>

									<ul class="sub-menu-list">

										<li>

											<a href="'. yii::$app->request->baseurl.'/'.md5('admin_creatadmin').'"> <i class="fa fa-plus-circle"></i> Create Admin </a>

										</li>

										<li>

											<a href="'. yii::$app->request->baseurl.'/'.md5('admin_adminliste').'"> <i class="fa fa-user"></i> List Admin </a>

										</li>

									</ul>

								</li>

								';

							}

							

							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Content Manager")

							{

								echo '

								<li class="menu-list">

									<a href="#"> <i class="fa fa-picture-o"></i></i> <span> Manage Slider </span> </a> <i class="fas fa-sliders-h"></i>

									<ul class="sub-menu-list">

										<li>

											<a href="'. yii::$app->request->baseurl.'/'.md5('admin_crateslidbar').'"> Add Image Slider </a>

										</li>

										<li>

											<a href="'. yii::$app->request->baseurl.'/'.md5('admin_listeslidbar').'"> List Image Slider </a>

										</li>

									</ul>

								</li>

								';

							}

							

							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Sales Manager")

							{

								echo '

								<li class="menu-list">

									<a href="#"> <i class="fa fa-users"></i> <span> Manage Customer </span> </a>

									<ul class="sub-menu-list">

										<li>

											<a href="'. yii::$app->request->baseurl.'/'.md5('admin_custommer').'"> Customer List </a>

										</li>

										<li>

											<a href="'. yii::$app->request->baseurl.'/'.md5('admin_review').'"> Customer Overview </a>

										</li>

									</ul>

								</li>

								';

							}

							

							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator")

							{

								echo '

								<li class="menu-list">

									<a href="#"> <i class="fa fa-folder-open"></i> <span> Manage Category </span> </a>

									<ul class="sub-menu-list">

										<li>

											<a href="'. yii::$app->request->baseurl.'/'.md5('admin_creatCategorie').'"> Create Category </a>

										</li>

										<li>

											<a href="'. yii::$app->request->baseurl.'/'.md5('admin_listcategorie').'"> List Category </a>

										</li>

									</ul>

								</li>

								';

							}

							

							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator")

							{

								echo '

								<li class="menu-list">

									<a href="#"> <i class="fa fa-list-alt"></i> <span> Manage Sub Category </span> </a>

									<ul class="sub-menu-list">

										<li>

											<a href="'. yii::$app->request->baseurl.'/'.md5('admin_subcategorie').'"> Create Sub Category </a>

										</li>

										<li>

											<a href="'. yii::$app->request->baseurl.'/'.md5('admin_listesubcat').'"> Sub Category List </a>

										</li>

									</ul>

								</li>

								';

							}

							

							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Content Manager")

							{

								echo '

								<li class="menu-list">

									<a href="#"> <i class="fa fa-th"></i> <span> Manage Products </span> </a>

									<ul class="sub-menu-list">

										<li>

											<a href="create-product.php"> Create Products</a>

										</li>

										<li>

											<a href="list-product.php"> Products List </a>

										</li>

									</ul>

								</li>

								';

							}

							

							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Sales Manager")

							{

								echo '

								<li class="menu-list">

									<a href="#"> <i class="fa fa-tags"></i> <span> Manage Orders </span> </a> <i class="fas fa-sort-amount-up-alt"></i>

									<ul class="sub-menu-list">

										<li>

										<a href="list-order.php"> Orders List </a>

										</li>

										<li>

										<a href="invoice-list.php"> Invoice List </a>

										</li>

									</ul>

								</li>';

							}

							

							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Sales Manager")

							{

								echo '

								<li class="menu-list">

									<a href="#"> <i class="fa fa-tags"></i> <span> SEO </span> </a> <i class="fas fa-sort-amount-up-alt"></i>

									<ul class="sub-menu-list">

										<li>

											<a href="pages.php"> Pages </a>

										</li>										

										<li>

											<a href="pages-details.php"> Pages Details </a>

										</li>

									</ul>

								</li>';

							}

							## ===*=== [A]CCESS CONTROL CONTENT END ===*=== ##

						?>

						

					</ul>

				</div>

			</div>





            	<!--=*= MAIN CONTENT START =*=-->

				<div class="main-content" >

					<div class="header-section">

						<a class="toggle-btn"> <i class="fa fa-bars"></i> </a>

						

						<form class="searchform" action="" method="post">

							<input type="text" class="form-control" name="keyword" placeholder="Search here..." />

						</form>

						

						<div class="menu-right">

							<ul class="notification-menu">

								<li>

									<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

										<img src="<?= Yii::$app->request->baseUrl ?>/public/uploads/<?php $_SESSION['SMC_login_admin_image']; ?>" alt="" />

										<?php echo $_SESSION['SMC_login_admin_name']; ?> 

										<span class="caret"></span>

									</a>

									<ul class="dropdown-menu dropdown-menu-usermenu pull-right">

										<li>

											<a href="?exit=lock"><i class="fa fa-user"></i> Lock Screen </a>

										</li>

										<li>

											<a href="?exit=yes"><i class="fa fa-sign-out"></i> Log Out </a>

										</li>

									</ul>

								</li>

							</ul>

						</div>

					</div>																																																