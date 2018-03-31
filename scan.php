<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

ignore_user_abort(); //run when web is closed
set_time_limit(0); // no time limit
$interval = 60*60; // interval is 1h

while(true){
sleep($interval); // sleep for time of interval, scan database per 1 hour

include 'config.php';

$conn = New mysqli($host,$username,$password,$dbname) or die($conn->connect_error);

date_default_timezone_set("Europe/London");
$date=date("Y-m-d H:i:s");

$sql = "SELECT * from selling WHERE biddingenddate<'".$date."' and confirm=0";
$results = $conn->query($sql) or die("database access failed:" . $conn->error);



while( $row = $results->fetch_array(MYSQLI_ASSOC) ) {
$sql = "SELECT * from userinfo WHERE userid='".$row['bidderid']."'";
$itemname=$row['itemname'];
$targetmails = $conn->query($sql) or die("database access failed:" . $conn->error);
$targetmail = $targetmails->fetch_assoc();
$targetbidder = $targetmail['email'];

$sql = "SELECT * from userinfo WHERE userid='".$row['userid']."'";
$targetmails = $conn->query($sql) or die("database access failed:" . $conn->error);
$targetmail = $targetmails->fetch_assoc();
$targetseller = $targetmail['email'];

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
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
    $mail->addAddress($targetbidder);     // Add a recipient
    $mail->addAddress($targetseller);               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Bidding Item Report';
    $mail->Body    = '<h>Dear Customer: </h><p>Your bidding for item: '.$itemname.' is succeed. Congratulations.</p><p>Regards</p><p>Market 28</p>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    $query="UPDATE selling SET confirm=1 WHERE itemid=".$row['itemid'];
    $result=$conn->query($query) 
        or die('Error deleting item where itemid='.$_GET['itemid'].'.'.mysql_error());




}
}

?>