<?php
include 'database_profile.php';
global $pro_bdd;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $pseudo = $_GET['id'];
    $query = "SELECT use_code FROM users WHERE pseudo = :pseudo";
    $stmt = $pro_bdd->prepare($query);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $id_user_live = $_COOKIE['id'];
        $useCode = $row['use_code'];  
        $stmt_ban_verif = $pro_bdd->prepare('SELECT id FROM ban WHERE pp = :id_user AND b = :id_user_live');
        $stmt_ban_verif->execute([
            "id_user" => $useCode,
            "id_user_live" => $id_user_live
        ]);
        if ($stmt_ban_verif->rowCount() == 0) {
            include '../profile.php';
            exit();
        } else {
            include '../404.php';
        }
    } else {
        include '../404.php';
    }
    $stmt->closeCursor();
} else {
    include '../404.php'; 
}
?>
