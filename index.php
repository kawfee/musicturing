<?php
	include 'setSession.php';
	if(empty($_SESSION['data'])) {
		setSession($songs);
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Musical Turing Test</title>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="subquiz.js"></script>
		<link href="styles.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="wrapper">
			<div class="main">
				<h1>Musical Turing Test</h1>
				<h2>Song List</h2>
				<ul>
				<?php
					for($i = 0; $i < 10; $i++) {
						echo '<li>
									<audio controls>
										<source src="audio.php?id=' . $i . '">
										Your browser does not support the audio element for mp3 files
									</audio>
									<span>
										<label>
											<input type="radio" name="f'. $i . '" value="b">Bach
										</label>
										<label>
											<input type="radio" name="f'. $i . '" value="e">Emi
										</label>
										<img id="i' . $i . '"></img>
									</span>
								</li>';
					}
				?>
				</ul>
				<p class="button"><a id="click" onClick="submitQuiz()">Vote</a></p>
			</div>
			<p id="msg"></p>
		</div>
	</body>
</html>