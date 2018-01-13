<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");

$floorId = $_GET['floorId'];
$result = $mysqli->query("SELECT `r`.`room_id`, `r`.`room_number`, `r`.`room_status`, 
`r`.`room_type_id`, `r`.`floor_id`, `t`.`room_type_picture` 
FROM `room` `r`
INNER JOIN `room_type` `t`
ON `floor_id` = $floorId AND `r`.`room_type_id` = `t`.`room_type_id`
GROUP BY `r`.`room_id`");


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    if($rs["room_status"] == 'Available'){
        $color = "background-color:#ffffff;";
    }else if($rs["room_status"] == 'Occupied'){
        $color = "background-color:#d9d9d9;";
    }else{
        $color = "background-color:#000000;";
    }
    $outp .= '{"RoomId":"'  . $rs["room_id"] . '",';
    $outp .= '"RoomNumber":"'  . $rs["room_number"] . '",';
    $outp .= '"RoomStatus":"'  . $rs["room_status"] . '",';
    $outp .= '"Color":"'  . $color . '",';
    $outp .= '"RoomTypeId":"'  . $rs["room_type_id"] . '",';
    $outp .= '"Picture":"'  . $rs["room_type_picture"] . '",';
    $outp .= '"FloorId":"'   . $rs["floor_id"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>