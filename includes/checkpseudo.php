<?php
include 'database_profile.php';
global $pro_bdd;
if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
	$stmt = $pro_bdd->prepare('SELECT use_code FROM users WHERE pseudo = :pseudo');
	$stmt->execute([
		"pseudo" => $_POST['pseudo']
	]);
	$result = $stmt->fetch();
	$num = $stmt->rowCount();
	if ($num == 0 || $_POST['use_code'] == $result['use_code']) {
		echo true;
	}else{
		echo false;
	}
}