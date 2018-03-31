<?php
require_once 'init.php';

if(Session::exists('home')) {
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()) {
?>
	<p>Hello <a href="#"><?php echo escape($user->data()->name); ?></a>!</p>

	<p> <?php echo escape($user->data()->userid); ?> </p>

	<ul>
		<li><a href="update.php">Update details</a></li>
		<li><a href="logout.php">Log out</a></li>
	</ul>

<?php
	if($user->hasPermission('admin')){
		echo '<p>You are an administrator!</p>';
	}

} else {
	echo '<p>You need to <a href="login.php">log in or <a href="registration.php">register</a></p>';
}