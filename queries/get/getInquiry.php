<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

//$emp_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `f`.`inquiry_id`, `f`.`message`, `f`.`	user_id`, 
CONCAT(`u`.`first_Name`,' ', `u`.`middle_initial`, ' ', `u`.`last_name`) AS `name`
FROM `inquiry` `f`
INNER JOIN `check_in` `c`
ON `f`.`check_in_id` = `c`.`check_in_id`
INNER JOIN `reservation` `r`
ON `r`.`reservation_id` = `c`.`reservation_id`
INNER JOIN `reservation_request` `rr`
ON `rr`.`reservation_request_id` = `r`.`reservation_request_id`
INNER JOIN `user_account` `u`
ON `rr`.`user_id` = `u`.`user_id`
ORDER BY `c`.`check_in_end`");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"InquiryId":"'  . $rs["inquiry_id"] . '",';
    $outp .= '"message":"'  . $rs["message"] . '",';
    $outp .= '"user_id":"'   . $rs["user_id"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>