<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $number=$request['floor'];
    $query = "INSERT INTO `floor` (`floor_number`) VALUES ('$number');";
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>