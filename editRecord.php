<?php
	include 'config.php';
?>

<?php
	$conn = New mysqli($host,$username,$password,$dbname) or die($conn->connect_error);
    $id = $_GET['id'];
    $pw = $conn->query("SELECT password FROM userinfo WHERE userid=".$id);

	if (isset($_POST['update'])) {
		$sql = "UPDATE userinfo SET username = '".$_POST["name"]."', password = '".$_POST["pw"]."' WHERE userid ='".$id."'";
        if ($conn->query($sql) === TRUE)
        {
            echo "<script type='text/javascript'>window.location.href='showUser.php'</script>";
        } else {
            echo $conn->error;
        }
    }
    else {
        $sql = "SELECT * FROM userinfo WHERE userid = '".$id."'";
        $results =$conn->query($sql) or die ('request "Could not execute the SQL query" '.$sql);
        if ($results-> num_rows!=0)
        {
            $row = $results->fetch_assoc();
            $name = $row['username'];
            $pw = $row['password'];
        }
    }
?>

<!doctype html>
<html lang="en">
<body>
    <form method="post">
		<label for="name">User Name</label>
		<input type="text" name="name" id="name" value="<?php echo $name ?>"> <br>

		<label for="pw">Password</label>
		<input type="text" name="pw" id="pw" value="<?php echo $pw ?>"> <br>


		<input type="submit" name="update" value="Update">
	</form>
</body>
