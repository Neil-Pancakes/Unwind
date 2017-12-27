<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $floor = $request['floor_id'];
    $typeId = $request['room_type_id'];

    $sql = $mysqli->query("SELECT SUBSTRING(`room_number`+1, 2, LENGTH(`room_number`)) AS 'number'
    FROM `room` 
    WHERE `floor_id`=$floor
    ORDER BY `room_number` DESC
    LIMIT 1");

    $rs = $sql->fetch_array(MYSQLI_ASSOC);
    $val = $rs["number"];
    if($rs["number"]==""){
      $val = "01";
    }
    $number = $floor.$val;
    echo $number;
    
    echo $floor;
    echo $typeId;
    $query = "INSERT INTO `room` 
    (`room_number`, `floor_id`, `room_type_id`) 
    VALUES 
    ('$number', '$floor', '$typeId');";
    
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>