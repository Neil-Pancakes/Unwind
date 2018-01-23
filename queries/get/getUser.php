<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
$ret=0;
$result = $mysqli->query("SELECT *
FROM `employee`
WHERE `email`='".$request["email"]."'");
while($ret==0 && $rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if(md5($request["password"]) == $rs["password"]){
        $ret=1;
    }
}
$mysqli->close();
if($ret==1){
session_start();
$_SESSION['email']=$rs['email'];
$_SESSION['name']=$rs['first_name']." ".$rs['last_name'];
$_SESSION['position']=$rs['position'];
// $_SESSION['position']=$request['position'];
// position needed
}
echo $ret;
?>