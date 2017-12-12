<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");

$floorId = $_GET['floorId'];
$result = $mysqli->query("SELECT `room_id`, `room_number`, `room_status`, `room_type_id`, `floor_id` 
FROM `room`
WHERE `floor_id` = $floorId");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    
    $outp .= '{"RoomId":"'  . $rs["room_id"] . '",';
    $outp .= '"RoomNumber":"'  . $rs["room_number"] . '",';
    $outp .= '"RoomStatus":"'  . $rs["room_status"] . '",';
    $outp .= '"RoomTypeId":"'  . $rs["room_type_id"] . '",';
    $outp .= '"FloorId":"'   . $rs["floor_id"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>