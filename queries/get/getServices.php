<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT `service_id`, `service_name`, `service_type`
FROM `service`");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"ServiceId":"'  . $rs["service_id"] . '",';
    $outp .= '"ServiceName":"'  . $rs["service_name"] . '",';
    $outp .= '"ServiceType":"'   . $rs["service_type"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>