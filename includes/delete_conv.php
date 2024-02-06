<?php
include 'database_message.php';
		global $msg_bdd;
if (isset($_POST['conv']) && isset($_POST['user']) && isset($_POST['nat'])) {
	if (!empty($_POST['conv']) && !empty($_POST['user']) && !empty($_POST['nat'])) {
		$nat = $_POST['nat'];
		$conv = $_POST['conv'];
		if ($nat == 1) {
			$state = 0;
			$user = $_POST['user'];
			$verif = $msg_bdd->prepare('SELECT user FROM conv_info WHERE conv_id = :idconv AND state = :state');
			$verif->execute([
					'idconv' => $conv,
					'state' => 0
			]);
			while ($info = $verif->fetch()) {
				if ($info['user'] == $user) {
					$state = 1;
				}
			}
			if ($state == 1) {
				$result = $verif->rowCount();
				if ($result == 1) {
					$requete = $msg_bdd->prepare('DELETE FROM conv_info WHERE conv_id = :conv_id');
					$requete->execute([
					    'conv_id' => $conv
					]);
					$delete = $msg_bdd->prepare('DELETE FROM message WHERE discution_id = :conv');
					$delete->execute([
						':conv' => $conv
					]);
				}
				if ($result >= 2) {
					$requete = $msg_bdd->prepare('UPDATE conv_info SET state = 1 WHERE user = :user AND conv_id = :conv_id');
					$requete->execute([
					    'user' => $user,
					    'conv_id' => $conv
					]);
				}
			}
		}
		elseif ($nat == 2){
			$users = json_decode($_POST['user'], true);
			$from = $_POST['from'];
			$stmt1 = $msg_bdd->prepare('SELECT role FROM conv_info WHERE conv_id = :conv_id AND user = :user');
			$stmt1->execute([
				"user" => $from,
				"conv_id" => $conv
			]);
			$result = $stmt1->fetch();
			if ($result['role'] == 1 || $result['role'] == 2) {
				$stmt2 = $msg_bdd->prepare('DELETE FROM conv_info WHERE conv_id = :conv_id AND user = :user');
				foreach ($users as $to_value) {
				    $stmt2->execute([
				        'user' => $to_value,
				        'conv_id' => $conv
				    ]);
				}
			}
		}
	}
}
?>