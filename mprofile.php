<!DOCTYPE HTML>
<html>
<?php 
include 'init.php';
include 'head.php';

if(empty($_POST)===false){
    $required = array('first_name', 'email','password', 'conf_password');
    foreach ($_POST as $key => $value) {
        if(empty($value)&& in_array($key, $required) === true){
            $errors[] = 'fields with marks are required';
            break 1;
        }
    }

    if(empty($errors) === true){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
            $errors[] = 'Your email is not vaild!';
        }else if(user_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']){
             $errors[] = 'You are allready registered in that email';
        }
        if(preg_match("/\\s/", $_POST['email']) == true){
            $errors[] = 'Your email must not contain any space';
        }
        if(strlen($_POST['password']) < 6){
            $errors[] = 'Your password must be greter than 6 charecters';
        }
        if($_POST['password'] !== $_POST['conf_password']){
            $errors[] = 'Your passwords do not match';
        }
    }
}


?>
<body>
<div class="wrapper">
<?php include 'header.php';?>
<div id="content">
    <br /><h1>Update Profile</h1>
    <div id="updatedata_form">
        <?php
        if (isset($_GET['success']) === true && empty($_GET['success']) === true)
        {
            echo 'Your data has been updated!';
        }else{
        if(empty($_POST) === false && empty($errors) === true){
            $update_data = array(
                'email' => $_POST['email'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'password' => $_POST['password'],
            );
            update_user($update_data);
            header('Location: mprofile.php?success');
            exit();


        }else if(empty($errors) === false){
            echo output_errors($errors);
        }

    ?><br />
    <form method="POST" action="">
            <input id="signup_firstname" name="first_name" placeholder="First name*" size="30" type="text" value="<?php echo $user_data['first_name'];?>"><br />
            <input id="signup_lastname" name="last_name" placeholder="Last name" size="30" type="text" value="<?php echo $user_data['last_name'];?>"><br />
            <input id="signup_email" name="email" placeholder="Email Address*" size="30" type="text"value="<?php echo $user_data['email'];?>"><br />
            <input id="signup_password" name="password" placeholder="Password*" size="30" type="password" value="<?php echo $user_data['password'];?>"><br />
            <input id="signup_password" name="conf_password" placeholder="Confirm Password*" size="30" type="password" value="<?php echo $user_data['password'];?>">
    </form>
    <p><input class="button" type="submit" value="update" /></p>
    <?php }?>
<?php include 'sidebar.php';?>
</div><!--- #content -->
</div>
</div>
<?php include 'footer.php';?>
</body>
</html>