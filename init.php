<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require 'config.php';
require 'function.php';
if(logged_in() === true){
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id,'email', 'first_name', 'last_name', 'password');
}

$errors = array();
?>