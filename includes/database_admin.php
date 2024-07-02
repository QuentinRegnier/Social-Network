<?php 

	define('HOST_pro','localhost');
	define('DB_NAME_pro','admin');
	define('USER_pro','root');
	define('PASS_pro','Nerzus2224!');

	try{
	    $admin_data = new PDO("mysql:host=" . HOST_pro . ";dbname=" . DB_NAME_pro, USER_pro, PASS_pro);
	    $admin_data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
	    echo $e;
	}

?>
