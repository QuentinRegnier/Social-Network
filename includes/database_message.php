<?php 

	define('HOST_msg','localhost');
	define('DB_NAME_msg','chat');
	define('USER_msg','root');
	define('PASS_msg','Nerzus2224!');

	try{
	    $msg_bdd = new PDO("mysql:host=" . HOST_msg . ";dbname=" . DB_NAME_msg, USER_msg, PASS_msg);
	    $msg_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
	    echo $e;
	}

?>
