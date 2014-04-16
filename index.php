<?php

	session_start();

	$songs = array(
		'e' => array(
			'007607b_',
			'018506b_',
			'028300b_',
			'037300b_',
			'040900bv',
			'066000b_',
		),
		'b' => array(
			'bach-138',
			'bach-207',
			'bach-272',
			'bach-329',
			'bach-380',
			'bach-470',
		),
	);

	function randNum($min, $max, $quantity) {
		$numbers = range($min, $max);
		shuffle($numbers);
		return array_slice($numbers, 0, $quantity);
	}

	function setSession($songs) {
		$eCount = rand(4,6);
		$bCount = 10 - $eCount;
		$eValues = randNum(0, sizeof($songs['e']) - 1, $eCount);
		$bValues = randNum(0, sizeof($songs['b']) - 1, $bCount);
		$values = array();
		$i = 0;
		foreach($eValues as $key) {
			$values[$i] = array($songs['e'][$key], 'e');
			$i++;
		}
		foreach($bValues as $key) {
			$values[$i] = array($songs['b'][$key], 'b');
			$i++;
		}
		shuffle($values);
		$_SESSION['data'] = $values;
	}

	if(empty($_SESSION['data'])) {
		setSession($songs);
	}

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Musical Turing Test</title>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script>
			$(function(){
				$("audio").on("play", function() {
					$("audio").not(this).each(function(index, audio) {
						audio.pause();
					});
				});
			});
			function submitQuiz(){
				var data = new Array();
				data[0] = $('#f0').val();
				data[1] = $('#f1').val();
				data[2] = $('#f2').val();
				data[3] = $('#f3').val();
				data[4] = $('#f4').val();
				data[5] = $('#f5').val();
				data[6] = $('#f6').val();
				data[7] = $('#f7').val();
				data[8] = $('#f8').val();
				data[9] = $('#f9').val();
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: {data:data}
				}).done(function( result ) {
					$("#msg").html( " Query result: " + result );
					$("#p0")[0].pause();
					$("#p0")[0].load();
					$("#p1")[0].pause();
					$("#p1")[0].load();
					$("#p2")[0].pause();
					$("#p2")[0].load();
					$("#p3")[0].pause();
					$("#p3")[0].load();
					$("#p4")[0].pause();
					$("#p4")[0].load();
					$("#p5")[0].pause();
					$("#p5")[0].load();
					$("#p6")[0].pause();
					$("#p6")[0].load();
					$("#p7")[0].pause();
					$("#p7")[0].load();
					$("#p8")[0].pause();
					$("#p8")[0].load();
					$("#p9")[0].pause();
					$("#p9")[0].load();
				});
			}
		</script>
	</head>
	<body>
		<ol>
		<?php
			for($i = 0; $i < 10; $i++) {
				echo '<li><audio id="p' . $i . '" controls>
						<source src="audio.php?id=' . $i . '">
					  </audio>
					  <select id="f' . $i .'">
						<option value="0">Bach Original</option>
						<option value="1">Computer Generated</option>
					  </select></li>';
			}
		?>
		</ol>
		<p id="msg"></p>
		<input type="submit" onClick="submitQuiz()" value="Submit">
	</body>
</html>