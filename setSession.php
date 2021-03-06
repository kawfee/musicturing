<?php
	session_start();

	//Array of all songs to be possibly loaded
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
?>