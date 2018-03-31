<?php session_start();
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// require 'vendor/autoload.php';
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("p").hide();
    });
    $("#show").click(function(){
        $("p").show();
    });
});
</script>
<style>
    .submitbut{
        margin-top: 20px;
        width: 150px;
        height:50px;
    }
    .price-form{
        width: 150px;
        margin-left: 70px;
    }
    .singleimage{
        height: 500px;
        margin-left: auto;
        margin-right: auto;
    }
.biddingtable thead, .biddingtable tbody { display: block; }

.biddingtable tbody {
    height: 200px;
    display: inline-block;
    width: 100%;
    overflow: auto;
}
</style>
<body class="body-wrapper">
        <?php
      
    ob_start();


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
<!--===================================
=            Store Section            =
====================================-->
     <?php
      //关闭错误报告
      if(isLoggedIn())
                        {
                            $connection=mysqli_connect('localhost','root','root','bidding')
                                or die('Error connecting to MySQL server.'.mysql_error());
          
                            $query="SELECT * FROM selling WHERE itemid='{$_GET['itemid']}'";
                            $data=mysqli_query($connection, $query)
                                or die('Error validating user query.'.mysql_error());
          
//    echo "<script>alert('connected');</script>";
                           
          
      }
          
             ?>              
  
<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
            <?php
      //关闭错误报告
      if(isLoggedIn())
                        {
                            $connection=mysqli_connect('localhost','root','root','bidding')
                                or die('Error connecting to MySQL server.'.mysql_error());
          
                            $query="SELECT * FROM selling WHERE itemid='{$_GET['itemid']}'";
                            $data=mysqli_query($connection, $query)
                                or die('Error validating user query.'.mysql_error());
                            $row=mysqli_fetch_array($data);
                            //viewing traffice counter
                            $currentviewing=$row['viewing']+1;
                            $sql=mysqli_query($connection, "UPDATE selling SET viewing = '$currentviewing' WHERE itemid='{$_GET['itemid']}' ");
                    
			                 echo'<div class="col-md-8">';
				                echo'<div class="product-details">';
					               echo'<h1 class="product-title">'.$row['itemname'].'</h1>';
					                   echo'<div class="product-meta">';
						                      echo'<ul class="list-inline">';
                                                $ui = $row['userid'];
                                              
                                                $query1="SELECT * FROM userinfo WHERE userid='$ui'";
                                                $data1=mysqli_query($connection, $query1)
                                                    or die('Error validating user query.'.mysql_error());
                                                $rowuser=mysqli_fetch_array($data1);
							                     echo'<li class="list-inline-item"><i class="fa fa-user-o"></i> By '.$rowuser['username'].'</li>';
							                     echo'<li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Category'.$row['category'].'</li>';
                                                 echo'<li class="list-inline-item"><i class="fa fa-calendar"></i> post time'.$row['postdate'].'</li>';
                                                 echo'<li class="list-inline-item"><i class="fa fa-eye"></i> viewing traffic'.$row['viewing'].'</li>';
         
						                      echo'</ul>';
					                   echo'</div>';
                                    echo'<div id="carouselExampleIndicators" class="product-slider carousel slide" data-ride="carousel">';
                            echo'<div class="carousel-inner">';
                            echo'<div class="carousel-item active">';
								    echo'<img class="d-block singleimage" src="./itemphoto/'.$row['itemid'].'.jpg" alt="First slide">';
							echo' </div>';
                        echo'</div>'; 
                    echo'</div>';
                  }   
      
			?>
					<div class="content">  
						<ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Product Details</a>
							</li>
							 
							<li class="nav-item">
								<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Reviews</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">Product Description</h3>
                                <?php
								echo'<p>'.$row['description'].'</p>';
                                ?>
								
						
							

							</div>
								<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
						<h3 class="tab-title">Product Review 
							<?php
							include 'config.php';
							$conn = New mysqli($host,$username,$password,$dbname) or die($conn->connect_error);
							$sql="SELECT AVG(score) AS avg FROM feedback WHERE itemid=".$_GET['itemid'];
							$result=$conn->query($sql);
							$rowfb=$result->fetch_assoc();
							if($rowfb["avg"]!=null){
								$avg=round($rowfb["avg"]);
								echo '<div class="ratings">';
								echo '<ul class="list-inline">';
								echo '<span style="margin-right: 30px;">Overall Scores: </span>';
								for ($x=1; $x<=$avg; $x++){
									echo '<li class="list-inline-item">';
									echo '<i class="fa fa-star"></i>';
									echo '</li>';
								}

								echo '</ul>';
								echo '</div>';
							}
							?>
						</h3>
						<div class="product-review">
							<?php
							$sql="SELECT * FROM feedback WHERE itemid=".$_GET['itemid'];
							$result=mysqli_query($connection, $sql);
							while($rowfeedback=mysqli_fetch_array($result)){
								$namesql="SELECT * FROM userinfo WHERE userid=".$rowfeedback['userid'];
								$nameresult=mysqli_query($connection, $namesql);
								$namerow=mysqli_fetch_array($nameresult);
								$name=$namerow['username'];

								$scoresql="SELECT score FROM feedback WHERE itemid=".$_GET['itemid']." AND userid=".$rowfeedback['userid'];
								$scoreresult=$conn->query($scoresql);
							    $scorerow=$scoreresult->fetch_assoc();

								echo '<div class="media">';
								echo '<div class="media-body">';
								echo '<div class="name">';
								echo '<h5>'.$name.'</h5>';
								for ($x=1; $x<=$scorerow["score"]; $x++){
									echo '<li class="list-inline-item">';
									echo '<i class="fa fa-star"></i>';
									echo '</li>';
								}
								echo '</div>';
								echo '<div class="date">';
								echo '<p>'.$rowfeedback['reviewdate'].'</p>';
								echo '</div>';
								echo '<div class="review-comment">';
								echo '<p>'.$rowfeedback['message'].'</p>';
								echo '</div>';
								echo '</div>';
								echo '</div>';
							}
							?>

							<div class="review-submission">
								<h3 class="tab-title">Submit your review</h3>
								<!-- Rate -->
								<form action=<?php echo "addFeedback.php?itemid=".$_GET['itemid'];?> method="post">
									<div class="rate">
										<span style="margin-right: 20px;"><strong>Score the Item:  </strong></span>
										<select name="score"><option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option></select>
										</div>
										<div class="review-submit">
											<div class="col-12">
												<textarea name="review" id="review" rows="10" class="form-control" placeholder="Message"></textarea>
											</div>
											<div class="col-12">
												<input class="btn btn-main" name="add" type="submit" value="Submit">
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="widget price text-center">
                        <?php
						echo'<h4>Current Price</h4>';
						echo'<p>$'.$row['currentprice'].'</p>';
                        echo'<h4>Starting Price</h4>';
						echo'<p>$'.$row['startingprice'].'</p>';
                        echo'<h4>Time Left</h4>';
                        date_default_timezone_set('Europe/London');
                        $currentdate=date("Y-m-d H:i:s");
                        $dayleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))/86400);
                        $hourleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))%86400/3600);
                        $minuteleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))%86400%3600/60);
                        $secondleft=floor((strtotime($row['biddingenddate'])-strtotime($currentdate))%86400%3600%60);
                        if($dayleft>0 ||$hourleft>0||$minuteleft>0||$secondleft>0){
                        if($dayleft>0){
                            echo '<p>'.$dayleft.'Days '.$hourleft.'Hours'.' </p>';
                        }
                        else{
                             echo '<p>'.$hourleft.'Hours '.$minuteleft.'Minutes '.$secondleft.'Seconds'.' </p>';
                        }
                        }
                           else{
                               echo '<p>Bid Ended</p>';
                           }
					echo'</div>';
                            ?>
					<!-- User Profile widget -->
					<div class="widget user">
						<img class="rounded-circle" src="images/usericon.png" alt="">
                        <?php
						echo'<h4>'.$rowuser['username'].'</h4>';
                        	?>
						<p class="member-time">Member Since <?php echo $_SESSION['joined']?></p>
					<ul class="list-inline mt-20">
				<?php
                          
                        $itemid=$_GET['itemid'];
                            echo'<form enctype="multipart/form-data" method="post" action="single.php?itemid='.$itemid.'" name="addNewSellingItem">';
                      
                          
                              echo'<input type="text" name="newbiddingprice" class="form-control price-form" placeholder="price">';
                          echo'<input type="submit" value="Make an offer" class="submitbut" name="submit">';
                            echo'</form>';
             
				          $currentbidder=$_SESSION['userid'];
                          $currentseller = $rowuser['userid'];
                          if (isset($_POST['submit'])  ){
                            $nbp=$_POST['newbiddingprice'];
                           $bidderid=$_SESSION['userid'];
                            $reserveprice=$row['reserveprice'];
                             if($dayleft>0 ||$hourleft>0||$minuteleft>0||$secondleft>0){
                              if ($nbp>$row['currentprice'] ){   
                               if($currentbidder !=$currentseller){

								$result=mysqli_query($connection, "SELECT *  FROM selling WHERE itemid='{$_GET['itemid']}'");
								$row = $result->fetch_assoc();
								$overBidItem=$row['itemname'];
								$sql = "SELECT * from userinfo WHERE userid='".$row['bidderid']."'";
								$targetmails = $connection->query($sql) or die("database access failed:" . $connection->error);
								$targetmail = $targetmails->fetch_assoc();
								$target = $targetmail['email'];
								$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
								try{
    $mail->SMTPDebug = false;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'testchizhimeng@gmail.com';                 // SMTP username
    $mail->Password = 'Qwerty12';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('testchizhimeng@gmail.com');
    $mail->addAddress($target);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Your Item :'.$overBidItem.' is out bid';
    $mail->Body    = '<h>Dear Customer: </h><p>Your item :'.$overBidItem.' has been overbidden by another user.</p><p>Regards</p><p>Market 28</p>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send(); }catch(Exception $e){
    	echo 'Message could not be sent. Mailer Error: ',$mail->ErrorInfo;
    }
               

                            $result=mysqli_query($connection, "UPDATE selling SET currentprice='$nbp', bidderid='$bidderid' WHERE itemid='{$_GET['itemid']}'")
                                or die('Error making saveToDatabase query.'.mysql_error());
                            date_default_timezone_set('Europe/London');
                            $postdate=date("Y-m-d H:i:s");    
                            $result1=mysqli_query($connection,"INSERT INTO biddinghistory (username,itemid,biddingprice,biddingdate) VALUES ('{$_SESSION['userid']}','{$_GET['itemid']}','$nbp','{$postdate}')")
                                or die('Error making saveToDatabase query.'.mysql_error());
                          
                             }
                                else{
                                    echo "<script>alert('you cannot bid on your onw item');</script>"; 
                                }
                            }
                              else{
                                  echo "<script>alert('you have to insert a higer price');</script>";
//                                  echo "<script>javascript: alert('you have to insert a higer pricex')></script>";
                                  //  $errorMessage='Please enter starting price';
                              }
                          }
                                else{
                             echo "<script>alert('the bid has already ended');</script>";
                        }
                          }
                      
                       
						echo'</ul>';
					echo'</div>';
                    
                     
                        ?>
					<!-- Map Widget -->
					<div class="widget biddingtable">
						
                                <h4>bidding history</h4>
                    <?php
                        $connection=mysqli_connect('localhost','root','root','bidding')
                                or die('Error connecting to MySQL server.'.mysql_error());
          
                            $sqlquery="SELECT * FROM biddinghistory WHERE itemid='{$_GET['itemid']}'";
                            $data=mysqli_query($connection, $sqlquery)
                                or die('Error validating user query.'.mysql_error());
                               echo'<table>';
                        echo'<col width="400">';
                         echo'<col width="100">';
                         echo'<col width="100">';
                         echo'<tr>';
                             echo'<th>bidding date</th>';
                             echo'<th>name</th>';
                             echo'<th>price</th>';
                       echo'</tr>';
                        while($rowhistory=mysqli_fetch_array($data)){
                     
                       echo'<tr>';
                    $ui = $rowhistory['username'];
                                              
                                                $query2="SELECT * FROM userinfo WHERE userid='$ui'";
                                                $data1=mysqli_query($connection, $query2)
                                                    or die('Error validating user query.'.mysql_error());
                                                $rowuser=mysqli_fetch_array($data1);
                         echo'<td>'.$rowhistory['biddingdate'].'</td>';
                         echo'<td>'.$rowuser['username'].'</td>';
                         echo'<td>'.$rowhistory['biddingprice'].'</td>';
                       echo'</tr>';
 }
                        echo'</table>';
                       
                        ?>
					</div>
					<!-- Rate Widget -->
<!--
					<div class="widget rate">
				
						<h5 class="widget-header text-center">What would you rate
						<br>
						this product</h5>
					
						<div class="starrr"></div>
					</div>
-->
		
				
					
				</div>
			</div>
			
		</div>
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