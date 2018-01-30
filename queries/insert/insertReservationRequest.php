<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){
    $userId = $request['user_id'];
    $rrDate = $request['reservation_request_date'];
    $checkinDate = $request['checkin_date'];
    $checkoutDate = $request['checkout_date'];
    $adultQty = $request['adult_qty'];
    $childQty = $request['child_qty'];
    $employeeId = $_SESSION['employee_id'];
    
    $query = "INSERT INTO `reservation_request`
    (`reservation_request_date`, `checkin_date`, `checkout_date`, `adult_qty`, `child_qty`, 
    `reservation_request_status`, `response_time`, `user_id`, `employee_id`
    VALUES
    ('$rrDate', '$checkinDate', '$checkoutDate', $adultQty, $childQty, 'Accepted', NOW(), $userId, $employeeId);";
    $result = mysqli_query($mysqli, $query);
    echo $result;
  }else{
      echo "error";
  }
?>