<?php 

	define('HOST_pro','localhost');
	define('DB_NAME_pro','profile');
	define('USER_pro','root');
	define('PASS_pro','Nerzus2224!');

	try{
	    $pro_bdd = new PDO("mysql:host=" . HOST_pro . ";dbname=" . DB_NAME_pro, USER_pro, PASS_pro);
	    $pro_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
	    echo $e;
	}

?>
