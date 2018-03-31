<?php
session_start();
function isLoggedIn(){return isset($_SESSION['userid']);}

if(!isLoggedIn())
{
  $URL='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.html';
  header('Location:'.$URL);
}
?>

<?php
include 'config.php';
$conn = New mysqli($host,$username,$password,$dbname) or die($conn->connect_error);
$itemid=$_GET['itemid'];
date_default_timezone_set('Europe/London');
$reviewdate=date("Y-m-d");

$sql = "SELECT * FROM feedback WHERE userid=".$_SESSION["userid"]." and itemid=".$itemid;
$result=$conn->query($sql);
$rownumber=$result->num_rows;

if (isset($_POST['add'])) {
  if($rownumber==0){
    $sql = "INSERT INTO feedback (userid, itemid, score, message, reviewdate) VALUES ('".$_SESSION["userid"]."', 
    '".$itemid."', '".$_POST["score"]."', 
    '".$_POST["review"]."', '".$reviewdate."')";
    if ($conn->query($sql) === TRUE) {
      // echo "New record is added successfully";
      echo "<script type='text/javascript'>window.location.href='single.php?itemid=".$itemid."'</script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }else{
    $sql = "UPDATE feedback SET score='".$_POST["score"]."', message='".$_POST["review"]."', reviewdate='".$reviewdate."' WHERE userid=".$_SESSION["userid"]." and itemid=".$itemid;
    if ($conn->query($sql) === TRUE) {
      // echo "New record is updated successfully";
      echo "<script type='text/javascript'>window.location.href='single.php?itemid=".$itemid."'</script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}


?>
