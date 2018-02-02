<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");

$rrId = $_GET['rrId'];
$result = $mysqli->query("SELECT `room_res`.`room_reserved_id`, `r`.`room_number`, `rt`.`name`, `rt`.`price`, 
`rt`.`description`, `rt`.`room_type_picture`
FROM `room_reserved` `room_res`
INNER JOIN `room` `r`
ON `room_res`.`room_id` = `r`.`room_id`
INNER JOIN `room_type` `rt`
ON `r`.`room_type_id` = `rt`.`room_type_id`
INNER JOIN `reservation_request` `rr`
ON `room_res`.`reservation_request_id` = `rr`.`reservation_request_id`
AND `rr`.`reservation_request_id` = $rrId");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"RoomReservedId":"'  . $rs["room_reserved_id"] . '",';
    $outp .= '"RoomNumber":"'  . $rs["room_number"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"Price":"'  . $rs["price"] . '",';
    $outp .= '"Picture":"'  . $rs["room_type_picture"] . '",';
    $outp .= '"Description":"'   . $rs["description"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>