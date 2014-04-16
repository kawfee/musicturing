<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Musical Turing Test</title>
    </head>
    <body>
        <h4>Musical Turing Test</h4>
		<h1>Song List</h1>
		<ol>
		<?php
			$filetype = "mp3";
			$files = glob(dirname(__FILE__) . "/*." . $filetype);
			shuffle($files);
			if(sizeof($files) == 0) {
				print "<p>Sorry, no $filetype files were found.</p>";
			}
			for ($i=0; $i<sizeof($files); $i++) {
				preg_match('/([^\/]+)$/', $files[$i], $matches);
				print '<li><a href="' . $matches[0] . '">' . $matches[0] . '</a></li>';
			}
		?>
		</ol>		
    </body>
</html>
