<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

$id = $_SESSION['employee_id'];
$result = $mysqli->query("SELECT `rr`.`reservation_request_id`, `rr`.`reservation_request_date`, `rr`.`checkin_date`, 
`rr`.`checkout_date`, `rr`.`adult_qty`, `rr`.`child_qty`, `rr`.`response_time`, 
CONCAT(`e`.`first_Name`,' ', `e`.`middle_initial`, ' ', `e`.`last_name`) AS `name` 
FROM `reservation_request` `rr`
INNER JOIN `employee` `e`
ON  `rr`.`employee_id` = `e`.`employee_id
AND `employee_id` = $id");
$outp = "";

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"ReservationRequestId":"'  . $rs["reservation_request_id"] . '",';
    $outp .= '"ReservationRequestDate":"'  . $rs["reservation_request_date"] . '",';
    $outp .= '"CheckInDate":"'  . $rs["checkin_date"] . '",';
    $outp .= '"CheckOutDate":"'  . $rs["checkout_date"] . '",';
    $outp .= '"AdultQty":"'  . $rs["adult_qty"] . '",';
    $outp .= '"ChildQty":"'  . $rs["child_qty"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"ResponseTime":"'   . $rs["response_time"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>