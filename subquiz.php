<?php
	header("Content-type: application/javascript");
	session_start();
?>
$(document).ready(function() {
	$('audio').on('play',function() {
		$('audio').not(this).each(function(index, audio) {
			audio.pause();
		});
	});
	$('#info').on('click',function() {
		if(!$('.messi-box').length) {
			var msg = "<?php echo 'Answers to quiz:<br>1) '.$_SESSION['data'][0][0].'.mp3'.' ['.$_SESSION['data'][0][1].']<br>2) '.$_SESSION['data'][1][0].'.mp3'.' ['.$_SESSION['data'][1][1].']<br>3) '.$_SESSION['data'][2][0].'.mp3'.' ['.$_SESSION['data'][2][1].']<br>4) '.$_SESSION['data'][3][0].'.mp3'.' ['.$_SESSION['data'][3][1].']<br>5) '.$_SESSION['data'][4][0].'.mp3'.' ['.$_SESSION['data'][4][1].']<br>6) '.$_SESSION['data'][5][0].'.mp3'.' ['.$_SESSION['data'][5][1].']<br>7) '.$_SESSION['data'][6][0].'.mp3'.' ['.$_SESSION['data'][6][1].']<br>8) '.$_SESSION['data'][7][0].'.mp3'.' ['.$_SESSION['data'][7][1].']<br>9) '.$_SESSION['data'][8][0].'.mp3'.' ['.$_SESSION['data'][8][1].']<br>10) '.$_SESSION['data'][9][0].'.mp3 ['.$_SESSION['data'][9][1].']'; ?>";
			Messi.alert(msg);
			$('#overlay').fadeIn();
		}
	});
	$('#close').on('click',function() {
		$('#overlay').fadeOut();
	});
});

function submitQuiz() {
	var data = new Array(
		$('input:radio[name=f0]:checked').val(),
		$('input:radio[name=f1]:checked').val(),
		$('input:radio[name=f2]:checked').val(),
		$('input:radio[name=f3]:checked').val(),
		$('input:radio[name=f4]:checked').val(),
		$('input:radio[name=f5]:checked').val(),
		$('input:radio[name=f6]:checked').val(),
		$('input:radio[name=f7]:checked').val(),
		$('input:radio[name=f8]:checked').val(),
		$('input:radio[name=f9]:checked').val());
	if($.grep(data, function(elem){ return elem === undefined;}).length < 1) {
		$.ajax({
			type: 'POST',
			url: 'ajax.php',
			data: {data:data}
		}).done(function(data) {
			$('input:radio').attr('disabled', 'disabled');
			$('audio').each(function() { this.pause(); });
			var sum = 0;
			$.each(data.wrong,function(){sum+=parseFloat(this) || 0;});
			$('#msg').fadeOut().delay(900).queue(function(n){$(this).html('Score: '+(10-sum)+'/10 correct!');n();}).fadeIn();
			for(i=0; i<10;i++) {
				if(data.wrong[i]==1) {
					$('#i'+i).attr('src', 'img/wrong.png');
				} else {
					$('#i'+i).attr('src', 'img/right.png');
				}
				$('#i'+i).delay(i*100).fadeIn();
			}
			$('#click').html('Processing...').attr('onClick', '').delay(900).queue(function(n){$(this).attr('onClick', 'resetQuiz()');$(this).html('Reset');n();});
		});
	} else {
		$('#click').attr('onClick', '').delay(900).queue(function(n){$(this).attr('onClick', 'submitQuiz()');n();});
		$('#msg').fadeOut().html('Please try again. Make sure each question is answered.').fadeIn();
	}
}
function resetQuiz() {
	$('input:radio').removeAttr('checked').removeAttr('disabled');
	$('#msg').delay(900).fadeOut().queue(function(n){$(this).html('');n();});
	for(i=0; i<10;i++){
		$('audio')[i].pause();
		$('audio')[i].load();
		$('#i'+i).delay(i*100).fadeOut();
	}
	$('#click').html('Resetting...').attr('onClick', '').delay(900).queue(function(n){$(this).attr('onClick', 'submitQuiz()');$(this).html('Vote');n();});
}

function hideOverlay() {
	$('#overlay').fadeOut();
}