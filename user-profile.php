<?php 
require_once 'login&regis/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
	header('Location: index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calssimax</title>
  
  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="plugins/slick-carousel/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
  <!-- Fancy Box -->
  <link href="plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  <link href="plugins/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
  <!-- CUSTOM CSS -->
  <link href="css/style.css" rel="stylesheet">

  <!-- FAVICON -->
  <link href="img/favicon.png" rel="shortcut icon">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">


<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg  navigation">
					<a class="navbar-brand" href="index.html">
						<img src="images/logo3.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item active">
								<a class="nav-link" href="item.php">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="sellingItems.php">Dashboard</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="item.php">Items</a>
							</li>
						</ul>
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
								<a class="nav-link login-button" href="login&regis/logout.php">Log out</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>
<!--==================================
=            User Profile            =
===================================-->

<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user-dashboard-profile">
						<!-- User Image -->
						<div class="profile-thumb">
							<img src="images/user/user-thumb.jpg" alt="" class="rounded-circle">
						</div>
						<!-- User Name -->
						<h5 class="text-center"><?php echo $_SESSION['username']?></h5>
						<p>Joined <?php echo $_SESSION['joined']?></p>
					</div>
					<!-- Dashboard Links -->
					<div class="widget user-dashboard-menu">
						<ul>
							<li class="active"><a href="user-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
							<li><a href="sellingItems.php"><i class="fa fa-bookmark-o"></i>Selling Items</a></li>
							<li><a href="biddingItems.php"><i class="fa fa-file-archive-o"></i>Bidding Items</a></li>
							<li><a href="sellingHistory.php"><i class="fa fa-bolt"></i>Selling History</a></li>
							<li><a href="biddingHistory.php"><i class="fa fa-bolt"></i>Bidding History</a></li>
							<li><a href="login&regis/logout.php"><i class="fa fa-cog"></i>Logout</a></li>				
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<div style="background-color:lightblue;color: red"> <?php if(Input::exists()) {
					    if(CSRF_Protection::check(Input::get('token'))){

					        $validate = new RegistrationValidator();
					        $validation = $validate -> check($_POST,array(
					            'name' => [
					                'required' => true,
					                'max' => 20,
					                'min' => 2
					            ],   
					            'password' => [
					                'required' => true,
					            ],                                     
					            'new-password' => [
					                'required' => true,
					                'max' => 30,
					                'min' => 6,
					                'secure' => 'password'
					            ],
					            'new-password-confirmation' => [
					                'required' => true,
					                'matches' => 'new-password'
					            ],
					            'email' => [
					                'required' => true,
					                'email' => true
					            ]
					        ));

					        if ($validation->passed()) {

					        	if(Hash::encrypt(Input::get('password')) !== $user->data()->password){
					        		echo '* Your current password is wrong.';
					        	} else {
					        		try{
										$user->update(array(
						        			'password' => Hash::encrypt(Input::get('new-password')),
						                    'name' => Input::get('name'),
                 	                        'email' => Input::get('email')
					        			));
					        			echo 'Your password has been changed!';

					        		} catch(Exception $e) {
					        		    die($e->getMessage());
					                }   		
					        	}
					            
					        } else {
					            foreach ($validation->errors() as $error) {
					                echo '* ' . $error, '<br>';
					            }
					        }
					    }
					}

					?> </div>
					<h3 class="widget-header user">Edit Personal Information</h3>
					
					<form action="" method="post">
						<!-- Name -->
						<div class="form-group">
						    <label for="name">Enter Name</label>
						    <input type="text" class="form-control" id="name" name="name" value="<?php echo Input::get('name');?>">
						</div>						
						
				<!-- Change Password -->
				<div class="widget change-password">
					<h3 class="widget-header user">Edit Password</h3>
					
						<!-- Current Password -->
						<div class="form-group">
						    <label for="current-password">Current Password</label>
						    <input type="password" class="form-control" id="current-password" name="password" value="<?php echo Input::get('password');?>">
						</div>
						<!-- New Password -->
						<div class="form-group">
						    <label for="new-password">New Password</label>
						    <input type="password" class="form-control" id="new-password" name="new-password" value="<?php echo Input::get('new-password');?>">
						</div>
						<!-- Confirm New Password -->
						<div class="form-group">
						    <label for="confirm-password">Confirm New Password</label>
						    <input type="password" class="form-control" id="confirm-password" name="new-password-confirmation" value="<?php echo Input::get('new-password-confirmation');?>">
						</div>
						
				<!-- Change Email Address -->
				<div class="widget change-email mb-0">
					<h3 class="widget-header user">Edit Email Address</h3>
					
					
						<!-- New email -->
						<div class="form-group">
						    <label for="new-email">New Email</label>
						    <input type="email" class="form-control" id="new-email" name="email" value="<?php echo Input::get('username');?>">
						</div>
						<!-- Submit Button -->
						<input type="hidden" name = "token" value = "<?php echo CSRF_Protection::generate(); ?>">
						<input type="submit" value = "Save changes" class="button">
						
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<!--============================
=            Footer            =
=============================-->

<!-- Footer Bottom -->
<footer class="footer-bottom">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-12">
          <!-- Copyright -->
          <div class="copyright">
            <p>Copyright © 2016. All Rights Reserved</p>
          </div>
        </div>
        <div class="col-sm-6 col-12">
          <!-- Social Icons -->
          <ul class="social-media-icons text-right">
              <li><a class="fa fa-facebook" href=""></a></li>
              <li><a class="fa fa-twitter" href=""></a></li>
              <li><a class="fa fa-pinterest-p" href=""></a></li>
              <li><a class="fa fa-vimeo" href=""></a></li>
            </ul>
        </div>
      </div>
    </div>
    <!-- Container End -->
    <!-- To Top -->
    <div class="top-to">
      <a id="top" class="" href=""><i class="fa fa-angle-up"></i></a>
    </div>
</footer>

  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="plugins/tether/js/tether.min.js"></script>
  <script src="plugins/raty/jquery.raty-fa.js"></script>
  <script src="plugins/bootstrap/dist/js/popper.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="plugins/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
  <script src="plugins/slick-carousel/slick/slick.min.js"></script>
  <script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
  <script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
  <script src="js/scripts.js"></script>

</body>

</html>