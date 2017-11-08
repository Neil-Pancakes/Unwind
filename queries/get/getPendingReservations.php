<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

//$emp_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `r`.`reservation_request_id`, `r`.`reservation_request_date`, `r`.`user_id`, CONCAT(`u`.`first_Name`,' ', `u`.`last_name`) AS `name`
FROM `reservation_request` `r`
INNER JOIN `user_account` `u`
ON `r`.`reservation_request_status` = 'Pending'");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"ReservationRequestId":"'  . $rs["reservation_request_id"] . '",';
    $outp .= '"ReservationRequestDate":"'  . $rs["reservation_request_date"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"UserId":"'   . $rs["user_id"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>