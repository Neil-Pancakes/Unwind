<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();
/*
$val = $request['room_type_id'];
$qty = $request['quantity'];
$result = $mysqli->query("SELECT `r`.`room_id`, `r`.`room_number`, `t`.`name`, `t`.`price`, `t`.`description`
FROM `room` `r`
INNER JOIN `room_type` `t`
ON `r`.`room_type_id` = `t`.`room_type_id`
AND `r`.`room_status` = 'Available'
AND `r`.`room_type_id` = $val
LIMIT $qty");
*/

$checkIn = $request['check_in_date'];
$checkOut = $request['check_out_date'];
$type = $request['roomType'];

$result = $mysqli->query("SELECT `r`.`room_id`, `r`.`room_number`, `rr`.`checkin_date`, `rr`.`checkout_date`
FROM `room` `r`
INNER JOIN `room_reserved` `res`
ON `r`.`room_id` = `res`.`room_id` AND `r`.`room_type_id`=$type
INNER JOIN `reservation_request` `rr`
ON `rr`.`reservation_request_id` = `res`.`reservation_request_id`
AND ((`rr`.`checkin_date` <= '$checkOut' AND `rr`.`checkout_date` > '$checkIn')
OR (`rr`.`checkout_date` > '$checkOut' AND `rr`.`checkin_date` <= '$checkIn'))");

$qry = "SELECT `r`.`room_id`, `r`.`room_number`, `t`.`name`, `t`.`price`, `t`.`description`
FROM `room` `r`
INNER JOIN `room_type` `t`
ON `r`.`room_type_id` = `t`.`room_type_id`
AND `r`.`room_status` = 'Available'
AND `r`.`room_type_id` = $type";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    $qry .= "AND NOT `r`.`room_id` = ".$rs['room_id']."";
}

$outp = "";
while($rs = $qry->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"RoomId":"'  . $rs["room_id"] . '",';
    $outp .= '"RoomNumber":"'  . $rs["room_number"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"Price":"'  . $rs["price"] . '",';
    $outp .= '"Desc":"'   . $rs["description"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>