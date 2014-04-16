<?php

	include 'setSession.php';

	if(empty($_SESSION['data'])) {
		setSession($songs);
	}

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Musical Turing Test</title>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="subquiz.js"></script>
		<style>
			img {
				height:15px;
				width:15px;
				display:none;
			}
		</style>
	</head>
	<body>
		<h4>Musical Turing Test</h4>
		<h1>Song List</h1>
		<ol>
		<?php
			for($i = 0; $i < 10; $i++) {
				echo '<li>
						<audio id="p' . $i . '" controls>
						  <source src="audio.php?id=' . $i . '">
						</audio>
						<select id="f' . $i .'" tabindex="' . $i . 1 . '">
						  <option selected disabled>-- Select Artist -- </option>
						  <option value="b">Bach</option>
						  <option value="e">EMI</option>
						</select>
						<img id="i' . $i . '"></img>
					  </li>';
			}
		?>
		</ol>
		<p id="msg"></p>
		<input type="submit" onClick="submitQuiz()" value="Vote">
	</body>
</html>