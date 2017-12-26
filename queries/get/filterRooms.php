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
$numAdult = $request['numAdult'];
$numChild = $request['numChild'];

    $result = $mysqli->query("SELECT `r`.`room_id`, `r`.`room_number`, `rr`.`checkin_date`, `rr`.`checkout_date`
    FROM `room` `r`
    INNER JOIN `room_reserved` `res`
    ON `r`.`room_id` = `res`.`room_id`
    INNER JOIN `reservation_request` `rr`
    ON `rr`.`reservation_request_id` = `res`.`reservation_request_id`
    AND ((`rr`.`checkin_date` <= '$checkOut' AND `rr`.`checkout_date` > '$checkIn')
    OR (`rr`.`checkout_date` > '$checkOut' AND `rr`.`checkin_date` <= '$checkIn'))");

$qry = "SELECT `r`.`room_id`, `r`.`room_number`, `t`.`name`, `t`.`price`, `t`.`description`
FROM `room` `r`
INNER JOIN `room_type` `t`
ON `r`.`room_type_id` = `t`.`room_type_id`
AND `r`.`room_status` = 'Available'
AND `t`.`max_adult` >= $numAdult
AND `t`.`max_child` >= $numChild";
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

<?php
    include("../dbconnect.php");

    $conn = OpenCon();
    session_start();
    
    $checkIn = mysqli_real_escape_string($conn, $_POST["check_in_date"]);
    $checkOut = mysqli_real_escape_string($conn, $_POST["check_out_date"]);
    $numAdult = mysqli_real_escape_string($conn, $_POST["numAdult"]);
    $numChild = mysqli_real_escape_string($conn, $_POST["numChild"]);


    $sql = "SELECT `r`.`room_id`, `r`.`room_number`, `t`.`name`, `t`.`price`, `t`.`description`
        FROM `room` `r`
        INNER JOIN `room_type` `t`
        ON `r`.`room_type_id` = `t`.`room_type_id`
        AND `r`.`room_status` = 'Available'
        AND `r`.`room_type_id` = $val
        LIMIT $qty ";

    $result = mysqli_query($conn, $sql);

    if($result){
        if(mysqli_num_rows($result) > 0){    
            $bookingData = array();
            $x = 0;
            while($row = mysqli_fetch_array($result)){
                $bookingData[$x] = array(
                    "roomID" => $row["room_id"],
                    "roomNumber" => $row["room_number"],
                    "Name" => $row["name"],
                    "Price" => $row["price"],
                    "Description" => $row["description"]
                );
                $x++;
            }

            $json = json_encode($roomData);
            echo $json;
        }else{
            echo "no data";
        }
    }else{
        echo "query error";
    }

?>