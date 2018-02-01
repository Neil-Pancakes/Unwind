<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT `f`.`name` AS `food_name`,COUNT(`fi`.`qty`) AS `food_amount`
FROM `food_item` `fi`
INNER JOIN `food_order` `fo`
ON `fo`.`food_order_id` = `fi`.`food_order_id`
AND `fo`.`food_order_status` = 'Completed'
INNER JOIN `food` `f`
ON `f`.`food_id` = `fi`.`food_id`
GROUP BY `fi`.`food_id`;");
$outp = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"FoodName":"'  . $rs['food_name'] . '",';
    $outp .= '"FoodAmount":"'  . $rs['food_amount'] . '"}';
    }

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>