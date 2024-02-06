<?php
include 'database.php';
global $db;
if (isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['pub']) && !empty($_POST['pub'])) {
    $stmt1 = $db->prepare('SELECT id FROM like_pub WHERE pub = :pub');
    $stmt1->execute([
        'pub' => $_POST['pub']
    ]);
    $stmt2 = $db->prepare('SELECT id FROM like_pub WHERE pub = :pub AND user = :user');
    $stmt2->execute([
        'pub' => $_POST['pub'],
        'user' => $_POST['user']
    ]);
    if ($stmt2->rowCount() == 1) {
        $yn = 1;
    } else {
        $yn = 0;
    }
    $tab = [
        'num' => $stmt1->rowCount(),
        'yn' => $yn
    ];
    echo(json_encode($tab));
}
?>
