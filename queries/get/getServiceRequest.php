<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT `s`.`service_request_id`, `s`.`service_request_date`, `s`.`service_id`, 
`ser`.`service_name`, `ser`.`service_type`, `s`.`check_in_id`, `s`.`service_request_status`,
CONCAT(`u`.`first_Name`,' ', `u`.`middle_initial`, ' ', `u`.`last_name`) AS `name`
FROM `service_request` `s`
INNER JOIN `service` `ser`
ON `s`.`service_id` = `ser`.`service_id`
INNER JOIN `check_in` `c`
ON `s`.`check_in_id` = `c`.`check_in_id`
INNER JOIN `reservation` `r`
ON `c`.`reservation_id` = `r`.`reservation_id`
INNER JOIN `reservation_request` `rr`
ON `r`.`reservation_request_id` = `rr`.`reservation_request_id`
INNER JOIN `user_account` `u`
ON `rr`.`user_id` = `u`.`user_id`
AND `s`.`service_request_status` != 'Completed'
AND `s`.`service_request_status` != 'Rejected'");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"ServiceRequestId":"'  . $rs["service_request_id"] . '",';
    $outp .= '"ServiceRequestDate":"'  . $rs["service_request_date"] . '",';
    $outp .= '"ServiceId":"'  . $rs["service_id"] . '",';
    $outp .= '"ServiceName":"'  . $rs["service_name"] . '",';
    $outp .= '"ServiceType":"'  . $rs["service_type"] . '",';
    $outp .= '"ServiceRequestStatus":"'  . $rs["service_request_status"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"CheckInId":"'   . $rs["check_in_id"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>