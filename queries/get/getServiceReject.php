<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");

$id = $_GET['service_request_id'];
$result = $mysqli->query("SELECT `service_reject_id`, `message`
FROM `service_reject`
WHERE `service_request_id` = $id");

$rs = $result->fetch_array(MYSQLI_ASSOC);
$outp = "";
$outp .= '{"ServiceRejectId":"'  . $rs["service_reject_id"] . '",';
$outp .= '"Message":"'   . $rs["message"] . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>