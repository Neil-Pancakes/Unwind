<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");

$result = $mysqli->query("SELECT SUM(`rt`.`price`) AS `total`, CONCAT(MONTHNAME(`c`.`check_in_start`), ' ', YEAR(`c`.`check_in_start`)) AS `month`
FROM `room_reserved` `room_res`
INNER JOIN `room` `r`
ON `room_res`.`room_id` = `r`.`room_id`
INNER JOIN `room_type` `rt`
ON `r`.`room_type_id` = `rt`.`room_type_id`
INNER JOIN `reservation_request` `rr`
ON `room_res`.`reservation_request_id` = `rr`.`reservation_request_id`
INNER JOIN `reservation` `res`
ON `rr`.`reservation_request_id` = `res`.`reservation_request_id`
INNER JOIN `check_in` `c`
ON `res`.`reservation_id` = `c`.`reservation_id`
AND (`res`.`reservation_status` = 'Checked-in' OR `res`.`reservation_status` = 'Checked-out')
GROUP BY MONTH(`c`.`check_in_start`)
ORDER BY `month`");

$outp = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Month":"'  . $rs['month'] . '",';
    $outp .= '"Total":"'  . $rs['total'] . '"}';
    }

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>