<?php
$predisloc = 'predis-2.2.1/autoload.php';
include 'includes/predis.php';
if ($redis->ping() == "PONG") {
    echo "Connexion à Redis établie.";
} else {
    echo "Impossible de se connecter à Redis.";
}