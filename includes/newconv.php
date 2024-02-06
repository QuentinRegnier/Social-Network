<?php
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
if (isset($_POST['from']) && isset($_POST['nat'])) {
	if (!empty($_POST['from']) && !empty($_POST['nat'])) {
		$nat = $_POST['nat'];
		if ($nat == 2 && isset($_POST['to']) && !empty($_POST['to'])) {
			$mp = generatePassword(64);
			$stmt = $msg_bdd->prepare("SELECT COUNT(*) FROM conv_info WHERE conv_id = :mp");
			$stmt->execute([':mp' => $mp]);
			$count = $stmt->fetchColumn();
			while (true) {
				if ($count == 0) {
					break;
				}
				else{
					$mp = generatePassword(64);
					$stmt = $msg_bdd->prepare("SELECT COUNT(*) FROM conv_info WHERE conv_id = :mp");
					$stmt->execute([':mp' => $mp]);
					$count = $stmt->fetchColumn();
				}
			}
			$to = $_POST['to'];
			$from = $_POST['from'];
			$stmt1 = $msg_bdd->prepare("INSERT INTO conv_info (conv_id, user) VALUES (:mp, :fromm)");
			$stmt1->execute([
				':mp' => $mp,
				':fromm' => $from
			]);
			$stmt2 = $msg_bdd->prepare("INSERT INTO conv_info (conv_id, user) VALUES (:mp, :to)");
			$stmt2->execute([
				':mp' => $mp,
				':to' => $to
			]);
			echo $mp;
		}
		elseif ($nat == 1 && isset($_POST['tab']) && !empty($_POST['tab']) && isset($_POST['name']) && !empty($_POST['name'])) {
			$tab = json_decode($_POST['tab'], true);
			$mp = generatePassword(64);
			$name = $_POST['name'];
			$stmt = $msg_bdd->prepare("SELECT COUNT(*) FROM conv_info WHERE conv_id = :mp");
			$stmt->execute([':mp' => $mp]);
			$count = $stmt->fetchColumn();
			while (true) {
				if ($count == 0) {
					break;
				}
				else{
					$mp = generatePassword(64);
					$stmt = $msg_bdd->prepare("SELECT COUNT(*) FROM conv_info WHERE conv_id = :mp");
					$stmt->execute([':mp' => $mp]);
					$count = $stmt->fetchColumn();
				}
			}
			$from = $_POST['from'];
			$stmt1 = $msg_bdd->prepare("INSERT INTO conv_info (conv_id, user, name, role) VALUES (:mp, :fromm, :name, :role)");
			$stmt1->execute([
				':mp' => $mp,
				':fromm' => $from,
				':name' => $name,
				':role' => 2
			]);
			$stmt2 = $msg_bdd->prepare("INSERT INTO conv_info (conv_id, user, name) VALUES (:mp, :to, :name)");
			foreach ($tab as $to_value) {
			    $stmt2->execute([
			        ':mp' => $mp,
			        ':to' => $to_value,
			        ':name' => $name
			    ]);
			}	
		}
		echo $mp;
	}
}
?>