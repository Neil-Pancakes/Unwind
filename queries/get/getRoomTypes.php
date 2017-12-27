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
    $outp .= '{"RoomTypeId":"'  . $rs["room_type_id"] . '",';
    $outp .= '"RoomName":"'   . $rs["name"] . '",';
    $outp .= '"RoomPrice":"'   . $rs["price"] . '",';
    $outp .= '"RoomDesc":"'   . $rs["description"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>