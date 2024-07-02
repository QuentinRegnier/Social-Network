<?php
include '../database.php';
		global $db;
if (isset($_POST['user'])) {
	if (!empty($_POST['user'])) {
		$send = [];
		$data = $_POST['user'];
		$user = json_decode("$data", true);
		$stmt = $db->prepare("SELECT pseudo FROM users WHERE use_code = :user");
		foreach ($user as $code) {
		    $stmt->bindParam(':user', $code);
		    $stmt->execute();
		    while ($row = $stmt->fetch()) {
		        $tab = Array(
		        	"name" => $row['pseudo'],
		        	"code" => $code		        );
		        array_push($send, $tab);
		    }
		}
		echo json_encode($send);
	}
}