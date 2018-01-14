<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
$ret=0;

$result = $mysqli->query("SELECT `password`
FROM `user_account`
WHERE `username`='".$request["username"]."'");
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if(md5($request["password"]) == $rs["password"]){
        $ret=1;
    }
}

echo $ret;
$mysqli->close();

?>