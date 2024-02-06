<?php
function generatePassword_v($length) {
    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $password;
}
if (isset($_COOKIE['tmp']) && !empty($_COOKIE['tmp'])) {
	$verify = $pro_bdd->prepare('SELECT tmp FROM users WHERE use_code = :use_code');
	$verify->execute([
		'use_code' => $_POST[$id_name]
	]);
	$row = $verify->fetch();
	if ($row[0] != $_COOKIE['tmp']){
		exit();
	}
}