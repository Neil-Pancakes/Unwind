<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $number = $request['room_number'];
    $floor = $request['floor'];
    $status = $request['room_status'];
    $typeId = $request['room_type_id'];
    
    $query = "INSERT INTO `room` 
    (`room_number`, `floor`, `room_status`, `room_type_id`) 
    VALUES 
    ('$number', '$floor', '$status', '$typeId');";
    
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>