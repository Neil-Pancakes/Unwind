<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $name = $request['name'];
    
    $query = "INSERT INTO `menu` 
    (`name`) 
    VALUES 
    ('$name');";
    
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>