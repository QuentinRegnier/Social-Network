<?php
$friend_verify = false;
$parms =  $pro_bdd->prepare('SELECT * FROM parms WHERE w =:id');
$parms->execute([
	"id" => $id_user
]);
$parmsresult = $parms->fetch();
$friend = $pro_bdd->prepare('SELECT state FROM sub WHERE w=:id');
$friend->execute([
	"id" => $id_user_live
]);
$friendresult = $friend->fetch();
if ($friendresult['state'] == 1) {
	$friend_verify = true;
}else{
	$friend_verify = false;
}
if ($parmsresult['vrn'] == 1) {
	$vrn = true;
}elseif ($parmsresult['vrn'] == 2) {
	if ($friend_verify == true) {
		$vrn = true;
	}else{
		$vrn = false;
	}
}elseif ($parmsresult['vrn'] == 3) {
	$vrn = false;
}
if ($parmsresult['vpi'] == 1) {
	$vpi = true;
}elseif ($parmsresult['vpi'] == 2) {
	if ($friend_verify == true) {
		$vpi = true;
	}else{
		$vpi = false;
	}
}elseif ($parmsresult['vpi'] == 3) {
	$vpi = false;
}
if ($parmsresult['vbs'] == 1) {
	$vbs = true;
}elseif ($parmsresult['vbs'] == 2) {
	if ($friend_verify == true) {
		$vbs = true;
	}else{
		$vbs = false;
	}
}elseif ($parmsresult['vbs'] == 3) {
	$vbs = false;
}
if ($parmsresult['vp'] == 1) {
	$vp = true;
}elseif ($parmsresult['vp'] == 2) {
	if ($friend_verify == true) {
		$vp = true;
	}else{
		$vp = false;
	}
}elseif ($parmsresult['vp'] == 3) {
	$vp = false;
}
if ($parmsresult['vtl'] == 1) {
	$vtl = true;
}elseif ($parmsresult['vtl'] == 2) {
	if ($friend_verify == true) {
		$vtl = true;
	}else{
		$vtl = false;
	}
}elseif ($parmsresult['vtl'] == 3) {
	$vtl = false;
}