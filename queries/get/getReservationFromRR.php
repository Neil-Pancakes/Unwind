<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$id = $request['reservation_request_id'];
$result = $mysqli->query("SELECT `reservation_id`, `reservation_status` 
FROM `reservation`
WHERE `reservation_request_id` = '$id'");

$rs = $result->fetch_array(MYSQLI_ASSOC);
$outp = "";
$outp .= '{"ReservationId":"'  . $rs["reservation_id"] . '",';
$outp .= '"ReservationStatus":"'   . $rs["reservation_status"]        . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>