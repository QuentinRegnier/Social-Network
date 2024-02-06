<?php
include '../database.php';
		global $db;
if (isset($_POST['user'])) {
	if (!empty($_POST['user'])) {
		$user = $_POST['user'];
		$date = date('Y-m-d H:i:s');
		$requete = $db->prepare('UPDATE users SET state = :dat WHERE use_code = :user');
		$requete->execute([
		    'user' => $user,
		    'dat' => $date
		]);
	}
}