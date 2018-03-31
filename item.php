<?php
require_once 'login&regis/init.php';

$user = new User();
if($user->isLoggedIn()) {
	if($user->hasPermission('admin')){
		header('Location: showuser.php');
	}		
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
    <style>
        .recommend img{
            height:150px;
            width:auto;
            margin-left: auto;
           
        }
        .recommend{
            text-align: center;
        }
    </style>
<body class="body-wrapper">

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
									<a class="nav-link" href="sellingItems.php">Dashboard</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="item.php">
										Items
									</a>

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
	<section class="page-search">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Advance Search -->
					<div class="advance-search">
						<form method="post">
							<div class="form-row">
								<div class="form-group col-md-9">
									<input type="text" class="form-control" id="inputtext4" placeholder="What are you looking for" name="keyword">
								</div>
								<div class="form-group col-md-2">
									<button type="submit" id="searchButton" class="btn btn-primary" name="search">Search Now</button>
								</div>
								

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section-sm">
		<div class="container">
			<?php
			if(isset($_POST['search'])){
			echo '<div class="row" id="searchInfo">';
				echo '<div class="col-md-12">';
					echo '<div class="search-result bg-gray">';
						echo '<h2>Results For "'.$_POST['keyword'].'"</h2>';
						echo '<p>123 Results on 12 December, 2017</p>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}else if(isset($_GET['category'])){
			echo '<div class="row" id="searchInfo">';
				echo '<div class="col-md-12">';
					echo '<div class="search-result bg-gray">';
						echo '<h2>Results For "'.$_GET['category'].'"</h2>';
						echo '<p>123 Results on 12 December, 2017</p>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
			?>
			<div class="row">
				<div class="col-md-3">
					<div class="category-sidebar">
						<div class="widget category-list">
							<h4 class="widget-header">All Category</h4>
							<ul class="category-list">
								<li><a href="item.php">All</a></li>
								<li><a href="item.php?category=Clothes">Clothes</a></li>
								<li><a href="item.php?category=Electronic device">Electronic device</a></li>
								<li><a href="item.php?category=Literature">Literature</a></li>
								<li><a href="item.php?category=Sports">Sports</a></li>
								<li><a href="item.php?category=Food">Food</a></li>
								<li><a href="item.php?category=Beauty">Beauty</a></li>
								<li><a href="item.php?category=Furniture">Furniture</a></li>
								<li><a href="item.php?category=Music">Music</a></li>
								<li><a href="item.php?category=Kitchen">Kitchen</a></li>
								<li><a href="item.php?category=Stationery">Stationery</a></li>
							</ul>
						</div>






					</div>
				</div>
				<div class="col-md-9">
					<div class="category-search-filter">
						<div class="row">
							<div class="col-md-6">
								<strong>Short</strong>
								<select>
									<option>Most Recent</option>
									<option value="1">Most Popular</option>
									<option value="2">Lowest Price</option>
									<option value="4">Highest Price</option>
								</select>
							</div>

						</div>
					</div>
					<div class="widget dashboard-container my-adslist">
						<div class="row mt-30">
							<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
								<th>Image</th>
								<th>Product Title</th>
								<th class="text-center">Category</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							
                        <?php
                        function isLoggedIn(){return isset($_SESSION['userid']);}
                        if(isLoggedIn())
                        {
                            $connection=mysqli_connect('localhost','root','root','bidding')
                                or die('Error connecting to MySQL server.'.mysql_error());
                            $perNumber=6; 
                            if (isset($_GET['page'])){
    						$page=$_GET['page']; 
                            }
                            else{
                                $page=1;
                            }
                            date_default_timezone_set("Europe/London");
							$date=date("Y-m-d H:i:s");
							if(isset($_POST['search'])){
						    	$sql="SELECT count(*) FROM selling WHERE biddingenddate>'".$date."' AND itemname LIKE '%".$_POST['keyword']."%'";
						    }else if(isset($_GET['category'])){
						    	$sql="SELECT count(*) FROM selling WHERE biddingenddate>'".$date."' AND category='".$_GET['category']."'";
						    }else{
							$sql="SELECT count(*) FROM selling WHERE biddingenddate>'".$date."'";
						}
							$count=mysqli_query($connection, $sql) or die('Error validating user query.'.mysql_error());
							$rs=mysqli_fetch_array($count); 
							$totalNumber=$rs[0];
							$totalPage=ceil($totalNumber/$perNumber); 
							if (!isset($page)) {
								$page=1;
							} 
							$startCount=($page-1)*$perNumber;


						    if(isset($_POST['search'])){
						    	$query="SELECT * FROM selling INNER JOIN userinfo ON selling.userid=userinfo.userid WHERE biddingenddate>'".$date."' AND itemname LIKE '%".$_POST['keyword']."%' LIMIT $startCount,$perNumber";
						    }else if(isset($_GET['category'])){
						    	$query="SELECT * FROM selling INNER JOIN userinfo ON selling.userid=userinfo.userid WHERE biddingenddate>'".$date."' AND category='".$_GET['category']."' LIMIT $startCount,$perNumber";
						    }else{
                            $query="SELECT * FROM selling INNER JOIN userinfo ON selling.userid=userinfo.userid WHERE biddingenddate>'".$date."' LIMIT $startCount,$perNumber";
                        }
                            $data=mysqli_query($connection, $query)
                                or die('Error validating user query.'.mysql_error());
                            mysqli_close($connection);
                            while($row=mysqli_fetch_array($data))
                            {
                                echo '<tr>';
                                echo '<td class="product-thumb">';
                                    echo '<img width="80px" height="auto" src="./itemphoto/'.$row['itemid'].'.jpg" alt="image description"></td>';
                                echo '<td class="product-details">';
                                    echo '<h3 class="title">'.$row['itemname'].'</h3>';
                                    echo '<span class="add-id"><strong>Item ID:</strong>'.$row['itemid'].'</span>';
                                    echo '<span><strong>Posted on: </strong><time>'.$row['postdate'].'</time> </span>';
                                    date_default_timezone_set('Europe/London');
                                    $currentdate=date("Y-m-d H:i:s");
                                    $dayleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))/86400);
                                    $hourleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))%86400/3600);
                                    $minuteleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))%86400%3600/60);
                                    $secondleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))%86400%3600%60);
                                    if($dayleft>0)
                                        echo '<span><strong>Time left: </strong>'.$dayleft.'Days '.$hourleft.'Hours'.' </span>';
                                    else
                                        echo '<span><strong>Time left: </strong>'.$hourleft.'Hours '.$minuteleft.'Minutes '.$secondleft.'Seconds'.' </span>';
                                    echo '<span class="location"><strong>Current Price:</strong>'.$row['currentprice'].'</span>';
                                    echo '<span class="location"><strong>Seller:</strong>'.$row['username'].'</span>';
                                echo '</td>';
                                echo '<td class="product-category"><span class="categories">'.$row['category'].'</span></td>';
                                echo '<td class="action" data-title="Action">';
                                    echo '<div class="">';
                                        echo '<ul class="list-inline justify-content-center">';
                                            echo '<li class="list-inline-item">';
                                                echo '<a data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="view" href="'.'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/single.php?itemid='.$row['itemid'].'">';
                                                    echo '<i class="fa fa-eye"></i>';
                                                echo '</a>';		
                                            echo '</li>';                                            
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</td>';
                                echo '</tr>'; 
                            }
                          
						?>
                        </tbody>
					</table>
					  </div>
					</div>
					<div class="pagination justify-content-center">
						<ul class="pagination">
					<?php
					if ($page != 1) { 
                            ?>
                            	<li class="page-item"><a class="page-link" href="item.php?page=<?php echo $page - 1;?>">Prev</a></li> 
                            <?php
                            }
							for ($i=1;$i<=$totalPage;$i++) { 
							?>
							<li class="page-item <?php if($i==$page) echo "active"; ?>"><a class="page-link" href="item.php?page=<?php echo $i;?>"><?php echo $i ;?></a></li>
							<?php
							}
							if ($page<$totalPage) { 
							?>
							<li class="page-item"><a class="page-link" href="item.php?page=<?php echo $page + 1;?>">Next</a></li>
							<?php
							}
						}
					?>
				</ul>
					</div>

				</div>
			</div>
		</div>
	</section>
<!--============================
=            Footer            =
=============================-->


<footer class="footer section section-sm">
  <!-- Container Start -->
  <div class="container">
  	<h style="color: white; font-size: 40px;" > You May Also Like: </h>
  	<div class="row">
  		<?php
                        if(isLoggedIn())
                        {
                        	$connection=mysqli_connect('localhost','root','root','bidding')
                                or die('Error connecting to MySQL server.'.mysql_error());
                            
							$sql="select count(*) from selling";
							$count=mysqli_query($connection, $sql) or die('Error validating user query.'.mysql_error()); //获得记录总数
							$rs=mysqli_fetch_array($count); 
							$totalNumber=$rs[0];
							$totalPage=ceil($totalNumber/$perNumber); 
							if (!isset($page)) {
								$page=1;
							} 
							$startCount=($page-1)*$perNumber; 

                            $userid=$_SESSION['userid'];
                            
                            $query="SELECT DISTINCT itemid FROM biddinghistory WHERE username=".$userid;
                            $data=mysqli_query($connection, $query)
                                or die('Error validating user query.'.mysql_error());
                            $recmon=array();
                            $recmon[]=1;
                            while($row=mysqli_fetch_array($data)){
                            	$query="SELECT DISTINCT username FROM biddinghistory WHERE username!=".$userid." and itemid=".$row["itemid"];
                                $otherusers=mysqli_query($connection, $query) or die('Error validating user query.'.mysql_error());
                                while($row_1=mysqli_fetch_array($otherusers)){
                                	$query="SELECT DISTINCT itemid FROM biddinghistory WHERE username=".$row_1["username"];
                                	$otheritems=mysqli_query($connection, $query) or die('Error validating user query.'.mysql_error());
                                	while($row_2=mysqli_fetch_array($otheritems)){
                                		$recmon[]=$row_2["itemid"];
                                	}
                                }
                            }
                            $recmon=array_unique($recmon);


                            foreach($recmon as $id) {
                            	$query="SELECT * FROM selling WHERE biddingenddate>'".$currentdate."' itemid=".$id;
                                $data=mysqli_query($connection, $query) or die('Error validating user query.'.mysql_error());
                                
                            while($row=mysqli_fetch_array($data))
                            {
                            	echo '<div class="col-sm-12 col-lg-3 col-md-6">';

                            	echo '<div class="product-item bg-light">';
                            	echo '<div class="card recommend">';
                            	echo '<div class="thumb-content">';
                            	echo '<img class="card-img-top img-fluid " width="80px" style="margin-top: 20px;" src="./itemphoto/'.$row['itemid'].'.jpg" alt="image description"></td>';
                            	echo '</div>';
                            	echo '<div class="card-body">';
                            	echo '<a href="'.'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/single.php?itemid='.$row['itemid'].'"><h4 class="card-title" style="text-align: center;">'.$row['itemname'].'</h4></a>';
                            	date_default_timezone_set('Europe/London');
                            	$currentdate=date("Y-m-d H:i:s");
                            	$dayleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))/86400);
                            	$hourleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))%86400/3600);
                            	$minuteleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))%86400%3600/60);
                            	$secondleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))%86400%3600%60);
                            	if($dayleft>0)
                            		echo '<span><strong>Time left: </strong>'.$dayleft.'Days '.$hourleft.'Hours'.' </span><br>';
                            	else
                            		echo '<span><strong>Time left: </strong>'.$hourleft.'Hours '.$minuteleft.'Minutes '.$secondleft.'Seconds'.' </span><br>';
                            	echo '<span><strong>Current Price:</strong>$'.$row['currentprice'].'</span>';

                            	echo '</div>';
                            	echo '</div>';
                            	echo '</div>';
                            	echo '</div>';


                            }
                        }
                    }
mysqli_close($connection);
                          
		?>

  	</div>
  </div>
  <!-- Container End -->
</footer>


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

<script>
	$(document).ready(function(){
		$("#searchButton").click(function(){
			$("#searchInfo").removeClass("collapse");
		});
	});
</script>