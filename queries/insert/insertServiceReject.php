<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $message = $request['message'];
    $serviceRequestId = $request['id'];
    
    $query = "INSERT INTO `service_reject`
    (`message`, `service_request_id`)
    VALUES
    ('$message', $serviceRequestId);";
    $result = mysqli_query($mysqli, $query);
    echo $result;
  }else{
      echo "error";
  }
?>