<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

//$emp_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT `i`.`inquiry_id`, `i`.`message`, `u`.`user_id`, DAY(`i`.`inquiry_timestamp`) AS 'day', YEAR(`i`.`inquiry_timestamp`) AS 'year', MONTH(`i`.`inquiry_timestamp`) AS 'month',
CONCAT(`u`.`first_Name`,' ', `u`.`middle_initial`, ' ', `u`.`last_name`) AS `name`
FROM `inquiry` `i`
INNER JOIN `user_account` `u`
ON `i`.`user_id` = `u`.`user_id`
ORDER BY `i`.`inquiry_timestamp` DESC");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"InquiryId":"'  . $rs["inquiry_id"] . '",';
    $outp .= '"Message":"'  . $rs["message"] . '",';
    $outp .= '"Month":"'  . $rs["month"] . '",';
    $outp .= '"Day":"'  . $rs["day"] . '",';
    $outp .= '"Year":"'  . $rs["year"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"UserId":"'   . $rs["user_id"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>