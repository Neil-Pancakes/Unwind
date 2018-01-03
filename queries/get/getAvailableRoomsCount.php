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

$checkIn = '2018-01-05';
$checkOut = '2018-01-31';

$result = $mysqli->query("SELECT `r`.`room_id`, `r`.`room_number`, `rr`.`checkin_date`, `rr`.`checkout_date`
    FROM `room` `r`
    INNER JOIN `room_reserved` `res`
    ON `r`.`room_id` = `res`.`room_id`
    INNER JOIN `reservation_request` `rr`
    ON `rr`.`reservation_request_id` = `res`.`reservation_request_id`
    AND ((`rr`.`checkin_date` <= '$checkOut' AND `rr`.`checkout_date` > '$checkIn')
    OR (`rr`.`checkout_date` > '$checkOut' AND `rr`.`checkin_date` <= '$checkIn'))");

$qry = "SELECT COUNT(*) AS 'type_count', `t`.`room_type_id`, `t`.`name`, `t`.`price`, `t`.`description`
    FROM `room` `r`
    INNER JOIN `room_type` `t`
    ON `r`.`room_type_id` = `t`.`room_type_id`";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    $qry .= " AND NOT `r`.`room_id` = ".$rs['room_id']."";
}
$qry .= " GROUP BY `t`.`room_type_id`";

$result2 = $mysqli->query($qry);

$outp = "";
while($rs2 = $result2->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"RoomTypeId":"'  . $rs2["room_type_id"] . '",';
    $outp .= '"Name":"'  . $rs2["name"] . '",';
    $outp .= '"Name":"'  . $rs2["name"] . '",';
    $outp .= '"Name":"'  . $rs2["name"] . '",';
    $outp .= '"TypeCount":"'   . $rs2["type_count"]        . '"}';
}

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>