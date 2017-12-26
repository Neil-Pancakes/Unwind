<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $name = $request['name'];
    $price = $request['price'];
    $desc = $request['description'];
    $maxAdult = $request['max_adult'];
    $maxChild = $request['max_child'];
    
    $query = "INSERT INTO `room_type` 
    (`name`, `price`, `description`, `max_adult`, `max_child`) 
    VALUES 
    ('$name', '$price', '$desc', $maxAdult, $maxChild);";
    
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>