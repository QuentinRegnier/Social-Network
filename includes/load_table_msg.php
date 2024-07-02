<?php
include 'database_message.php';
		global $msg_bdd;
if (isset($_POST['from']) && isset($_POST['id_conv'])) {
	if (!empty($_POST['from']) && !empty($_POST['id_conv'])) {
		$from = $_POST['from'];
		$id_discution = $_POST['id_conv'];
		$table = [];
		$recoverMessages = $msg_bdd->prepare('SELECT id, user FROM message WHERE discution_id = :id ORDER BY creation_date');
		$recoverMessages->execute([
			'id' => $id_discution
		]);
		while($message = $recoverMessages->fetch()){
			$tab = Array(
			"id" => $message['id'],
			"user" => $message['user']
			);
			array_push($table, $tab);	
		}
		echo json_encode($table);
	}
}
