<?php

    define('HOST','localhost');
    define('DB_NAME','web');
    define('USER','root');
    define('PASS','Nerzus2224!');

    try{
        $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo $e;
    }

?>
