<?php
$id_name = 'id';
include 'database_profile.php';
		global $pro_bdd;
if (isset($_POST['values']) && !empty($_POST['values']) && isset($_POST['id']) && !empty($_POST['id'])) {
	$data = $_POST['values'];
	$values = json_decode("$data", true);
	for ($i=0; $i < count($values); $i++) { 
		$stmt = $pro_bdd->prepare('UPDATE sub SET state = 2 WHERE s = :s AND w = :w');
		$stmt->execute([
			's' => $values[$i],
			'w' => $_POST['id']
		]);
	}
}