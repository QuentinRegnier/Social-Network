<?php
if (isset($_GET['tableau'])) {
	include 'database_message.php';
			global $msg_bdd;
	$tableau_encode = $_GET['tableau'];
	$tableau_decode = explode(',', $tableau_encode);
	$tableau = array_map('urldecode', $tableau_decode);
	$ids = implode(',', $tableau);
	$sql = "UPDATE message SET state = 1 WHERE id IN ($ids)";
	$stmt = $msg_bdd->prepare($sql);
	$stmt->execute();
}
?>