<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $message = $request['message'];
    $reservationRequestId = $request['id'];
    
    $query = "INSERT INTO `reservation_reject`
    (`message`, `reservation_request_id`)
    VALUES
    ('$message', $reservationRequestId);";
    $result = mysqli_query($mysqli, $query);
    echo $result;
  }else{
      echo "error";
  }
?>