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
				}).done(function(data) {
					var sum = 0;
					$.each(data.wrong,function(){sum+=parseFloat(this) || 0;});
					if(sum > 0) {
						$("#msg").html(data.wrong);
					} else {
						$("#msg").html("Great job!");
					}
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
					  </li>';
			}
		?>
		</ol>
		<p id="msg"></p>
		<input type="submit" onClick="submitQuiz()" value="Vote">
	</body>
</html>