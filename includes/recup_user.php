<?php
include '../database.php';
		global $db;
if (isset($_POST['user'])) {
	if (!empty($_POST['user'])) {
		$user = $_POST['user'];
		$requete = $db->prepare('SELECT pseudo FROM users WHERE use_code = :usecode');
		$requete->execute([
		    'usecode' => $user
		]);
		$val = $requete->fetch();
		echo $val['pseudo'];
	}
}