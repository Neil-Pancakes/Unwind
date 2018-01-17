<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
$ret=0;


$result = $mysqli->query("SELECT *
FROM `user_account`
WHERE `email`='".$request["email"]."'");
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if(md5($request["password"]) == $rs["password"]){
        $ret=1;
    }
}

$mysqli->close();

if($ret==1){
session_start();
$_SESSION['email']=$request['email'];
$_SESSION['password']=$request['password'];
// $_SESSION['position']=$request['position'];
// position needed
}

echo $ret;
?>