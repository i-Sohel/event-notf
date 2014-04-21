<!DOCTYPE HTML>
<html>
<?php include 'init.php';?>
<?php include 'head.php';?>
<body>
<div class="wrapper">
<?php include 'header.php';?>
<div id="content">
    <h1 class="content_h1">Search</h1>
    <form action="" method="POST">
    <input id="search" name="search" placeholder="Search" size="30" type="text">
    <input class="button" type="submit" value="Search"/><br />
    </form>


    <?php
        if(isset($_POST['search'])){
            $keywords = trim($_POST['search']);

            if(empty($keywords)){
                $errors[] = 'Please enter a keywords';
            }else if (strlen($keywords)<3){
                $errors[] = 'Your search term must be at least 3 or greater';
            } else {
                $errors[] = 'no result found';
            }

            if (empty($errors)){
                search_results($keywords);
            } else {
                echo output_errors($errors);
            }
        }

    ?>

    <?php include 'sidebar.php';?>
</div><!--- #event -->
</div>
<?php include 'footer.php';?>
</div>

</body>
</html>