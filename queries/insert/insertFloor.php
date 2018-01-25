<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $floor=$request['floor'];
    $query = "INSERT INTO `floor` (`floor_number`) VALUES ('$floor');";
    $number = $request['floor_number'];
    
    $query = "INSERT INTO `floor` 
    (`floor_number`) 
    VALUES 
    ($number);";
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>