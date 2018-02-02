<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $reservationId = $request['id'];
    
    $query = "INSERT INTO `reservation_request`
    (`check_in_start`, `reservation_id`)
    VALUES
    (NOW(), $reservationId);";
    $result = mysqli_query($mysqli, $query);
    echo $result;
  }else{
      echo "error";
  }
?>