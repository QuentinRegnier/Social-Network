<?php
include 'database_profile.php';
        global $pro_bdd;
$output = '';
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    $ids = array();
    $output = [];
    $stmt1 = $pro_bdd->prepare('SELECT s FROM sub WHERE w = :w AND (state = 0 OR state = 1)');
    $stmt1->execute([
        'w' => $id
    ]);
    if ($stmt1->rowCount() != 0) {
        while ($row = $stmt1->fetch()) {
            $ids[] = $row['s'];
        }
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt2 = $pro_bdd->prepare('SELECT pseudo, use_code FROM users WHERE use_code IN (' . $placeholders . ')');
        $stmt2->execute($ids);
        while ($row = $stmt2->fetch()) {
            $stmt3 = $pro_bdd->prepare('SELECT state FROM sub WHERE w = :w AND s = :s');
            $stmt3->execute([
                'w' => $id,
                's' => $row["use_code"]
            ]);
            $value = $stmt3->fetch();
            $in_output = Array ( 
                "pseudo" => $row["pseudo"],
                "code" => $row["use_code"],
                "state" => $value[0]
            );
            array_push($output, $in_output);
        }
        $json = json_encode($output);
        echo "$json";
    }
}
?>