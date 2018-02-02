<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

$inquiryId = $_GET["inquiry_id"];
$result = $mysqli->query("SELECT `i`.`inquiry_id`, `i`.`message`, `u`.`user_id`, DAY(`i`.`inquiry_timestamp`) AS 'day', YEAR(`i`.`inquiry_timestamp`) AS 'year', MONTHNAME(`i`.`inquiry_timestamp`) AS 'month',
CONCAT(`u`.`first_Name`,' ', `u`.`middle_initial`, ' ', `u`.`last_name`) AS `name`, `employee_id`, DATE_FORMAT(`inquiry_timestamp`, '%H:%i') AS 'time'
FROM `inquiry` `i`
INNER JOIN `user_account` `u`
ON `i`.`user_id` = `u`.`user_id`
AND (`i`.`inquiry_id` = $inquiryId OR `i`.`inquiry_response_id` = $inquiryId)");

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
    $outp .= '"EmployeeId":"'  . $rs["employee_id"] . '",';
    $outp .= '"Time":"'  . $rs["time"] . '",';
    $outp .= '"UserId":"'   . $rs["user_id"]        . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>