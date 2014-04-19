<?php
	session_start();
	$filename = $_SESSION['data'][$_GET['id']][0] . '.mp3';
	if(file_exists($filename)) {
		header('Content-Type: audio/mpeg');
		header('Content-Disposition: filename="'.$filename.'"');
		header('Content-length: '.filesize($filename));
		header('Cache-Control: no-cache');
		header("Content-Transfer-Encoding: chunked"); 
		readfile($filename);
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>