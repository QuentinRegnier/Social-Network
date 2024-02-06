<?php
if (isset($_POST['id_conv']) && isset($_POST['id_user']) && isset($_POST['nat'])) {
	if (!empty($_POST['id_conv']) && !empty($_POST['id_user'])) {
		include 'predis.php';
		include 'database_message.php';
			global $msg_bdd;
		function generatePassword($length) {
		    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		    $password = '';
		    for ($i = 0; $i < $length; $i++) {
		        $password .= $chars[rand(0, strlen($chars) - 1)];
		    }
		    return $password;
		}
		$prov = $_POST['nat'];
		$id_conv = $_POST['id_conv'];
		$id_user = $_POST['id_user'];
		$new = [];
		$state = 0;
		$newMessage = [];
		if (isset($_FILES['img'])) {
			if (!empty($_FILES['img'])) {
				$pass = generatePassword(12);
				$chemin = '../img_msg/' . $pass . '.png';
				$import = 'i:' . $pass . '.png';
				while (true) {
					if (!file_exists($chemin)) {
						move_uploaded_file($_FILES['img']['tmp_name'], $chemin);
						break;
					}
					else{
						$pass = generatePassword(12);
						$chemin = '../img_msg/' . $pass . '.png';
						$import = '../img_msg/' . $pass . '.png';
					}
				}
				$msg_bdd->beginTransaction();
				$ins2 = $msg_bdd->prepare('INSERT INTO message (user, message, discution_id, nat, prov) VALUES (:user, :message, :discution_id, :statnat, :prov)');
				$ins2->execute([
				  'user' => $id_user,
				  'message' => $import,
				  'discution_id' => $id_conv,
				  'statnat' => 1,
				  'prov' => $prov
				]);
				if ($ins2) {
					$result_select = $msg_bdd->prepare('SELECT LAST_INSERT_ID() AS message');
				    $result_select->execute();
				    if ($result_select) {
				        $row = $result_select->fetch();
				        $msg_bdd->commit();
				    }else{
				    	echo "Erreur lors de la récupération de l'ID : " . mysqli_error($msg_bdd);
				    	$msg_bdd->rollBack();
				    }
				}
				$lastInsertId_i = $row[0];
				$new['img']= $lastInsertId_i;
				$state = 1;
				$newMessage['id'] = $lastInsertId_i;
				$newMessage['text'] = $inport;
				$newMessage['user'] = $id_user;
				$newMessage['conv'] = $id_conv;
				$newMessage['nat'] = 1;
				$newMessage['state'] = 0;
				$newMessage['prov'] = $prov;
				$eventData = json_encode(['type' => 'new_message', 'data' => $newMessage]);
				$redis->publish('sse_' . $id_user, $eventData);
			}
		}
		$newMessage = [];
		if (isset($_POST['text'])) {
			if (!empty($_POST['text'])) {
				$text = $_POST['text'];
				$msg_bdd->beginTransaction();
				$ins = $msg_bdd->prepare('INSERT INTO message (user, message, discution_id, prov) VALUES (:user, :message, :discution_id, :prov)');
				$ins->execute([
				  'user' => $id_user,
				  'message' => $text,
				  'discution_id' => $id_conv,
				  'prov' => $prov
				]);
				if ($ins) {
					$result_select = $msg_bdd->prepare('SELECT LAST_INSERT_ID() AS message');
				    $result_select->execute();
				    if ($result_select) {
				        $row = $result_select->fetch();
				        $msg_bdd->commit();
				    }else{
				    	echo "Erreur lors de la récupération de l'ID : " . mysqli_error($msg_bdd);
				    	$msg_bdd->rollBack();
				    }
				}
				$lastInsertId_t = $row[0];
				$new['txt']= $lastInsertId_t;
				$state = 1;
				$newMessage['id'] = $lastInsertId_t;
				$newMessage['text'] = $text;
				$newMessage['user'] = $id_user;
				$newMessage['conv'] = $id_conv;
				$newMessage['nat'] = 0;
				$newMessage['state'] = 0;
				$newMessage['prov'] = $prov;
				$channelName = 'sse_' . $id_conv;
				$messageData = json_encode($newMessage);
				$redis->set($channelName, $messageData);
			}
		}
		if ($state == 1) {
			$date = date('Y-m-d H:i:s');
			$stmt = $msg_bdd->prepare('UPDATE conv_info SET modification_date = :data WHERE conv_id = :id');
			$stmt->execute([
				"id" => $id_conv,
				"data" => $date
			]);
		}
		$json = json_encode($new);
		echo $json;
	}
}
?>