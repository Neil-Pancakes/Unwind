<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

//$emp_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `rr`.`reservation_request_id`, `rr`.`reservation_request_date`, `rr`.`checkin_date`, `rr`.`checkout_date`,
YEAR(`rr`.`checkin_date`) AS `checkin_year`, MONTHNAME(`rr`.`checkin_date`) AS `checkin_month`, DAY(`rr`.`checkin_date`) AS `checkin_day`,
YEAR(`rr`.`checkout_date`) AS `checkout_year`, MONTHNAME(`rr`.`checkout_date`) AS `checkout_month`, DAY(`rr`.`checkout_date`) AS `checkout_day`,
`rr`.`adult_qty`, `rr`.`child_qty`, `rr`.`user_id`, CONCAT(`u`.`first_Name`,' ', `u`.`middle_initial`, ' ', `u`.`last_name`) AS `name`,
`r`.`reservation_status`, `r`.`reservation_id`
FROM `reservation_request` `rr`
INNER JOIN `user_account` `u`
ON `rr`.`user_id` = `u`.`user_id` 
INNER JOIN `reservation` `r`
ON `rr`.`reservation_request_id` = `r`.`reservation_request_id`
AND `r`.`reservation_status` = 'Waiting'
GROUP BY `u`.`user_id`");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"ReservationRequestId":"'  . $rs["reservation_request_id"] . '",';
    $outp .= '"ReservationId":"'  . $rs["reservation_id"] . '",';
    $outp .= '"ReservationRequestDate":"'  . $rs["reservation_request_date"] . '",';
    $outp .= '"CheckInDate":"'  . $rs["checkin_date"] . '",';
    $outp .= '"CheckOutDate":"'  . $rs["checkout_date"] . '",';
    $outp .= '"CheckInYear":"'  . $rs["checkin_year"] . '",';
    $outp .= '"CheckInMonth":"'  . $rs["checkin_month"] . '",';
    $outp .= '"CheckInDay":"'  . $rs["checkin_day"] . '",';
    $outp .= '"CheckOutYear":"'  . $rs["checkout_year"] . '",';
    $outp .= '"CheckOutMonth":"'  . $rs["checkout_month"] . '",';
    $outp .= '"CheckOutDay":"'  . $rs["checkout_day"] . '",';
    $outp .= '"AdultQty":"'  . $rs["adult_qty"] . '",';
    $outp .= '"ChildQty":"'  . $rs["child_qty"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"Status":"'  . $rs["reservation_status"] . '",';
    $outp .= '"UserId":"'   . $rs["user_id"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>