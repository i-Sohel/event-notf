<!DOCTYPE HTML>
<html>
<?php 
include 'init.php';
include 'head.php';

if(empty($_POST)===false){
    $required = array('first_name', 'email', 'conf_email','password', 'conf_password');
    foreach ($_POST as $key => $value) {
        if(empty($value)&& in_array($key, $required) === true){
            $errors[] = 'fields with marks are required';
            break 1;
        }
    }

    if(empty($errors) === true){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
            $errors[] = 'Your email is not vaild!';
        }
        if(user_exists($_POST['email']) === true){
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
<?php include 'header.php' ;?>
<div id="content">
    <h1 class="content_h1">Sign Up</h1>
    <br />
    <?php 
    if (isset($_GET['success']) && empty($_GET['success']))
    {
        echo 'Thank you for registring with us !';
    }else{
    if(empty($_POST)=== false && empty($errors) === true){
        $register_data = array(
            'email' => $_POST['email'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'password' => $_POST['password'],

            );
        register_user($register_data);
        header('Location: signup.php?success');
        exit();

    } else if (empty($errors) === false){
        echo output_errors($errors);
    }
    ?>
    <br />
    <div id="signup_form">
        <p>Please fill the form below</p>
    <form method="POST" action="">
            <input id="signup_firstname" name="first_name" placeholder="First name*" size="30" type="text"><br />
            <input id="signup_lastname" name="last_name" placeholder="Last name" size="30" type="text"><br />
            <input id="signup_email" name="email" placeholder="Email Address*" size="30" type="text"><br />
            <input id="signup_email" name="conf_email" placeholder="Confirm Email*" size="30" type="text"><br />
            <input id="signup_password" name="password" placeholder="Password*" size="30" type="password"><br />
            <input id="signup_password" name="conf_password" placeholder="Confirm Password*" size="30" type="password">
    <div align="center">
    </form>
    <p><input class="button" type="submit" value="Sign Up" /></p>
    <p>By clicking "Sign up", I confirm that I agree with the Evento <a href="#">terms of service</a> and <a href="#">privacy policy</a>.
   </div>
</div>
</div>
<?php 
}
include 'footer.php';?>
</body>
</html>