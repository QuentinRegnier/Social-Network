<?php
include 'database_profile.php';
		global $pro_bdd;
if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['ban']) && !empty($_POST['ban'])) {
	$id_name = 'id';
	include 'verify_sys.php';
	$stmt = $pro_bdd->prepare('DELETE FROM ban WHERE pp = :id AND b = :ban');
	$stmt->execute([
		"id" => $_POST['id'],
		"ban" => $_POST['ban']
	]);
}