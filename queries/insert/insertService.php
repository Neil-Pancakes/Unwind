<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $name = $request['serviceName'];
    $type = $request['serviceType'];
    
    $query = "INSERT INTO `service` 
    (`service_name`, `service_type`) 
    VALUES 
    ('$name', '$type');";
    
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>