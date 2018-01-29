<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT `f`.`food_order_id`, `f`.`food_order_status`, `f`.`response_time`, `f`.`price`,
CONCAT(`u`.`first_Name`,' ', `u`.`middle_initial`, ' ', `u`.`last_name`) AS `name`,
CONCAT(`e`.`first_Name`,' ', `e`.`middle_initial`, ' ', `e`.`last_name`) AS `employee_name` 
FROM `food_order` `f`
INNER JOIN `employee` `e`
ON  `f`.`employee_id` = `e`.`employee_id`
INNER JOIN `check_in` `c`
ON `f`.`check_in_id` = `c`.`check_in_id`
INNER JOIN `reservation` `r`
ON `c`.`reservation_id` = `r`.`reservation_id`
INNER JOIN `reservation_request` `rr`
ON `r`.`reservation_request_id` = `rr`.`reservation_request_id`
INNER JOIN `user_account` `u`
ON `rr`.`user_id` = `u`.`user_id`");
$outp = "";

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"FoodOrderId":"'  . $rs["food_order_id"] . '",';
    $outp .= '"FoodOrderStatus":"'  . $rs["food_order_status"] . '",';
    $outp .= '"ResponseTime":"'  . $rs["response_time"] . '",';
    $outp .= '"Price":"'  . $rs["price"] . '",';
    $outp .= '"EmployeeName":"'  . $rs["employee_name"] . '",';
    $outp .= '"Name":"'   . $rs["name"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>