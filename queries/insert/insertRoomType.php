<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $name = $request['name'];
    $price = $request['price'];
    $desc = $request['description'];
    
    $query = "INSERT INTO `room_type` 
    (`name`, `price`, `description`) 
    VALUES 
    ('$name', '$price', '$desc');";
    
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>