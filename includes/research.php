<?php
$db = mysqli_connect("localhost", "root", "", "web");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($db, $_POST["query"]);
 $value = '%'.$search.'%';
 $query = "SELECT * FROM users WHERE pseudo LIKE '".$value."' OR first_name LIKE '".$value."' OR last_name LIKE '".$value."' LIMIT 20";
}
else
{
 $query = "
  SELECT * FROM users ORDER BY id
 ";
}
$result = mysqli_query($db, $query);
if(mysqli_num_rows($result) > 0)
{
 $output = [];
 while($row = mysqli_fetch_array($result))
 {
    if ($_GET['user'] !== $row["use_code"]) {
        $in_output = Array ( 
            "pseudo" => $row["pseudo"],
            "code" => $row["use_code"]
        );
        array_push($output, $in_output);
    }
 }
 $json = json_encode($output);
 echo "$json";
}
else
{
 echo 'Data Not Found';
}
?>