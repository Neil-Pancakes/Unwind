<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
session_start();

//$emp_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT
SUM(CASE WHEN `f`.`rating` = 5 THEN 1 ELSE 0 END) AS `fiveCnt`,
SUM(CASE WHEN `f`.`rating` = 4 THEN 1 ELSE 0 END) AS `fourCnt`,
SUM(CASE WHEN `f`.`rating` = 3 THEN 1 ELSE 0 END) AS `threeCnt`,
SUM(CASE WHEN `f`.`rating` = 2 THEN 1 ELSE 0 END) AS `twoCnt`,
SUM(CASE WHEN `f`.`rating` = 1 THEN 1 ELSE 0 END) AS `oneCnt`,
SUM(CASE WHEN `f`.`rating` = 0 THEN 1 ELSE 0 END) AS `zeroCnt`
FROM `feedback` `f`");

$rs = $result->fetch_array(MYSQLI_ASSOC);
$outp = "";
$outp .= '{"FiveCnt":"'  . $rs["fiveCnt"] . '",';
$outp .= '"FourCnt":"'  . $rs["fourCnt"] . '",';
$outp .= '"ThreeCnt":"'  . $rs["threeCnt"] . '",';
$outp .= '"TwoCnt":"'  . $rs["twoCnt"] . '",';
$outp .= '"OneCnt":"'  . $rs["oneCnt"] . '",';
$outp .= '"ZeroCnt":"'   . $rs["zeroCnt"]        . '"}';

$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>