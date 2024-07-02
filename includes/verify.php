<?php
function generatePassword_v($length) {
    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $password;
}
if (isset($_COOKIE['tmp']) && !empty($_COOKIE['tmp']) && isset($_COOKIE['id']) && !empty($_COOKIE['id'])) {
	$verify = $pro_bdd->prepare('SELECT tmp FROM users WHERE use_code = :use_code');
	$verify->execute([
		'use_code' => $_COOKIE['id']
	]);
	$row = $verify->fetch();
	if ($row[0] === $_COOKIE['tmp']) {
		$identity = true;
		$pass_id = generatePassword_v(18);
		setcookie('tmp', $pass_id, time() + 365*24*3600, '/', '127.0.0.1', false, true);
		$update_verify = $pro_bdd->prepare('UPDATE users SET tmp = :tmp WHERE use_code = :use_code');
		$update_verify->execute([
			'tmp' => $pass_id,
			'use_code' => $_COOKIE['id']
		]);
	}
	else{
		$identity = false;
		header("Location: login.php");
	}
}
else{
	header("Location: login.php");
}
