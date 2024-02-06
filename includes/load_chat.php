<?php
	header("Access-Control-Allow-Origin: *");
	header('Content-Type: text/event-stream\n\n');
	header('Cache-Control: no-cache');
	include 'database_message.php';
				global $msg_bdd;

	ini_set(max_execution_time, 0);
	$from = '2';
	$to = '1';
	$id_discution = "ezdhnijkezd&ézuoijde_hjé_àe'dzunbfezd";
	$dmd_last_id_msg = $msg_bdd->prepare('SELECT * FROM message WHERE discution_id = :id ORDER BY creation_date DESC');
	$dmd_last_id_msg->execute([
		'id' => $id_discution
	]);
	while($message = $dmd_last_id_msg->fetch()){
		$last_msg_date = $message['creation_date'];
		$last_msg_id = array($message['id']); 
		break;
	}
	while (true) {
		if(connection_aborted()) exit();
		$dmd_if_new_msg = $msg_bdd->prepare('SELECT * FROM message WHERE discution_id = :id AND creation_date >= :last_creation ORDER BY creation_date');
		$dmd_if_new_msg->execute([
			'id' => $id_discution,
			'last_creation' => $last_msg_date
		]);
		$data = 'data: ';
		echo $data;
		while($message = $dmd_if_new_msg->fetch()){
			if(in_array($message['id'],$last_msg_id)){}
			else{
				if($message['user'] == $from){$id_div = "from";}
				elseif($message['user'] == $to){$id_div = "to";}
				$data = '<div class="message" id="' .$id_div. '"><p>' .$message['message']. '</p></div><br><br><br>';
				$data = htmlspecialchars($data);
				echo $data;
				if ($message['creation_date'] > $last_msg_date) {
					$last_msg_date = $message['creation_date'];
					$last_msg_id = array($message['id']);
				}
				elseif($message['creation_date'] = $last_msg_date){
					array_push($last_msg_id, $message['id']);
				}
			}
		}
		flush();
		sleep(1);
	}


?>
