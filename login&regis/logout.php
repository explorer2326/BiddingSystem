<?php 
require_once 'init.php';

$user = new User();
$user ->logout();

header('Location: login.php');