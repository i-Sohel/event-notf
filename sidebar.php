<aside id="right_bar">
	<?php 
	if(logged_in() === true)
	{
		include 'loggedin.php';
	}
	else {
		include 'wedgits/login.php';
	}
	?>
 </aside>