<?php
include 'database_message.php';
		global $msg_bdd;
if (isset($_POST['user']) && isset($_POST['group'])) {
	if (!empty($_POST['user']) && !empty($_POST['group'])) {
		$group = $_POST['group'];
		$stmt = $msg_bdd->prepare("SELECT name FROM conv_info WHERE conv_id = :mp");
		$stmt->execute([':mp' => $group]);
		$count = $stmt->rowCount();
		$val = $stmt->fetchAll();
		if ($count >= 1) {
			if (isset($_POST['nat']) && !empty($_POST['nat']) && $_POST['nat'] == 1) {
				$user = json_decode($_POST['user'], true);
				$stmt1 = $msg_bdd->prepare("INSERT INTO conv_info (conv_id, user, name) VALUES (:mp, :fromm, :name)");
				foreach ($user as $to_value) {
				    $stmt1->execute([
				        'mp' => $group,
				        'fromm' => $to_value,
				        'name' => $val[0][0]
				    ]);
				}
			}
			else{
				$user = $_POST['user'];
				$stmt1 = $msg_bdd->prepare("INSERT INTO conv_info (conv_id, user, name) VALUES (:mp, :fromm, :name)");
				$stmt1->execute([
					'mp' => $group,
					'fromm' => $user,
					'name' => $val[0][0]
				]);
			}
		}
	}
}