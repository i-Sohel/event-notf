<!DOCTYPE HTML>
<html>
<?php include 'init.php';?>
<?php include 'head.php';?>
<body>
<div class="wrapper">
<?php include 'header.php';?>
<div id="content">
    <h1 class="content_h1">Manage Events</h1>
    <div id="event">
        <?php
$query="SELECT * FROM `events`WHERE `user_id` = '$session_user_id' ORDER BY `event_id` DESC";
$result=mysql_query($query);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$event_id=mysql_result($result,$i,"event_id");
$event_title=mysql_result($result,$i,"event_title");
$event_des=mysql_result($result,$i,"event_des");
$event_place=mysql_result($result,$i,"event_place");
$event_date=mysql_result($result,$i,"event_date");
$event_detail=mysql_result($result,$i,"event_detail");
  echo '
        <table class="event_list">
            <tr>
                <td class="date" rowspan="4">',$i+1,'<br /></td></tr>
            <tr>
                <td class="event_info">
                    <a href="editev.php?p=',$event_id,'"><h3>',$event_title,'</h3></a>
                    <p class="event_cat">',$event_des,'</p>
                    <table id="inner_info">
                        <tr><th><strong>When:</strong></th><td>',$event_place,'</td></tr>
                        <tr><th><strong>&nbsp;Where:</strong></th><td>',$event_date,'</td></tr>
                    </table><!--- #inner-info -->
                </td>
            </tr>
        </table><!--- .event_list -->';

$i++;
} 
?>
    </div><!--- #event -->
   <?php include 'sidebar.php';?>
</div>

</div>

</body>
</html>