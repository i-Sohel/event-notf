<?php 
include 'init.php';
include 'head.php';

if(empty($_POST)===false){
    $required = array('event_title', 'event_des', 'event_place','event_date', 'event_detail');
    foreach ($_POST as $key => $value) {
        if(empty($value)&& in_array($key, $required) === true){
            $errors[] = 'fields with marks are required';
            break 1;
        }
    }
}

?>

<body>
<div class="wrapper">
<?php include 'header.php';?>
<div id="content">
    <h1 class="content_h1">Create Event</h1>
    <?php 
    if (isset($_GET['success']) && empty($_GET['success']))
    {
        echo 'Thank you your event has been added !';
    }else{
    if(empty($_POST)=== false && empty($errors) === true){
        $event_data = array(
            'user_id' => $session_user_id,
            'event_title' => $_POST['event_title'],
            'event_des' => $_POST['event_des'],
            'event_place' => $_POST['event_place'],
            'event_date' => $_POST['event_date'],
            'event_detail' => $_POST['event_detail'],

            );
        new_event($event_data);
        header('Location: create.php?success');
        exit();

    } else if (empty($errors) === false){
        echo output_errors($errors);
    }
    ?>
    <form action="" method="POST">
        <input id="event_title" name="event_title" placeholder="Event Title" size="60" type="text"><br />
        <input id="event_des" name="event_des" placeholder="Event description" size="60" type="text"><br />
        <input id="event_des" name="event_place" placeholder="Event Place" size="60" type="text"><br />
         <input id="event_des" name="event_date" placeholder="Event date DD/MM/YYYY" size="60" type="text"><br />
        <textarea placeholder="Event Details" name="event_detail" style="width:425px; height:120px;"></textarea><br />
        <p><input class="button" type="submit" value="Submit" /></p>
    </form>
    <?php } ?>
    <?php include 'sidebar.php';?>
</div>

</div>
<?php include'footer.php';?>