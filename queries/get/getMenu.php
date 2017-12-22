<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT `menu_id`, `name` FROM `menu`");
$outp = "";

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"MenuId":"'  . $rs["menu_id"] . '",';
    $outp .= '"Name":"'   . $rs["name"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>