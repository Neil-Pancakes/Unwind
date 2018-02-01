<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT COUNT(check_in_id) AS `number`, CONCAT(YEAR(check_in_start),'-',MONTH(check_in_start),'-',DAY(check_in_start)) AS `month`
FROM `check_in`
GROUP BY MONTH(check_in_start)");
$outp = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Month":"'  . $rs['month'] . '",';
    $outp .= '"Number":"'  . $rs['number'] . '"}';
    }

$result = $mysqli->query("SELECT COUNT(check_in_id) AS `number`, CONCAT(YEAR(check_in_start),'-',MONTH(check_in_start),'-',DAY(check_in_start)) AS `month`
FROM `check_in`
GROUP BY YEAR(check_in_start)");
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Month":"'  . $rs['month'] . '",';
    $outp .= '"Number":"'  . $rs['number'] . '"}';
    }

// ask niel laturrr
$result = $mysqli->query("SELECT `f`.`name` AS `food_name`, MONTH(`fo`.`response_time`) AS `food_month`,COUNT(`fi`.`qty`) AS `food_amount`
FROM `food_item` `fi`
INNER JOIN `food_order` `fo`
ON `fo`.`food_order_id` = `fi`.`food_order_id`
AND `fo`.`food_order_status` = 'Completed'
INNER JOIN `food` `f`
ON `f`.`food_id` = `fi`.`food_id`
GROUP BY `fo`.`response_time`;");
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"FoodName":"'  . $rs['food_name'] . '",';
    $outp .= '{"FoodMonth":"'  . $rs['food_month'] . '",';
    $outp .= '"FoodAmount":"'  . $rs['food_amount'] . '"}';
    }

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>