<?php
	include 'setSession.php';
	if(empty($_SESSION['data'])) {
		setSession($songs);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Musical Turing Test</title>
		<!--[if IE]><style>div.wrapper{min-width:750px;}</style><![endif]-->
		<link rel="stylesheet" type="text/css" href="styles.css">
		<link rel="stylesheet" type="text/css" href="messi.min.css">
	</head>
	<body>
		<div class="wrapper">
			<h1>Musical Turing Test <a id="info">[i]</a></h1>
			<div class="msg">
				<p id="msg"></p>
			</div>
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
								<span class="icon"><img id="i' . $i . '"></img></span>
							</span>
						</li>';
				}
			?>
			</ul>
			<p class="button cf"><a id="click" onClick="submitQuiz()">Vote</a></p>
			<div class="cf"></div>
		</div>
		<div id="overlay"></div>		
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="subquiz.js"></script>
		<script src="messi.min.js"></script>
	</body>
</html>