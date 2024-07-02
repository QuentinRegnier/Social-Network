<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
include '../database.php';
		global $db;
if (isset($_GET)) {
	if (!empty($_GET)) {
		$user = $_GET['user'];
		$file_path = '../configurationofuser/'.$user.'.json';
		$file_content = file_get_contents($file_path);
		$data = json_decode($file_content, true);
		$parametres = $data[1];
		while(true){
			$send = [];
			$verif = $db->prepare('SELECT state, use_code FROM users WHERE use_code IN ('.implode(",", array_fill(0, count($parametres), '?')).')');
			$verif->execute($parametres);
			while ($insert = $verif->fetch()) {
				$date = $insert['state'];
				$timestamp = strtotime($date);
				$seconds_since = time() - $timestamp;
				if ($seconds_since < 270) {
					$new = Array ( 
		    			"user" => $insert['use_code'],
		    			"state" => 1
		    		);
		    		array_push($send, $new);
				}
				else{
					$new = Array ( 
		    			"user" => $insert['use_code'],
		    			"state" => 0 
		    		);
		    		array_push($send, $new);
				}
			}
			echo 'data:';
			$json = json_encode($send);
			echo "$json";
			echo "\n\n";
			ob_flush();
			flush();
			sleep(270);
		}
	}
}