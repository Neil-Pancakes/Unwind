<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

//$emp_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `o`.`food_order_id`, `o`.`price`, `o`.`timestamp_ordered`, 
CONCAT(`u`.`first_Name`,' ', `u`.`middle_initial`, ' ', `u`.`last_name`) AS `name`
FROM `food_order` `o`
INNER JOIN `check_in` `c`
ON `o`.`check_in_id` = `c`.`check_in_id`
INNER JOIN `reservation` `r`
ON `r`.`reservation_id` = `c`.`reservation_id`
INNER JOIN `reservation_request` `rr`
ON `rr`.`reservation_request_id` = `r`.`reservation_request_id`
INNER JOIn `user_account` `u`
ON `rr`.`user_id` = `u`.`user_id`
ORDER BY `o`.`timestamp_ordered`");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"FoodOrderId":"'  . $rs["food_order_id"] . '",';
    $outp .= '"Price":"'  . $rs["price"] . '",';
    $outp .= '"TimestampOrdered":"'  . $rs["timestamp_ordered"] . '",';
    $outp .= '"Name":"'   . $rs["name"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>