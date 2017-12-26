<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT `s`.`service_request_id`, `s`.`service_request_date`, `s`.`service_id`, 
`s`.`check_in_id`
FROM `service_request` `s`
INNER JOIN `check_in` `c`
ON `s`.`check_in_id` = `c`.`check_in_id`
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
    $outp .= '{"FoodId":"'  . $rs["food_id"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"Description":"'  . $rs["description"] . '",';
    $outp .= '"Price":"'   . $rs["price"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>