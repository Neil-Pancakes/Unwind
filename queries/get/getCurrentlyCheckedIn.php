<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

$result = $mysqli->query("SELECT `c`.`check_in_id`, `rr`.`checkin_date`, `rr`.`checkout_date`,
CONCAT(`u`.`first_Name`,' ', `u`.`last_name`) AS `name`
FROM `check_in` `c`
INNER JOIN `reservation` `r`
ON `c`.`reservation_id` = `r`.`reservation_id`
INNER JOIN `reservation_request` `rr`
ON `r`.`reservation_request_id` = `rr`.`reservation_request_id`
AND `rr`.`checkin_date` >= CURDATE() AND `rr`.`checkout_date` <= CURDATE()
INNER JOIN `user_account` `u`
ON `rr`.`user_id` = `u`.`user_id`");

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