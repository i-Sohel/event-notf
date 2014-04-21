<div id="ev_con">
    <div id="event">
<?php

if(empty($_GET['p'])){
    $query="SELECT * FROM `events` ORDER BY `event_id` DESC";
$result=mysql_query($query);
?><h1 class="content_h1">Latest Events</h1><?php
while ($row = mysql_fetch_array($result)) {
$event_id = $row['event_id'];
$event_title = $row['event_title'];
$event_des = $row['event_des'];
$event_place = $row['event_place'];
$event_date = $row['event_date'];
$event_detail = $row['event_detail'];


  echo '
        <table class="event_list">
            <tr>
                <td class="date" rowspan="4"><br /></td></tr>
            <tr>
                <td class="event_info">
                    <a href="?p=',$event_id,'"><h3>',$event_title,'</h3></a>
                    <p class="event_cat">',$event_des,'</p>
                    <table id="inner_info">
                        <tr><th><strong>When:</strong></th><td>',$event_place,'</td></tr>
                        <tr><th><strong>&nbsp;Where:</strong></th><td>',$event_date,'</td></tr>
                    </table><!--- #inner-info -->
                </td>
            </tr>
        </table>
        <div id="event_clear"></div>
        <!--- .event_list -->';

} 
}else{
    $p = $_GET['p'];
    $query .= sprintf('SELECT * FROM `events` where event_id=%s ORDER BY `event_id` DESC',intval($p));
    $event = mysql_query($query);
    $details = mysql_fetch_assoc($event);
    echo'
    <h1 class="content_h1">'.$details[event_title].'</h1>
<table class="event_list">
            <tr>
                <td class="date" rowspan="4"><br /></td></tr>
            <tr>
                <td class="event_info">
                    <p class="event_cat">'.$details[event_des].'</p>
                    <table id="inner_info">
                        <tr><th><strong>When:</strong></th><td>'.$details[event_date].'</td></tr>
                        <tr><th><strong>&nbsp;Where:</strong></th><td>'.$details[event_place].'</td></tr>
                        <tr><th><strong>&nbsp;Details:</strong></th><td>'.$details[event_detail].'</td></tr>
                    </table><!--- #inner-info -->
                </td>
            </tr>
        </table><!--- .event_list -->';
        if (check_attend($session_user_id,$details[event_id])){
            ?>
            <br />
            <p>Marked!</p>
            <?php
        }else{
            ?>
            <p><a class="button" href="index.php?p=<?php echo $p ?>&attend_request=1">Attend</a></p>
            <?php
            if($_GET['attend_request']== true){
            attend($session_user_id,$details[event_id]);
            header("Location: index.php?p=$p&attend_request=1");
            exit();
        }
        }

}

?>
</div><!--- #event -->
</div>