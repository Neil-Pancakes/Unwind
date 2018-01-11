<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

//$emp_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `r`.`reservation_request_id`, `r`.`reservation_request_date`, `r`.`checkin_date`, `r`.`checkout_date`,
YEAR(`r`.`checkin_date`) AS `checkin_year`, MONTHNAME(`r`.`checkin_date`) AS `checkin_month`, DAY(`r`.`checkin_date`) AS `checkin_day`,
YEAR(`r`.`checkout_date`) AS `checkout_year`, MONTHNAME(`r`.`checkout_date`) AS `checkout_month`, DAY(`r`.`checkout_date`) AS `checkout_day`,
`r`.`adult_qty`, `r`.`child_qty`, `r`.`user_id`, CONCAT(`u`.`first_Name`,' ', `u`.`last_name`) AS `name`
FROM `reservation_request` `r`
INNER JOIN `user_account` `u`
ON `r`.`user_id` = `u`.`user_id` AND `r`.`reservation_request_status` = 'Pending' AND `r`.`checkout_date` > CURDATE()
GROUP BY `u`.`user_id`");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"ReservationRequestId":"'  . $rs["reservation_request_id"] . '",';
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
    $outp .= '"UserId":"'   . $rs["user_id"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>