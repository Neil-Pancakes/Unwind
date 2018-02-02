<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");

$id = $_GET['reservation_request_id'];
$result = $mysqli->query("SELECT `reservation_reject_id`, `message`
FROM `reservation_reject`
WHERE `reservation_request_id` = $id");

$rs = $result->fetch_array(MYSQLI_ASSOC);
$outp = "";
$outp .= '{"ReservationRejectId":"'  . $rs["reservation_reject_id"] . '",';
$outp .= '"Message":"'   . $rs["message"] . '"}';
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>