<?php 
include 'init.php';
include 'head.php';

if(empty($_POST)=== false){
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if(empty($email) === true || empty($subject) === true || empty($message) === true){
        $errors[] = 'Email , subject and message are required!' ;

    } else {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $errors[] = 'Your email is not valid!';
        }

    }

    if(empty($errors) === true){
        mail('sohel@sohel.ws', 'Contact form' , $message, 'From:'.$email);
        header('Location:contact.php?sent');
        exit();
    }
}
?>
<body>
<div class="wrapper">
<?php include 'header.php';?>
<div id="content">    <h1 class="content_h1">Contact Us</h1>
    <?php if(isset($_GET['sent']) === true){
        echo '<br /><p> Thank your for contacting with us!</p>';
    } else {
        echo output_errors($errors);
        ?>
    <form action="" method="POST">
        <input id="signup_email" name="email" placeholder="Email Address" size="30" type="text"><br />
        <input id="signup_email" name="subject" placeholder="Subject" size="30" type="text"><br />
        <textarea placeholder="message" name="message" style="width:425px; height:120px;"></textarea><br />
        <p><input class="button" type="submit" value="Send" /></p>
    </form>
    <?php } ?>
</div>

</div>

