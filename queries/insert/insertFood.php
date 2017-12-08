<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $name = $request['foodName'];
    $desc = $request['foodDesc'];
    $price = $request['foodPrice'];
    $menuId = $request['menu_id'];
    
    $query = "INSERT INTO `food` 
    (`name`,`description`, `price`, `menu_id`) 
    VALUES 
    ('$name', '$desc', '$price', '$menuId');";
    
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>