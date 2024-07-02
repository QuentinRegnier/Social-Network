<?php
include 'database_message.php';
		global $msg_bdd;
if (isset($_POST['users']) && isset($_POST['group']) && isset($_POST['from'])) {
	if (!empty($_POST['users']) && !empty($_POST['group']) && !empty($_POST['from'])) {
		$group = $_POST['group'];
		$from = $_POST['from'];
		$stmt = $msg_bdd->prepare('SELECT role FROM conv_info WHERE conv_id = :mp AND user = :user');
		$stmt->execute([
			"mp" => $group,
			"user" => $from
		]);
		$result = $stmt->fetch();
		$count = $stmt->rowCount();
		if ($count == 1 && $result['role'] == 2) {
			$users = json_decode($_POST['users'], true);
			$stmt1 = $msg_bdd->prepare("UPDATE conv_info SET role = 1 WHERE user = :user AND conv_id = :conv_id");
			foreach ($users as $to_value) {
			    $stmt1->execute([
			        'user' => $to_value,
			        'conv_id' => $group
			    ]);
			}
		}
	}
}