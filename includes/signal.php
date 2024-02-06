<?php
include 'database.php';
		global $db;
include 'database_admin.php';
		global $admin_data;
if (isset($_POST['user']) && isset($_POST['object']) && isset($_POST['sign']) && $_POST['text']) {
	if (!empty($_POST['user']) && !empty($_POST['object']) && !empty($_POST['sign']) && !empty($_POST['text'])) {
		$val = json_decode($_POST['sign'] ,true);
		if (strpos($_POST['object'], "[pub]") === 0) {
		    $value = substr($_POST['object'], strlen("[pub]"));
		    $result_ob = $value;
		} else {
		    $result_ob = $_POST['object'];
		}
		$stmt = $db->prepare('SELECT user, tmp_code FROM publications WHERE id = :id');
		$stmt->execute([
			"id" => htmlspecialchars($result_ob)
		]);
		$response = $stmt->fetch();
		$stmt2 = $admin_data->prepare('INSERT INTO sign (informer, accuse, object, sx, dh, ve, ig, ih, ar, it, ef, txt) VALUES (:user, :ac, :ob, :sx, :dh, :ve, :ig, :ih, :ar, :it, :ef, :txt)');
		$stmt2->execute([
			"user" => $_POST['user'],
			"ac" => $response[0],
			"ob" => $response[1],
			"sx" => $val[0],
			"dh" => $val[1],
			"ve" => $val[2],
			"ig" => $val[3],
			"ih" => $val[4],
			"ar" => $val[5],
			"it" => $val[6],
			"ef" => $val[7],
			"txt" => $_POST['text']
		]);
	}
}