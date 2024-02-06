<?php
include 'database_profile.php';
		global $pro_bdd;
if (isset($_POST['user']) && isset($_POST['id']) && isset($_POST['config'])) {
	if (!empty($_POST['user']) && !empty($_POST['id']) && !empty($_POST['config'])) {
		if ($_POST['user'] != $_POST['id']) {
			if ($_POST['config'] == 1) {
				$stmt = $pro_bdd->prepare("INSERT INTO sub (w, s) VALUES (:w, :s)");
				$stmt->execute([
					'w' => $_POST['id'],
					's' => $_POST['user']
				]);
			}
			elseif ($_POST['config'] == 2) {
				$stmt = $pro_bdd->prepare("DELETE FROM sub WHERE w = :w AND s = :s");
				$stmt->execute([
					'w' => $_POST['id'],
					's' => $_POST['user']
				]);
			}
		}
	}
}