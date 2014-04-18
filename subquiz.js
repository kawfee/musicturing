$(function() {
	$("audio").on("play", function() {
		$("audio").not(this).each(function(index, audio) {
			audio.pause();
		});
	});
});
function submitQuiz() {
	var data = new Array();
	data[0] = $('input:radio[name=f0]:checked').val();
	data[1] = $('input:radio[name=f1]:checked').val();
	data[2] = $('input:radio[name=f2]:checked').val();
	data[3] = $('input:radio[name=f3]:checked').val();
	data[4] = $('input:radio[name=f4]:checked').val();
	data[5] = $('input:radio[name=f5]:checked').val();
	data[6] = $('input:radio[name=f6]:checked').val();
	data[7] = $('input:radio[name=f7]:checked').val();
	data[8] = $('input:radio[name=f8]:checked').val();
	data[9] = $('input:radio[name=f9]:checked').val();
	$.ajax({
		type: "POST",
		url: "ajax.php",
		data: {data:data}
	}).done(function(data) {
		$('input:radio').attr('disabled', 'disabled');
		var sum = 0;
		$.each(data.wrong,function(){sum+=parseFloat(this) || 0;});
		$("#msg").html("Score: "+(10-sum)+"/"+10+" correct!");
		for(i=0; i<10;i++) {
			if(data.wrong[i]==1) {
				$("#i"+i).attr("src", "wrong.png");
			} else {
				$("#i"+i).attr("src", "right.png");
			}
			$("#i"+i).fadeIn(i*100);
		}
		$("#click").attr("onClick", "resetQuiz()");
		$("#click").html("Reset");
	});
}
function resetQuiz() {
	$.ajax({
		type: "GET",
		url: "reset.php"
	}).done(function() {
		$('input:radio').removeAttr('checked');
		$('input:radio').removeAttr('disabled');
		$("#msg").html("");
		for(i=0; i<10;i++){
			$("audio")[i].pause();
			$("audio")[i].load();
			$("#i"+i).fadeOut(i*100);
		}
		$("#click").attr("onClick", "submitQuiz()");
		$("#click").html("Vote");
	});
}