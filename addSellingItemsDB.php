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
    <?php
        session_start();
        function isLoggedIn(){return isset($_SESSION['userid']);}
        
        if(!isLoggedIn())
        {
            $URL='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.html';
            header('Location:'.$URL);
        }
    ?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg  navigation">

						<img src="images/logo3.png" alt="">

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item active">
								<a class="nav-link" href="item.php">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="user-profile.php">Dashboard</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="item.php">Items</a>
							</li>

						</ul>
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
								<a class="nav-link login-button" href="login&regis/logout.php">Log Out</a>
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
<section class="dashboard section">
	<!-- Container Start -->
	<div class="container">
		<!-- Row Start -->
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
						<h5 class="text-center"><?php echo 'Username: '.$_SESSION['username'];?></h5>
						<p>Joined <?php echo $_SESSION['joined']?></p>
					</div>
					<!-- Dashboard Links -->
					<div class="widget user-dashboard-menu">
						<ul>
              <li><a href="user-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
              <li class="active"><a href="sellingItems.php"><i class="fa fa-bookmark-o"></i>Selling Items</a></li>
              <li><a href="biddingItems.php"><i class="fa fa-file-archive-o"></i>Bidding Items</a></li>
              <li><a href="sellingHistory.php"><i class="fa fa-bolt"></i>Selling History</a></li>
              <li><a href="biddingHistory.php"><i class="fa fa-bolt"></i>Bidding History</a></li>
              <li><a href="login&regis/logout.php"><i class="fa fa-cog"></i>Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Recently Favorited -->
				<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">Sell New Item</h3>
                    <?php
                        function isDataValid()
                        {
                            date_default_timezone_set('Europe/London');
                            $errorMessage=null;
                            if(!isset($_POST['itemname']) || trim($_POST['itemname'])=='')
                                $errorMessage='Please enter itemname';
                            else if(!isset($_POST['category']) || trim($_POST['category'])=='')
                                $errorMessage='Please select category';
                            else if(!isset($_POST['startingprice']) || trim($_POST['startingprice'])=='')
                                $errorMessage='Please enter starting price';
                              else if($_POST['reserveprice']<$_POST['startingprice'])
                                $errorMessage='Please enter a reserve price higher than starting price';
                            else if(!isset($_POST['biddingenddate']) || trim($_POST['biddingenddate'])=='')
                                $errorMessage='Please select bidding end date';
                            else if(!isset($_POST['biddingendtime']) || trim($_POST['biddingendtime'])=='')
                                $errorMessage='Please select bidding end time';
                            else if($_FILES['photofile']['type']!='image/jpeg')
                                $errorMessage='Please upload a valid JPEG file';
                            else if(!isset($_POST['description']) || trim($_POST['description'])=='')
                                $errorMessage='Please enter product description';
                            else if(strtotime($_POST['biddingenddate'].$_POST['biddingendtime'])<strtotime(date("Y-m-d H:i:s")))
                                $errorMessage='Please select valid date and time';
                            
                            if($errorMessage !== null)
                            {
                                echo "<p>Error:{$errorMessage}</p>";
                                return False;
                            }
                            return True;
                        }
                        function saveToDatabase($newItem)
                        {
                            $connection=mysqli_connect('localhost','root','root','bidding')
                                or die('Error connecting to MySQL server.'.mysql_error());
                            date_default_timezone_set('Europe/London');
                            $postdate=date("Y-m-d H:i:s");
                            $result=mysqli_query($connection, "INSERT INTO selling (itemname, category, startingprice,reserveprice, currentprice, postdate, biddingenddate, userid, bidderid,description,viewing)
                            VALUES ('{$newItem['itemname']}', '{$newItem['category']}', '{$newItem['startingprice']}', '{$newItem['reserveprice']}','{$newItem['startingprice']}', '{$postdate}', '{$newItem['biddingenddate']}', '{$_SESSION['userid']}', '0','{$newItem['description']}','0')")
                                or die('Error making saveToDatabase query.'.mysql_error());
                              $itemid=mysqli_insert_id($connection);
                        
                            $uploaddir='./itemphoto/'.$itemid.'.jpg';
                            move_uploaded_file($_FILES['photofile']['tmp_name'],$uploaddir);
                            mysqli_close($connection);
                        }
                        function getNewItem()
                        {
                            $newItem=array();
                            $newItem['itemname']=$_POST['itemname'];
                            $newItem['category']=$_POST['category'];
                            $newItem['startingprice']=$_POST['startingprice'];
                            $newItem['reserveprice']=$_POST['reserveprice'];
                            $newItem['biddingenddate']=date("Y-m-d H:i:s", strtotime($_POST['biddingenddate'].$_POST['biddingendtime']));
                            $newItem['description']=$_POST['description'];
                            return $newItem;
                        }
                        
                        if(isDataValid())
                        {
                            $newItem=getNewItem();
                            saveToDatabase($newItem);
                            echo "<h2>New Item added</h2>";
                        }
                    ?>
				</div>
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
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
            <p>Copyright ? 2016. All Rights Reserved</p>
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