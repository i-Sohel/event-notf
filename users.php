<?php
function logged_in(){
	return (isset ($_SESSION['user_id'])) ? true : false;
}

function user_exists($email){
	$email = sanitize1($email);
	return (mysql_result(mysql_query("SELECT COUNT (`user_id`) FROM `users` WHERE `email` = '$email'"), 0) ==1) ? ture : false;
}

function user_id_from_email($email){
	$email = sanitize1($email);
	return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `email` = '$email'"), 0, 'user_id');
}

function login($email, $pass){
	$user_id = user_id_from_email($email);

	$email = sanitize1($email);
	$pass = md5($pass);

	return (mysql_result(mysql_query("SELECT COUNT (`user_id`) FROM `users` WHERE `email` = $email AND `password` = '$pass'"), 0)==1)? $user_id : false;
}

?>