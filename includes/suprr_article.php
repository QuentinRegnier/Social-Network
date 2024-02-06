<?php 
include '../database.php';
		global $db;
include 'database_profile.php';
global $pro_bdd;
$id_name = 'user';
include 'verify_sys.php';
	if(isset($_POST['id']) AND isset($_POST['user']) AND !empty($_POST['id']) AND !empty($_POST['user'])) {
		$suprr_id = htmlspecialchars($_POST['id']);
		$user = htmlspecialchars($_POST['user']);
		$verifuser = $db->prepare('SELECT user FROM publications WHERE id = :id');
		$verifuser->execute([
			'id' => $suprr_id
		]);
		$result = $verifuser->fetch();
		if ($result[0] == $user) {
			$suppr = $db->prepare('DELETE FROM publications WHERE id = :id');
			$suppr->execute([
				'id' => $suprr_id
			]);
		}
	}
?>