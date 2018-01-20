<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");

$result = $mysqli->query("SELECT `food_id`, `name`, `description`, `price`, `food_picture`, `category`
FROM `food`");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    $outp .= '{"FoodId":"'  . $rs["food_id"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"Description":"'  . $rs["description"] . '",';
    $outp .= '"Picture":"'  . $rs["food_picture"] . '",';
    $outp .= '"Category":"'  . $rs["category"] . '",';
    $outp .= '"Price":"'   . $rs["price"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$mysqli->close();

echo($outp);
?>