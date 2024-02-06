<?php
include 'database_message.php';
		global $msg_bdd;
if (isset($_POST['conv'])) {
	if (!empty($_POST['conv'])) {
		$conv = $_POST['conv'];
		$tab=[];
		$stmt = $msg_bdd->prepare('SELECT role, user FROM conv_info WHERE conv_id = :conv');
		$stmt->execute([
			"conv" => $conv
		]);
		while ($raw = $stmt->fetch()) {
			$tab[$raw['user']] = $raw['role'];
		}
		echo json_encode($tab);
	}
}