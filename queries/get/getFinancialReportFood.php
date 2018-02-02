<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");

$result = $mysqli->query("SELECT SUM(`fo`.`price`) AS `total`, CONCAT(MONTHNAME(`c`.`check_in_start`), ' ', YEAR(`c`.`check_in_start`)) AS `month`
FROM `food_order` `fo`
INNER JOIN `check_in` `c`
ON `fo`.`check_in_id` = `c`.`check_in_id`
GROUP BY MONTH(`c`.`check_in_start`)
ORDER BY `month`");

$outp = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"Month":"'  . $rs['month'] . '",';
    $outp .= '"Total":"'  . $rs['total'] . '"}';
    }

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>