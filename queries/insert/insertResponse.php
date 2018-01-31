<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  session_start();

  if(count($request>0)){
    $message = $request['message'];
    $userId = $request['user_id'];
    $inquiryReponseId = $request['inquiry_response_id'];
    $employeeId = $_SESSION['employee_id'];
    
    $query = "INSERT INTO `inquiry`
    (`message`, `inquiry_timestamp`, `user_id`, `inquiry_response_id`, `employee_id`)
    VALUES
    ('$message', NOW(), $userId, $inquiryReponseId, $employeeId);";
    $result = mysqli_query($mysqli, $query);
    echo $query;
  }else{
      echo "error";
  }
?>