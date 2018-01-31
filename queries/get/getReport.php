<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT COUNT(check_in_id)
FROM `check_in`
WHERE `MONTH(check_in_start)`= 1");
$outp = "";
    while($rs = $result->fetch_array(MYSQLI_NUM)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Month":"'  . $x . '",';
    $outp .= '"Number":"'  . $rs[0] . '"}';
    }
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>