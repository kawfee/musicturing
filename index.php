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
		<link href="styles.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="main">
			<h1>Musical Turing Test</h1>
			<h2>Song List</h2>
			<ul class="cf">
			<?php
				for($i = 0; $i < 10; $i++) {
					echo '<li class="cf">
							<audio id="p' . $i . '" controls>
							  <source src="audio.php?id=' . $i . '">
							  Your browser does not support the audio element for wav files
							</audio>
							<select id="f' . $i .'" tabindex="' . $i . 1 . '">
							  <option value="" selected disabled>-- Select Artist -- </option>
							  <option value="b">Bach</option>
							  <option value="e">EMI</option>
							</select>
							<img id="i' . $i . '"></img>
						  </li>';
				}
			?>
			</ul>
			<p class="cf"><a id="click" onClick="submitQuiz()">Vote</a></p>
			<p id="msg"></p>
		</div>
	</body>
</html>