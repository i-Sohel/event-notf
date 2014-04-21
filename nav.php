<ul id="navtop">
	<div id="logo">
                <h1><a href="index.php">Evento</a><h1>
        </div><!-- #logo -->
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="search.php">Search</a></li>
            <?php if(logged_in() === false){
            	echo'<li><a href="signup.php">Sign Up</a></li>';
            }?>
            <li><a href="index.php">Home</a></li>
</ul><!-- #navtop -->