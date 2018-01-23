<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $name = $request['foodName'];
    $desc = $request['foodDesc'];
    $price = $request['foodPrice'];
    $category = $request['foodType'];
    
    $query = "INSERT INTO `food` 
    (`name`,`description`, `price`, `category`) 
    VALUES 
    ('$name', '$desc', '$price', '$category');";
    
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>