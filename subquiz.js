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
		for(i=0; i<10;i++){
			$("audio")[i].pause();
			$("audio")[i].load();
			if(data.wrong[i] == 1) {
				$("#i"+i).attr("src", "wrong.png");
			} else {
				$("#i"+i).attr("src", "right.png");
			}
			$("#i"+i).css("display", "inline");
		}
	});
}