<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';
function isLoggedIn(){return isset($_SESSION['userid']);}
if(!isLoggedIn())
{
    $URL='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.html';
    header('Location:'.$URL);
}




include 'config.php';
$conn = New mysqli($host,$username,$password,$dbname) or die($conn->connect_error);

    // send email to deleted bidder
$sql = "SELECT * FROM selling WHERE itemid='{$_GET['itemid']}' AND userid='{$_SESSION['userid']}'";
$results = $conn->query($sql) or die("database access failed:" . $conn->error);

try{
while( $row = $results->fetch_array(MYSQLI_ASSOC) ) {
    $sql = "SELECT * from userinfo WHERE userid='".$row['bidderid']."'";
    $targetmails = $conn->query($sql) or die("database access failed:" . $conn->error);
    $targetmail = $targetmails->fetch_assoc();
    $target = $targetmail['email'];
    $deletedItem=$row['itemname'];

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
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
    $mail->Subject = 'Bidding Item Deleted';
    $mail->Body    = '<h>Dear Customer:</h><p>Your item: '.$deletedItem.' has been removed by seller.</p><p>Sorry for incovienient</p><p>Regards</p><p>Market 28</p>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    

    }
} catch(Exception $e) {
    echo 'Message could not be sent. Error: ', $mail->ErrorInfo;
}
$connection=mysqli_connect('localhost','root','root','bidding')
or die('Error connecting to MySQL server.'.mysql_error());
$query="DELETE FROM selling WHERE itemid='{$_GET['itemid']}' AND userid='{$_SESSION['userid']}'";
$result=mysqli_query($connection, $query)
or die('Error deleting item where itemid='.$_GET['itemid'].'.'.mysql_error());
mysqli_close($connection);
unlink('./itemphoto/'.$_GET['itemid'].'.jpg');
$URL='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/sellingItems.php';
echo "<script type='text/javascript'>window.location.href='".$URL."'</script>";
?>