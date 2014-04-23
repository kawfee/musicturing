<?php
	session_start();
	$filename = $_SESSION['data'][$_GET['id']][0] . '.mp3';
	if(file_exists($filename)) {
		header('Content-Type: audio/mpeg');
		header('Cache-Control: no-cache');
		header('Accept-Ranges: bytes');
		header("Content-Transfer-Encoding: binary");
		header('Content-Disposition: inline; filename="'.$filename.'"');
		header('Content-Length: '.filesize($filename));
		readfile($filename);
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>