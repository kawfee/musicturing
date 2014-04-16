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
			function submitQuiz(){
				var f0 = $('#f0').val();
				var f1 = $('#f1').val();
				var f2 = $('#f2').val();
				var f3 = $('#f3').val();
				var f4 = $('#f4').val();
				var f5 = $('#f5').val();
				var f6 = $('#f6').val();
				var f7 = $('#f7').val();
				var f8 = $('#f8').val();
				var f9 = $('#f9').val();
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: {f0:f0, f1:f1, f2:f2, f3:f3, f4:f4, f5:f5, f6:f6, f7:f7, f8:f8, f9:f9}
				}).done(function( result ) {
					$("#msg").html( " Query result: " + result );
					$("#p0, p1, p2, p3, p4, p5, p6, p7, p8, p9")[0].pause();
					$("#p0, p1, p2, p3, p4, p5, p6, p7, p8, p9")[0].load();
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