<?php
include '../database.php';
		global $db;
if (isset($_POST['user'])) {
	if (!empty($_POST['user'])) {
		$user = $_POST['user'];
		$verif = $db->prepare('SELECT state FROM users WHERE use_code = :id');
		$verif->execute([
			'id' => $user
		]);
		$num = $verif->rowCount();
		if ($num == 1) {
			while($insert = $verif->fetch()){
				$state = $insert['state'];
			}
			$date = $state;
			$timestamp = strtotime($date);
			$seconds_since = time() - $timestamp;
			if ($seconds_since < 270) {
				echo 1;
			}
			else{
				echo 0;
			}
		}
	}
}