<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $roomId = $request['room_id'];
    $reservationRequestId = $request['reservation_request_id'];
    
    $query = "INSERT INTO `room_reserved`
    (`room_id`, `reservation_id`)
    VALUES
    ('$roomId', '$reservationRequestId');";
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>