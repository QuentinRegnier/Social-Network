<?php
include 'database.php';
		global $db;
if (isset($_POST['conv'])) {
	if (!empty($_POST['conv'])) {
		$id_discution = $_POST['conv'];
		$recoverUser = $db->prepare('SELECT pseudo FROM users WHERE use_code = :id');
		$recoverUser->execute([
			'id' => $id_discution
		]);
		while($user = $recoverUser->fetch()){
			echo $user['pseudo'];
		}
	}
}
?>