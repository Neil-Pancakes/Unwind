<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");

$result = $mysqli->query("SELECT `e`.`employee_id`, `e`.`position`, `e`.`email`, `e`.`birthdate`,
`e`.`gender`, `e`.`contact_no`, CONCAT(`e`.`first_Name`,' ', `e`.`middle_initial`, ' ', `e`.`last_name`) AS `name`,
`e`.`picture`
FROM `employee` `e`
ORDER BY `e`.`position`");
$outp = "";

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"EmployeeId":"'  . $rs["employee_id"] . '",';
    $outp .= '"Position":"'  . $rs["position"] . '",';
    $outp .= '"Email":"'  . $rs["email"] . '",';
    $outp .= '"Birthdate":"'  . $rs["birthdate"] . '",';
    $outp .= '"Gender":"'  . $rs["gender"] . '",';
    $outp .= '"ContactNo":"'  . $rs["contact_no"] . '",';
    $outp .= '"Picture":"'  . $rs["picture"] . '",';
    $outp .= '"Name":"'   . $rs["name"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>