<?php
include 'database_profile.php';
		global $pro_bdd;
if (isset($_POST['id']) && !empty($_POST['id'])) {
	$id_name = 'id';
	include 'verify_sys.php';
	$change_user_table = 0;
	$change_color_table = 0;
	$sql_dmd_user = '';
	$sql_dmd_color = '';
	$data_user = [];
	$data_color = [];
	$data_user['id'] = $_POST['id'];
	$data_color['id'] = $_POST['id'];
	if (isset($_POST['prename']) && !empty($_POST['prename'])) {
		$change_user_table ++;
		$sql_dmd_user .= 'first_name = :prename';
		$data_user['prename'] = htmlspecialchars($_POST['prename']);
	}
	if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
		if ($change_user_table >= 1) {
			$sql_dmd_user .= ',';
		}
		$change_user_table ++;
		$sql_dmd_user .= 'pseudo = :pseudo';
		$data_user['pseudo'] = htmlspecialchars($_POST['pseudo']);
	}
	if (isset($_POST['localisation']) && !empty($_POST['localisation'])) {
		$change_color_table = 1;
		$sql_dmd_color .= 'live = :localisation';
		$data_color['localisation'] = $_POST['localisation'];
	}
	if (isset($_POST['work']) && !empty($_POST['work'])) {
		if ($change_color_table >= 1) {
			$sql_dmd_color .= ',';
		}
		$change_color_table ++;
		$sql_dmd_color .= 'works = :work';
		$data_color['work'] = htmlspecialchars($_POST['work']);
	}
	if (isset($_POST['name']) && !empty($_POST['name'])) {
		if ($change_user_table >= 1) {
			$sql_dmd_user .= ',';
		}
		$change_user_table ++;
		$sql_dmd_user .= 'last_name = :name';
		$data_user['name'] = htmlspecialchars($_POST['name']);
	}
	if (isset($_POST['phone']) && !empty($_POST['phone'])) {
		if ($change_user_table >= 1) {
			$sql_dmd_user .= ',';
		}
		$change_user_table ++;
		$sql_dmd_user .= 'phone = :phone';
		$data_user['phone'] = $_POST['phone'];
	}
	if (isset($_POST['school']) && !empty($_POST['school'])) {
		if ($change_color_table >= 1) {
			$sql_dmd_color .= ',';
		}
		$change_color_table ++;
		$sql_dmd_color .= 'school = :school';
		$data_color['school'] = htmlspecialchars($_POST['school']);
	}
	if (isset($_POST['valor']) && !empty($_POST['valor'])) {
		if ($change_color_table >= 1) {
			$sql_dmd_user .= ',';
		}
		$change_color_table ++;
		$sql_dmd_color .= 'valor = :valor';
		$data_color['valor'] = htmlspecialchars($_POST['valor']);
	}
	if (isset($_FILES['pp']) && !empty($_FILES['pp'])) {
		if ($change_user_table >= 1) {
			$sql_dmd_user .= ',';
		}
		$change_user_table ++;
		$sql_dmd_user .= 'pp = :pp';
		$data_user['pp'] = 1;
		$chemin = '../img_user/' . $_POST['id'] . '_pp.png';
		move_uploaded_file($_FILES['pp']['tmp_name'], $chemin);
	}
	if (isset($_FILES['ban']) && !empty($_FILES['ban'])) {
		if ($change_color_table >= 1) {
			$sql_dmd_user .= ',';
		}
		$change_color_table ++;
		$sql_dmd_color .= 'ban = :ban';
		$data_color['ban'] = 1;
		$chemin = '../img_user/' . $_POST['id'] . '_ban.png';
		move_uploaded_file($_FILES['ban']['tmp_name'], $chemin);
	}
	if (isset($_POST['desc']) && !empty($_POST['desc'])) {
		if ($change_color_table >= 1) {
			$sql_dmd_color .= ',';
		}
		$change_color_table ++;
		$sql_dmd_color .= 'desp = :desc';
		$data_color['desc'] = $_POST['desc'];
	}
	if (isset($_POST['sec']) && !empty($_POST['sec'])) {
		$tab_sec = json_decode($_POST['sec'], true);
		$stmt = $pro_bdd->prepare('UPDATE parms SET vrn = :vrn, vpi = :vpi, vbs = :vbs, vp = :vp, vtl = :vtl WHERE w = :id');
		$stmt->execute([
			'vrn' => $tab_sec[0],
			'vpi' => $tab_sec[1],
			'vbs' => $tab_sec[2],
			'vp' => $tab_sec[3],
			'vtl' => $tab_sec[4],
			'id' => $_POST['id']
		]);
	}
	if ($change_user_table >= 1) {
		$stmt = $pro_bdd->prepare('UPDATE users SET '.$sql_dmd_user.' WHERE use_code = :id');
		$stmt->execute($data_user);
	}
	if ($change_color_table >= 1) {
		$stmt = $pro_bdd->prepare('UPDATE color SET '.$sql_dmd_color.' WHERE w = :id');
		$stmt->execute($data_color);
	}
}