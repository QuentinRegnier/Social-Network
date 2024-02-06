<?php
$id_name = 'id';
include 'database_profile.php';
		global $pro_bdd;
include 'verify_sys.php';
if (isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['it']) && !empty($_POST['it'])) {
	if ($_POST['it'] == 1) {
		$stmt = $pro_bdd->prepare('UPDATE sub SET state = 1 WHERE s = :s AND w = :w');
		$stmt->execute([
			's' => $_POST['user'],
			'w' => $_POST['id']
		]);
	}
	elseif ($_POST['it'] == 2) {
		$stmt = $pro_bdd->prepare('UPDATE sub SET state = 0 WHERE s = :s AND w = :w');
		$stmt->execute([
			's' => $_POST['user'],
			'w' => $_POST['id']
		]);
	}
}