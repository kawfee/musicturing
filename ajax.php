<?php
	if(isset($_POST['data'])) {
		header('Content-type: application/json');		
		include 'setSession.php';
		$i = 0;
		//$rightCount = 0;
		foreach($_SESSION['data'] as $song) {
			if($song[1] != $_POST['data'][$i]) {
				$response_array['wrong'][$i] = 1; //wrong
			} else {
				$response_array['wrong'][$i] = 0; //right
				//$rightCount++;
			}
			$i++;
		}
		//send number correct to database
		/*$con = mysqli_connect('localhost','root','mysql','ajax');
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_query($con,"INSERT INTO results (data) VALUES ($rightCount)");
		mysqli_close($con);*/
		unset($_SESSION['data']);
		setSession($songs);
		echo json_encode($response_array);	
	}
?>