<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT `user_id` AS `id`, CONCAT(`first_name`,' ',last_name) AS `username`
FROM `user_account`");
$outp = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"id":"'  . $rs['id'] . '",';
    $outp .= '"name":"'  . $rs['username'] . '"}';
    }

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>