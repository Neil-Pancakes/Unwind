<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT COUNT(`rt`.`name`) AS `rtnum`, `rt`.`name` AS `rtname`
FROM `room_reserved` `rr`
INNER JOIN `reservation_request` `rq`
ON `rq`.`reservation_request_id` = `rr`.`reservation_request_id`
AND `rq`.`reservation_request_status` = 'Accepted'
INNER JOIN `room` `r`
ON `r`.`room_id` = `rr`.`room_id`
INNER JOIN `room_type` `rt`
ON `rt`.`room_type_id` = `r`.`room_type_id`
GROUP BY `rt`.`room_type_id`;");
$outp = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"rtnum":"'  . $rs['rtnum'] . '",';
    $outp .= '"rtname":"'  . $rs['rtname'] . '"}';
    }

$outp ='{"rtrecords":['.$outp.']}';
$mysqli->close();

echo($outp);
?>