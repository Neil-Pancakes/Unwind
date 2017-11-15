<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $requestId = $request['reservation_request_id'];
    $roomQty = $request['room_qty'];
    
    $query = "INSERT INTO `reservation`
    (`reservation_request_id`, `room_qty`)
    VALUES
    ('$requestId', '$roomQty');";
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>