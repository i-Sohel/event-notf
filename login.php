<?php include 'init.php';?>
<?php include 'head.php';?>
<?php
if (empty($_POST)=== false) {
	$email= $_POST['email'];
	$pass= $_POST['pass'];
	
	if(empty($email)===true || empty($pass)===true){
		$errors[] = 'You need to enter user name and pass word';
	} else if (user_exists($email) === false){
		$errors[] = 'Your user name is not in our database';
	}
	else {
		$login = login($email, $pass);
		if ($login === false){
			$errors[] = 'That username/password is incorrect';
		} else{
			$_SESSION['user_id'] = $login;
			header ('Location: index.php');
			exit();
		}
	}
}

?>
<div class="wrapper">
<?php include 'header.php';?>
<div id="content">
<?php echo output_errors($errors);?>
</div><!--- #content -->
<?php include 'footer.php';?>
</div>
</body>