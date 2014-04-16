<?php
	session_start();
	header('Content-type: application/json');

	/*$con = mysql_connect('localhost','root','mysql');
	$db= mysql_select_db('ajax', $con);
	$sql = "SELECT * from results";
	$result = mysql_query($sql,$con);
	for($i = 0; $i < mysql_num_rows($result); $i++) {
		$row[$i] = mysql_fetch_row($result);
	}*/

	$i = 0;
	foreach($_SESSION['data'] as $song) {
		if($song[1] != $_POST['data'][$i]) {
			$response_array['wrong'][$i] = 1; //wrong
		} else {
			$response_array['wrong'][$i] = 0; //right
		}
		$i++;
	}
	echo json_encode($response_array);
?>