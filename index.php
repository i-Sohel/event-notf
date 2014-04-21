<!DOCTYPE HTML>
<html>
<?php include 'init.php';?>
<?php include 'head.php';?>
<body>
<div class="wrapper">
<?php include 'header.php';?>
<?php include 'slider.php';?>
<div id="content">
  	<?php include 'ev_con.php';?>
  	<?php include 'sidebar.php';?>
</div><!--- #content -->
<?php include 'footer.php';?>
</div>
<script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider();
});

function NoWordWritten() 
 {  var uname = document.forms["login_form"]["login[email]"].value;
    var pwd = document.forms["login_form"] ["login[password]"].value;
 if ( uname = null || pwd= null )
   { alert("please, write UserName and password ")
    return false;
    }
 }

</script>

</body>
</html>