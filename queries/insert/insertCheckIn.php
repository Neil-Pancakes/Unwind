<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $reservationId = $request['id'];
    
    $return = mysqli_query("INSERT INTO `room_reserved`
    (`first_name`, `last_name,`, `middle_initial`, `email`, `birthdate`, `gender`, `contact_no`, `date_account_created`, `password`)
    VALUES
    ('$first_name', '$last_name', '$middle_initial', '$email', '$birthdate', '$gender', '$contact_no', NOW(), '$password');");
    if($return=TRUE){
      $user_id = mysqli_insert_id($mysqli);
      $return = mysqli_query("INSERT INTO `reservation_request`
      (`first_name`, `last_name,`, `middle_initial`, `email`, `birthdate`, `gender`, `contact_no`, `date_account_created`, `password`)
      VALUES
      ('$first_name', '$last_name', '$middle_initial', '$email', '$birthdate', '$gender', '$contact_no', NOW(), '$password');");
      }
  }else{
      echo "error";
  }
?>