<?php
function array_sanitize(&$item){
	$item = mysql_real_escape_string($item);

}
function sanitize1 ($data){
	return mysql_real_escape_string($data);
}
function logged_in(){
	return (isset ($_SESSION['user_id'])) ? true : false;
}

function user_exists($email){
	$email = sanitize1($email);
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'"), 0)==1) ? true : false;
}

function user_id_from_email($email){
	$email = sanitize1($email);
	return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `email` = '$email'"), 0, 'user_id');
}

function login($email, $pass){
	$user_id = user_id_from_email($email);

	$email = sanitize1($email);
	$pass = md5($pass);

	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `password`= '$pass'"), 0)==1)? $user_id : false;
}

function output_errors($errors){
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}

function user_data($user_id){
	$data = array();
	$user_id = (int)$user_id;

	$func_num_args = func_num_args();
	$func_get_args = func_get_args();

	if($func_num_args > 1){
		unset($func_get_args[0]);

		$fields = '`'.implode('`, `', $func_get_args).'`';
		$data = mysql_fetch_array(mysql_query("SELECT $fields FROM `users` WHERE `user_id` = $user_id"));
		return $data;
	}

}

function register_user($register_data){
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data ='\'' . implode('\',\'', $register_data) . '\'';

	mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
}

function update_user($update_data){
	global $session_user_id;
	$update = array();
	array_walk($update_data, 'array_sanitize');

	foreach ($update_data as $field => $data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}

	mysql_query("UPDATE `users` SET ". implode(', ', $update) . "WHERE `user_id` = $session_user_id");
}

function new_event($event_data){
	array_walk($event_data, 'array_sanitize');
	$fields = '`' . implode('`, `', array_keys($event_data)) . '`';
	$data ='\'' . implode('\',\'', $event_data) . '\'';
//	exit("INSERT INTO `events` ($fields) VALUES ($data)");
	mysql_query("INSERT INTO `events` ($fields) VALUES ($data)");

}

function update_event($event_id,$event_title,$event_des,$event_place,$event_date,$event_detail){
	//exit("UPDATE `events` SET `event_title` = '$event_title' AND `event_des` = '$event_des' and `event_place` = '$event_place' and `event_date` = '$event_date' and `event_detail` = '$event_detail' WHERE `event_id` = $event_id");
	mysql_query("UPDATE `events` SET `event_title` = '$event_title' , `event_des` = '$event_des' , `event_place` = '$event_place' , `event_date` = '$event_date' , `event_detail` = '$event_detail' WHERE `event_id` = $event_id");
}

function event_data($event_id){
	$data = array();
	$event_id = (int)$event_id;

	$func_num_args = func_num_args();
	$func_get_args = func_get_args();

	if($func_num_args > 1){
		unset($func_get_args[0]);

		$fields = '`'.implode('`, `', $func_get_args).'`';
		$data = mysql_fetch_array(mysql_query("SELECT $fields FROM `events` WHERE `event_id` = $event_id"));
		return $data;
	}

}

function check_attend($user_id, $event_id)
{
	$query = mysql_query("SELECT count(*) as results_number FROM `attend` WHERE `user_id` = $user_id AND `event_id` = $event_id");
	$result = mysql_fetch_assoc($query);
	if ($result['results_number'] == 0){
		return false;
	}else {
		return true;
	}
}
function attend($user_id,$event_id){
	$query = mysql_query("INSERT INTO `attend` (`event_id`,`user_id`) VALUES ('$event_id','$user_id')");

}

function search_results($keywords){

$query="SELECT * FROM `events` WHERE `event_title` LIKE '%$keywords%' ORDER BY `event_id` DESC";
$result=mysql_query($query);
if(mysql_query($query) == true){
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
return true;
}else return false;
}
?>