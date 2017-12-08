<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT `room_type_id`, `name`, `price`, `description` FROM `room_type`");
$outp = "";

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"RoomTypeId":"'  . $rs["floor_id"] . '",';
    $outp .= '"RoomName":"'   . $rs["floor_number"] . '",';
    $outp .= '"RoomPrice":"'   . $rs["floor_number"] . '",';
    $outp .= '"RoomDesc":"'   . $rs["floor_number"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>