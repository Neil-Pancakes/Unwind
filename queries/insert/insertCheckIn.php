<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  session_start();

  if(count($request>0)){
    $fn=$request['fn'];
    $mi=$request['mi'];
    $ln=$request['ln'];
    $email=$request['email'];
    $bday=$request['bday'];
    $gender=$request['gender'];
    $cnum=$request['cnum'];
    $pass=$request['pass'];
    $checkin_date=$request['checkin_date'];
    $checkout_date=$request['checkout_date'];
    $adult_qty=$request['adult_qty'];
    $reservation_request_status=$request['reservation_request_status'];
    $user_id=$request['user_id'];
    $employee_id=$_SESSION['employee_id'];
    $room_id=$request['room_id'];

    $return = mysqli_query("INSERT INTO `user_account`
    (`first_name`, `last_name`, `middle_initial`, `email`, `birthdate`, `gender`, `contact_no`, `date_account_created`, `password`)
    VALUES
    ('$first_name', '$last_name', '$middle_initial', '$email', '$birthdate', '$gender', '$contact_no', NOW(), '$password');");

      //if user is successfully created
      if($return==TRUE){

        $return = mysqli_query("INSERT INTO `reservation_request`
        (`reservation_request_date`, `checkin_date`, `checkout_date`, `adult_qty`, `reservation_request_status`, `user_id`, `employee_id`)
        VALUES
        (NOW(), '$checkin_date', '$checkout_date', '$adult_qty', '$reservation_request_status', '$user_id', '$employee_id');");

        //if reservation request is successful
        if($return==TRUE){
          $reservation_request_id=mysqli_insert_id($mysqli);
          $return = mysqli_query("INSERT INTO `room_reserved`
          (`room_id`, `reservation_request_id`,)
          VALUES
          ('$room_id', '$reservation_request_id');");
          echo"Check-In Creation Successful";
        }else{
          echo "Reservation request failed";
        }
      }else{
        echo "User Creation failed";
      }
    }
?>