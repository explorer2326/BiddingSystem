<?php
require 'config.php';
$conn = New mysqli($host,$username,$password,$dbname) or die($conn->connect_error);

if(isset($_POST["deleteRecord"]))
{   
$id=$_GET['id'];
$sql="DELETE FROM userinfo WHERE userid= '".$id."'";
if ($conn->query($sql) === TRUE){
            header("Location: showUser.php");
} else {
            echo $conn->error;
}
}
?>


<!doctype html>
<html lang="en">
<body>
    <form method="post">
		<label for="name">Name</label>
		<input type="text" name="name" id="name"> <br>

		<label for="pw">Password</label>
		<input type="text" name="pw" id="pw"> <br>


		<input type="submit" name="add" value="Add">
	</form>
</body>
